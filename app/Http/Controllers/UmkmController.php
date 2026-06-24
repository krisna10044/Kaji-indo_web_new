<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Member;
use App\Models\Team;
use App\Models\Produk;
use App\Models\Mentor;
use App\Models\ProdukItem;
use App\Models\MentorUlasan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UmkmController extends Controller
{
    public function index(): View
    {
        $members = Member::all();
        $teams = Team::all();

        return view('pages.umkm', [
            'title' => 'UMKM',
            'metaDescription' => 'Pendampingan dan penguatan kapasitas UMKM oleh KAJI Indonesia.',
            'members' => $members,
            'teams' => $teams,
        ]);
    }

    public function produk(): View
{
    $produks = ProdukItem::where('is_unggulan', true)
        ->whereHas('produk', function($q) {
    $q->where('status', 'approved');
})
        ->with('produk')
        ->latest()
        ->get();

    return view('pages.umkm-produk', [
        'title' => 'Produk UMKM',
        'produks' => $produks,
    ]);
}

public function produkDetail($id): View
{
    // Hapus where is_unggulan agar semua item bisa dibuka
    $item = ProdukItem::with('produk')
        ->whereHas('produk', fn($q) => $q->where('status', 'approved'))
        ->findOrFail($id);

    $itemLainnya = ProdukItem::where('produk_id', $item->produk_id)
        ->where('id', '!=', $item->id)
        ->get();

    return view('pages.detail-produk', [
        'title'           => $item->nama,
        'metaDescription' => $item->deskripsi,
        'item'            => $item,
        'produk'          => $item->produk,
        'itemLainnya'     => $itemLainnya,
    ]);
}

public function produkProfil($id): View
{
    $produk = Produk::where('status', 'approved')->findOrFail($id);

    $items = ProdukItem::where('produk_id', $produk->id)
        ->orderByDesc('is_unggulan')
        ->latest()
        ->get();

    $item = $items->first();

    // $itemLainnya = semua item selain yang pertama (unggulan)
    $itemLainnya = $items->skip(1)->values();

    return view('pages.detail-produk', [
        'title'           => $produk->nama,
        'metaDescription' => $produk->deskripsi ?? '',
        'produk'          => $produk,
        'items'           => $items,
        'item'            => $item,
        'itemLainnya'     => $itemLainnya, // ← tambah ini
    ]);
}

    public function pembimbing(): View
    {
        $trainers = Mentor::where('status', 'approved')
            ->withCount('ulasanList')
            ->with('ulasanList')
            ->latest('reviewed_at')
            ->paginate(12);

        return view('pages.umkm-pembimbing', [
            'title' => 'Pembimbing UMKM',
            'metaDescription' => 'Tim pembimbing UMKM yang berpengalaman di KAJI Indonesia.',
            'trainers' => $trainers,
        ]);
    }

   public function showMentor($id): View
{
    $mentor = Mentor::where('status', 'approved')->findOrFail($id);

    $connectedUmkm = $mentor->produks()
        ->where('status', 'approved')
        ->get();

    $ulasan      = $mentor->ulasanList()->with('user')->latest()->get();
    $avgRating   = $ulasan->avg('rating') ?? 0;
    $totalUlasan = $ulasan->count();

    $bisaMemberiUlasan = false;
    $sudahUlasan       = false;

   if (Auth::check()) {
    $user = Auth::user();

    $produkUser = Produk::where('user_id', $user->id)
        ->where('status', 'approved')
        ->whereExists(function ($query) use ($mentor) {
            $query->selectRaw(1)
                ->from('produk_mentor')
                ->whereColumn('produk_mentor.produk_id', 'produks.id')
                ->where('produk_mentor.mentor_id', $mentor->id);
        })
        ->first();

    // ← Tambah ini sementara
    Log::info('Debug ulasan', [
        'user_id'            => $user->id,
        'mentor_id'          => $mentor->id,
        'produkUser_id'      => $produkUser?->id ?? 'NULL - tidak ditemukan',
        'bisaMemberiUlasan'  => $produkUser ? 'true' : 'false',
    ]);

    if ($produkUser) {
        $bisaMemberiUlasan = true;
        $sudahUlasan = MentorUlasan::where('mentor_id', $mentor->id)
            ->where('user_id', $user->id)
            ->exists();
    }
}

    // ← SATU return saja, di luar semua blok if
    return view('pages.detail-pembimbing', [
        'mentor'            => $mentor,
        'connectedUmkm'     => $connectedUmkm,
        'avgRating'         => $avgRating,
        'totalUlasan'       => $totalUlasan,
        'ulasan'            => $ulasan,
        'bisaMemberiUlasan' => $bisaMemberiUlasan,
        'sudahUlasan'       => $sudahUlasan,
    ]);
}

    public function lokasi(): View
    {
        return view('pages.umkm-lokasi', [
            'title' => 'Lokasi UMKM',
            'metaDescription' => 'Lokasi UMKM yang didampingi oleh KAJI Indonesia.',
        ]);
    }

    // =========================================================
    // API DATA PETA UMKM
    // =========================================================

    public function apiPeta()
    {
        $this->geocodeBelumAda();

        $produks = Produk::where('status', 'approved')
            ->whereNotNull('lat')
            ->whereNotNull('lng')
            ->select([
                'id',
                'nama',
                'logo',
                'foto_produk',
                'alamat',
                'lat',
                'lng',
                'provinsi',
                'kabupaten_kota',
                'kecamatan'
            ])
            ->get();

        $data = [];

        foreach ($produks as $p) {

            $fotoFile = $p->logo ?: $p->foto_produk;

        $fotoFile = $p->logo ?: $p->foto_produk;

// Cek apakah sudah ada 'produk-pict/' di path-nya
$fotoUrl = null;
if ($fotoFile) {
    if (str_starts_with($fotoFile, 'http')) {
        $fotoUrl = $fotoFile;
    } elseif (str_contains($fotoFile, '/')) {
        // sudah ada subfolder, langsung pakai storage/
        $fotoUrl = asset('storage/' . $fotoFile);
    } else {
        // hanya nama file
        $fotoUrl = asset('storage/produk-pict/' . $fotoFile);
    }
}

            $wilayah = trim(implode(', ', array_filter([
                $p->kecamatan,
                $p->kabupaten_kota,
                $p->provinsi
            ])));

            $alamatTampil = $p->alamat ?: $wilayah;

            $data[] = [
                'id' => $p->id,
                'nama' => $p->nama,
                'alamat' => $alamatTampil,
                'foto' => $fotoUrl,
                'lat' => (float) $p->lat,
                'lng' => (float) $p->lng,
            ];
        }

        return response()->json([
            'status' => 'success',
            'total' => count($data),
            'data' => $data,
        ]);
    }

    public function petaData()
{
    $this->geocodeBelumAda();

    $totalApproved = Produk::where('status', 'approved')
        ->whereHas('user', fn($q) => $q->where('role', 'umkm'))
        ->count();

    $produks = Produk::where('status', 'approved')
        ->whereHas('user', fn($q) => $q->where('role', 'umkm'))
        ->whereNotNull('lat')
        ->whereNotNull('lng')
        ->where('lat', '!=', 0)
        ->where('lng', '!=', 0)
        ->select([
            'id',
            'nama',
            'logo',
            'foto_produk',
            'alamat',
            'lat',
            'lng',
            'provinsi',
            'kabupaten_kota',
            'kecamatan',
            'user_id'
        ])
        ->get();

        $data = [];

        foreach ($produks as $p) {

            if (!$this->koordinatValid((float) $p->lat, (float) $p->lng)) {
                continue;
            }

            $fotoFile = $p->logo ?: $p->foto_produk;

$fotoUrl = null;
if ($fotoFile) {
    if (str_starts_with($fotoFile, 'http')) {
        $fotoUrl = $fotoFile;
    } elseif (str_contains($fotoFile, '/')) {
        $fotoUrl = asset('storage/' . $fotoFile);
    } else {
        $fotoUrl = asset('storage/produk-pict/' . $fotoFile);
    }
}

            $wilayah = trim(implode(', ', array_filter([
                $p->kecamatan,
                $p->kabupaten_kota,
                $p->provinsi
            ])));

            $alamatTampil = $p->alamat ?: $wilayah;

            $data[] = [
                'id' => $p->id,
                'nama' => $p->nama,
                'alamat' => $alamatTampil,
                'foto' => $fotoUrl,
                'lat' => (float) $p->lat,
                'lng' => (float) $p->lng,
            ];
        }

        return response()->json([
            'data' => $data,
            'total_approved' => $totalApproved,
            'total_mapped' => count($data),
        ]);
    }

    // =========================================================
    // PETA MENTOR
    // =========================================================

    public function petaDataMentor()
    {
        $totalApproved = Mentor::where('status', 'approved')
            ->whereHas('user', fn($q) => $q->where('role', 'mentor'))
            ->count();
    
        $mentors = Mentor::where('status', 'approved')
            ->whereHas('user', fn($q) => $q->where('role', 'mentor'))
            ->get();

        $data = [];

        foreach ($mentors as $m) {

            if ($m->lat && $m->lng) {

                $koordinat = [
                    'lat' => (float) $m->lat,
                    'lng' => (float) $m->lng
                ];

            } else {

                $wilayah = trim(implode(', ', array_filter([
                    $m->kecamatan,
                    $m->kabupaten,
                    $m->provinsi
                ])));

                $alamatGeocode = $m->gmaps_location ?: ($wilayah ?: $m->lokasi);

                if (!$alamatGeocode) {
                    continue;
                }

                $koordinat = $this->geocodeAlamat($alamatGeocode);

                if (!$koordinat) {
                    continue;
                }

                $m->update([
                    'lat' => $koordinat['lat'],
                    'lng' => $koordinat['lng'],
                ]);
            }

            $fotoPath = null;

if ($m->white_bg_photo) {
    $fotoPath = asset('storage/' . $m->white_bg_photo);
} elseif ($m->foto) {
    $fotoPath = asset('storage/' . $m->foto); // ← hapus 'pembimbing/', foto sudah include path lengkap
}

            $data[] = [
                'id' => $m->id,
                'nama' => $m->full_name ?: $m->nama,
                'lokasi' => $m->gmaps_location ?: ($m->lokasi ?: implode(', ', array_filter([$m->kecamatan, $m->kabupaten, $m->provinsi]))),
                'foto' => $fotoPath,
                'lat' => $koordinat['lat'],
                'lng' => $koordinat['lng'],
            ];
        }

        return response()->json([
            'data' => $data,
            'total_approved' => $totalApproved,
            'total_mapped' => count($data),
        ]);
    }

    // =========================================================
    // GEOCODING
    // =========================================================

    private function geocodeBelumAda(): void
{
    $belum = Produk::where('status', 'approved')
        ->whereHas('user', fn($q) => $q->where('role', 'umkm'))
        ->where(function ($q) {
            $q->whereNull('lat')
              ->orWhereNull('lng');
        })
        ->get();

        foreach ($belum as $produk) {

            $wilayah = trim(implode(', ', array_filter([
                $produk->kecamatan,
                $produk->kabupaten_kota,
                $produk->provinsi
            ])));

            $alamatGeocode = $produk->alamat ?: $wilayah;

            if (!$alamatGeocode) {
                continue;
            }

            $koordinat = $this->geocodeAlamat($alamatGeocode);

            if ($koordinat) {

                $produk->update([
                    'lat' => $koordinat['lat'],
                    'lng' => $koordinat['lng'],
                ]);
            }

            usleep(500000);
        }
    }

    private function koordinatValid(float $lat, float $lng): bool
    {
        return $lat >= -11 &&
               $lat <= 6 &&
               $lng >= 95 &&
               $lng <= 141;
    }

    private function geocodeAlamat(string $alamat): ?array
    {
        try {

            $response = Http::timeout(8)
                ->withHeaders([
                    'User-Agent' => 'KaryaKamiUMKMApp/1.0',
                ])
                ->get('https://nominatim.openstreetmap.org/search', [
                    'q' => $alamat . ', Indonesia',
                    'format' => 'json',
                    'limit' => 1,
                ]);

            $hasil = $response->json();

            if (!empty($hasil)) {

                return [
                    'lat' => (float) $hasil[0]['lat'],
                    'lng' => (float) $hasil[0]['lon'],
                ];
            }

        } catch (\Exception $e) {

            Log::error('Geocode Error: ' . $e->getMessage());
        }

        return null;
    }
}
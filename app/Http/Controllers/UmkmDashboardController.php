<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Produk;
use App\Models\ProdukItem;
use App\Models\Program;
use App\Models\Mentor;

class UmkmDashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $myProducts = Produk::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

    $myUmkm = Produk::where('user_id', $user->id)
        ->where('status', 'approved')
        ->with('mentors')
        ->latest()
        ->first();

    $myMentors = $myUmkm ? $myUmkm->mentors : collect();

    $produkItems = ProdukItem::where('user_id', $user->id)
        ->orderByDesc('is_unggulan')
        ->orderBy('created_at')
        ->get();

    // ── Produk terhapus (soft deleted) ──────────────────────── ← TAMBAH INI
    $produkTerhapus = $myUmkm
        ? ProdukItem::onlyTrashed()
            ->where('produk_id', $myUmkm->id)
            ->latest('deleted_at')
            ->get()
        : collect();

    $availablePrograms = Program::published()->latest()->get();

    $joinedProgramIds = \DB::table('pendaftaran_programs')
        ->where('user_id', $user->id)
        ->pluck('program_id')
        ->toArray();

    $stats = [
        'total_produk'    => $myProducts->count(),
        'pending_produk'  => $myProducts->where('status', 'pending')->count(),
        'active_produk'   => $myProducts->where('status', 'approved')->count(),
        'program_diikuti' => count($joinedProgramIds),
    ];

    return view('profile.dashboard-umkm', compact(
        'user',
        'myProducts',
        'myUmkm',
        'myMentors',
        'produkItems',
        'produkTerhapus', // ← TAMBAH INI
        'availablePrograms',
        'joinedProgramIds',
        'stats',
    ));
}

    public function joinProgram($id)
    {
        $user = Auth::user();

        if (!$user->programs()->where('program_id', $id)->exists()) {
            $user->programs()->attach($id, ['status' => 'joined']);
        }

        return back()->with('success', 'Berhasil mendaftar program pelatihan!');
    }

    // =========================================================
    // PILIH MENTOR (multi-mentor via pivot)
    // =========================================================
    public function pilihMentor($mentorId)
    {
        $user = Auth::user();

        $umkm = Produk::where('user_id', $user->id)
                      ->where('status', 'approved')
                      ->first();

        if (!$umkm) {
            return redirect()->route('umkm.mentor.detail', $mentorId)
                ->with('error', 'Profil UMKM Anda belum disetujui admin.');
        }

        $mentor = Mentor::where('status', 'approved')->find($mentorId);

        if (!$mentor) {
            return redirect()->route('umkm.mentor.detail', $mentorId)
                ->with('error', 'Mentor tidak ditemukan.');
        }

        // Cek sudah terhubung
        if ($umkm->mentors()->where('mentor_id', $mentorId)->exists()) {
            return redirect()->route('umkm.mentor.detail', $mentorId)
                ->with('error', 'Anda sudah terhubung dengan mentor ini.');
        }

        $umkm->mentors()->attach($mentorId);

        return redirect()->route('umkm.mentor.detail', $mentorId)
            ->with('success', 'Berhasil terhubung dengan mentor ' . ($mentor->full_name ?? $mentor->nama) . '!');
    }

    // =========================================================
    // LEPAS MENTOR
    // =========================================================
    public function lepasMentor($mentorId)
    {
        $user = Auth::user();

        $umkm = Produk::where('user_id', $user->id)
                      ->where('status', 'approved')
                      ->first();

        if (!$umkm) {
            return back()->with('error', 'Profil UMKM tidak ditemukan.');
        }

        $umkm->mentors()->detach($mentorId);

        return back()->with('success', 'Mentor berhasil dilepas.');
    }

    // =========================================================
    // EDIT & UPDATE PRODUK UMKM
    // =========================================================
    public function editProduk($id)
    {
        $product = Produk::where('id', $id)
                         ->where('user_id', Auth::id())
                         ->firstOrFail();

        return view('profile.edit-produk', compact('product'));
    }

    public function updateProduk(Request $request, $id)
    {
        $product = Produk::where('id', $id)
                         ->where('user_id', Auth::id())
                         ->firstOrFail();

        $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori'    => 'required',
            'deskripsi'   => 'required|string',
            'kontak'      => 'nullable|string|max:20',
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'logo'        => 'nullable|image|max:2048',
        ]);

        // Update logo
        if ($request->hasFile('logo')) {
            if ($product->logo) {
                Storage::disk('public')->delete($product->logo);
            }
            $product->logo = $request->file('logo')->store('produk/logo', 'public');
        }

        $data = [
            'nama'      => $request->nama,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'kontak'    => $request->kontak,
            'status'    => $product->status === 'approved' ? 'approved' : 'pending',
        ];

        // Update foto produk
        if ($request->hasFile('foto_produk')) {
            if ($product->foto_produk) {
                Storage::disk('public')->delete($product->foto_produk);
            }
            $data['foto_produk'] = $request->file('foto_produk')->store('produk-pict', 'public');
        }

        $product->update($data);

        return redirect()->route('dashboard-umkm')
            ->with('success', 'Data usaha berhasil diperbarui!');
    }
}
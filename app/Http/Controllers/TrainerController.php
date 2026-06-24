<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Program;
use App\Models\Event;
use Illuminate\Support\Str; 
use App\Models\PendaftaranProgram;



class TrainerController extends Controller
{
    private const ALLOWED_TAGS = '<p><br><strong><em><u><s><ol><ul><li><h1><h2><h3><h4><a><span><blockquote>';

    // ═══════════════════════════════════════════════════════════════
    // DASHBOARD
    // ═══════════════════════════════════════════════════════════════

    public function index()
{
    $user    = Auth::user();
    $trainer = \App\Models\Trainer::where('user_id', $user->id)->first();

    $pelatihanList = Program::withTrashed()
    ->where('trainer_id', $user->id)
    ->latest()
    ->get();

    $eventList = Event::where('trainer_id', $user->id)
    ->latest()
    ->get();

    $totalKurikulum        = $pelatihanList->where('tipe', 'kurikulum')->count();
    $totalModul            = $pelatihanList->where('tipe', 'modul')->count();
    $totalEvent            = $eventList->count();
    $pendingPelatihanCount = $pelatihanList->where('status', 'pending')->count();
    $pendingEventCount     = $eventList->where('status', 'pending')->count();
    $pendingTotal          = $pendingPelatihanCount + $pendingEventCount;

    $recentSubmissions = $pelatihanList
    ->concat(
        $eventList->map(function($item) {
            $clone = clone $item;
            $clone->tipe = 'event';
            // Normalisasi agar blade bisa cek !empty($item->deleted_at)
            if (!empty($clone->deleted_by_admin_at)) {
                $clone->deleted_at = $clone->deleted_by_admin_at;
            }
            return $clone;
        })
    )
    ->sortByDesc('created_at')
    ->take(5);

    $totalUlasan = \App\Models\TrainerUlasan::where('trainer_id', $user->id)->count();

    $deletedLogs = \App\Models\DeletedProgramLog::where('trainer_user_id', $user->id)
        ->orderByDesc('deleted_at_by_admin')
        ->get();

        $deletedEventLogs = \App\Models\DeletedEventLog::where('trainer_user_id', $user->id)
        ->orderByDesc('deleted_at_by_admin')
        ->get();

    $activePage = session('active_page', 'dashboard');

    return view('trainer.dashboard', compact(
        'user',
        'totalKurikulum',
        'totalModul',
        'totalEvent',
        'pendingTotal',
        'pendingPelatihanCount',
        'pendingEventCount',
        'pelatihanList',
        'eventList',
        'recentSubmissions',
        'trainer',
        'totalUlasan',
        'deletedLogs',
        'deletedEventLogs', 
        'activePage',

    ));
}

    // ═══════════════════════════════════════════════════════════════
    // PROGRAM — STORE
    // ═══════════════════════════════════════════════════════════════

    public function storeProgram(Request $request)
{
    $request->validate([
        'judul'          => 'required|string|max:255',
        'tipe'           => 'required|in:kurikulum,materi',
        'deskripsi'      => 'nullable|string|max:500',
        'metode'         => 'nullable|in:online,offline,hybrid',
        'tingkat'        => 'nullable|in:pemula,menengah,lanjut',
        'bahasa'         => 'nullable|string|max:100',
        'total_jam'      => 'nullable|integer|min:0',
        'jumlah_sesi'    => 'nullable|integer|min:0',
        'sertifikat'     => 'nullable|boolean',
        'phone'          => 'nullable|string|max:20',
        'biaya'          => 'nullable|string|max:100',
        'alamat'         => 'nullable|string|max:500',
        'gambar'         => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        'absensi_aktif'  => 'nullable|boolean',
        'absensi_mulai'  => 'nullable|date',
        'absensi_selesai'=> 'nullable|date|after:absensi_mulai',
        'absensi_url'    => 'nullable|url|max:255',
        'materi_type'    => 'nullable|in:pdf,youtube',
        'materi_pdf'     => 'nullable|file|mimes:pdf|max:20480',
        'materi_youtube' => 'nullable|url|max:255',
        'program_mulai'   => 'nullable|date',
'program_selesai' => 'nullable|date|after_or_equal:program_mulai',
    ]);

    $gambar = null;
    if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar')->store('program', 'public');
    }

    $materiPdf = null;
if ($request->materi_type === 'pdf' && $request->hasFile('materi_pdf')) {
    $materiPdf = $request->file('materi_pdf')->store('materi', 'public');
}
    Program::create([
        'trainer_id'     => Auth::id(),
        'judul'          => $request->judul,
        'tipe'           => $request->tipe,
        'deskripsi'      => $request->deskripsi,
        'metode'         => $request->metode,
        'tingkat'        => $request->tingkat,
        'bahasa'         => $request->bahasa,
        'total_jam'      => $request->total_jam,
        'jumlah_sesi'    => $request->jumlah_sesi,
        'sertifikat'     => $request->boolean('sertifikat'),
        'phone'          => $request->phone ?? Auth::user()->phone,
        'biaya'          => $request->biaya,
        'alamat'         => $request->alamat,
        'gambar'         => $gambar,
        'status'         => 'pending',
        'absensi_aktif'  => $request->boolean('absensi_aktif'),
        'absensi_mulai'  => $request->absensi_aktif ? $request->absensi_mulai   : null,
        'absensi_selesai'=> $request->absensi_aktif ? $request->absensi_selesai : null,
        'absensi_url'    => $request->absensi_aktif ? $request->absensi_url     : null,
        'program_mulai'  => $request->filled('program_mulai')  ? $request->program_mulai  : null,  // ← tambah
        'program_selesai'=> $request->filled('program_selesai') ? $request->program_selesai : null, // ← tambah
        'materi_type'    => $request->materi_type,
        'materi_pdf'     => $materiPdf,
        'materi_youtube' => $request->materi_type === 'youtube' ? $request->materi_youtube : null,
    ]);

    return redirect()->route('trainer.dashboard')
        ->with('success', 'Kurikulum berhasil dikirim dan menunggu persetujuan admin.')
        ->with('active_page', 'program');
}
    // ═══════════════════════════════════════════════════════════════
    // PROGRAM — UPDATE
    // ═══════════════════════════════════════════════════════════════

    public function updateProgram(Request $request, $id)
{
    $program = Program::where('id', $id)
        ->where('trainer_id', Auth::id())
        ->firstOrFail();

    // FIX 3: approved boleh edit HANYA field absensi
    if ($program->status === 'approved') {
        $program->update([
            'absensi_aktif'  => $request->boolean('absensi_aktif'),
            'absensi_mulai'  => $request->absensi_aktif ? $request->absensi_mulai   : null,
            'absensi_selesai'=> $request->absensi_aktif ? $request->absensi_selesai : null,
            'absensi_url'    => $request->absensi_aktif ? $request->absensi_url     : null,
            'phone'          => $request->phone ?? Auth::user()->phone,
            'program_mulai'   => $request->filled('program_mulai')   ? $request->program_mulai   : null,  // ← tambah
            'program_selesai' => $request->filled('program_selesai') ? $request->program_selesai : null,  // ← tambah
        ]);
        return redirect()->route('trainer.dashboard')
            ->with('success', 'Jadwal absensi berhasil diperbarui.')
            ->with('active_page', 'program');
    }

    $request->validate([
        'judul'          => 'required|string|max:255',
        'tipe'           => 'required|in:kurikulum,materi',
        'deskripsi'      => 'nullable|string|max:500',
        'metode'         => 'nullable|in:online,offline,hybrid',
        'tingkat'        => 'nullable|in:pemula,menengah,lanjut',
        'bahasa'         => 'nullable|string|max:100',
        'total_jam'      => 'nullable|integer|min:0',
        'jumlah_sesi'    => 'nullable|integer|min:0',
        'sertifikat'     => 'nullable|boolean',
        'phone'          => 'nullable|string|max:20',
        'biaya'          => 'nullable|string|max:100',
        'alamat'         => 'nullable|string|max:500',
        'gambar'         => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        'absensi_aktif'  => 'nullable|boolean',
        'absensi_mulai'  => 'nullable|date',
        'absensi_selesai'=> 'nullable|date|after:absensi_mulai',
        'absensi_url'    => 'nullable|url|max:255',
        'materi_type'    => 'nullable|in:pdf,youtube',
        'materi_pdf'     => 'nullable|file|mimes:pdf|max:20480',
        'materi_youtube' => 'nullable|url|max:255',
        'program_mulai'   => 'nullable|date',
'program_selesai' => 'nullable|date|after_or_equal:program_mulai',
    ]);

    if ($request->hasFile('gambar')) {
        if ($program->gambar) Storage::disk('public')->delete($program->gambar);
        $program->gambar = $request->file('gambar')->store('program', 'public');
    }

    $materiPdf = null;
if ($request->materi_type === 'pdf' && $request->hasFile('materi_pdf')) {
    if ($program->materi_pdf) {
        Storage::disk('public')->delete($program->materi_pdf);
    }
    $materiPdf = $request->file('materi_pdf')->store('materi', 'public');
} elseif (isset($program)) {
    $materiPdf = $program->materi_pdf;
}

    $program->update([
        'judul'          => $request->judul,
        'tipe'           => $request->tipe,
        'deskripsi'      => $request->deskripsi,
        'metode'         => $request->metode,
        'tingkat'        => $request->tingkat,
        'bahasa'         => $request->bahasa,
        'total_jam'      => $request->total_jam,
        'jumlah_sesi'    => $request->jumlah_sesi,
        'sertifikat'     => $request->boolean('sertifikat'),
        'phone'          => $request->phone ?? Auth::user()->phone,
        'biaya'          => $request->biaya,
        'alamat'         => $request->alamat,
        'gambar'         => $program->gambar,
        'status'         => 'pending',
        'catatan_admin'  => null,
        'absensi_aktif'  => $request->boolean('absensi_aktif'),
        'absensi_mulai'  => $request->absensi_aktif ? $request->absensi_mulai   : null,
        'absensi_selesai'=> $request->absensi_aktif ? $request->absensi_selesai : null,
        'absensi_url'    => $request->absensi_aktif ? $request->absensi_url     : null,
        'program_mulai'  => $request->filled('program_mulai')  ? $request->program_mulai  : null,  // ← tambah
        'program_selesai'=> $request->filled('program_selesai') ? $request->program_selesai : null, // ← tambah
        'materi_type'    => $request->materi_type,
    'materi_pdf'     => $materiPdf,
    'materi_youtube' => $request->materi_type === 'youtube' ? $request->materi_youtube : null,
    ]);

    return redirect()->route('trainer.dashboard')
        ->with('success', 'Kurikulum diperbarui dan dikirim ulang untuk disetujui.')
        ->with('active_page', 'program');
}

    // ═══════════════════════════════════════════════════════════════
    // PROGRAM — DESTROY
    // ═══════════════════════════════════════════════════════════════

    public function destroyProgram($id)
{
    $program = Program::where('id', $id)
        ->where('trainer_id', Auth::id())
        ->firstOrFail();

    if ($program->status === 'approved') {
        return back()->with('error', 'Program yang sudah disetujui tidak dapat dihapus.');
    }

    if ($program->gambar) Storage::disk('public')->delete($program->gambar);
    
    // Tandai bahwa ini dihapus oleh trainer sendiri
    $program->deleted_by = Auth::id(); // ← tambah ini
    $program->save();
    
    $program->delete();

    return redirect()->route('trainer.dashboard')
        ->with('success', 'Program berhasil dihapus.')
        ->with('active_page', 'program');
}

    // ═══════════════════════════════════════════════════════════════
    // EVENT — STORE
    // FIX: tambah tipe, kapasitas, biaya; gunakan 'gambar' (bukan banner)
    // ═══════════════════════════════════════════════════════════════

    public function storeEvent(Request $request)
    {
        $request->validate([
            'judul'         => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'waktu_mulai'   => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
            'lokasi'        => 'nullable|string|max:255',
            'kapasitas'     => 'nullable|integer|min:1',
            'biaya'         => 'nullable|string|max:100',
            'deskripsi'     => 'required|string',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'phone' => 'nullable|string|max:20',
        ]);
    
        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('event', 'public');
        }
    
        \App\Models\Event::create([
            'trainer_id'    => Auth::id(),
            'judul'         => $request->judul,
            'tanggal'       => $request->tanggal,
            'waktu_mulai'   => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi'        => $request->lokasi,
            'kapasitas'     => $request->kapasitas,
            'biaya'         => $request->biaya,
'nominal_biaya' => $request->biaya === 'Berbayar' ? $request->nominal_biaya : null,
            'deskripsi'     => $request->deskripsi,
            'gambar'        => $gambar,
            'status'        => 'pending',
            'phone'         => $request->phone ?? Auth::user()->phone,
        ]);
    
        return redirect()->route('trainer.dashboard')
            ->with('success', 'Event berhasil dikirim, menunggu persetujuan admin.')
            ->with('active_page', 'event');
    }


    // ═══════════════════════════════════════════════════════════════
    // EVENT — UPDATE
    // ═══════════════════════════════════════════════════════════════

    public function updateEvent(Request $request, $id)
    {
        $event = \App\Models\Event::where('id', $id)
            ->where('trainer_id', Auth::id())
            ->firstOrFail();
    
            
        $request->validate([
            'judul'         => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'waktu_mulai'   => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i|after:waktu_mulai',
            'lokasi'        => 'nullable|string|max:255',
            'kapasitas'     => 'nullable|integer|min:1',
            'biaya'         => 'nullable|string|max:100',
            'deskripsi'     => 'required|string',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'phone' => 'nullable|string|max:20', 
        ]);
    
        if ($request->hasFile('gambar')) {
            if ($event->gambar) \Illuminate\Support\Facades\Storage::disk('public')->delete($event->gambar);
            $event->gambar = $request->file('gambar')->store('event', 'public');
        }
    
        $event->update([
            'judul'         => $request->judul,
            'tanggal'       => $request->tanggal,
            'waktu_mulai'   => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi'        => $request->lokasi,
            'kapasitas'     => $request->kapasitas,
            'biaya'         => $request->biaya,
'nominal_biaya' => $request->biaya === 'Berbayar' ? $request->nominal_biaya : null,
            'deskripsi'     => $request->deskripsi,
            'gambar'        => $event->gambar,
            'status'        => 'pending',
            'catatan_admin' => null,
            'phone' => $request->phone ?? Auth::user()->phone,
        ]);
    
        return redirect()->route('trainer.dashboard')
            ->with('success', 'Event diperbarui dan dikirim ulang untuk disetujui.')
            ->with('active_page', 'event');
    }
    // ═══════════════════════════════════════════════════════════════
    // EVENT — DESTROY
    // ═══════════════════════════════════════════════════════════════

    public function destroyEvent($id)
    {
        $event = Event::where('id', $id)
            ->where('trainer_id', Auth::id())
            ->firstOrFail();

        // Trainer boleh hapus event apapun statusnya
        if ($event->gambar) Storage::disk('public')->delete($event->gambar);
        $event->delete();

        return redirect()->route('trainer.dashboard')
            ->with('success', 'Event berhasil dihapus.')
            ->with('active_page', 'event');
    }

    public function updateDisplayedBidang(Request $request)
{
    $user    = Auth::user();
    $trainer = \App\Models\Trainer::where('user_id', $user->id)->first();

    if (!$trainer) {
        return back()->with('error', 'Data trainer tidak ditemukan.');
    }

    $request->validate([
        'displayed_bidang' => 'required|string|max:100',
    ]);

    $trainer->update(['displayed_bidang' => $request->displayed_bidang]);

    return back()->with('success', 'Bidang keahlian berhasil diperbarui!');
}

public function getPeserta($id)
{
    $program = Program::withTrashed()  // ← tambah ini
        ->where('id', $id)
        ->where('trainer_id', auth()->id())
        ->firstOrFail();

    $peserta = PendaftaranProgram::where('program_id', $id) // ← fix
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($p, $i) {
            return [
                'no'               => $i + 1,
                'nama'             => $p->nama_lengkap,
                'email'            => $p->email,
                'no_hp'            => $p->no_hp,
                'alamat'           => $p->alamat,
                'bukti_pembayaran' => $p->bukti_pembayaran
                    ? asset('storage/' . $p->bukti_pembayaran)
                    : null,
                'tanggal_daftar'   => $p->created_at->translatedFormat('d M Y, H:i'),
                'status'           => $p->status,
            ];
        });

    return response()->json([
        'success' => true,
        'total'   => $peserta->count(),
        'peserta' => $peserta,
    ]);
}

public function exportPesertaCsv($id)
{
    $program = Program::withTrashed()  // ← tambah ini juga
        ->where('id', $id)
        ->where('trainer_id', auth()->id())
        ->firstOrFail();

    $peserta = PendaftaranProgram::where('program_id', $id) // ← fix
        ->orderBy('created_at', 'desc')
        ->get();

    $filename = 'peserta-' . Str::slug($program->judul) . '-' . date('Ymd') . '.csv';

    $headers = [
        'Content-Type'        => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ];

    $callback = function () use ($peserta) {
        $file = fopen('php://output', 'w');
        fputcsv($file, ['No', 'Nama', 'Email', 'No HP', 'Alamat', 'Status', 'Tanggal Daftar']);
        foreach ($peserta as $i => $p) {
            fputcsv($file, [
                $i + 1,
                $p->nama_lengkap,
                $p->email,
                $p->no_hp,
                $p->alamat,
                $p->status,
                $p->created_at->format('d/m/Y H:i'),
            ]);
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}


    // ═══════════════════════════════════════════════════════════════
    // PROFIL — UPDATE
    // FIX: handle semua field dari form: name, email, no_hp,
    //      bidang_keahlian, bio, linkedin, foto, password
    // ═══════════════════════════════════════════════════════════════

    public function updateProfil(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name'             => 'required|string|max:255',
        'email'            => 'required|email|max:255|unique:users,email,' . $user->id,
        'phone'            => 'nullable|string|max:20',
        'academic_degree'  => 'nullable|string|max:255',
        'bidang_keahlian'  => 'nullable|string|max:1000',
        'displayed_bidang' => 'nullable|string|max:255',
        'bio'              => 'nullable|string|max:1000',
        'lokasi'           => 'nullable|string|max:500',
        'sosmed'           => 'nullable|array',
        'sosmed.instagram' => 'nullable|string|max:100',
'sosmed.linkedin'  => 'nullable|string|max:500', // ← naikan dari 100 ke 255
'sosmed.twitter'   => 'nullable|string|max:100',
'sosmed.youtube'   => 'nullable|string|max:500', // ← URL bisa panjang
'sosmed.facebook'  => 'nullable|string|max:500',
        'foto'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'password' => [
            'nullable', 'string', 'min:8',
            function ($attribute, $value, $fail) use ($request) {
                if ($value && $value !== $request->password_confirmation) {
                    $fail('Konfirmasi password tidak cocok.');
                }
            },
        ],
        'password_confirmation' => 'nullable|string',
    ]);

    // ═══════════════════════════════════════════════════════════════
// DELETED PROGRAM LOG — MARK AS READ
// ═══════════════════════════════════════════════════════════════

    // Update users table
    $userData = $request->only(['name', 'email', 'phone']);
    if ($request->filled('password')) {
        $userData['password'] = Hash::make($request->password);
    }
    $user->update($userData);

    // Update trainer table
    $trainer = \App\Models\Trainer::firstOrNew(['user_id' => $user->id]);

    $sosmedInput = $request->input('sosmed', []);

// Ambil sosmed lama dari DB
$sosmedLama = $trainer->sosmed ?? [];

// Merge: update semua key yang dikirim, pertahankan key lain
$sosmed = array_merge($sosmedLama, [
    'instagram' => trim($sosmedInput['instagram'] ?? ''),
    'linkedin'  => trim($sosmedInput['linkedin']  ?? ''),
    'twitter'   => trim($sosmedInput['twitter']   ?? ''),
    'youtube'   => trim($sosmedInput['youtube']   ?? ''),
    'facebook'  => trim($sosmedInput['facebook']  ?? ''),
]);

$trainer->sosmed = $sosmed;

    $trainer->fill([
        'bio'              => $request->bio,
        'lokasi'           => $request->lokasi,
        'keahlian'         => $request->bidang_keahlian,
        'academic_degree'  => $request->academic_degree,
        'displayed_bidang' => $request->displayed_bidang,
        'nama'             => $request->name,
    ]);

    if ($request->hasFile('foto')) {
        if ($trainer->foto) Storage::disk('public')->delete($trainer->foto);
        $trainer->foto = $request->file('foto')->store('profil', 'public');
        $trainer->white_bg_photo = null;
    }

    if (!$trainer->exists) {
        $trainer->user_id = $user->id;
        $trainer->status  = 'pending';
    }

    $trainer->save();


    return back()
        ->with('success', 'Profil berhasil diperbarui.')
        ->with('active_page', 'profil');
}

public function restoreProgram($id)
{
    $log = \App\Models\DeletedProgramLog::where('id', $id)
        ->where('trainer_user_id', Auth::id())
        ->firstOrFail();

    // Coba cari dengan withTrashed (soft deleted)
    $program = Program::withTrashed()->where('id', $log->program_id)->first();

    if ($program) {
        // Data masih ada (soft deleted) — pulihkan
        $program->restore();
        $program->update([
            'status'         => 'pending',
            'catatan_admin'  => null,
            'deleted_by'     => null,
            'deleted_reason' => null,
            'trainer_id'     => Auth::id(),
        ]);
    } else {
        // Data sudah hard deleted — buat ulang minimal
        Program::create([
            'trainer_id' => Auth::id(),
            'judul'      => $log->program_title,
            'tipe'       => $log->program_tipe,
            'status'     => 'pending',
            'deskripsi'  => 'Program dipulihkan. Mohon lengkapi data kembali.',
            'bahasa'     => 'Bahasa Indonesia',
            'tingkat'    => 'pemula',
            'metode'     => 'online',
        ]);
    }

    $log->delete();

    return redirect()->route('trainer.dashboard')
        ->with('success', 'Program "' . $log->program_title . '" berhasil dipulihkan. Silakan lengkapi data program.')
        ->with('active_page', 'program');
}
public function markDeletedLogRead()
{
    \App\Models\DeletedProgramLog::where('trainer_user_id', auth()->id())
        ->where('is_read', false)
        ->update(['is_read' => true]);

    return response()->json(['success' => true]);
}

// DELETED EVENT LOG — MARK AS READ
// ═══════════════════════════════════════════════════════════════
public function markDeletedEventLogRead()
{
    \App\Models\DeletedEventLog::where('trainer_user_id', auth()->id())
        ->where('is_read', false)
        ->update(['is_read' => true]);

    return response()->json(['success' => true]);
}

// ═══════════════════════════════════════════════════════════════
// DELETED EVENT LOG — RESTORE
// ═══════════════════════════════════════════════════════════════
public function restoreEvent($id)
{
    $log = \App\Models\DeletedEventLog::where('id', $id)
        ->where('trainer_user_id', Auth::id())
        ->firstOrFail();

    // Cari event aslinya pakai event_id
    $event = \App\Models\Event::withoutGlobalScope('not_deleted_by_admin')
        ->find($log->event_id);

    if ($event) {
        // Pulihkan event yang sudah ada
        $event->update([
            'deleted_by_admin_at' => null,
            'deleted_by_admin_id' => null,
            'deleted_reason'      => null,
            'status'              => 'pending',
            'approved_at'         => null,
            'approved_by'         => null,
        ]);
    } else {
        // Event sudah force deleted — buat ulang minimal
        \App\Models\Event::create([
            'trainer_id' => Auth::id(),
            'judul'      => $log->event_title,
            'tanggal'    => $log->event_tanggal ?? now()->addDays(7)->toDateString(),
            'deskripsi'  => 'Event dipulihkan. Mohon lengkapi data kembali.',
            'status'     => 'pending',
        ]);
    }

    $log->delete();

    return redirect()->route('trainer.dashboard')
        ->with('success', 'Event "' . $log->event_title . '" berhasil dipulihkan dan menunggu persetujuan.')
        ->with('active_page', 'event');
}

    // ═══════════════════════════════════════════════════════════════
    // HELPER PRIVATE
    // ═══════════════════════════════════════════════════════════════

    private function sanitize(?string $html): ?string
    {
        if (!$html) return null;
        return strip_tags($html, self::ALLOWED_TAGS);
    }
}
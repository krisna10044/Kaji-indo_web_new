<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Produk;
use App\Models\Program;
use App\Models\User;
use App\Models\Mentor;
use App\Models\DeletedEventLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    // ═════════════════════════════════════════════════════════════════════
    // BERANDA / DASHBOARD
    // ═════════════════════════════════════════════════════════════════════
    public function index()
    {
        $stats = [
            'total_pending'    => Program::where('status', 'pending')->count()
                                + Produk::where('status', 'pending')->count()
                                + Event::where('status', 'pending')->count()
                                + User::where('trainer_status', 'pending')->count(),
            'pending_produk'   => Produk::where('status', 'pending')->count(),
            'pending_program'  => Program::where('status', 'pending')->count(),
            'pending_event'    => Event::where('status', 'pending')->count(),
            'pending_trainer'  => User::where('trainer_status', 'pending')->count(),
            'pending_mentor'   => User::where('mentor_status', 'pending')->count(),
            'pending_hari_ini' => Produk::where('status', 'pending')->whereDate('created_at', today())->count()
                                + Program::where('status', 'pending')->whereDate('created_at', today())->count()
                                + Event::where('status', 'pending')->whereDate('created_at', today())->count()
                                + User::where('trainer_status', 'pending')->whereDate('trainer_applied_at', today())->count(),
            'disetujui_bulan'  => Program::where('status', 'approved')->whereMonth('updated_at', now()->month)->count()
                                + Produk::where('status', 'approved')->whereMonth('updated_at', now()->month)->count()
                                + Event::where('status', 'approved')->whereMonth('updated_at', now()->month)->count(),
            'total_users'      => User::count(),
            'total_umkm'       => User::where('role', 'umkm')->count(),
            'total_pembimbing' => User::where('role', 'pembimbing')->count(),
        ];
        $pendingProgram = $stats['pending_program'];
        $pendingEvent   = $stats['pending_event'];
        $totalProgram   = Program::where('status', 'approved')->count();
        $totalPengguna  = User::count();
        $antrian_terbaru = collect()
            ->merge(
                Program::with('trainer')->where('status', 'pending')->latest()->take(3)->get()
                    ->map(fn($p) => [
                        'id'             => $p->id,
                        'type'           => 'program',
                        'nama'           => $p->judul ?? 'Program',
                        'submitter'      => optional($p->trainer)->name ?? 'trainer',
                        'submitter_role' => 'trainer',
                        'tanggal'        => $p->created_at,
                        'avatar_color'   => 'var(--accent)',
                    ])
            )
            ->merge(
                Produk::with('umkm')->where('status', 'pending')->latest()->take(3)->get()
                    ->map(fn($p) => [
                        'id'             => $p->id,
                        'type'           => 'produk',
                        'nama'           => $p->nama ?? 'Produk',
                        'foto'           => $p->foto ?? null,
                        'submitter'      => optional($p->umkm)->name ?? 'UMKM',
                        'submitter_role' => 'UMKM',
                        'tanggal'        => $p->created_at,
                        'avatar_color'   => 'var(--accent3)',
                    ])
            )
            ->sortByDesc('tanggal')
            ->take(5)
            ->values();
        $programPending = Program::with('trainer')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();
        $eventPending = Event::with('trainer')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();
        $pengguna_terbaru = User::latest()->take(5)->get();
        $produk_terbaru   = Produk::latest()->take(5)->get();
        return view('admin.dashboard-admin', compact(
            'stats',
            'antrian_terbaru',
            'pengguna_terbaru',
            'produk_terbaru',
            'pendingProgram',
            'pendingEvent',
            'totalProgram',
            'totalPengguna',
            'programPending',
            'eventPending'
        ));
    }

    // ═════════════════════════════════════════════════════════════════════
    // APPROVAL PROGRAM (kurikulum + modul)
    // ═════════════════════════════════════════════════════════════════════
    public function approvalProgram(Request $request)
    {
        $status = $request->get('status', 'pending');
        $tipe   = $request->get('tipe', 'all');
    
        // Tab dihapus
        $deletedLogs = \App\Models\DeletedProgramLog::latest('deleted_at_by_admin')
    ->paginate(15, ['*'], 'deleted_page')
    ->withQueryString();
    
        $programs = Program::with('trainer')
            ->when($status !== 'all', fn($q) => $q->where('status', $status))
            ->when($tipe   !== 'all', fn($q) => $q->where('tipe', $tipe))
            ->latest()
            ->paginate(15)
            ->withQueryString();
    
        $counts = [
            'pending'  => Program::where('status', 'pending')->count(),
            'approved' => Program::where('status', 'approved')->count(),
            'rejected' => Program::where('status', 'rejected')->count(),
            'deleted'  => \App\Models\DeletedProgramLog::count(),  // ← tambah
        ];
    
        $tipeBase = $status !== 'all'
            ? Program::where('status', $status)
            : Program::query();
    
        $countTipe = [
            'all'       => (clone $tipeBase)->count(),
            'kurikulum' => (clone $tipeBase)->where('tipe', 'kurikulum')->count(),
            'modul'     => (clone $tipeBase)->where('tipe', 'modul')->count(),
        ];
    
        $statusDaftar = $request->get('status_daftar',
            $request->get('tab') === 'pendaftaran'
                ? ($status === 'approved' ? 'diterima' : ($status === 'rejected' ? 'ditolak' : 'menunggu_verifikasi'))
                : 'menunggu_verifikasi'
        );
    
        $pendaftarans = \App\Models\PendaftaranProgram::with(['user', 'program'])
            ->when($statusDaftar !== 'all', fn($q) => $q->where('status', $statusDaftar))
            ->latest()
            ->paginate(20, ['*'], 'daftar_page')
            ->withQueryString();
    
        $countsDaftar = [
            'menunggu_verifikasi' => \App\Models\PendaftaranProgram::where('status', 'menunggu_verifikasi')->count(),
            'diterima'            => \App\Models\PendaftaranProgram::where('status', 'diterima')->count(),
            'ditolak'             => \App\Models\PendaftaranProgram::where('status', 'ditolak')->count(),
        ];
    
        return view('admin.approval-program', compact(
            'programs', 'counts', 'countTipe', 'status', 'tipe',
            'pendaftarans', 'countsDaftar', 'statusDaftar',
            'deletedLogs'  // ← tambah
        ));
    }

    public function restoreProgramAdmin($id)
{
    $log = \App\Models\DeletedProgramLog::findOrFail($id);

    $program = Program::withTrashed()->find($log->program_id);

    if ($program) {
        $program->restore();
        $program->update([
            'status'        => 'pending',
            'catatan_admin' => null,
            'deleted_by'    => null,
        ]);
    }
    

    $judul = $log->program_title;
    $log->delete();

    return back()->with('success', "Program \"{$judul}\" berhasil dipulihkan.");
}

public function destroyDeletedLog($id)
{
    $log = \App\Models\DeletedProgramLog::findOrFail($id);
    $judul = $log->program_title;

    // Hapus permanen program-nya juga (force delete)
    $program = Program::withTrashed()->find($log->program_id);
    if ($program) {
        $program->forceDelete();
    }

    $log->delete();

    return back()->with('success', "Log program \"{$judul}\" berhasil dihapus permanen.");
}
    public function detailProgram(Program $program)
    {
        return response()->json($program->load('trainer'));
    }
    public function approveProgram(Request $request, Program $program)
    {
        $request->validate(['catatan' => 'nullable|string|max:1000']);
        $program->update([
            'status'        => 'approved',
            'catatan_admin' => $request->catatan,
            'approved_at'   => now(),
            'approved_by'   => Auth::id(),
            'rejected_at'   => null,
            'rejected_by'   => null,
        ]);
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Program berhasil disetujui.', 'program' => $program]);
        }
        return back()->with('success', "Program \"{$program->judul}\" berhasil disetujui.");
    }
    public function rejectProgram(Request $request, Program $program)
    {
        $request->validate(['catatan' => 'required|string|max:1000']); // ← ganti 'alasan' → 'catatan'
        $program->update([
            'status'        => 'rejected',
            'catatan_admin' => $request->catatan,
            'rejected_at'   => now(),
            'rejected_by'   => Auth::id(),
            'approved_at'   => null,
            'approved_by'   => null,
        ]);
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Program berhasil ditolak.']);
        }
        return back()->with('success', "Program \"{$program->judul}\" telah ditolak.");
    }

    public function destroyProgram(Program $program)
    {
        $trainerUserId = $program->trainer_id;
    
        if ($trainerUserId) {
            \App\Models\DeletedProgramLog::create([
                'trainer_user_id'     => $trainerUserId,
                'program_id'          => $program->id,
                'program_title'       => $program->judul,
                'program_tipe'        => $program->tipe,
                'is_read'             => false,
                'deleted_at_by_admin' => now(),
            ]);
        }
    
        if ($program->gambar && \Storage::disk('public')->exists($program->gambar)) {
            \Storage::disk('public')->delete($program->gambar);
        }
    
        // Soft delete modul juga (dengan SoftDeletes, delete() = soft delete)
        if ($program->tipe === 'kurikulum') {
            Program::where('kurikulum_id', $program->id)->each(function ($modul) {
                $modul->delete(); // soft delete modul
            });
        }
    
        $judul = $program->judul;
        $program->delete(); // soft delete kurikulum
    
        return back()->with('success', "Program \"{$judul}\" berhasil dihapus.");
    }
    
    // Tambah method baru untuk polling counts
    public function approvalProgramCounts(Request $request)
    {
        $status = $request->get('status', 'pending');
    
        $tipeBase = Program::where('status', $status);
    
        return response()->json([
            'counts' => [
                'pending'  => Program::where('status', 'pending')->count(),
                'approved' => Program::where('status', 'approved')->count(),
                'rejected' => Program::where('status', 'rejected')->count(),
            ],
            'countTipe' => [
                'all'       => (clone $tipeBase)->count(),
                'kurikulum' => (clone $tipeBase)->where('tipe', 'kurikulum')->count(),
                'modul'     => (clone $tipeBase)->where('tipe', 'modul')->count(),
            ],
            'countsDaftar' => [
                'menunggu_verifikasi' => \App\Models\PendaftaranProgram::where('status', 'menunggu_verifikasi')->count(),
                'diterima'            => \App\Models\PendaftaranProgram::where('status', 'diterima')->count(),
                'ditolak'             => \App\Models\PendaftaranProgram::where('status', 'ditolak')->count(),
            ],
        ]);
    }

// ── Export CSV Approval Program & Pendaftaran ─────────────────────────
public function exportCsvApproval(Request $request)
{
    $tab    = $request->get('tab', 'program');
    $status = $request->get('status', 'pending');

    if ($tab === 'pendaftaran') {
        $statusDaftar = $request->get('status_daftar', 'menunggu_verifikasi');

        $rows = \App\Models\PendaftaranProgram::with('program')
            ->where('status', $statusDaftar)
            ->orderByDesc('created_at')
            ->get();

        $filename = 'pendaftaran-' . $statusDaftar . '-' . now()->format('Ymd') . '.csv';

        return response()->streamDownload(function () use ($rows) {
            $h = fopen('php://output', 'w');
            fprintf($h, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM UTF-8
            fputcsv($h, ['ID','Nama Lengkap','Email','No HP','Alamat','Program','Biaya Program','Bukti Bayar','Status','Alasan Penolakan','Tanggal Daftar']);

            foreach ($rows as $p) {
                $isBerbayar = !empty($p->program->biaya)
                    && strtolower($p->program->biaya) !== 'gratis'
                    && $p->program->biaya != 0;

                fputcsv($h, [
                    $p->id,
                    $p->nama_lengkap,
                    $p->email,
                    $p->no_hp,
                    $p->alamat ?? '-',
                    $p->program->judul ?? '-',
                    $isBerbayar ? 'Berbayar' : 'Gratis',
                    $p->bukti_pembayaran ? 'Ada' : 'Tidak Ada',
                    $p->status,
                    $p->alasan_penolakan ?? '-',
                    $p->created_at->format('d/m/Y H:i'),
                ]);
            }
            fclose($h);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    // ── Tab program (kurikulum & modul) ──────────────────────────────
    $tipe = $request->get('tipe', 'all');

    $rows = Program::with('trainer')
        ->when($status !== 'all', fn($q) => $q->where('status', $status))
        ->when($tipe   !== 'all', fn($q) => $q->where('tipe', $tipe))
        ->orderByDesc('created_at')
        ->get();

    $filename = 'approval-program-' . $status
        . ($tipe !== 'all' ? '-' . $tipe : '')
        . '-' . now()->format('Ymd') . '.csv';

    return response()->streamDownload(function () use ($rows) {
        $h = fopen('php://output', 'w');
        fprintf($h, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($h, ['ID','Judul','Tipe','Trainer','Metode','Tingkat','Bahasa','Biaya','Status','Catatan Admin','Diajukan']);

        foreach ($rows as $p) {
            fputcsv($h, [
                $p->id,
                $p->judul ?? $p->nama,
                ucfirst($p->tipe ?? '-'),
                optional($p->trainer)->name ?? '-',
                $p->metode ?? '-',
                $p->tingkat ?? '-',
                $p->bahasa ?? '-',
                $p->biaya ?? '-',
                $p->status,
                $p->catatan_admin ?? '-',
                $p->created_at->format('d/m/Y H:i'),
            ]);
        }
        fclose($h);
    }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
}

    // ═════════════════════════════════════════════════════════════════════
// APPROVAL PENDAFTARAN PROGRAM
// ═════════════════════════════════════════════════════════════════════
public function pendaftaranIndex(Request $request)
{
    $status = $request->get('status', 'menunggu_verifikasi');

    $pendaftarans = \App\Models\PendaftaranProgram::with(['user', 'program'])
        ->when($status !== 'all', fn($q) => $q->where('status', $status))
        ->latest()
        ->paginate(20)
        ->withQueryString();

    $counts = [
        'menunggu_verifikasi' => \App\Models\PendaftaranProgram::where('status', 'menunggu_verifikasi')->count(),
        'diterima'            => \App\Models\PendaftaranProgram::where('status', 'diterima')->count(),
        'ditolak'             => \App\Models\PendaftaranProgram::where('status', 'ditolak')->count(),
    ];

    return view('admin.approval-pendaftaran', compact('pendaftarans', 'counts', 'status'));
}

public function pendaftaranApprove($id)
{
    $pendaftaran = \App\Models\PendaftaranProgram::findOrFail($id);
    $pendaftaran->update(['status' => 'diterima']);

    return back()->with('success', "Pendaftaran {$pendaftaran->nama_lengkap} berhasil diterima.");
}

public function pendaftaranReject(Request $request, $id)
{
    $request->validate(['alasan_penolakan' => 'required|string|max:500']);

    $pendaftaran = \App\Models\PendaftaranProgram::findOrFail($id);
    $pendaftaran->update([
        'status'           => 'ditolak',
        'alasan_penolakan' => $request->alasan_penolakan,
    ]);

    return back()->with('success', "Pendaftaran {$pendaftaran->nama_lengkap} telah ditolak.");
}

public function unsuspendPengguna(Request $request, User $user)
{
    $user->update(['status' => 'active']);
    return back()->with('success', 'Pengguna berhasil di-unsuspend.');
}

    // ═════════════════════════════════════════════════════════════════════
    // APPROVAL PRODUK
    // ═════════════════════════════════════════════════════════════════════
    public function approvalProduk(Request $request)
{
    $pending  = Produk::with(['items'])->where('status', 'pending')->whereNull('deleted_at')->latest()->get();
    $approved = Produk::with(['items'])->where('status', 'approved')->whereNull('deleted_at')->latest()->get();
    $rejected = Produk::with(['items'])->where('status', 'rejected')->whereNull('deleted_at')->latest()->get();
    $deleted  = Produk::with(['items'])->onlyTrashed()->latest('deleted_at')->get();

    $counts = [
        'pending'  => $pending->count(),
        'approved' => $approved->count(),
        'rejected' => $rejected->count(),
        'deleted'  => $deleted->count(), // ← pastikan ini ada
    ];

    return view('admin.approval-produk', compact(
        'pending', 'approved', 'rejected', 'deleted', 'counts' // ← 'deleted' harus ikut
    ));
}

public function restoreProduk($id)
{
    $produk = Produk::onlyTrashed()->findOrFail($id);
    $produk->restore();
    $produk->update(['status' => 'pending']);

    return back()->with('success', "UMKM \"{$produk->nama}\" berhasil dipulihkan.");
}

public function forceDeleteProduk($id)
{
    $produk = Produk::onlyTrashed()->findOrFail($id);
    $nama = $produk->nama;
    $produk->forceDelete();

    return back()->with('success', "UMKM \"{$nama}\" dihapus permanen.");
}

public function exportCsvProduk(Request $request)
{
    $status = $request->query('status', 'pending');
    $type   = $request->query('type', 'profil');

    if ($type === 'items') {
        // Export semua produk item dari UMKM approved
        $produks  = Produk::with('produkItems')->where('status', $status)->get();
        $filename = "produk-items-{$status}-" . now()->format('Ymd-His') . '.csv';

        return response()->streamDownload(function () use ($produks) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID Item', 'Nama Item', 'UMKM', 'Kategori', 'Harga', 'Stok', 'Satuan']);
            foreach ($produks as $p) {
                foreach ($p->produkItems as $item) {
                    fputcsv($file, [
                        $item->id,
                        $item->nama,
                        $p->nama,
                        $item->kategori ?? '-',
                        $item->harga,
                        $item->stok ?? '-',
                        $item->satuan ?? '-',
                    ]);
                }
            }
            fclose($file);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    // Default: export profil UMKM
    $produks  = Produk::where('status', $status)->get();
    $filename = "umkm-{$status}-" . now()->format('Ymd-His') . '.csv';

    return response()->streamDownload(function () use ($produks) {
        $file = fopen('php://output', 'w');
        fputcsv($file, ['ID', 'Nama Usaha', 'Pemilik', 'Kategori', 'NIB', 'Kontak', 'Provinsi', 'Kab/Kota', 'Status', 'Didaftarkan']);
        foreach ($produks as $p) {
            fputcsv($file, [
                $p->id, $p->nama, $p->owner, $p->kategori,
                $p->nib, $p->kontak, $p->provinsi, $p->kabupaten_kota,
                $p->status, $p->created_at?->format('d/m/Y'),
            ]);
        }
        fclose($file);
    }, $filename, ['Content-Type' => 'text/csv']);
}

    
    public function detailProduk(Produk $produk)
    {
        return response()->json($produk->load('umkm'));
    }
    public function approveProduk(Request $request, Produk $produk)
{
    $request->validate(['catatan' => 'nullable|string|max:1000']);
    
    $produk->update([
        'status'        => 'approved',
        'catatan_admin' => $request->catatan,
        'approved_at'   => now(),
        'approved_by'   => Auth::id(),
    ]);

    // ← Tambahkan ini: update role user menjadi umkm
    if ($produk->user_id) {
        \App\Models\User::where('id', $produk->user_id)
            ->update(['role' => 'umkm']);
    }

    if ($request->expectsJson()) {
        return response()->json(['message' => 'Produk berhasil disetujui.', 'produk' => $produk]);
    }
    return redirect()->route('admin.approval.produk', ['tab' => 'approved'])
        ->with('success', 'Produk berhasil disetujui.');
}
public function rejectProduk(Request $request, Produk $produk)
{
    $request->validate(['alasan' => 'required|string|max:1000']);
    
    $produk->update([
        'status'           => 'rejected',
        'catatan_admin'    => $request->alasan,
        'rejection_reason' => $request->alasan,
        'rejected_at'      => now(),
        'rejected_by'      => Auth::id(),
    ]);

    // ← Opsional: kembalikan role ke umum jika ditolak
    if ($produk->user_id) {
        \App\Models\User::where('id', $produk->user_id)
            ->update(['role' => 'umum']);
    }

    if ($request->expectsJson()) {
        return response()->json(['message' => 'Produk berhasil ditolak.']);
    }
    return redirect()->route('admin.approval.produk', ['tab' => 'rejected'])
        ->with('success', 'Produk telah ditolak.');
}
    // ── BARU: Hapus produk (approved / rejected) ──────────────────────
    public function destroyProduk(Produk $produk)
    {
        $nama = $produk->nama;
        $produk->delete();
        return back()->with('success', "Produk \"{$nama}\" berhasil dihapus.");
    }

    public function destroyProdukItem($produkId, $itemId)
{
    $produk = Produk::findOrFail($produkId);
    $item   = $produk->items()->findOrFail($itemId);

    $item->delete(); // soft delete — UMKM masih bisa pulihkan

    return back()->with('success', "Item \"{$item->nama}\" berhasil dihapus.");
}

public function destroyUmkm($produk)
{
    $umkm = Produk::findOrFail($produk);
    $nama = $umkm->nama;

    // Reset role user jika ada
    if ($umkm->user_id) {
        User::where('id', $umkm->user_id)->update([
            'role' => 'umum',
        ]);
    }

    // Hapus semua produk items terkait
    $umkm->items()->delete();

    // Soft delete profil UMKM
    $umkm->delete();

    return back()->with('success', "UMKM \"{$nama}\" beserta datanya berhasil dihapus.");
}

    // ═════════════════════════════════════════════════════════════════════
    // APPROVAL EVENT — (diperbarui dari AdminEventController)
    // ═════════════════════════════════════════════════════════════════════
    public function approvalEvent(Request $request)
{
    $status = $request->get('status', 'pending');

    // Query base — exclude yang dihapus admin (kecuali tab deleted)
    $query = Event::withoutGlobalScope('not_deleted_by_admin')
    ->with(['trainer', 'deletedByAdmin'])
    ->orderBy('created_at', 'desc');

    if ($status === 'deleted') {
        // Hanya tampilkan yang dihapus admin
        $events = (clone $query)
            ->whereNotNull('deleted_by_admin_at')
            ->get();
    } else {
        // Tab normal: exclude yang dihapus admin
        $events = (clone $query)
            ->whereNull('deleted_by_admin_at')
            ->where('status', $status)
            ->get();
    }

    // Count per tab (exclude yang dihapus admin untuk tab normal)
    $counts = [
        'pending'  => Event::whereNull('deleted_by_admin_at')->where('status', 'pending')->count(),
        'approved' => Event::whereNull('deleted_by_admin_at')->where('status', 'approved')->count(),
        'rejected' => Event::whereNull('deleted_by_admin_at')->where('status', 'rejected')->count(),
        'deleted'  => Event::whereNotNull('deleted_by_admin_at')->count(),
    ];

    return view('admin.approval-event', compact('events', 'status', 'counts'));
}
    public function detailEvent(Event $event)
    {
        return response()->json($event->load('trainer'));
    }
    public function approveEvent($id)
    {
        $event = Event::withoutGlobalScope('not_deleted_by_admin')->findOrFail($id);
        $event->update([
            'status'        => 'approved',
            'approved_at'   => now(),
            'approved_by'   => Auth::id(),
            'rejected_at'   => null,
            'rejected_by'   => null,
            'catatan_admin' => null,
        ]);
        return back()->with('success', 'Event "' . $event->judul . '" berhasil disetujui.');
    }
    public function rejectEvent(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:500',
        ]);
        $event = Event::withoutGlobalScope('not_deleted_by_admin')->findOrFail($id);
        $event->update([
            'status'        => 'rejected',
            'rejected_at'   => now(),
            'rejected_by'   => Auth::id(),
            'catatan_admin' => $request->catatan_admin,
            'approved_at'   => null,
            'approved_by'   => null,
        ]);
        return back()->with('success', 'Event "' . $event->judul . '" ditolak dengan catatan.');
    }

    public function destroyEvent(Request $request, $id)
{
    $event = Event::withoutGlobalScope('not_deleted_by_admin')->findOrFail($id);

    if ($event->deleted_by_admin_at) {
        return back()->with('error', 'Event sudah dihapus sebelumnya.');
    }

    $event->update([
        'deleted_by_admin_at' => now(),
        'deleted_by_admin_id' => Auth::id(),
        'deleted_reason'      => $request->reason,
    ]);

    if ($event->trainer_id) {
        \App\Models\DeletedEventLog::create([
            'trainer_user_id'     => $event->trainer_id,
            'event_id'            => $event->id,       // ← kunci utama
            'event_title'         => $event->judul,
            'event_tanggal'       => $event->tanggal,
            'is_read'             => false,
            'deleted_at_by_admin' => now(),
        ]);
    }

    return redirect()->route('admin.approval.event', ['status' => 'deleted'])
        ->with('success', 'Event "' . $event->judul . '" berhasil dihapus.');
}

    // Hapus permanen event dari tab deleted
    public function forceDeleteEvent($id)
    {
        $event = Event::withoutGlobalScope('not_deleted_by_admin')
            ->whereNotNull('deleted_by_admin_at')
            ->findOrFail($id);
    
        $judul = $event->judul;
    
        if ($event->gambar && \Storage::disk('public')->exists($event->gambar)) {
            \Storage::disk('public')->delete($event->gambar);
        }
    
        \App\Models\DeletedEventLog::where('trainer_user_id', $event->trainer_id)
            ->where('event_title', $judul)
            ->delete();
    
        $event->forceDelete();
    
        return redirect()->route('admin.approval.event', ['status' => 'deleted'])
            ->with('success', "Event \"{$judul}\" dihapus permanen.");
    }

// Pulihkan event ke pending
public function restoreEventAdmin($id)
{
    $event = Event::withoutGlobalScope('not_deleted_by_admin')
        ->whereNotNull('deleted_by_admin_at')
        ->findOrFail($id);

    $event->update([
        'deleted_by_admin_at' => null,
        'deleted_by_admin_id' => null,  // ← fix: sebelumnya 'deleted_by_admin'
        'deleted_reason'      => null,
        'status'              => 'pending',
        'approved_at'         => null,
        'approved_by'         => null,
    ]);

    \App\Models\DeletedEventLog::where('trainer_user_id', $event->trainer_id)
        ->where('event_title', $event->judul)
        ->delete();

    return redirect()->route('admin.approval.event', ['status' => 'pending'])
        ->with('success', 'Event "' . ($event->judul) . '" dipulihkan ke pending.');
}

    // ═════════════════════════════════════════════════════════════════════
    // MANAJEMEN PENGGUNA
    // ═════════════════════════════════════════════════════════════════════
    public function pengguna(Request $request)
    {
        $users = User::when($request->role, fn($q) => $q->where('role', $request->role))
            ->when($request->search, fn($q) => $q->where(function ($q2) use ($request) {
                $q2->where('name', 'like', "%{$request->search}%")
                   ->orWhere('email', 'like', "%{$request->search}%");
            }))
            ->latest()
            ->paginate(20)
            ->withQueryString();
        return view('admin.pengguna', compact('users'));
    }
    public function exportCsvPengguna(Request $request)
{
    $role = $request->get('role', '');

    $users = User::when($role !== '', fn($q) => $q->where('role', $role))
        ->latest()
        ->get();

    $roleLabel = match($role) {
        'admin'   => 'Admin',
        'trainer' => 'Trainer',
        'mentor'  => 'Mentor',
        'umkm'    => 'UMKM',
        'umum'    => 'Umum',
        default   => 'Semua',
    };

    $filename = 'pengguna-' . strtolower($roleLabel) . '-' . now()->format('Ymd') . '.csv';

    return response()->streamDownload(function () use ($users) {
        $h = fopen('php://output', 'w');
        fprintf($h, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM UTF-8

        fputcsv($h, ['ID', 'Nama', 'Email', 'Role', 'No. Telepon', 'Alamat', 'Status', 'Bergabung']);

        foreach ($users as $u) {
            fputcsv($h, [
                $u->id,
                $u->name,
                $u->email,
                $u->role ?? 'umum',
                $u->phone ?? '-',
                $u->address ?? '-',
                $u->suspended_at ? 'Suspend' : 'Aktif',
                $u->created_at->format('d/m/Y'),
            ]);
        }

        fclose($h);
    }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
}
    public function verifikasiPengguna(Request $request, User $user)
    {
        $user->update(['status' => 'active', 'email_verified_at' => now()]);
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Pengguna berhasil diverifikasi.']);
        }
        return back()->with('success', 'Pengguna berhasil diverifikasi.');
    }
    public function suspendPengguna(Request $request, User $user)
    {
        $user->update(['status' => 'suspended']);
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Pengguna berhasil di-suspend.']);
        }
        return back()->with('success', 'Pengguna berhasil di-suspend.');
    }

    // ═════════════════════════════════════════════════════════════════════
    // APPROVAL TRAINER
    // ═════════════════════════════════════════════════════════════════════
    public function approvalTrainer()
    {
        // ── Export CSV ────────────────────────────────────────────────────
        if (request()->get('export') === 'csv') {
            $status = request()->get('status', 'pending');
            $data   = \App\Models\Trainer::with('user')->where('status', $status)->get();
            $filename = "trainer-{$status}-" . now()->format('Ymd') . '.csv';
    
            return response()->streamDownload(function () use ($data) {
                $h = fopen('php://output', 'w');
                fprintf($h, chr(0xEF).chr(0xBB).chr(0xBF));
                fputcsv($h, ['ID','Nama','Email','NIK','Status','Tanggal Daftar']);
                foreach ($data as $t) {
                    fputcsv($h, [
                        $t->id,
                        $t->nama,
                        $t->user->email ?? $t->email ?? '-',
                        $t->nik ?? '-',
                        $t->status,
                        $t->created_at->format('d/m/Y'),
                    ]);
                }
                fclose($h);
            }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
        }
        // ─────────────────────────────────────────────────────────────────
    
        // Query dari tabel trainer (bukan users) — kode yang sudah ada
        $pending  = \App\Models\Trainer::with('user')
                        ->where('status', 'pending')
                        ->latest('applied_at')
                        ->get();
    
        $approved = \App\Models\Trainer::with('user')
                        ->where('status', 'approved')
                        ->latest('updated_at')
                        ->get();
    
        $rejected = \App\Models\Trainer::with('user')
                        ->where('status', 'rejected')
                        ->latest('updated_at')
                        ->get();
    
                        $deleted = \App\Models\Trainer::onlyTrashed()
                        ->with('user')
                        ->latest('deleted_at')
                        ->get();
                    
                    $counts = [
                        'pending'  => $pending->count(),
                        'approved' => $approved->count(),
                        'rejected' => $rejected->count(),
                        'deleted'  => $deleted->count(), // ← tambah
                    ];
                    
                    return view('admin.approval-trainer', compact(
                        'pending', 'approved', 'rejected', 'deleted', 'counts' // ← tambah 'deleted'
                    ));
    }
 
public function approveTrainer(\App\Models\Trainer $trainer)
{
    \Illuminate\Support\Facades\DB::transaction(function () use ($trainer) {
        // ── Auto-fill displayed_bidang ──────────────────────────────
        $displayed = $trainer->displayed_bidang;
        if (empty($displayed) && !empty($trainer->keahlian)) {
            $keahlianList = array_values(array_filter(
                array_map('trim', explode(',', $trainer->keahlian))
            ));
            if (count($keahlianList) === 1) {
                $displayed = $keahlianList[0];
            } elseif (count($keahlianList) > 1) {
                $displayed = $keahlianList[array_rand($keahlianList)];
            }
        }
        // ────────────────────────────────────────────────────────────

        // Update tabel trainer
        $trainer->update([
            'status'           => 'approved',
            'reviewed_at'      => now(),
            'displayed_bidang' => $displayed,  // ← tambahan ini
        ]);

        // Update tabel users
        if ($trainer->user_id) {
            \App\Models\User::where('id', $trainer->user_id)->update([
                'role'                  => 'trainer',
                'trainer_status'        => 'approved',
                'is_pembimbing'         => true,
                'pembimbing_expired_at' => now()->addYear(),
            ]);
        }
    });

    return redirect()->to('/admin/approval/trainer')
        ->with('success', "{$trainer->nama} berhasil disetujui sebagai Trainer.");
}
 
public function rejectTrainer(Request $request, \App\Models\Trainer $trainer)
{
    $request->validate([
        'rejection_reason' => 'required|string|max:1000',
    ]);
 
    \Illuminate\Support\Facades\DB::transaction(function () use ($request, $trainer) {
        // Update tabel trainer
        $trainer->update([
            'status'           => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'reviewed_at'      => now(),
        ]);
 
        // Update tabel users: trainer_status + alasan penolakan
        if ($trainer->user_id) {
            \App\Models\User::where('id', $trainer->user_id)->update([
                'role'                       => 'umum',
                'trainer_status'             => 'rejected',
                'trainer_rejection_reason'   => $request->rejection_reason,
            ]);
        }
    });
 
    return redirect()->route('admin.approval.trainer')
        ->with('success', "Pendaftaran {$trainer->nama} telah ditolak.");
}
 
public function destroyTrainer(\App\Models\Trainer $trainer)
{
    // Hapus semua file dokumen dari storage
    $fileCols = ['ktp_scan', 'bnsp_certificate', 'white_bg_photo', 'ijazah_file', 'bukti_transfer'];
    foreach ($fileCols as $col) {
        if (!empty($trainer->$col)) {
            \Storage::disk('public')->delete($trainer->$col);
        }
    }
 
    // Reset trainer_status di users
    if ($trainer->user_id) {
        \App\Models\User::where('id', $trainer->user_id)->update([
            'role'                   => 'umum',
            'trainer_status'         => 'none',
            'trainer_applied_at'     => null,
            'trainer_rejection_reason' => null,
            'is_pembimbing'          => false,
            'pembimbing_expired_at'  => null,
        ]);
    }
 
    $nama = $trainer->nama;
    $trainer->delete(); // hapus record dari tabel trainer
 
    return redirect()->route('admin.approval.trainer')
        ->with('success', "Data trainer {$nama} berhasil dihapus.");
}

public function restoreTrainer($id)
{
    $trainer = \App\Models\Trainer::onlyTrashed()->findOrFail($id);
    $trainer->restore();
    $trainer->update([
        'status'           => 'pending',
        'reviewed_at'      => null,
        'rejection_reason' => null,
    ]);

    // Sinkronkan status user
    if ($trainer->user_id) {
        \App\Models\User::where('id', $trainer->user_id)->update([
            'trainer_status' => 'pending',
        ]);
    }

    return redirect()->route('admin.approval.trainer')
        ->with('success', "Trainer {$trainer->nama} berhasil dipulihkan.");
}

public function forceDeleteTrainer($id)
{
    $trainer = \App\Models\Trainer::onlyTrashed()->findOrFail($id);

    // Hapus file dokumen dari storage
    $fileCols = ['ktp_scan', 'bnsp_certificate', 'white_bg_photo', 'ijazah_file', 'bukti_transfer', 'foto'];
    foreach ($fileCols as $col) {
        if (!empty($trainer->$col)) {
            \Storage::disk('public')->delete($trainer->$col);
        }
    }

    $nama = $trainer->nama;
    $trainer->forceDelete();

    return redirect()->route('admin.approval.trainer')
        ->with('success', "Data trainer {$nama} dihapus permanen.");
}

    // ═════════════════════════════════════════════════════════════════════
    // APPROVAL MENTOR
    // ═════════════════════════════════════════════════════════════════════
    public function approvalMentor(Request $request)
{
    // ── Export CSV ────────────────────────────────────────────────────
    if ($request->get('export') === 'csv') {
        $status = $request->get('status', 'pending');
        $data   = Mentor::where('status', $status)->get();
        $filename = "mentor-{$status}-" . now()->format('Ymd') . '.csv';

        return response()->streamDownload(function () use ($data) {
            $h = fopen('php://output', 'w');
            fprintf($h, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM UTF-8
            fputcsv($h, ['ID', 'Nama', 'Email', 'No. WhatsApp', 'Lokasi', 'Status', 'Tanggal Daftar']);
            foreach ($data as $m) {
                fputcsv($h, [
                    $m->id,
                    $m->full_name,
                    $m->email,
                    $m->phone,
                    $m->gmaps_location ?? '-',
                    $m->status,
                    $m->created_at->format('d/m/Y'),
                ]);
            }
            fclose($h);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }
    // ─────────────────────────────────────────────────────────────────

    $pending  = Mentor::where('status', 'pending')->whereNull('deleted_at')->get();
    $approved = Mentor::where('status', 'approved')->whereNull('deleted_at')->get();
    $rejected = Mentor::where('status', 'rejected')->whereNull('deleted_at')->get();
    $deleted  = Mentor::onlyTrashed()->latest('deleted_at')->get(); // ← TAMBAH

    $stats = [
        'pending'  => $pending->count(),
        'approved' => $approved->count(),
        'rejected' => $rejected->count(),
        'deleted'  => $deleted->count(), // ← TAMBAH
    ];

    return view('admin.approval-mentor', compact(
        'pending', 'approved', 'rejected', 'deleted', 'stats'
    ));
}
    public function approveMentor(Mentor $mentor)
{
    \Illuminate\Support\Facades\DB::transaction(function () use ($mentor) {
        $mentor->update([
            'status'      => 'approved',
            'reviewed_at' => now(),
        ]);
        if ($mentor->user_id) {
            \App\Models\User::where('id', $mentor->user_id)->update([
                'role'         => 'mentor',
                'mentor_status' => 'approved',
            ]);
        }
    });

    return back()->with('success', "{$mentor->full_name} berhasil disetujui sebagai Mentor.");
}
public function rejectMentor(Request $request, Mentor $mentor)
{
    $request->validate(['rejection_reason' => 'required|string|max:1000']);

    \Illuminate\Support\Facades\DB::transaction(function () use ($request, $mentor) {
        $mentor->update([
            'status'           => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'reviewed_at'      => now(),
        ]);

        if ($mentor->user_id) {
            \App\Models\User::where('id', $mentor->user_id)->update([
                'role'          => 'umum',
                'mentor_status' => 'rejected',
            ]);
        }
    });

    return back()->with('success', "Pendaftaran {$mentor->full_name} telah ditolak.");
}
public function destroyMentor(Mentor $mentor)
{
    $nama = $mentor->full_name;
    $mentor->delete(); // soft delete — masih bisa dipulihkan

    // Cabut akses sementara
    if ($mentor->user_id) {
        \App\Models\User::where('id', $mentor->user_id)->update([
            'role'          => 'umum',
            'mentor_status' => 'none',
        ]);
    }

    return back()->with('success', "Mentor \"{$nama}\" berhasil dihapus.");
}

public function restoreMentor($id)
{
    $mentor = Mentor::onlyTrashed()->findOrFail($id);
    $mentor->restore();
    $mentor->update([
        'status'           => 'pending',
        'reviewed_at'      => null,
        'rejection_reason' => null,
    ]);

    if ($mentor->user_id) {
        \App\Models\User::where('id', $mentor->user_id)->update([
            'mentor_status' => 'pending',
        ]);
    }

    return redirect()->route('admin.approval.mentor')
        ->with('success', "Mentor \"{$mentor->full_name}\" berhasil dipulihkan.");
}

public function forceDeleteMentor($id)
{
    $mentor = Mentor::onlyTrashed()->findOrFail($id);

    // Hapus file dokumen dari storage
    foreach (['ktp_scan', 'white_bg_photo', 'bukti_transfer'] as $col) {
        if (!empty($mentor->$col)) {
            \Storage::disk('public')->delete($mentor->$col);
        }
    }

    $nama = $mentor->full_name;
    $mentor->forceDelete();

    return redirect()->route('admin.approval.mentor')
        ->with('success', "Data mentor \"{$nama}\" dihapus permanen.");
}
}
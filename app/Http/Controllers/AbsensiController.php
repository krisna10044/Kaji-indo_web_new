<?php

namespace App\Http\Controllers;

use App\Models\AbsensiPeserta;
use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AbsensiController extends Controller
{
    /**
     * POST /absensi/{pelatihan}/submit
     */
    public function submit(Request $request, Program $pelatihan)
    {
        if (! auth()->check()) {
            return response()->json([
                'success'       => false,
                'require_login' => true,
                'message'       => 'Silakan login terlebih dahulu untuk absen.',
            ], 401);
        }
    
        if (! $this->isAbsensiActive($pelatihan)) {
            return response()->json([
                'success' => false,
                'message' => 'Absensi tidak sedang aktif.',
            ], 422);
        }
    
        $userId = auth()->id();
    
        $sudah = AbsensiPeserta::where('pelatihan_id', $pelatihan->id)  // ← fix
            ->where('user_id', $userId)
            ->first();
    
        if ($sudah) {
            return response()->json([
                'success'   => true,
                'duplicate' => true,
                'nama'      => auth()->user()->name,
                'waktu'     => $sudah->created_at
                                ->setTimezone(config('app.timezone'))
                                ->format('H:i'),
            ]);
        }
    
        $absensi = AbsensiPeserta::create([
            'pelatihan_id' => $pelatihan->id,  // ← fix
            'user_id'      => $userId,
            'ip_address'   => $request->ip(),
        ]);
    
        return response()->json([
            'success' => true,
            'nama'    => auth()->user()->name,
            'email'   => auth()->user()->email,
            'waktu'   => $absensi->created_at
                            ->setTimezone(config('app.timezone'))
                            ->format('H:i'),
        ]);
    }
    
    public function daftarAbsensi(Program $pelatihan)
    {
        if ($pelatihan->trainer_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }
    
        $peserta = AbsensiPeserta::with('user')
            ->where('pelatihan_id', $pelatihan->id)  // ← fix
            ->orderBy('created_at', 'asc')
            ->get();
    
        return response()->json([
            'success' => true,
            'total'   => $peserta->count(),
            'program' => $pelatihan->judul ?? $pelatihan->nama,
            'peserta' => $peserta->map(function ($p, $i) {
                return [
                    'no'    => $i + 1,
                    'nama'  => $p->user->name  ?? '–',
                    'email' => $p->user->email ?? '–',
                    'waktu' => $p->created_at
                                ->setTimezone(config('app.timezone'))
                                ->format('d M Y, H:i'),
                ];
            }),
        ]);
    }
    
    public function exportCsv(Program $pelatihan)
    {
        if ($pelatihan->trainer_id !== auth()->id()) {
            abort(403);
        }
    
        $peserta = AbsensiPeserta::with('user')
            ->where('pelatihan_id', $pelatihan->id)  // ← fix
            ->orderBy('created_at', 'asc')
            ->get();

        $nama     = $pelatihan->judul ?? $pelatihan->nama ?? 'program';
        $filename = 'absensi_' . Str::slug($nama) . '_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($peserta) {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($out, ['No', 'Nama', 'Email', 'Waktu Absen']);
            foreach ($peserta as $i => $p) {
                fputcsv($out, [
                    $i + 1,
                    $p->user->name  ?? '–',
                    $p->user->email ?? '–',
                    $p->created_at
                        ->setTimezone(config('app.timezone'))
                        ->format('d/m/Y H:i:s'),
                ]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function isAbsensiActive(Program $pelatihan): bool
    {
        if (empty($pelatihan->absensi_mulai) || empty($pelatihan->absensi_selesai)) {
            return false;
        }
        $now = Carbon::now();
        return $now->between(
            Carbon::parse($pelatihan->absensi_mulai),
            Carbon::parse($pelatihan->absensi_selesai)
        );
    }
}
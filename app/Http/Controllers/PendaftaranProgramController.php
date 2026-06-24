<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranProgram;
use App\Models\Program;  // ← ganti dari Pelatihan ke Program
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranProgramController extends Controller
{
    public function create($programId)
    {
        $program = Program::findOrFail($programId);  // ← ganti

        $sudahDaftar = PendaftaranProgram::where('user_id', Auth::id())
            ->where('program_id', $programId)
            ->whereIn('status', ['pending', 'menunggu_verifikasi', 'diterima'])
            ->exists();

        if ($sudahDaftar) {
            return redirect()->route('pelatihan.detail', $programId)
                ->with('info', 'Anda sudah mendaftar program ini.');
        }

        $isBerbayar = !empty($program->biaya)
            && strtolower($program->biaya) !== 'gratis'
            && $program->biaya != 0;

        $user = Auth::user();

        return view('pages.pendaftaran-program', compact('program', 'isBerbayar', 'user'));
    }

    public function store(Request $request, $programId)
    {
        $program = Program::findOrFail($programId);  // ← ganti

        $isBerbayar = !empty($program->biaya)
            && strtolower($program->biaya) !== 'gratis'
            && $program->biaya != 0;

        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'no_hp'        => 'required|string|max:20',
            'alamat'       => 'nullable|string|max:500',
        ];

        if ($isBerbayar) {
            $rules['bukti_pembayaran'] = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048';
        }

        $validated = $request->validate($rules);

        $buktiPath = null;
        if ($isBerbayar && $request->hasFile('bukti_pembayaran')) {
            $buktiPath = $request->file('bukti_pembayaran')
                ->store('bukti-pembayaran', 'public');
        }

        PendaftaranProgram::create([
            'user_id'          => Auth::id(),
            'program_id'       => $programId,
            'nama_lengkap'     => $validated['nama_lengkap'],
            'email'            => $validated['email'],
            'no_hp'            => $validated['no_hp'],
            'alamat'           => $validated['alamat'] ?? null,
            'bukti_pembayaran' => $buktiPath,
            'status'           => $isBerbayar ? 'menunggu_verifikasi' : 'diterima',
        ]);

        return redirect()->route('pelatihan.detail', $programId)
            ->with('success', $isBerbayar
                ? 'Pendaftaran berhasil! Bukti pembayaran sedang diverifikasi admin.'
                : 'Pendaftaran berhasil! Selamat datang di program ini.');
    }

    public function riwayat()
    {
        $pendaftarans = PendaftaranProgram::with('program')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.riwayat-pendaftaran', compact('pendaftarans'));
    }
}
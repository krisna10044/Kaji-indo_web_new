<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Trainerpelatihancontroller extends Controller
{
    public function storeKurikulum(Request $request)
    {
        $request->validate([
            'judul'           => 'required|string|max:255',
            'deskripsi'       => 'nullable|string|max:500',
            'metode'          => 'nullable|in:online,offline,hybrid',
            'tingkat'         => 'nullable|in:pemula,menengah,lanjut',
            'bahasa'          => 'nullable|string|max:100',
            'jumlah_materi'   => 'nullable|integer|min:0',
            'total_jam'       => 'nullable|numeric|min:0',
            'jumlah_sesi'     => 'nullable|integer|min:0',
            'sertifikat'      => 'nullable|in:0,1',
            'gambar'          => 'nullable|image|max:5120',
            'phone'           => 'nullable|string|max:20',
            'absensi_aktif'   => 'nullable',
            'absensi_mulai'   => 'nullable|date',
            'absensi_selesai' => 'nullable|date|after:absensi_mulai',
            'absensi_url'     => 'nullable|url|max:500',
            'alamat'          => 'nullable|string|max:500',
            'biaya'           => 'nullable|string|max:100',
            'nominal_biaya' => 'nullable|numeric|min:0',
            'program_mulai'   => 'nullable|date',            // ← tambah
            'program_selesai' => 'nullable|date|after_or_equal:program_mulai', // ← tambah
        ]);
        
       $absensiAktif = $request->input('absensi_aktif') == '1';

$data = [
    'trainer_id'      => Auth::id(),      // ← TAMBAHKAN INI
    'tipe'            => 'kurikulum',     // ← TAMBAHKAN INI
    'status'          => 'pending',       // ← TAMBAHKAN INI
    'judul'           => $request->judul,
    'deskripsi'       => $request->deskripsi,
    'metode'          => $request->metode,
    'tingkat'         => $request->tingkat,
    'bahasa'          => $request->bahasa ?? 'Bahasa Indonesia',
    'jumlah_materi'   => $request->jumlah_materi,
    'total_jam'       => $request->total_jam,
    'jumlah_sesi'     => $request->jumlah_sesi,
    'phone'           => $request->phone,
    'sertifikat'      => $request->sertifikat ?? 0,
    'alamat'          => $request->alamat,
    'biaya'           => $request->biaya,
    'nominal_biaya' => $request->biaya === 'Berbayar' ? $request->nominal_biaya : null,
    'absensi_aktif'   => $absensiAktif,
    'absensi_mulai'   => $absensiAktif ? $request->absensi_mulai   : null,
    'absensi_selesai' => $absensiAktif ? $request->absensi_selesai : null,
    'absensi_url'     => $absensiAktif ? $request->absensi_url     : null,
    'program_mulai'   => $request->filled('program_mulai')   ? $request->program_mulai   : null,
    'program_selesai' => $request->filled('program_selesai') ? $request->program_selesai : null,
];
    
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('programs', 'public');
        }
    
        Program::create($data);
    
        return redirect()->back()
            ->with('success', 'Kurikulum berhasil diajukan.')
            ->with('active_page', 'program');
    }

    public function updateKurikulum(Request $request, $id)
    {
        // Hapus pengecekan trainer_id agar tidak gagal silent
        $program = Program::findOrFail($id);
    
        // Pastikan hanya trainer pemilik yang bisa edit
        if ($program->trainer_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Tidak diizinkan mengedit kurikulum ini.');
        }
    
        $request->validate([
            'judul'           => 'required|string|max:255',
            'deskripsi'       => 'nullable|string|max:500',
            'metode'          => 'nullable|in:online,offline,hybrid',
            'tingkat'         => 'nullable|in:pemula,menengah,lanjut',
            'bahasa'          => 'nullable|string|max:100',
            'jumlah_materi'   => 'nullable|integer|min:0',
            'total_jam'       => 'nullable|numeric|min:0',
            'jumlah_sesi'     => 'nullable|integer|min:0',
            'sertifikat'      => 'nullable|in:0,1',
            'gambar'          => 'nullable|image|max:5120',
            'phone'           => 'nullable|string|max:20',
            'absensi_aktif'   => 'nullable',
            'absensi_mulai'   => 'nullable|date',
            'absensi_selesai' => 'nullable|date|after:absensi_mulai',
            'absensi_url'     => 'nullable|url|max:500',
            'alamat'          => 'nullable|string|max:500',
            'biaya'           => 'nullable|string|max:100',
            'nominal_biaya' => 'nullable|numeric|min:0',
            'program_mulai'   => 'nullable|date',                              // ← TAMBAH
            'program_selesai' => 'nullable|date|after_or_equal:program_mulai', // ← TAMBAH
        ]);
    
        $absensiAktif = $request->input('absensi_aktif') == '1';
    
        $data = [
            'judul'           => $request->judul,
            'deskripsi'       => $request->deskripsi,
            'metode'          => $request->metode,
            'tingkat'         => $request->tingkat,
            'bahasa'          => $request->bahasa ?? 'Bahasa Indonesia',
            'jumlah_materi'   => $request->jumlah_materi,
            'total_jam'       => $request->total_jam,
            'jumlah_sesi'     => $request->jumlah_sesi,
            'phone'           => $request->phone,
            'sertifikat'      => $request->sertifikat ?? 0,
            'alamat'          => $request->alamat,
            'biaya'           => $request->biaya,
            'nominal_biaya' => $request->biaya === 'Berbayar' ? $request->nominal_biaya : null,
            'absensi_aktif'   => $absensiAktif,
            'absensi_mulai'   => $absensiAktif ? $request->absensi_mulai   : null,
            'absensi_selesai' => $absensiAktif ? $request->absensi_selesai : null,
            'absensi_url'     => $absensiAktif ? $request->absensi_url     : null,
            'program_mulai'   => $request->filled('program_mulai')   ? $request->program_mulai   : null, // ← TAMBAH
            'program_selesai' => $request->filled('program_selesai') ? $request->program_selesai : null, // ← TAMBAH
        ];
    
        // Reset ke pending hanya jika bukan approved
        // (approved tetap approved, tidak perlu review ulang)
        if ($program->status !== 'approved') {
            $data['status'] = 'pending';
        }
    
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('programs', 'public');
        }
    
        $program->update($data);
    
        return redirect()->route('trainer.dashboard')
            ->with('success', 'Kurikulum berhasil diperbarui.')
            ->with('active_page', 'program');
    }

    // updateModul, storeModul, destroy — tidak perlu diubah
    public function updateModul(Request $request, $id)
    {
        $modul = Program::where('id', $id)
            ->where('trainer_id', Auth::id())
            ->where('tipe', 'modul')
            ->firstOrFail();
    
        $request->validate([
            'kurikulum_id'   => 'required|exists:programs,id',
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'nullable|string|max:500',
            'urutan'         => 'nullable|integer|min:1',
            'materi_type'    => 'nullable|in:pdf,youtube',
            'materi_pdf'     => 'nullable|file|mimes:pdf|max:20480',
            'materi_youtube' => 'nullable|url|max:255',
            'akses_mulai'    => 'nullable|date',
            'akses_selesai'  => 'nullable|date|after:akses_mulai',
        ]);
    
        $materiPdf = $modul->materi_pdf; // pertahankan PDF lama by default
        if ($request->materi_type === 'pdf' && $request->hasFile('materi_pdf')) {
            if ($modul->materi_pdf) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($modul->materi_pdf);
            }
            $materiPdf = $request->file('materi_pdf')->store('materi', 'public');
        } elseif ($request->materi_type !== 'pdf') {
            $materiPdf = null; // hapus referensi PDF jika ganti ke youtube/none
        }
    
        $modul->update([
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi,
            'urutan'         => $request->urutan,
            'kurikulum_id'   => $request->kurikulum_id,
            'materi_type'    => $request->materi_type,
            'materi_pdf'     => $materiPdf,
            'materi_youtube' => $request->materi_type === 'youtube' ? $request->materi_youtube : null,
            'akses_mulai'    => $request->akses_mulai  ?: null,
            'akses_selesai'  => $request->akses_selesai ?: null,
        ]);
    
        return redirect()->back()
            ->with('success', 'Modul berhasil diperbarui.')
            ->with('active_page', 'program');
    }

    public function storeModul(Request $request)
    {
        $request->validate([
            'kurikulum_id'   => 'required|exists:programs,id',
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'nullable|string|max:500',
            'urutan'         => 'nullable|integer|min:1',
            'materi_type'    => 'nullable|in:pdf,youtube',
            'materi_pdf'     => 'nullable|file|mimes:pdf|max:20480',
            'materi_youtube' => 'nullable|url|max:255',
        ]);
    
        Program::where('id', $request->kurikulum_id)
            ->where('trainer_id', Auth::id())
            ->where('tipe', 'kurikulum')
            ->firstOrFail();
    
        $materiPdf = null;
        if ($request->materi_type === 'pdf' && $request->hasFile('materi_pdf')) {
            $materiPdf = $request->file('materi_pdf')->store('materi', 'public');
        }
    
        Program::create([
            'trainer_id'     => Auth::id(),
            'tipe'           => 'modul',
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi,
            'urutan'         => $request->urutan,
            'kurikulum_id'   => $request->kurikulum_id,
            'bahasa'         => 'Bahasa Indonesia',
            'status'         => 'pending',
            'materi_type'    => $request->materi_type,
            'materi_pdf'     => $materiPdf,
            'materi_youtube' => $request->materi_type === 'youtube' ? $request->materi_youtube : null,
            'akses_mulai'    => $request->akses_mulai  ?: null,
            'akses_selesai'  => $request->akses_selesai ?: null,
        ]);
    
        return redirect()->back()
            ->with('success', 'Modul berhasil ditambahkan.')
            ->with('active_page', 'program');
    }

    public function destroy($id)
    {
        $program = Program::where('id', $id)
            ->where('trainer_id', Auth::id())
            ->firstOrFail();

        $label = $program->tipe === 'modul' ? 'Modul' : ucfirst($program->tipe);
        $program->delete();

        return redirect()->back()
            ->with('success', $label . ' berhasil dihapus.')
            ->with('active_page', 'program');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\MentorUlasan;
use App\Models\Produk;
use Illuminate\Http\Request;

class UmkmMentorUlasanController extends Controller
{
    /**
     * Simpan ulasan mentor.
     * Hanya boleh dilakukan oleh user UMKM yang produknya terhubung dengan mentor tersebut.
     */
    public function store(Request $request, $mentorId)
    {
        // 1. Pastikan mentor ada dan sudah approved
        $mentor = Mentor::where('status', 'approved')->findOrFail($mentorId);

        $detailUrl = route('umkm.mentor.detail', $mentor->id);

        // 2. Pastikan user login
        $user = auth()->user();

        // 3. Pastikan user adalah UMKM yang produknya terhubung langsung ke mentor ini
       // SESUDAH (cek kolom langsung + pivot table):
$terhubung = Produk::where('user_id', $user->id)
    ->where('status', 'approved')
    ->where(function ($q) use ($mentor) {
        $q->where('mentor_id', $mentor->id)           // via FK langsung
          ->orWhereHas('mentors', fn($m) => $m->where('mentor.id', $mentor->id)); // via pivot
    })
    ->exists();

if (! $terhubung) {
    return redirect($detailUrl)->with('error', 'Hanya UMKM yang terhubung dengan mentor ini yang dapat memberikan ulasan.');
}

        // 4. Cegah ulasan duplikat
        $sudahUlasan = MentorUlasan::where('mentor_id', $mentor->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($sudahUlasan) {
            return redirect($detailUrl)->with('error', 'Anda sudah memberikan ulasan untuk mentor ini.');
        }

        // 5. Validasi input
        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ], [
            'rating.required' => 'Pilih bintang rating terlebih dahulu.',
            'rating.min'      => 'Rating minimal 1 bintang.',
            'rating.max'      => 'Rating maksimal 5 bintang.',
            'komentar.max'    => 'Komentar maksimal 1000 karakter.',
        ]);

        // 6. Simpan ulasan
        MentorUlasan::create([
            'mentor_id' => $mentor->id,
            'user_id'   => $user->id,
            'rating'    => $request->rating,
            'komentar'  => $request->komentar,
        ]);

        return redirect($detailUrl)->with('success', 'Ulasan berhasil dikirim. Terima kasih atas penilaian Anda!');
    }

    /**
     * Hapus ulasan (hanya bisa dihapus oleh pemilik ulasan itu sendiri)
     */
    public function destroy($mentorId, $ulasanId)
    {
        $ulasan = MentorUlasan::where('mentor_id', $mentorId)
            ->where('id', $ulasanId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $ulasan->delete();

        return redirect(route('umkm.mentor.detail', $mentorId))->with('success', 'Ulasan berhasil dihapus.');
    }
}
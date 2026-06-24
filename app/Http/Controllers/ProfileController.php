<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use App\Models\ActivityLog;
use App\Models\Mentor;
use App\Models\Produk;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user->name    = $request->name;
        $user->phone   = $request->phone;
        $user->address = $request->address;

        $user->save();

        ActivityLog::create([
            'user_id'     => $user->id,
            'type'        => 'profile',
            'label'       => 'Update profil',
            'description' => 'Informasi profil diperbarui',
            'ip_address'  => $request->ip(),
            'user_agent'  => $request->userAgent(),
            'is_success'  => true,
        ]);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function deletePhoto()
    {
        $user = Auth::user();

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
            $user->profile_photo_path = null;
            $user->save();

            ActivityLog::create([
                'user_id'     => $user->id,
                'type'        => 'photo',
                'label'       => 'Hapus foto profil',
                'description' => 'Foto profil dihapus',
                'ip_address'  => request()->ip(),
                'user_agent'  => request()->userAgent(),
                'is_success'  => true,
            ]);
        }

        return redirect()->route('profile.edit')
            ->with('success', 'Foto profil berhasil dihapus.');
    }

    public function password()
    {
        return view('profile.password');
    }

    public function updatePhoto(Request $request)
    {
        $user = \App\Models\User::findOrFail(Auth::id());

        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
            $user->save();

            ActivityLog::create([
                'user_id'     => $user->id,
                'type'        => 'photo',
                'label'       => 'Update foto profil',
                'description' => 'Foto profil berhasil diperbarui',
                'ip_address'  => $request->ip(),
                'user_agent'  => $request->userAgent(),
                'is_success'  => true,
            ]);
        }

        return redirect()->route('profile')->with('success', 'Foto profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'confirmed', Password::min(8)],
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini tidak sesuai.',
            ]);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        ActivityLog::create([
            'user_id'     => Auth::id(),
            'type'        => 'password',
            'label'       => 'Ubah password',
            'description' => 'Password berhasil diperbarui',
            'ip_address'  => $request->ip(),
            'user_agent'  => $request->userAgent(),
            'is_success'  => true,
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }

    // =====================
    // NOTIFIKASI
    // =====================
    public function notifications()
    {
        return view('profile.notifications');
    }

    public function updateNotifications(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'notif_email_pelatihan'  => $request->has('notif_email_pelatihan')  ? 1 : 0,
            'notif_email_umkm'       => $request->has('notif_email_umkm')       ? 1 : 0,
            'notif_email_halal'      => $request->has('notif_email_halal')       ? 1 : 0,
            'notif_email_newsletter' => $request->has('notif_email_newsletter')  ? 1 : 0,
            'notif_browser'          => $request->has('notif_browser')           ? 1 : 0,
        ]);

        ActivityLog::create([
            'user_id'     => $user->id,
            'type'        => 'profile',
            'label'       => 'Update pengaturan notifikasi',
            'description' => 'Preferensi notifikasi diperbarui',
            'ip_address'  => $request->ip(),
            'user_agent'  => $request->userAgent(),
            'is_success'  => true,
        ]);

        return back()->with('success', 'Pengaturan notifikasi berhasil disimpan!');
    }

    // =====================
    // HALAMAN PROFIL UTAMA
    // =====================
    public function index()
    {
        $user       = Auth::user()->fresh();
        $activities = ActivityLog::where('user_id', $user->id)->latest()->take(5)->get();
        $umkm       = \App\Models\Produk::where('user_id', $user->id)->latest()->first();
        $mentor     = \App\Models\Mentor::where('user_id', $user->id)->latest()->first();
        $trainer    = \App\Models\Trainer::where('user_id', $user->id)->latest()->first();

        return view('profile.index', compact('user', 'activities', 'umkm', 'mentor', 'trainer'));
    }

    public function daftarMentor(Request $request)
    {
        $user = Auth::user();

        ActivityLog::create([
            'user_id'     => $user->id,
            'type'        => 'profile',
            'label'       => 'Pengajuan Trainer',
            'description' => 'User mengajukan diri menjadi Trainer profesional',
            'ip_address'  => $request->ip(),
            'user_agent'  => $request->userAgent(),
            'is_success'  => true,
        ]);

        return back()->with('success', 'Pengajuan sebagai trainer telah dikirim!');
    }

    // =====================
    // TRAINER
    // =====================

    /**
     * Tampilkan formulir pendaftaran trainer.
     * Sosmed di-flatten ke $sosmedData agar mudah di-prefill via old().
     */
    public function showDaftarTrainer()
    {
        $user       = Auth::user();
        $trainer    = \App\Models\Trainer::where('user_id', $user->id)->first();
        $sosmedData = $trainer?->sosmed ?? [];   // sudah di-cast array oleh model

        return view('profile.daftar-trainer', compact('user', 'trainer', 'sosmedData'));
    }

    /**
     * Simpan / update data pendaftaran trainer.
     * Kolom sosmed (JSON) dan keahlian (text/CSV) sudah ada di tabel.
     */
    public function simpanTrainer(Request $request)
    {
        $user     = Auth::user();
        $existing = \App\Models\Trainer::where('user_id', $user->id)->first();

        // Cegah submit ulang jika sedang pending
        if ($existing && $existing->status === 'pending') {
            return back()->with('error', 'Pendaftaran kamu sedang dalam proses review admin.');
        }

        // ── Validasi ─────────────────────────────────────────────────
        $request->validate([
            'academic_degree'          => 'required|string|max:255',
            'no_hp'                    => 'required|string|max:20',
            'email'                    => 'required|email|max:255',
            'nik'                      => 'required|digits:16',
            'npwp'                     => 'nullable|string|max:30',
            'gmaps_location'           => 'required|string|max:500',
            'provinsi'                 => 'required|string|max:255',
            'kabupaten'                => 'required|string|max:255',
            'kecamatan'                => 'required|string|max:255',
            'kelurahan'                => 'required|string|max:255',
            'ijazah_type'              => 'required|in:SMA,D3,S1,S2,S3',
            'drive_link_documentation' => 'required|url|max:255',
            'experience'               => 'required|string',
            'bio'                      => 'required|string',
            'bidang_keahlian'          => 'required|string',
            // Sosmed tidak wajib satu per satu — dicek manual di bawah
            'sosmed_instagram'         => 'nullable|string|max:100',
            'sosmed_twitter'           => 'nullable|string|max:100',
            'sosmed_linkedin'          => 'nullable|url|max:255',
            'sosmed_youtube'           => 'nullable|url|max:255',
            'sosmed_facebook'          => 'nullable|url|max:255',
            // File — wajib hanya jika belum pernah diupload
            'ktp_scan'        => ($existing?->ktp_scan        ? 'nullable' : 'required') . '|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'bnsp_certificate'=> ($existing?->bnsp_certificate ? 'nullable' : 'required') . '|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'white_bg_photo'  => ($existing?->white_bg_photo   ? 'nullable' : 'required') . '|file|mimes:jpg,jpeg,png|max:2048',
            'bukti_transfer'  => ($existing?->bukti_transfer   ? 'nullable' : 'required') . '|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'agree_terms'     => 'required|accepted',
        ]);

        // ── Jalankan dalam transaksi ──────────────────────────────────
        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($request, $user, $existing) {

                // Cek minimal 1 sosmed diisi
                $sosmedFilled = collect([
                    'sosmed_instagram', 'sosmed_twitter', 'sosmed_linkedin',
                    'sosmed_youtube',   'sosmed_facebook',
                ])->some(fn($f) => !empty($request->input($f)));

                if (!$sosmedFilled) {
                    throw new \Exception('Isi minimal satu akun sosial media.');
                }

                // Bangun array sosmed → disimpan sebagai JSON
                $sosmed = array_filter([
                    'instagram' => $request->input('sosmed_instagram'),
                    'twitter'   => $request->input('sosmed_twitter'),
                    'linkedin'  => $request->input('sosmed_linkedin'),
                    'youtube'   => $request->input('sosmed_youtube'),
                    'facebook'  => $request->input('sosmed_facebook'),
                ]);

                // Bidang keahlian (CSV dari hidden input di Blade)
                $keahlian = $request->input('bidang_keahlian');

                // ── Data utama ────────────────────────────────────────
                $data = [
                    'user_id'                  => $user->id,
                    'nama'                     => $user->name,
                    'full_name'                => $user->name,
                    'email'                    => $request->email,
                    'no_hp'                    => $request->no_hp,
                    'phone'                    => $request->no_hp,
                    'academic_degree'          => $request->academic_degree,
                    'nik'                      => $request->nik,
                    'npwp'                     => $request->npwp,
                    'gmaps_location'           => $request->gmaps_location,
                    'lokasi'                   => $request->gmaps_location,
                    'provinsi'                 => $request->provinsi,
                    'kabupaten'                => $request->kabupaten,
                    'kecamatan'                => $request->kecamatan,
                    'kelurahan'                => $request->kelurahan,
                    'ijazah_type'              => $request->ijazah_type,
                    'drive_link_documentation' => $request->drive_link_documentation,
                    'experience'               => $request->experience,
                    'bio'                      => $request->bio,
                    'keahlian'                 => $keahlian,   // ← kolom text/CSV
                    'sosmed'                   => $sosmed,     // ← kolom JSON
                    'agree_terms'              => 1,
                    'status'                   => 'pending',
                    'applied_at'               => now(),
                ];

                // ── Upload file (ganti jika ada file baru) ────────────
                $fileMap = [
                    'ktp_scan'         => 'trainer_docs',
                    'bnsp_certificate' => 'trainer_docs',
                    'white_bg_photo'   => 'trainer_docs',
                    'bukti_transfer'   => 'trainer_docs',
                ];

                foreach ($fileMap as $field => $folder) {
                    if ($request->hasFile($field)) {
                        // Hapus file lama jika ada
                        if ($existing?->$field) {
                            \Storage::disk('public')->delete($existing->$field);
                        }
                        $data[$field] = $request->file($field)->store($folder, 'public');
                    }
                }

                // ── Insert atau update ────────────────────────────────
                \App\Models\Trainer::updateOrCreate(
                    ['user_id' => $user->id],
                    $data
                );

                // ── Update status di tabel users ──────────────────────
                $user->update([
                    'trainer_status'     => 'pending',
                    'trainer_applied_at' => now(),
                ]);

                // ── Activity log ──────────────────────────────────────
                \App\Models\ActivityLog::create([
                    'user_id'     => $user->id,
                    'type'        => 'profile',
                    'label'       => 'Menunggu Persetujuan Trainer',
                    'description' => 'User melengkapi persyaratan dan menunggu verifikasi admin',
                    'ip_address'  => request()->ip(),
                    'user_agent'  => request()->userAgent(),
                    'is_success'  => true,
                ]);
            });

        } catch (\Exception $e) {
            return back()->withErrors(['sosmed' => $e->getMessage()])->withInput();
        }

        return redirect()->route('profile')
            ->with('success', 'Pendaftaran trainer berhasil dikirim! Tunggu verifikasi admin.');
    }

    // =====================
    // UMKM
    // =====================

    public function showDaftarUmkm()
    {
        $user = Auth::user();
        if (!$user->profile_photo_path) {
            return redirect()->route('profile')->with('error', 'Upload foto profil dulu sebelum mendaftar sebagai UMKM.');
        }
        return view('profile.daftar-umkm');
    }

    public function simpanUmkm(Request $request)
    {
        $user = Auth::user();

        if (!$user->profile_photo_path) {
            return back()->with('error', 'Anda harus mengupload foto profil terlebih dahulu sebelum mendaftar sebagai UMKM.');
        }

        $request->validate([
            'nama'           => 'required|string|max:255',
            'kategori'       => 'required',
            'owner'          => 'required|string|max:255',
            'kontak'         => 'required|string|max:20',
            'provinsi'       => 'required',
            'kabupaten_kota' => 'required',
            'kecamatan'      => 'required',
            'kelurahan'      => 'required',
            'alamat'         => 'required|string',
            'deskripsi'      => 'required|string',
            'logo'           => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
            'foto_produk'    => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
            'lat'            => 'required|numeric|between:-11,6',
            'lng'            => 'required|numeric|between:95,141',
            'terms'          => 'required',
        ], [
            'terms.required' => 'Anda harus menyetujui Syarat dan Ketentuan.',
            'logo.required'  => 'Logo usaha wajib diunggah.',
            'lat.required'   => 'Titik lokasi di peta wajib dipilih.',
            'lng.required'   => 'Titik lokasi di peta wajib dipilih.',
            'lat.between'    => 'Koordinat tidak valid, pastikan lokasi berada di wilayah Indonesia.',
            'lng.between'    => 'Koordinat tidak valid, pastikan lokasi berada di wilayah Indonesia.',
        ]);

        $logoPath       = $request->file('logo')->store('produk-pict', 'public');
        $fotoProdukPath = $request->file('foto_produk')->store('produk-pict', 'public');

        \App\Models\Produk::create([
            'user_id'        => auth()->id(),
            'nama'           => $request->nama,
            'kategori'       => $request->kategori,
            'owner'          => $request->owner,
            'kontak'         => $request->kontak,
            'nib'            => $request->nib,
            'id_tkm'         => $request->id_tkm,
            'provinsi'       => $request->provinsi,
            'kabupaten_kota' => $request->kabupaten_kota,
            'kecamatan'      => $request->kecamatan,
            'kelurahan'      => $request->kelurahan,
            'alamat'         => $request->alamat,
            'deskripsi'      => $request->deskripsi,
            'whatsapp'       => preg_replace('/[^0-9]/', '', $request->kontak),
            'logo'           => $logoPath,
            'foto_produk'    => $fotoProdukPath,
            'lat'            => $request->lat,
            'lng'            => $request->lng,
            'status'         => 'pending',
        ]);

        ActivityLog::create([
            'user_id'     => auth()->id(),
            'type'        => 'profile',
            'label'       => 'Pendaftaran UMKM',
            'description' => 'User mendaftarkan unit usaha UMKM: ' . $request->nama,
            'ip_address'  => $request->ip(),
            'user_agent'  => $request->userAgent(),
            'is_success'  => true,
        ]);

        return redirect()->route('profile')->with('success', 'Pendaftaran UMKM berhasil dikirim! Mohon tunggu verifikasi admin.');
    }

    // =====================
    // MENTOR
    // =====================

    public function showDaftarMentor()
{
    $user = Auth::user();

    if (!$user->profile_photo_path) {          // ← cek dulu
        return redirect()->route('profile')->with('error', 'Upload foto profil dulu sebelum mendaftar sebagai Mentor.');
    }

    $mentor     = \App\Models\Mentor::where('user_id', $user->id)->latest()->first();
    $sosmedData = $mentor?->sosmed ?? [];

    return view('profile.daftar-mentor', compact('user', 'mentor', 'sosmedData'));
}
 
    public function simpanMentor(Request $request)
    {
        $user     = Auth::user();
        $existing = \App\Models\Mentor::where('user_id', $user->id)->latest()->first();
 
        if (!$user->profile_photo_path) {
            return back()->with('error', 'Anda harus mengupload foto profil terlebih dahulu sebelum mendaftar sebagai Mentor.');
        }
 
        // Cegah submit ulang jika sedang pending
        if ($existing && $existing->status === 'pending') {
            return back()->with('error', 'Pendaftaran kamu sedang dalam proses review admin.');
        }
 
        $request->validate([
            'full_name'          => 'required|string|max:255',
            'phone'              => 'required|string|max:20',
            'email'              => 'required|email|max:255',
            'gmaps_location'     => 'required|string|max:500',
            'provinsi'           => 'required|string|max:255',
            'kabupaten'          => 'required|string|max:255',
            'kecamatan'          => 'required|string|max:255',
            'kelurahan'          => 'required|string|max:255',
            'bio'                => 'required|string',
            'bidang_spesialisasi'=> 'required|string',
            // Sosmed — dicek manual (minimal 1)
            'sosmed_instagram'   => 'nullable|string|max:100',
            'sosmed_twitter'     => 'nullable|string|max:100',
            'sosmed_linkedin'    => 'nullable|url|max:255',
            'sosmed_youtube'     => 'nullable|url|max:255',
            'sosmed_facebook'    => 'nullable|url|max:255',
            // File — wajib hanya jika belum pernah diupload
            'white_bg_photo'     => ($existing?->white_bg_photo ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png|max:2048',
            'ktp_scan'           => ($existing?->ktp_scan       ? 'nullable' : 'required') . '|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'bukti_transfer'     => ($existing?->bukti_transfer  ? 'nullable' : 'required') . '|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'agree_terms'        => 'required|accepted',
            'lat'                => 'required|numeric|between:-11,6',
            'lng'                => 'required|numeric|between:95,141',
        ], [
            'full_name.required'          => 'Nama lengkap wajib diisi.',
            'phone.required'              => 'Nomor WhatsApp wajib diisi.',
            'email.required'              => 'Email aktif wajib diisi.',
            'email.email'                 => 'Format email tidak valid.',
            'gmaps_location.required'     => 'Lokasi tinggal wajib diisi.',
            'provinsi.required'           => 'Provinsi wajib dipilih.',
            'kabupaten.required'          => 'Kabupaten/Kota wajib dipilih.',
            'kecamatan.required'          => 'Kecamatan wajib dipilih.',
            'kelurahan.required'          => 'Desa/Kelurahan wajib dipilih.',
            'bio.required'                => 'Tentang diri Anda wajib diisi.',
            'bidang_spesialisasi.required'=> 'Pilih minimal 1 bidang spesialisasi.',
            'white_bg_photo.required'     => 'Pas foto background putih wajib diunggah.',
            'white_bg_photo.image'        => 'Pas foto harus berupa gambar (JPG/PNG).',
            'white_bg_photo.max'          => 'Ukuran pas foto maksimal 2 MB.',
            'ktp_scan.required'           => 'Scan KTP wajib diunggah.',
            'ktp_scan.mimes'              => 'Scan KTP harus berformat JPG, PNG, atau PDF.',
            'ktp_scan.max'                => 'Ukuran scan KTP maksimal 2 MB.',
            'bukti_transfer.required'     => 'Bukti transfer wajib diunggah.',
            'bukti_transfer.mimes'        => 'Bukti transfer harus berformat JPG, PNG, atau PDF.',
            'bukti_transfer.max'          => 'Ukuran bukti transfer maksimal 2 MB.',
            'agree_terms.required'        => 'Anda wajib menyetujui Syarat dan Ketentuan.',
            'agree_terms.accepted'        => 'Anda wajib menyetujui Syarat dan Ketentuan.',
            'lat.required'                => 'Titik lokasi di peta wajib dipilih.',
            'lng.required'                => 'Titik lokasi di peta wajib dipilih.',
            'lat.between'                 => 'Koordinat tidak valid, pastikan lokasi di wilayah Indonesia.',
            'lng.between'                 => 'Koordinat tidak valid, pastikan lokasi di wilayah Indonesia.',
        ]);
 
        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($request, $user, $existing) {
 
                // ── Cek minimal 1 sosmed diisi ────────────────────────
                $sosmedFilled = collect([
                    'sosmed_instagram', 'sosmed_twitter', 'sosmed_linkedin',
                    'sosmed_youtube',   'sosmed_facebook',
                ])->some(fn($f) => !empty($request->input($f)));
 
                if (!$sosmedFilled) {
                    throw new \Exception('Isi minimal satu akun sosial media.');
                }
 
                // ── Bangun array sosmed → disimpan sebagai JSON ────────
                $sosmed = array_filter([
                    'instagram' => $request->input('sosmed_instagram'),
                    'twitter'   => $request->input('sosmed_twitter'),
                    'linkedin'  => $request->input('sosmed_linkedin'),
                    'youtube'   => $request->input('sosmed_youtube'),
                    'facebook'  => $request->input('sosmed_facebook'),
                ]);
 
                // ── Lokasi gabungan ───────────────────────────────────
                $lokasi = implode(', ', array_filter([
                    $request->kelurahan,
                    $request->kecamatan,
                    $request->kabupaten,
                    $request->provinsi,
                ]));

                $spesialisasiArr = array_values(array_filter(
                    array_map('trim', explode(',', $request->input('bidang_spesialisasi', '')))
                ));
 
                // ── Data utama ────────────────────────────────────────
                $data = [
                    'user_id'               => $user->id,
                    'full_name'             => $request->full_name,
                    'nama'                  => $request->full_name,
                    'phone'                 => $request->phone,
                    'email'                 => $request->email,
                    'gmaps_location'        => $request->gmaps_location,
                    'provinsi'              => $request->provinsi,
                    'kabupaten'             => $request->kabupaten,
                    'kecamatan'             => $request->kecamatan,
                    'kelurahan'             => $request->kelurahan,
                    'lokasi'                => $lokasi,
                    'bio'                   => $request->bio,
                    'deskripsi'             => $request->bio,
                    'agree_terms'           => true,
                    'role'                  => 'Pembimbing',
                    'lat'                   => $request->lat,
                    'lng'                   => $request->lng,
                    'status'         => 'pending',
                    'sosmed'         => $sosmed,
                    'spesialisasi'   => $spesialisasiArr,
                ];
 
                // ── Upload file (ganti jika ada file baru) ────────────
                $fileMap = [
                    'white_bg_photo' => 'mentor/foto',
                    'ktp_scan'       => 'mentor/ktp',
                    'bukti_transfer' => 'mentor/transfer',
                ];
 
                foreach ($fileMap as $field => $folder) {
                    if ($request->hasFile($field)) {
                        if ($existing?->$field) {
                            \Storage::disk('public')->delete($existing->$field);
                        }
                        $data[$field] = $request->file($field)->store($folder, 'public');
                    }
                }
 
                // ── Insert atau update ────────────────────────────────
                $mentor = \App\Models\Mentor::updateOrCreate(
                    ['user_id' => $user->id],
                    $data
                );

                // Force simpan spesialisasi secara eksplisit
                $mentor->sosmed       = $sosmed;                
$mentor->spesialisasi = $spesialisasiArr;
$mentor->save();
 
                // ── Activity log ──────────────────────────────────────
                \App\Models\ActivityLog::create([
                    'user_id'     => $user->id,
                    'type'        => 'profile',
                    'label'       => 'Pendaftaran Mentor',
                    'description' => 'User mengajukan diri menjadi Mentor: ' . $request->full_name,
                    'ip_address'  => request()->ip(),
                    'user_agent'  => request()->userAgent(),
                    'is_success'  => true,
                ]);
            });
 
        } catch (\Exception $e) {
            return back()->withErrors(['sosmed' => $e->getMessage()])->withInput();
        }
 
        return redirect()->route('profile')
            ->with('success', 'Pendaftaran mentor berhasil dikirim, menunggu review admin.');
    }
}
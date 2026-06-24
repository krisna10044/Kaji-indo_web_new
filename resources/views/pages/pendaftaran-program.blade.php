@extends('layouts.app')

@section('title', 'Daftar Program: ' . $program->judul . ' - KAJI INDONESIA')

@section('content')

{{-- Header --}}
<section class="bg-gradient-to-br from-primary-dark via-primary to-primary py-10 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
            <a href="{{ route('pelatihan.detail', $program->id) }}" class="text-white/80 hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="font-serif text-2xl font-bold">Form Pendaftaran</h1>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-12 px-4 min-h-screen">
    <div class="max-w-2xl mx-auto space-y-6">

        {{-- Info Program --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 flex gap-4 items-center">
            <div class="w-14 h-14 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0 text-3xl">
                @if($program->gambar)
                    <img src="{{ asset('storage/' . $program->gambar) }}" class="w-full h-full object-cover rounded-xl" alt="">
                @else
                    &#127891;
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs text-gray-400 uppercase tracking-wide font-semibold mb-0.5">Program Pelatihan</p>
                <h2 class="font-serif font-bold text-gray-900 text-base leading-snug truncate">{{ $program->judul }}</h2>
                <div class="flex items-center gap-2 mt-1.5 flex-wrap">
                    @if($isBerbayar)
                        <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold px-2.5 py-1 rounded-full">
                            &#128179; {{ $program->biaya }}
                            @if($program->nominal_biaya)
                                &middot; Rp {{ number_format($program->nominal_biaya, 0, ',', '.') }}
                            @endif
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 bg-green-50 text-green-700 border border-green-200 text-xs font-bold px-2.5 py-1 rounded-full">
                            &#9989; Gratis
                        </span>
                    @endif
                    <span class="text-xs text-gray-400">{{ ucfirst($program->metode ?? '-') }}</span>
                </div>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('pelatihan.pendaftaran.store', $program->id) }}" method="POST" enctype="multipart/form-data"
              class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 space-y-5">
            @csrf

            <h3 class="font-serif font-bold text-gray-900 text-lg pb-3 border-b border-gray-100">Data Diri Pendaftar</h3>

            {{-- Nama --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_lengkap"
                       value="{{ old('nama_lengkap', $user->name ?? '') }}"
                       placeholder="Masukkan nama lengkap Anda"
                       class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent @error('nama_lengkap') border-red-400 @enderror">
                @error('nama_lengkap') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email"
                       value="{{ old('email', $user->email ?? '') }}"
                       placeholder="contoh@email.com"
                       class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent @error('email') border-red-400 @enderror">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- No HP --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">
                    Nomor HP / WhatsApp <span class="text-red-500">*</span>
                </label>
                <input type="text" name="no_hp"
                       value="{{ old('no_hp', $user->phone ?? '') }}"
                       placeholder="08xxxxxxxxxx"
                       class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent @error('no_hp') border-red-400 @enderror">
                @error('no_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">Alamat</label>
                <textarea name="alamat" rows="2" placeholder="Alamat tempat tinggal (opsional)"
                          class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent resize-none">{{ old('alamat') }}</textarea>
            </div>

            {{-- Bukti Pembayaran (hanya jika berbayar) --}}
            @if($isBerbayar)
            <div class="pt-2 border-t border-gray-100">
                <h3 class="font-serif font-bold text-gray-900 text-lg mb-4">Pembayaran</h3>

                {{-- Info biaya --}}
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-4 flex items-start gap-3">
                    <span class="text-2xl flex-shrink-0">&#128179;</span>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-amber-800 mb-0.5">Biaya Program: {{ $program->biaya }}</p>
                        <p class="text-xs text-amber-700 leading-relaxed">
                            Silakan transfer ke rekening berikut, lalu upload bukti pembayaran di bawah ini.
                            Pendaftaran akan dikonfirmasi setelah admin memverifikasi pembayaran Anda.
                        </p>

                        {{-- Nominal biaya --}}
                        @if($program->nominal_biaya)
                        <div class="mt-2 bg-amber-100 border border-amber-300 rounded-lg px-3 py-2 text-sm font-bold text-amber-900 flex items-center justify-between">
                            <span>Total yang harus dibayar:</span>
                            <span>Rp {{ number_format($program->nominal_biaya, 0, ',', '.') }}</span>
                        </div>
                        @endif

                        {{-- Info rekening --}}
                        <div class="mt-2 bg-white border border-amber-200 rounded-lg px-3 py-2 text-xs text-gray-700 space-y-0.5">
                            <p><span class="font-semibold">Bank BNI</span> &ndash; 873873298</p>
                            <p>a.n. <span class="font-semibold">Ari Prabowo</span></p>
                        </div>
                    </div>
                </div>

                {{-- Upload Bukti --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5">
                        Upload Bukti Pembayaran <span class="text-red-500">*</span>
                    </label>

                    <label for="bukti_pembayaran"
                           class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-xl py-8 px-4 cursor-pointer hover:border-green-400 hover:bg-green-50 transition group @error('bukti_pembayaran') border-red-400 @enderror"
                           id="uploadLabel">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-300 group-hover:text-green-400 transition mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                        </svg>
                        <p class="text-sm text-gray-500 group-hover:text-green-600 font-medium" id="uploadText">Klik untuk upload file</p>
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, atau PDF &bull; Maks. 2MB</p>
                    </label>

                    <input type="file" id="bukti_pembayaran" name="bukti_pembayaran"
                           accept=".jpg,.jpeg,.png,.pdf" class="hidden"
                           onchange="previewBukti(this)">

                    {{-- Preview --}}
                    <div id="previewContainer" class="hidden mt-3">
                        <img id="previewImg" src="" alt="Preview"
                             class="rounded-xl border border-gray-200 max-h-48 object-contain w-full">
                        <p id="previewName" class="text-xs text-gray-500 mt-1 text-center"></p>
                    </div>

                    @error('bukti_pembayaran') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            @endif

            {{-- Submit --}}
            <div class="pt-4 flex gap-3">
                <button type="submit"
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl text-sm transition-colors">
                    {{ $isBerbayar ? 'Kirim Pendaftaran & Bukti Bayar' : 'Kirim Pendaftaran' }}
                </button>
                <a href="{{ route('pelatihan.detail', $program->id) }}"
                   class="px-5 py-3 border border-gray-300 text-gray-600 hover:bg-gray-50 rounded-xl text-sm font-semibold transition-colors">
                    Batal
                </a>
            </div>

        </form>
    </div>
</section>

@push('scripts')
<script>
function previewBukti(input) {
    const text        = document.getElementById('uploadText');
    const preview     = document.getElementById('previewContainer');
    const previewImg  = document.getElementById('previewImg');
    const previewName = document.getElementById('previewName');

    if (!input.files || !input.files[0]) return;

    const file = input.files[0];
    previewName.textContent = file.name;
    text.textContent = '&#10003; File dipilih';

    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = e => {
            previewImg.src = e.target.result;
            previewImg.classList.remove('hidden');
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        previewImg.classList.add('hidden');
        preview.classList.remove('hidden');
    }
}
</script>
@endpush

@endsection
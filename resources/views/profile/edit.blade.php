@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600&display=swap');

    .blob {
        position: fixed;
        border-radius: 50%;
        filter: blur(90px);
        opacity: 0.4;
        pointer-events: none;
        z-index: 0;
        animation: float 14s ease-in-out infinite;
    }
    .blob-a { width: 520px; height: 520px; background: #c7d9ff; top: -180px; right: -120px; animation-delay: 0s; }
    .blob-b { width: 380px; height: 380px; background: #d4f0e0; bottom: -8
    0px; left: -60px; animation-delay: -5s; }
    .blob-c { width: 260px; height: 260px; background: #fdeac7; top: 45%; left: 35%; animation-delay: -9s; }

    @keyframes float {
        0%, 100% { transform: translate(0,0) scale(1); }
        40% { transform: translate(18px,-28px) scale(1.04); }
        70% { transform: translate(-12px,16px) scale(0.97); }
    }

    .profile-page {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 3rem 1.25rem 4rem;
        font-family: 'DM Sans', sans-serif;
    }

    .profile-card {
        width: 100%;
        max-width: 540px;
        background: rgba(255,255,255,0.88);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255,255,255,0.95);
        border-radius: 28px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.04), 0 8px 32px rgba(0,0,0,0.07), 0 32px 64px rgba(0,0,0,0.05);
        overflow: hidden;
        animation: rise 0.55s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    @keyframes rise {
        from { opacity: 0; transform: translateY(28px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .profile-hero {
        position: relative;
        padding: 2.25rem 2rem 2rem;
        background: linear-gradient(145deg, #eef3ff 0%, #f8faff 55%, #edfaf3 100%);
        border-bottom: 1px solid rgba(0,0,0,0.045);
    }

    .profile-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle, rgba(0,0,0,0.06) 1px, transparent 1px);
        background-size: 22px 22px;
        pointer-events: none;
    }

    .profile-back {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.73rem;
        font-weight: 500;
        color: #6b7280;
        text-decoration: none;
        padding: 5px 10px 5px 8px;
        border-radius: 9px;
        background: rgba(255,255,255,0.75);
        border: 1px solid rgba(0,0,0,0.07);
        transition: all 0.18s;
        margin-bottom: 1.5rem;
    }
    .profile-back:hover { color: #16a34a; background: white; border-color: rgba(22,163,74,0.2); }

    .avatar-cluster {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.6rem;
    }

    .avatar-ring {
        position: relative;
        width: 88px;
        height: 88px;
    }

    .avatar-img,
    .avatar-letter {
        width: 88px;
        height: 88px;
        border-radius: 50%;
        border: 3.5px solid white;
        box-shadow: 0 4px 18px rgba(0,0,0,0.13);
        transition: all 0.3s ease;
    }

    .avatar-img { object-fit: cover; display: block; }

    .avatar-letter {
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'DM Serif Display', serif;
        font-size: 2.1rem;
        color: white;
        background: linear-gradient(135deg, #16a34a, #4ade80);
    }

    .cam-btn {
        position: absolute;
        bottom: 1px;
        right: 1px;
        width: 27px;
        height: 27px;
        border-radius: 50%;
        background: white;
        border: 2px solid #e5e7eb;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.18s;
    }
    .cam-btn:hover { border-color: #16a34a; background: #f0fdf4; }
    .cam-btn svg { width: 13px; height: 13px; color: #6b7280; transition: color 0.18s; }
    .cam-btn:hover svg { color: #16a34a; }

    .profile-user-name {
        font-family: 'DM Serif Display', serif;
        font-size: 1.3rem;
        color: #111827;
        letter-spacing: -0.025em;
        text-align: center;
        line-height: 1.2;
        transition: all 0.2s ease;
    }

    .profile-user-email {
        font-size: 0.775rem;
        color: #9ca3af;
        margin-top: -2px;
        text-align: center;
    }

    .profile-user-phone {
        font-size: 0.72rem;
        color: #b0b7c3;
        text-align: center;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .profile-user-bio {
        font-size: 0.74rem;
        color: #6b7280;
        text-align: center;
        max-width: 320px;
        line-height: 1.55;
        font-style: italic;
        transition: all 0.2s ease;
        padding: 0 0.5rem;
    }

    .photo-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.7rem;
        font-weight: 500;
        color: #059669;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 20px;
        padding: 3px 10px;
    }

    .live-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.63rem;
        font-weight: 600;
        color: #16a34a;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 20px;
        padding: 2px 8px;
        position: absolute;
        top: 1rem;
        right: 1rem;
        z-index: 3;
        font-family: 'DM Sans', sans-serif;
    }
    .live-dot {
        width: 6px;
        height: 6px;
        background: #22c55e;
        border-radius: 50%;
        animation: pulse-dot 1.8s infinite;
    }
    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(0.7); }
    }

    .profile-form-body { padding: 1.75rem 2rem 2rem; }

    .profile-alert {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 0.7rem 1rem;
        border-radius: 12px;
        font-size: 0.79rem;
        margin-bottom: 1.5rem;
        animation: pop 0.25s ease both;
    }
    .profile-alert-ok { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
    .profile-alert-ok svg { color: #16a34a; flex-shrink: 0; }

    @keyframes pop { from { opacity:0; transform:scale(0.97); } to { opacity:1; transform:scale(1); } }

    .profile-sec-title {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #9ca3af;
        margin-bottom: 1rem;
        font-family: 'DM Sans', sans-serif;
    }

    .profile-fields { display: flex; flex-direction: column; gap: 0.875rem; }
    .profile-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 0.875rem; }
    @media (max-width: 460px) { .profile-row-2 { grid-template-columns: 1fr; } }

    .pf { display: flex; flex-direction: column; gap: 5px; }
    .pf-label {
        font-size: 0.71rem;
        font-weight: 600;
        color: #374151;
        font-family: 'DM Sans', sans-serif;
    }
    .pf-label .ast { color: #f87171; }

    .pf input,
    .pf textarea {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.855rem;
        color: #111827;
        background: #f9fafb;
        border: 1.5px solid #e5e7eb;
        border-radius: 11px;
        padding: 0.575rem 0.8rem;
        outline: none;
        transition: all 0.18s;
        width: 100%;
    }

    .pf input:focus,
    .pf textarea:focus {
        background: white;
        border-color: #16a34a;
        box-shadow: 0 0 0 3px rgba(22,163,74,0.09);
    }

    .pf input.is-error { border-color: #f87171; background: #fff5f5; }
    .pf input.locked { background: #f3f4f6; color: #9ca3af; cursor: default; border-color: transparent; }
    .pf textarea { resize: none; line-height: 1.55; }

    .pf-err { font-size: 0.69rem; color: #ef4444; font-family: 'DM Sans', sans-serif; }
    .pf-hint { font-size: 0.69rem; color: #d1d5db; text-align: right; margin-top: -2px; font-family: 'DM Sans', sans-serif; }

    .profile-sep { border: none; border-top: 1px dashed #e9ebf0; margin: 1.5rem 0; }

    .profile-foot {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-top: 1.5rem;
        padding-top: 1.25rem;
        border-top: 1px solid #f3f4f6;
    }

    .btn-del-photo {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 0.55rem 1rem;
        font-size: 0.78rem;
        font-weight: 500;
        color: #ef4444;
        background: transparent;
        border: 1.5px solid #fecaca;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.18s;
        font-family: 'DM Sans', sans-serif;
    }
    .btn-del-photo:hover { background: #fff5f5; border-color: #fca5a5; }

    .btn-save-profile {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 0.6rem 1.4rem;
        font-size: 0.855rem;
        font-weight: 600;
        color: white;
        background: #16a34a;
        border: none;
        border-radius: 11px;
        cursor: pointer;
        transition: all 0.2s;
        letter-spacing: 0.005em;
        font-family: 'DM Sans', sans-serif;
    }
    .btn-save-profile:hover { background: #15803d; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(22,163,74,0.32); }
    .btn-save-profile:active { transform: translateY(0); }
</style>
@endpush

@section('content')

    {{-- Background Blobs --}}
    <div class="blob blob-a"></div>
    <div class="blob blob-b"></div>
    <div class="blob blob-c"></div>

    <div class="profile-page">
        <div class="profile-card"
             x-data="{
                 previewUrl: null,
                 photoName: null,
                 bioLen: {{ strlen(Auth::user()->bio ?? '') }},
                 liveName: @js(Auth::user()->name),
                 livePhone: @js(Auth::user()->phone ?? ''),
                 liveBio: @js(Auth::user()->bio ?? ''),
                 pick(file) {
                     if (!file) return;
                     this.photoName = file.name;
                     const reader = new FileReader();
                     reader.onload = e => this.previewUrl = e.target.result;
                     reader.readAsDataURL(file);
                 }
             }">

            {{-- Hero Section --}}
            <div class="profile-hero">

                {{-- Live Preview Badge --}}
                <div class="live-badge">
                    <div class="live-dot"></div>
                    Pratinjau langsung
                </div>

               <a href="{{ route('home') }}" class="profile-back">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:14px;height:14px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>

                <div class="avatar-cluster">
                    <div class="avatar-ring">
                        <template x-if="previewUrl">
                            <img :src="previewUrl" class="avatar-img" alt="Preview Foto">
                        </template>
                        <template x-if="!previewUrl">
                            @if(Auth::user()->profile_photo_path)
                                <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" class="avatar-img" alt="Foto Profil">
                            @else
                                <div class="avatar-letter" x-text="liveName ? liveName.charAt(0).toUpperCase() : '?'"></div>
                            @endif
                        </template>

                        {{-- Tombol Kamera --}}
                        <label class="cam-btn" title="Ganti foto profil">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <input type="file" accept="image/*" class="hidden"
                                   @change="pick($event.target.files[0]); $refs.photoHidden.files = $event.target.files">
                        </label>
                    </div>

                    {{-- Live: Nama --}}
                    <p class="profile-user-name" x-text="liveName || '{{ Auth::user()->name }}'"></p>

                    {{-- Email (statis) --}}
                    <p class="profile-user-email">{{ Auth::user()->email }}</p>

                    {{-- Live: Telepon --}}
                    <p class="profile-user-phone" x-show="livePhone">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:11px;height:11px;flex-shrink:0;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span x-text="livePhone"></span>
                    </p>

                    {{-- Live: Bio --}}
                    <p class="profile-user-bio" x-show="liveBio" x-text="liveBio"></p>

                    {{-- Chip Foto Baru --}}
                    <div class="photo-chip" x-show="previewUrl" style="display:none;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:11px;height:11px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span x-text="photoName"></span>
                    </div>
                </div>
            </div>

            {{-- Form Body --}}
            <div class="profile-form-body">
                @if(session('success'))
                    <div class="profile-alert profile-alert-ok">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;flex-shrink:0;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <input type="file" name="photo" accept="image/*" class="hidden" x-ref="photoHidden">

                    <p class="profile-sec-title">Informasi Pribadi</p>

                    <div class="profile-fields">

                        {{-- Nama Lengkap --}}
                        <div class="pf">
                            <label class="pf-label">Nama Lengkap <span class="ast">*</span></label>
                            <input type="text" name="name"
                                   x-model="liveName"
                                   placeholder="Nama lengkap Anda"
                                   class="{{ $errors->has('name') ? 'is-error' : '' }}">
                            @error('name') <span class="pf-err">{{ $message }}</span> @enderror
                        </div>

                        {{-- Email + Telepon --}}
                        <div class="profile-row-2">
                            <div class="pf">
                                <label class="pf-label">Email</label>
                                <input type="text" value="{{ Auth::user()->email }}" class="locked" readonly>
                            </div>
                            <div class="pf">
                                <label class="pf-label">No. Telepon</label>
                                <input type="text" name="phone"
                                       x-model="livePhone"
                                       placeholder="08xxxxxxxxxx">
                                @error('phone') <span class="pf-err">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="pf">
                            <label class="pf-label">Alamat</label>
                            <textarea name="address" rows="2"
                                      placeholder="Jl. Contoh No. 1, Kota, Provinsi">{{ old('address', Auth::user()->address ?? '') }}</textarea>
                            @error('address') <span class="pf-err">{{ $message }}</span> @enderror
                        </div>

                        {{-- Bio --}}
                        <div class="pf">
                            <label class="pf-label">Bio Singkat</label>
                            <textarea name="bio" rows="3" maxlength="500"
                                      @input="bioLen = $event.target.value.length; liveBio = $event.target.value"
                                      placeholder="Ceritakan sedikit tentang diri Anda...">{{ old('bio', Auth::user()->bio ?? '') }}</textarea>
                            <span class="pf-hint"><span x-text="bioLen"></span>/500</span>
                            @error('bio') <span class="pf-err">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <hr class="profile-sep">

                    {{-- Footer Buttons --}}
                    <div class="profile-foot">
                        @if(Auth::user()->profile_photo_path)
                            <button type="button" class="btn-del-photo"
                                    onclick="if(confirm('Hapus foto profil?')) document.getElementById('hapus-foto').submit()">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:14px;height:14px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus foto
                            </button>
                        @else
                            <span></span>
                        @endif

                        <button type="submit" class="btn-save-profile">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:15px;height:15px;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Form Hapus Foto --}}
    @if(Auth::user()->profile_photo_path)
        <form id="hapus-foto" method="POST" action="{{ route('profile.photo.delete') }}" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    @endif

@endsection
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
    .blob-b { width: 380px; height: 380px; background: #d4f0e0; bottom: -80px; left: -60px; animation-delay: -5s; }
    .blob-c { width: 260px; height: 260px; background: #fdeac7; top: 45%; left: 35%; animation-delay: -9s; }

    @keyframes float {
        0%, 100% { transform: translate(0,0) scale(1); }
        40%       { transform: translate(18px,-28px) scale(1.04); }
        70%       { transform: translate(-12px,16px) scale(0.97); }
    }

    .pass-page {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 3rem 1.25rem 4rem;
        font-family: 'DM Sans', sans-serif;
    }

    .pass-card {
        width: 100%;
        max-width: 480px;
        background: rgba(255,255,255,0.88);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255,255,255,0.95);
        border-radius: 28px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.04), 0 8px 32px rgba(0,0,0,0.07);
        overflow: hidden;
        animation: rise 0.55s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    @keyframes rise {
        from { opacity: 0; transform: translateY(28px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .pass-hero {
        position: relative;
        padding: 2rem 2rem 1.75rem;
        background: linear-gradient(145deg, #eef3ff 0%, #f8faff 55%, #edfaf3 100%);
        border-bottom: 1px solid rgba(0,0,0,0.045);
    }

    .pass-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle, rgba(0,0,0,0.05) 1px, transparent 1px);
        background-size: 22px 22px;
        pointer-events: none;
    }

    .pass-back {
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
    .pass-back:hover { color: #16a34a; background: white; border-color: rgba(22,163,74,0.2); }

    .pass-icon-wrap {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
    }

    .pass-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, #44ef61, #71f888);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 18px rgba(239,68,68,0.25);
        border: 3px solid white;
    }

    .pass-icon svg { width: 28px; height: 28px; color: white; }

    /* Hapus / komentari .pass-icon lama, tambahkan ini */
.pass-avatar-ring {
    position: relative;
    width: 88px;
    height: 88px;
}

.pass-avatar-img {
    width: 88px;
    height: 88px;
    border-radius: 50%;
    object-fit: cover;
    border: 3.5px solid white;
    box-shadow: 0 4px 18px rgba(0,0,0,0.13);
    display: block;
}

.pass-avatar-letter {
    width: 88px;
    height: 88px;
    border-radius: 50%;
    border: 3.5px solid white;
    box-shadow: 0 4px 18px rgba(0,0,0,0.13);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'DM Serif Display', serif;
    font-size: 2.1rem;
    color: white;
    background: linear-gradient(135deg, #16a34a, #15803d);
}

.pass-lock-badge {
    position: absolute;
    bottom: 1px;
    right: 1px;
    width: 27px;
    height: 27px;
    border-radius: 50%;
    background: white;
    border: 2px solid #cafed5;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #15803d;
}

    .pass-title {
        font-family: 'DM Serif Display', serif;
        font-size: 1.25rem;
        color: #111827;
        letter-spacing: -0.02em;
        text-align: center;
    }

    .pass-subtitle {
        font-size: 0.75rem;
        color: #9ca3af;
        text-align: center;
    }

    .pass-body { padding: 1.75rem 2rem 2rem; }

    .pass-alert {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 0.7rem 1rem;
        border-radius: 12px;
        font-size: 0.79rem;
        margin-bottom: 1.5rem;
        animation: pop 0.25s ease both;
    }
    .pass-alert-ok  { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
    .pass-alert-err { background: #fff5f5; border: 1px solid #fecaca; color: #dc2626; }
    @keyframes pop { from { opacity:0; transform:scale(0.97); } to { opacity:1; transform:scale(1); } }

    .pf { display: flex; flex-direction: column; gap: 5px; margin-bottom: 0.875rem; }
    .pf-label {
        font-size: 0.71rem;
        font-weight: 600;
        color: #374151;
    }

    .pf-input-wrap {
        position: relative;
    }

    .pf input {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.855rem;
        color: #111827;
        background: #f9fafb;
        border: 1.5px solid #e5e7eb;
        border-radius: 11px;
        padding: 0.575rem 2.5rem 0.575rem 0.8rem;
        outline: none;
        transition: all 0.18s;
        width: 100%;
    }
    .pf input:focus {
        background: white;
        border-color: #16a34a;
        box-shadow: 0 0 0 3px rgba(22,163,74,0.09);
    }
    .pf input.is-error { border-color: #f87171; background: #fff5f5; }

    .toggle-eye {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        color: #9ca3af;
        transition: color 0.18s;
    }
    .toggle-eye:hover { color: #374151; }
    .toggle-eye svg { width: 16px; height: 16px; display: block; }

    .pf-err { font-size: 0.69rem; color: #1fdf49; }

    .strength-bar {
        height: 4px;
        border-radius: 4px;
        background: #e5e7eb;
        overflow: hidden;
        margin-top: 4px;
    }
    .strength-fill {
        height: 100%;
        border-radius: 4px;
        transition: width 0.3s, background 0.3s;
    }
    .strength-text {
        font-size: 0.67rem;
        margin-top: 3px;
        text-align: right;
    }

    .pass-sep { border: none; border-top: 1px dashed #e9ebf0; margin: 1.25rem 0; }

    .pass-foot {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        padding: 0.6rem 1.1rem;
        font-size: 0.82rem;
        font-weight: 500;
        color: #6b7280;
        background: #f3f4f6;
        border: none;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.18s;
        font-family: 'DM Sans', sans-serif;
    }
    .btn-cancel:hover { background: #e5e7eb; color: #374151; }

    .btn-save {
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
        font-family: 'DM Sans', sans-serif;
    }
    .btn-save:hover { background: #15803d; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(22,163,74,0.3); }
    .btn-save:active { transform: translateY(0); }
</style>
@endpush

@section('content')

<div class="blob blob-a"></div>
<div class="blob blob-b"></div>
<div class="blob blob-c"></div>

<div class="pass-page">
    <div class="pass-card" x-data="{
        showCurrent: false,
        showNew: false,
        showConfirm: false,
        password: '',
        strength: 0,
        strengthLabel: '',
        strengthColor: '',
        checkStrength(val) {
            let score = 0;
            if (val.length >= 8)               score++;
            if (/[A-Z]/.test(val))             score++;
            if (/[0-9]/.test(val))             score++;
            if (/[^A-Za-z0-9]/.test(val))      score++;
            this.strength = score;
            const map = {
                0: { label: '',        color: 'transparent', width: '0%'   },
                1: { label: 'Lemah',   color: '#ef4444',     width: '25%'  },
                2: { label: 'Cukup',   color: '#f59e0b',     width: '50%'  },
                3: { label: 'Kuat',    color: '#3b82f6',     width: '75%'  },
                4: { label: 'Sangat Kuat', color: '#16a34a', width: '100%' },
            };
            this.strengthLabel = map[score].label;
            this.strengthColor = map[score].color;
            this.$refs.fill.style.width = map[score].width;
            this.$refs.fill.style.background = map[score].color;
        }
    }">

        {{-- Hero --}}
        <div class="pass-hero">
            <a href="{{ route('home') }}" class="pass-back">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:14px;height:14px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali 
</a>
           <div class="pass-icon-wrap">
    <div class="pass-avatar-ring">
        @if(Auth::user()->profile_photo_path)
            <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}"
                 class="pass-avatar-img" alt="Foto Profil">
        @else
            <div class="pass-avatar-letter">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        @endif

        {{-- Badge kunci kecil --}}
        <div class="pass-lock-badge">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:11px;height:11px;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
    </div>
    <p class="pass-title">Ubah Password</p>
    <p class="pass-subtitle">{{ Auth::user()->email }}</p>
</div>
               
        </div>

        {{-- Body --}}
        <div class="pass-body">

            @if(session('success'))
                <div class="pass-alert pass-alert-ok">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;flex-shrink:0;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->has('current_password'))
                <div class="pass-alert pass-alert-err">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;flex-shrink:0;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $errors->first('current_password') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PATCH')

                {{-- Password Saat Ini --}}
                <div class="pf">
                    <label class="pf-label">Password Saat Ini</label>
                    <div class="pf-input-wrap">
                        <input :type="showCurrent ? 'text' : 'password'"
                               name="current_password"
                               placeholder="Masukkan password saat ini"
                               class="{{ $errors->has('current_password') ? 'is-error' : '' }}">
                        <button type="button" class="toggle-eye" @click="showCurrent = !showCurrent">
                            <svg x-show="!showCurrent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showCurrent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <hr class="pass-sep">

                {{-- Password Baru --}}
                <div class="pf">
                    <label class="pf-label">Password Baru</label>
                    <div class="pf-input-wrap">
                        <input :type="showNew ? 'text' : 'password'"
                               name="password"
                               placeholder="Minimal 8 karakter"
                               x-model="password"
                               @input="checkStrength($event.target.value)"
                               class="{{ $errors->has('password') ? 'is-error' : '' }}">
                        <button type="button" class="toggle-eye" @click="showNew = !showNew">
                            <svg x-show="!showNew" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showNew" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    {{-- Strength Bar --}}
                    <div class="strength-bar" x-show="password.length > 0">
                        <div class="strength-fill" x-ref="fill"></div>
                    </div>
                    <span class="strength-text" x-show="password.length > 0"
                          :style="'color:' + strengthColor" x-text="strengthLabel"></span>
                    @error('password') <span class="pf-err">{{ $message }}</span> @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="pf">
                    <label class="pf-label">Konfirmasi Password Baru</label>
                    <div class="pf-input-wrap">
                        <input :type="showConfirm ? 'text' : 'password'"
                               name="password_confirmation"
                               placeholder="Ulangi password baru"
                               class="{{ $errors->has('password_confirmation') ? 'is-error' : '' }}">
                        <button type="button" class="toggle-eye" @click="showConfirm = !showConfirm">
                            <svg x-show="!showConfirm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showConfirm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation') <span class="pf-err">{{ $message }}</span> @enderror
                </div>

                <hr class="pass-sep">

                <div class="pass-foot">
                    <a href="{{ route('home') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-save">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:15px;height:15px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
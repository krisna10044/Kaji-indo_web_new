<?php $__env->startSection('content'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Lora:ital,wght@0,600;1,600&display=swap');

    .login-wrap {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f6f5f0;
        font-family: 'Plus Jakarta Sans', sans-serif;
        padding: 2rem 1rem;
        position: relative;
        overflow: hidden;
    }

    .login-wrap::before {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(45,106,79,0.08) 0%, transparent 70%);
        top: -100px;
        right: -100px;
        border-radius: 50%;
    }

    .login-wrap::after {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(45,106,79,0.05) 0%, transparent 70%);
        bottom: -50px;
        left: -50px;
        border-radius: 50%;
    }

    .login-card {
        background: #ffffff;
        border-radius: 28px;
        padding: 40px 36px;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 8px 48px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.04);
        position: relative;
        z-index: 1;
        animation: cardIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) both;
    }

    @keyframes cardIn {
        from { opacity: 0; transform: translateY(24px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .brand-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f0f9f4;
        border: 1px solid #d1eadb;
        border-radius: 20px;
        padding: 5px 12px 5px 8px;
        margin-bottom: 20px;
    }

    .brand-dot {
        width: 8px;
        height: 8px;
        background: #2d6a4f;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(0.85); }
    }

    .brand-badge span {
        font-size: 12px;
        font-weight: 600;
        color: #2d6a4f;
    }

    .login-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 28px;
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1.2;
        margin-bottom: 6px;
    }

    .login-title em {
        font-family: 'Lora', serif;
        font-style: italic;
        color: #2d6a4f;
    }

    .login-subtitle {
        font-size: 13.5px;
        color: #888;
        margin-bottom: 28px;
    }

    .divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 20px 0;
    }

    .divider-line {
        flex: 1;
        height: 1px;
        background: #ebebeb;
    }

    .divider-text {
        font-size: 12px;
        color: #aaa;
        white-space: nowrap;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #333;
        margin-bottom: 7px;
    }

    .input-wrap {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #bbb;
        display: flex;
        align-items: center;
    }

    .form-input {
        width: 100%;
        padding: 12px 14px 12px 42px;
        border: 1.5px solid #e8e8e8;
        border-radius: 14px;
        font-size: 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #1a1a1a;
        background: #fafafa;
        transition: all 0.2s;
        outline: none;
    }

    .form-input::placeholder { color: #bbb; }

    .form-input:focus {
        border-color: #2d6a4f;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(45,106,79,0.08);
    }

    .toggle-password {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #bbb;
        display: flex;
        align-items: center;
        padding: 0;
        transition: color 0.2s;
    }

    .toggle-password:hover { color: #2d6a4f; }

    .form-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
        margin-top: -4px;
    }

    .remember-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #555;
        cursor: pointer;
    }

    .remember-checkbox {
        width: 16px;
        height: 16px;
        border-radius: 4px;
        border: 1.5px solid #ddd;
        accent-color: #2d6a4f;
        cursor: pointer;
    }

    .forgot-link {
        font-size: 13px;
        font-weight: 600;
        color: #2d6a4f;
        text-decoration: none;
        transition: opacity 0.2s;
    }

    .forgot-link:hover { opacity: 0.7; }

    .btn-login {
        width: 100%;
        padding: 14px;
        background: #2d6a4f;
        color: #fff;
        border: none;
        border-radius: 14px;
        font-size: 15px;
        font-weight: 700;
        font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
        letter-spacing: 0.01em;
    }

    .btn-login:hover {
        background: #1f4e37;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(45,106,79,0.3);
    }

    .btn-login:active { transform: translateY(0); }

    .btn-login svg { transition: transform 0.2s; }
    .btn-login:hover svg { transform: translateX(3px); }

    .register-link {
        text-align: center;
        margin-top: 20px;
        font-size: 13.5px;
        color: #888;
    }

    .register-link a {
        font-weight: 700;
        color: #2d6a4f;
        text-decoration: none;
    }

    .register-link a:hover { text-decoration: underline; }

    .alert {
        padding: 10px 14px;
        border-radius: 10px;
        font-size: 13px;
        margin-bottom: 16px;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .alert-success {
        background: #f0f9f4;
        border: 1px solid #d1eadb;
        color: #2d6a4f;
    }

    .alert-error {
        background: #fff5f5;
        border: 1px solid #fecaca;
        color: #dc2626;
    }
    .alert-warning {
        background: #fffbeb;
        border: 1px solid #fcd34d;
        color: #92400e;
    }
    
    .btn-google {
    width: 100%;
    padding: 12px 14px;
    background: #fff;
    color: #333;
    border: 1.5px solid #e8e8e8;
    border-radius: 14px;
    font-size: 14px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    text-decoration: none;
    transition: all 0.2s;
    margin-bottom: 4px;
}

.btn-google:hover {
    border-color: #4285F4;
    background: #f8f9ff;
    box-shadow: 0 4px 12px rgba(66,133,244,0.12);
    transform: translateY(-1px);
}
</style>

<div class="login-wrap">
    <div class="login-card">

        
        <div class="brand-badge">
            <div class="brand-dot"></div>
            <span>Selamat Datang</span>
        </div>

        
        <h1 class="login-title">Masuk ke <em>Kaji Indonesia</em></h1>
       <p class="login-subtitle">Gunakan akun Anda untuk mengakses layanan kami.</p>


<a href="<?php echo e(route('auth.google')); ?>" class="btn-google">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
    </svg>
    Masuk dengan Google
</a>

<div class="divider">
    <div class="divider-line"></div>
    <span class="divider-text">atau masuk dengan email</span>
    <div class="divider-line"></div>
</div>


        <?php if(session('auth_required')): ?>
            <div class="alert alert-warning" style="display:flex;align-items:flex-start;gap:8px;">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="flex-shrink:0;margin-top:1px"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 3a9 9 0 100 18A9 9 0 0012 3z"/></svg>
                <div>
                    <?php echo e(session('auth_required')); ?>

                    <div style="margin-top:6px;">
                        <a href="<?php echo e(route('register')); ?>" style="font-weight:700;color:#92400e;text-decoration:underline;">Daftar sekarang</a>
                        &nbsp;atau&nbsp;
                        <span style="font-weight:600;">login di bawah ini.</span>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="flex-shrink:0;margin-top:1px"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-error">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="flex-shrink:0;margin-top:1px"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-error">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="flex-shrink:0;margin-top:1px"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 3a9 9 0 100 18A9 9 0 0012 3z"/></svg>
                <div>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div><?php echo e($error); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        
        <form action="/login" method="POST">
            <?php echo csrf_field(); ?>

            
            <div class="form-group">
                <label class="form-label">Alamat Email</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </span>
                    <input type="email" name="email" class="form-input"
                        placeholder="Email@gmail.com"
                        value="<?php echo e(old('email')); ?>" required>
                </div>
            </div>

            
            <div class="form-group">
                <label class="form-label">Kata Sandi</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>
                    <input type="password" name="password" id="password-field" class="form-input"
                        placeholder="Masukkan kata sandi" required>
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <svg id="eye-icon" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                </div>
            </div>

            
            <div class="form-row">
                <label class="remember-label">
                    <input type="checkbox" name="remember" class="remember-checkbox">
                    Ingat saya
                </label>
                <a href="#" class="forgot-link">Lupa sandi?</a>
            </div>

            
            <button type="submit" class="btn-login">
                Masuk Sekarang
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </button>
        </form>

        
        <p class="register-link">
            Belum punya akun?
            <a href="<?php echo e(route('register')); ?>">Daftar Sekarang</a>
        </p>

    </div>
</div>

<script>
    function togglePassword() {
        const field = document.getElementById('password-field');
        const icon  = document.getElementById('eye-icon');
        if (field.type === 'password') {
            field.type = 'text';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
        } else {
            field.type = 'password';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/infojawatimur/kajiindonesia.com_new/resources/views/pages/login.blade.php ENDPATH**/ ?>
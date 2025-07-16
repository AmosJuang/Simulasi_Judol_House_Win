@extends('layouts.app')

@section('content')
<div class="container-fluid login-container">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-5 col-md-8">
                <div class="casino-login-card animate__animated animate__zoomIn">
                    <div class="login-header text-center">
                        <div class="casino-logo mb-3">
                            <i class="fas fa-crown"></i>
                        </div>
                        <h2 class="casino-title">
                            <i class="fas fa-dice"></i> W568 CASINO <i class="fas fa-dice"></i>
                        </h2>
                        <p class="casino-subtitle">
                            Selamat Datang KE W568 CASINO DI PASTIKAN GACOR DAN AMAN !!
                        </p>
                    </div>
                    
                    <div class="login-body">
                        <div class="player-login-header text-center mb-4">
                            <h4><i class="fas fa-user-circle"></i> PLAYER LOGIN</h4>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            @if($errors->any())
                                <div class="casino-alert casino-alert-danger mb-4">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <div class="form-group mb-4">
                                <label for="login" class="casino-label">
                                    <i class="fas fa-user"></i> Username / Email
                                </label>
                                <input id="login" type="text" 
                                       class="casino-input @error('login') is-invalid @enderror" 
                                       name="login" 
                                       value="{{ old('login') }}" 
                                       required 
                                       autofocus
                                       placeholder="Masukkan username atau email Anda">
                                @error('login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password" class="casino-label">
                                    <i class="fas fa-lock"></i> Kata Sandi 
                                </label>
                                <input id="password" type="password" 
                                       class="casino-input @error('password') is-invalid @enderror" 
                                       name="password" 
                                       required 
                                       autocomplete="current-password"
                                       placeholder="Masukkan kata sandi Anda">
                            </div>

                            <div class="form-check casino-checkbox mb-4">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    <i class="fas fa-check-circle"></i> Ingat Saya
                                </label>
                            </div>

                            <div class="d-grid gap-2 mb-4">
                                <button type="submit" class="btn-casino-login">
                                    <i class="fas fa-sign-in-alt"></i> MASUK CASINO
                                </button>
                            </div>
                            
                            <div class="login-footer text-center">
                                <p class="text-muted mb-2">
                                    Tidak Mempunyai Akun?
                                </p>
                                <a href="{{ route('register') }}" class="register-link">
                                    <i class="fas fa-user-plus"></i> Gabung di Casino Sekarang!
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Promotional Cards -->
                <div class="login-promo-cards mt-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="promo-card-small animate__animated animate__fadeInLeft">
                                <div class="promo-icon">🎰</div>
                                <h6>WELCOME BONUS</h6>
                                <p>100% Deposit Bonus</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="promo-card-small animate__animated animate__fadeInRight">
                                <div class="promo-icon">💰</div>
                                <h6>INSTANT WITHDRAWAL</h6>
                                <p>1-3 Minutes Process</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
/* Login Page Specific Styles */
.login-container {
    background: #0a0a0a;
    min-height: 100vh;
    padding: 20px 0;
}

.casino-login-card {
    background: linear-gradient(135deg, rgba(26, 26, 26, 0.95), rgba(45, 45, 45, 0.95));
    border: 3px solid #ffd700;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 
        0 20px 60px rgba(255, 215, 0, 0.3),
        inset 0 0 30px rgba(255, 215, 0, 0.1);
    backdrop-filter: blur(10px);
}

.login-header {
    background: linear-gradient(135deg, #ff6b35, #ff0000);
    padding: 30px 20px;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.login-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shimmer 3s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.casino-logo {
    font-size: 4rem;
    color: #ffd700;
    text-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
    animation: logoGlow 2s ease-in-out infinite alternate;
}

@keyframes logoGlow {
    0% { transform: scale(1); filter: drop-shadow(0 0 10px #ffd700); }
    100% { transform: scale(1.05); filter: drop-shadow(0 0 20px #ffd700); }
}

.casino-title {
    font-size: 2rem;
    font-weight: 900;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    margin-bottom: 10px;
    color: #ffd700;
}

.casino-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

.login-body {
    padding: 40px 30px;
}

.player-login-header h4 {
    color: #ffd700;
    font-weight: bold;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

.casino-label {
    color: #ffd700;
    font-weight: bold;
    margin-bottom: 8px;
    display: block;
    font-size: 1rem;
}

.casino-input {
    background: linear-gradient(145deg, #1a1a1a, #2d2d2d);
    border: 2px solid #ffd700;
    color: #fff;
    padding: 15px 20px;
    border-radius: 12px;
    font-size: 1.1rem;
    width: 100%;
    transition: all 0.3s ease;
    box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.3);
}

.casino-input:focus {
    border-color: #ffed4a;
    box-shadow: 
        0 0 20px rgba(255, 215, 0, 0.5),
        inset 0 2px 5px rgba(0, 0, 0, 0.3);
    background: linear-gradient(145deg, #2d2d2d, #1a1a1a);
    color: #fff;
    outline: none;
}

.casino-input::placeholder {
    color: #999;
}

.casino-checkbox {
    margin: 20px 0;
}

.casino-checkbox .form-check-input {
    background: linear-gradient(145deg, #1a1a1a, #2d2d2d);
    border: 2px solid #ffd700;
    border-radius: 6px;
    width: 1.2em;
    height: 1.2em;
}

.casino-checkbox .form-check-input:checked {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    border-color: #ffd700;
}

.casino-checkbox .form-check-label {
    color: #ccc;
    font-weight: 500;
    margin-left: 10px;
}

.btn-casino-login {
    background: linear-gradient(45deg, #ffd700, #ffed4a);
    border: none;
    color: #000;
    font-weight: bold;
    padding: 18px 30px;
    border-radius: 50px;
    font-size: 1.3rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    box-shadow: 
        0 8px 25px rgba(255, 215, 0, 0.4),
        inset 0 0 20px rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    width: 100%;
    cursor: pointer;
}

.btn-casino-login:hover {
    transform: translateY(-3px);
    box-shadow: 
        0 12px 35px rgba(255, 215, 0, 0.6),
        inset 0 0 30px rgba(255, 255, 255, 0.2);
    background: linear-gradient(45deg, #ffed4a, #ffd700);
}

.btn-casino-login::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: left 0.5s;
}

.btn-casino-login:hover::before {
    left: 100%;
}

.casino-alert {
    padding: 15px 20px;
    border-radius: 10px;
    font-weight: bold;
    border: 2px solid;
}

.casino-alert-danger {
    background: linear-gradient(135deg, rgba(255, 0, 0, 0.1), rgba(220, 53, 69, 0.1));
    border-color: #dc3545;
    color: #ff6b6b;
}

.login-footer {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 215, 0, 0.3);
}

.register-link {
    color: #ffd700;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    display: inline-block;
}

.register-link:hover {
    color: #ffed4a;
    transform: scale(1.05);
    text-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
}

.login-promo-cards {
    margin-top: 30px;
}

.promo-card-small {
    background: linear-gradient(135deg, rgba(255, 107, 53, 0.8), rgba(255, 0, 0, 0.8));
    border: 2px solid #ffd700;
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.promo-card-small:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
}

.promo-card-small .promo-icon {
    font-size: 2rem;
    margin-bottom: 10px;
    filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.8));
}

.promo-card-small h6 {
    color: #ffd700;
    font-weight: bold;
    margin-bottom: 5px;
    font-size: 0.9rem;
}

.promo-card-small p {
    color: #fff;
    margin: 0;
    font-size: 0.8rem;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .casino-title {
        font-size: 1.5rem;
    }
    
    .casino-logo {
        font-size: 3rem;
    }
    
    .login-body {
        padding: 30px 20px;
    }
    
    .btn-casino-login {
        font-size: 1.1rem;
        padding: 15px 25px;
    }
}
</style>
@endsection

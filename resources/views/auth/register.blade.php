@extends('layouts.app')

@section('content')
<div class="container-fluid register-container">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-6 col-md-8">
                <div class="casino-register-card animate__animated animate__zoomIn">
                    <div class="register-header text-center">
                        <div class="casino-logo mb-3">
                            <i class="fas fa-star"></i>
                        </div>
                        <h2 class="casino-title">
                            <i class="fas fa-user-plus"></i> JOIN W568 CASINO <i class="fas fa-user-plus"></i>
                        </h2>
                        <p class="casino-subtitle">
                            Mulai perjalanan mu ke kekayaan!
                        </p>
                    </div>
                    
                    <div class="register-body">
                        <div class="player-register-header text-center mb-4">
                            <h4><i class="fas fa-crown"></i> BUAT AKUN PLAYER </h4>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            @if($errors->any())
                                <div class="casino-alert casino-alert-danger mb-4">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <label for="name" class="casino-label">
                                            <i class="fas fa-user"></i> Nama Lengkap 
                                        </label>
                                        <input id="name" type="text" 
                                               class="casino-input @error('name') is-invalid @enderror" 
                                               name="name" 
                                               value="{{ old('name') }}" 
                                               required 
                                               autocomplete="name" 
                                               autofocus
                                               placeholder="Masukkan nama lengkap Anda">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="email" class="casino-label">
                                    <i class="fas fa-envelope"></i> Email Anda
                                </label>
                                <input id="email" type="email" 
                                       class="casino-input @error('email') is-invalid @enderror" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autocomplete="email"
                                       placeholder="Masukkan alamat email Anda">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="password" class="casino-label">
                                            <i class="fas fa-lock"></i> Kata Sandi 
                                        </label>
                                        <input id="password" type="password" 
                                               class="casino-input @error('password') is-invalid @enderror" 
                                               name="password" 
                                               required 
                                               autocomplete="new-password"
                                               placeholder="Buat kata sandi">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="password-confirm" class="casino-label">
                                            <i class="fas fa-lock"></i> Konfirmasi Kata Sandi 
                                        </label>
                                        <input id="password-confirm" type="password" 
                                               class="casino-input" 
                                               name="password_confirmation" 
                                               required 
                                               autocomplete="new-password"
                                               placeholder="Konfirmasi kata sandi">
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mb-4">
                                <button type="submit" class="btn-casino-register">
                                    <i class="fas fa-rocket"></i> DAFTAR & MULAI MENANG!
                                </button>
                            </div>
                            
                            <div class="register-footer text-center">
                                <p class="text-muted mb-2">
                                    Sudah punya akun?
                                </p>
                                <a href="{{ route('login') }}" class="login-link">
                                    <i class="fas fa-sign-in-alt"></i> Masuk ke Akun Casino Anda
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Welcome Bonus Info -->
                <div class="register-bonus-info mt-4">
                    <div class="bonus-card animate__animated animate__fadeInUp">
                        <div class="bonus-icon">🎁</div>
                        <h5>BONUS SELAMAT DATANG</h5>
                        <div class="bonus-details">
                            <div class="bonus-item">
                                <span class="bonus-percentage">100K</span>
                                <span class="bonus-text">Saldo Awal Gratis</span>
                           </div>
                            <div class="bonus-item">
                                <span class="bonus-percentage">24/7</span>
                                <span class="bonus-text">Customer Service</span>
                            </div>
                            <div class="bonus-item">
                                <span class="bonus-percentage">INSTANT</span>
                                <span class="bonus-text">Withdraw Cepat</span>
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
    .casino-input {
    background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
    border: 2px solid #ffd700;
    color: #fff;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 1rem;
    width: 100%;
    transition: all 0.3s ease;
    box-shadow: inset 0 0 10px rgba(255, 215, 0, 0.2);
}

.casino-input::placeholder {
    color: rgba(255, 255, 255, 0.6);
    font-style: italic;
}

.casino-input:focus {
    outline: none;
    border-color: #ffed4a;
    box-shadow: 0 0 10px #ffd700, inset 0 0 15px rgba(255, 255, 255, 0.1);
    background: linear-gradient(135deg, #2d2d2d, #1a1a1a);
    color: #fff;
}

/* Register Page Specific Styles */
.register-container {
    background: #0a0a0a;
    min-height: 100vh;
    padding: 20px 0;
}

.casino-register-card {
    background: linear-gradient(135deg, rgba(26, 26, 26, 0.95), rgba(45, 45, 45, 0.95));
    border: 3px solid #ffd700;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 
        0 20px 60px rgba(255, 215, 0, 0.3),
        inset 0 0 30px rgba(255, 215, 0, 0.1);
    backdrop-filter: blur(10px);
}

.register-header {
    background: linear-gradient(135deg, #00aa44, #32cd32);
    padding: 30px 20px;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.register-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shimmer 3s infinite;
}

.register-body {
    padding: 40px 30px;
}

.player-register-header h4 {
    color: #ffd700;
    font-weight: bold;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

.btn-casino-register {
    background: linear-gradient(45deg, #00aa44, #32cd32);
    border: none;
    color: #fff;
    font-weight: bold;
    padding: 18px 30px;
    border-radius: 50px;
    font-size: 1.3rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    box-shadow: 
        0 8px 25px rgba(0, 170, 68, 0.4),
        inset 0 0 20px rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    width: 100%;
    cursor: pointer;
}

.btn-casino-register:hover {
    transform: translateY(-3px);
    box-shadow: 
        0 12px 35px rgba(0, 170, 68, 0.6),
        inset 0 0 30px rgba(255, 255, 255, 0.2);
    background: linear-gradient(45deg, #32cd32, #00aa44);
}

.btn-casino-register::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: left 0.5s;
}

.btn-casino-register:hover::before {
    left: 100%;
}

.terms-link {
    color: #ffd700;
    text-decoration: none;
    font-weight: bold;
}

.terms-link:hover {
    color: #ffed4a;
    text-decoration: underline;
}

.login-link {
    color: #ffd700;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    display: inline-block;
}

.login-link:hover {
    color: #ffed4a;
    transform: scale(1.05);
    text-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
}

.register-bonus-info {
    margin-top: 30px;
}

.bonus-card {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.9), rgba(255, 237, 74, 0.9));
    border: 3px solid #ff6b35;
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    color: #000;
    backdrop-filter: blur(10px);
    box-shadow: 0 15px 40px rgba(255, 215, 0, 0.3);
}

.bonus-icon {
    font-size: 3rem;
    margin-bottom: 15px;
    filter: drop-shadow(0 0 10px rgba(255, 107, 53, 0.8));
}

.bonus-card h5 {
    font-weight: 900;
    margin-bottom: 20px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

.bonus-details {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 15px;
}

.bonus-item {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.bonus-percentage {
    font-size: 2rem;
    font-weight: 900;
    color: #ff0000;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.bonus-text {
    font-size: 0.9rem;
    font-weight: bold;
    margin-top: 5px;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .casino-title {
        font-size: 1.5rem;
    }
    
    .casino-logo {
        font-size: 3rem;
    }
    
    .register-body {
        padding: 30px 20px;
    }
    
    .btn-casino-register {
        font-size: 1.1rem;
        padding: 15px 25px;
    }
    
    .bonus-details {
        flex-direction: column;
        gap: 10px;
    }
    
    .bonus-item {
        flex-direction: row;
        gap: 10px;
    }
    
    .bonus-percentage {
        font-size: 1.5rem;
    }
}
</style>
@endsection


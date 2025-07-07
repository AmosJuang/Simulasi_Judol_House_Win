@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="casino-title">
                <i class="fas fa-dice"></i> CASINO ROYAL
            </div>
            <div class="casino-subtitle">
                Welcome to the ultimate gaming experience
            </div>
            
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-circle"></i> PLAYER LOGIN
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        @if($errors->any())
                            <div class="alert alert-danger mb-4">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i> Email Address
                            </label>
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email" 
                                   autofocus
                                   placeholder="Enter your email">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i> Password
                            </label>
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   required 
                                   autocomplete="current-password"
                                   placeholder="Enter your password">
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                <i class="fas fa-remember"></i> Remember Me
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i> ENTER CASINO
                            </button>
                        </div>
                        
                        <div class="text-center mt-4">
                            <p class="mb-0" style="color: #cccccc;">
                                Don't have an account? 
                                <a href="{{ route('register') }}" style="color: #ffd700; text-decoration: none;">
                                    <i class="fas fa-user-plus"></i> Join the Casino
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

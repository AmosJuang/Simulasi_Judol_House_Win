@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h4><i class="fas fa-magic"></i> Tentukan Hasil Spin Selanjutnya</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Player Info -->
                    <div class="card mb-4 bg-light">
                        <div class="card-body">
                            <h5 class="card-title">📊 Statistik Pemain</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                    <p><strong>Saldo Saat Ini:</strong> <span class="text-success">Rp {{ number_format($user->balance) }}</span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Total Permainan:</strong> {{ $user->total_attempts }}</p>
                                    <p><strong>Menang:</strong> <span class="text-success">{{ $user->total_wins }}</span></p>
                                    <p><strong>Kalah:</strong> <span class="text-danger">{{ $user->total_losses }}</span></p>
                                    <p><strong>Win Rate:</strong> 
                                        @php
                                            $winRate = $user->total_attempts > 0 ? ($user->total_wins / $user->total_attempts) * 100 : 0;
                                        @endphp
                                        <span class="badge {{ $winRate > 50 ? 'bg-success' : 'bg-danger' }}">
                                            {{ number_format($winRate, 2) }}%
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Current Forced Result -->
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle"></i> Status Saat Ini:</h6>
                        @if($user->forced_result)
                            <p>Hasil spin berikutnya telah diatur ke: 
                                <span class="badge {{ $user->forced_result == 'win' ? 'bg-success' : 'bg-danger' }} fs-6">
                                    {{ $user->forced_result == 'win' ? '🎉 MENANG' : '💀 KALAH' }}
                                </span>
                            </p>
                        @else
                            <p>Hasil spin berikutnya: <span class="badge bg-secondary fs-6">🎲 RANDOM</span></p>
                        @endif
                    </div>

                    <!-- Force Result Form -->
                    <form method="POST" action="{{ route('gambling.updateForceResult') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        
                        <div class="mb-4">
                            <label class="form-label"><strong>Pilih Hasil Spin Selanjutnya:</strong></label>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="card text-center border-success force-card">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="result" value="win" id="win" 
                                                    {{ $user->forced_result == 'win' ? 'checked' : '' }}>
                                                <label class="form-check-label w-100" for="win">
                                                    <div class="p-3">
                                                        <h1 class="text-success">🎉</h1>
                                                        <h5 class="text-success">MENANG</h5>
                                                        <p class="text-muted small">Pemain akan menang di spin berikutnya</p>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center border-danger force-card">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="result" value="lose" id="lose"
                                                    {{ $user->forced_result == 'lose' ? 'checked' : '' }}>
                                                <label class="form-check-label w-100" for="lose">
                                                    <div class="p-3">
                                                        <h1 class="text-danger">💀</h1>
                                                        <h5 class="text-danger">KALAH</h5>
                                                        <p class="text-muted small">Pemain akan kalah di spin berikutnya</p>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card text-center border-secondary force-card">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="result" value="" id="reset"
                                                    {{ !$user->forced_result ? 'checked' : '' }}>
                                                <label class="form-check-label w-100" for="reset">
                                                    <div class="p-3">
                                                        <h1 class="text-secondary">🎲</h1>
                                                        <h5 class="text-secondary">RANDOM</h5>
                                                        <p class="text-muted small">Kembali ke hasil acak normal</p>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <h6><i class="fas fa-exclamation-triangle"></i> Peringatan:</h6>
                            <ul class="mb-0">
                                <li>Pengaturan ini akan berlaku untuk spin <strong>berikutnya</strong> saja</li>
                                <li>Setelah spin selesai, hasil akan kembali ke mode random</li>
                                <li>Gunakan fitur ini dengan bijak untuk menjaga keseimbangan permainan</li>
                            </ul>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('gambling.admin') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left"></i> Kembali ke Admin Panel
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Terapkan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.force-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.force-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.form-check-input:checked + .form-check-label .card-body {
    background-color: rgba(13, 110, 253, 0.1);
    border: 2px solid #0d6efd;
    border-radius: 10px;
}

.form-check-label {
    cursor: pointer;
    display: block;
}

.form-check-input {
    position: absolute;
    top: 10px;
    right: 10px;
    transform: scale(1.5);
    cursor: pointer;
}

.force-card .card-body {
    transition: all 0.3s ease;
}

.force-card:hover .card-body {
    background-color: rgba(0,0,0,0.05);
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle card clicks to select radio buttons
    document.querySelectorAll('.force-card').forEach(card => {
        card.addEventListener('click', function() {
            const radio = this.querySelector('input[type="radio"]');
            if (radio) {
                radio.checked = true;
            }
        });
    });

    // Handle radio button changes to update card styling
    document.querySelectorAll('input[name="result"]').forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove active styling from all cards
            document.querySelectorAll('.force-card .card-body').forEach(body => {
                body.style.backgroundColor = '';
                body.style.border = '';
            });

            // Add active styling to selected card
            if (this.checked) {
                const cardBody = this.closest('.force-card').querySelector('.card-body');
                cardBody.style.backgroundColor = 'rgba(13, 110, 253, 0.1)';
                cardBody.style.border = '2px solid #0d6efd';
                cardBody.style.borderRadius = '10px';
            }
        });
    });

    // Set initial styling for checked radio button
    const checkedRadio = document.querySelector('input[name="result"]:checked');
    if (checkedRadio) {
        checkedRadio.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
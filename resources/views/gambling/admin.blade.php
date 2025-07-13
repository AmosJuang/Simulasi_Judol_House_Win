@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="casino-title">
                <i class="fas fa-crown"></i> CASINO ADMIN PANEL
            </div>
            <div class="casino-subtitle">
                Atur dan Monitor Situasi Casino Anda
            </div>
        </div>
    </div>

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

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-users"></i> Jumlah Pemain
                </div>
                <div class="card-body text-center">
                    <h2 class="text-warning">{{ $totalUsers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-coins"></i> Saldo Pemain 
                </div>
                <div class="card-body text-center">
                    <h2 class="text-warning">Rp {{ number_format($totalBalance) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-gamepad"></i> Jumlah Permainan 
                </div>
                <div class="card-body text-center">
                    <h2 class="text-warning">{{ number_format($totalGames) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-trophy"></i> Presentase Kemenangan
                </div>
                <div class="card-body text-center">
                    <h2 class="text-warning">{{ $totalGames > 0 ? number_format(($totalWins / $totalGames) * 100, 2) : 0 }}%</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Players Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-table"></i> PLAYER MANAGEMENT
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-hashtag"></i> Rank</th>
                                    <th><i class="fas fa-user"></i> Player</th>
                                    <th><i class="fas fa-envelope"></i> Email</th>
                                    <th><i class="fas fa-coins"></i> Saldo</th>
                                    <th><i class="fas fa-gamepad"></i> Permainan</th>
                                    <th><i class="fas fa-trophy"></i> M/K</th>
                                    <th><i class="fas fa-percentage"></i> Win Rate</th>
                                    <th><i class="fas fa-magic"></i> Forced Result</th>
                                    <th><i class="fas fa-cogs"></i> Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                <tr>
                                    <td>
                                        @if($index == 0)
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-crown"></i> #{{ $index + 1 }}
                                            </span>
                                        @elseif($index == 1)
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-medal"></i> #{{ $index + 1 }}
                                            </span>
                                        @elseif($index == 2)
                                            <span class="badge bg-info">
                                                <i class="fas fa-medal"></i> #{{ $index + 1 }}
                                            </span>
                                        @else
                                            <span class="badge bg-dark">#{{ $index + 1 }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="text-warning fw-bold">
                                            Rp {{ number_format($user->balance) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->total_attempts }}</td>
                                    <td>
                                        <span class="text-success">{{ $user->total_wins }}</span>/
                                        <span class="text-danger">{{ $user->total_losses }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $winRate = $user->total_attempts > 0 ? ($user->total_wins / $user->total_attempts) * 100 : 0;
                                        @endphp
                                        <span class="badge {{ $winRate > 50 ? 'bg-success' : 'bg-danger' }}">
                                            {{ number_format($winRate, 2) }}%
                                        </span>
                                    </td>
                                    <td>
                                        @if($user->forced_result)
                                            <span class="badge {{ $user->forced_result == 'win' ? 'bg-success' : 'bg-danger' }} fs-6">
                                                {{ $user->forced_result == 'win' ? '🎉 WIN' : '💀 LOSE' }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary fs-6">🎲 RANDOM</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('gambling.forceResult', $user->id) }}" 
                                               class="btn btn-sm btn-outline-warning" 
                                               title="Force Result">
                                                <i class="fas fa-magic"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-info balance-btn" 
                                                    data-user-id="{{ $user->id }}" 
                                                    data-user-name="{{ $user->name }}" 
                                                    data-current-balance="{{ $user->balance }}"
                                                    title="Adjust Balance">
                                                <i class="fas fa-coins"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Balance Modal -->
<div class="modal fade" id="balanceModal" tabindex="-1" aria-labelledby="balanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header border-bottom border-info">
                <h5 class="modal-title text-info" id="balanceModalLabel">
                    <i class="fas fa-coins"></i> Adjust Balance
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="balanceForm" method="POST" action="{{ route('gambling.adjustBalance') }}">
                @csrf
                <input type="hidden" name="user_id" id="balanceUserId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-light">Player:</label>
                        <input type="text" class="form-control bg-dark text-info border-info" id="balanceUserName" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-light">Current Balance:</label>
                        <input type="text" class="form-control bg-dark text-warning border-warning" id="currentBalance" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-light">Action:</label>
                        <select name="action" class="form-select bg-dark text-light border-info" required>
                            <option value="add">Add to Balance</option>
                            <option value="subtract">Subtract from Balance</option>
                            <option value="set">Set Balance</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-light">Amount:</label>
                        <input type="number" name="amount" class="form-control bg-dark text-light border-info" min="0" step="1000" required>
                    </div>
                </div>
                <div class="modal-footer border-top border-info">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save"></i> Apply
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const balanceModal = new bootstrap.Modal(document.getElementById('balanceModal'));

    // Handle balance button clicks
    document.querySelectorAll('.balance-btn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            const userName = this.getAttribute('data-user-name');
            const currentBalance = this.getAttribute('data-current-balance');

            document.getElementById('balanceUserId').value = userId;
            document.getElementById('balanceUserName').value = userName;
            document.getElementById('currentBalance').value = 'Rp ' + new Intl.NumberFormat('id-ID').format(currentBalance);

            balanceModal.show();
        });
    });
});
</script>
@endsection

@section('styles')
<style>
.casino-title {
    text-align: center;
    font-size: 2.5rem;
    font-weight: bold;
    color: #ffd700;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    margin-bottom: 10px;
}

.casino-subtitle {
    text-align: center;
    font-size: 1.1rem;
    color: #ccc;
    margin-bottom: 30px;
}

.card {
    background: rgba(0, 0, 0, 0.8);
    border: 2px solid #ffd700;
    border-radius: 15px;
    margin-bottom: 20px;
}

.card-header {
    background: linear-gradient(90deg, #ffd700, #ffed4a);
    color: #000000;
    font-weight: bold;
    border-bottom: 2px solid #ffd700;
    border-radius: 13px 13px 0 0 !important;
}

.table-dark {
    --bs-table-bg: rgba(255, 255, 255, 0.05);
    --bs-table-border-color: #ffd700;
}

.table-dark th {
    background: linear-gradient(90deg, #ffd700, #ffed4a);
    color: #000000;
    font-weight: bold;
    border-color: #ffd700;
}

.table-dark td {
    border-color: rgba(255, 215, 0, 0.3);
}

.table-striped > tbody > tr:nth-of-type(odd) > td {
    background-color: rgba(255, 255, 255, 0.02);
}

.modal-content {
    border: 2px solid #ffd700;
    border-radius: 15px;
}

.modal-header {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 237, 74, 0.1));
}

.modal-footer {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 237, 74, 0.1));
}

.modal-body {
    max-height: 400px;
    overflow-y: auto;
    padding: 20px;
}

/* Add responsive containers */
.container {
    max-width: 100%;
    overflow-x: hidden;
    padding-left: 15px;
    padding-right: 15px;
}

.row {
    margin-left: -15px;
    margin-right: -15px;
    overflow-x: hidden;
}

[class*="col-"] {
    padding-left: 15px;
    padding-right: 15px;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

/* Fix table overflow */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    max-width: 100%;
}

.table {
    min-width: 800px;
    word-wrap: break-word;
}

@media (max-width: 768px) {
    .container {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .row {
        margin-left: -10px;
        margin-right: -10px;
    }
    
    [class*="col-"] {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .table {
        font-size: 0.8rem;
        min-width: 600px;
    }
    
    .table th, .table td {
        padding: 0.5rem;
        white-space: nowrap;
    }
    
    .btn-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .btn-group .btn {
        width: 100%;
    }
}

@media (max-width: 576px) {
    .container {
        padding-left: 5px;
        padding-right: 5px;
    }
    
    .row {
        margin-left: -5px;
        margin-right: -5px;
    }
    
    [class*="col-"] {
        padding-left: 5px;
        padding-right: 5px;
    }
    
    .table {
        font-size: 0.7rem;
        min-width: 500px;
    }
    
    .table th, .table td {
        padding: 0.3rem;
        font-size: 0.75rem;
    }
    
    .casino-title {
        font-size: 1.8rem;
    }
    
    .casino-subtitle {
        font-size: 1rem;
    }
    
    .card {
        margin-bottom: 15px;
    }
    
    .card-header {
        font-size: 0.9rem;
        padding: 10px;
    }
    
    .card-body {
        padding: 10px;
    }
    
    .badge {
        font-size: 0.7rem;
    }
}

/* Fix modal overflow */
.modal-dialog {
    max-width: 95%;
    margin: 10px auto;
}

.modal-body {
    max-height: 70vh;
    overflow-y: auto;
    word-wrap: break-word;
}

.btn-close-white {
    filter: invert(1) grayscale(100%) brightness(200%);
}

.btn:focus {
    box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
}

.result-btn {
    cursor: pointer;
    transition: all 0.2s ease;
}

.result-btn.active {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
}

.result-btn:hover {
    transform: scale(1.02);
}

/* Ensure buttons are clickable */
.modal .btn {
    pointer-events: auto !important;
}

.modal-dialog {
    pointer-events: none;
}

.modal-content {
    pointer-events: auto;
}
</style>
@endsection
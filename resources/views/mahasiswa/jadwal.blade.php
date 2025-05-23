@extends('layouts.app')

@section('style')
    <style>
        /* Mode Togle */
        .mode-toggle {
            position: relative;
            background: #f8f9fa;
            border: 2px solid var(--bs-primary);
            border-radius: 50px;
            padding: 4px;
            display: flex;
            width: fit-content;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .toggle-option {
            position: relative;
            padding: 8px 24px;
            font-weight: 600;
            color: var(--bs-primary);
            z-index: 2;
            /* Increased z-index */
            transition: all 0.3s ease;
            user-select: none;
        }

        .toggle-option:not(.active) {
            color: white;
            opacity: 1;
        }

        .toggle-option.active {
            opacity: 0.6;
        }

        .slider {
            position: absolute;
            top: 4px;
            left: 4px;
            bottom: 4px;
            width: calc(50% - 4px);
            background: var(--bs-primary);
            border-radius: 25px;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 1;
            /* Lower than toggle-option */
        }

        .mode-toggle[data-mode="false"] .slider {
            transform: translateX(100%);
            /* Changed from left to transform */
        }
    </style>
@endsection
@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-start mb-3">
            <a href="{{ route('mahasiswa.index') }}" class="back-button">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: #09191F;">
                        <h5 class="mb-0 text-white">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Pengajuan Jadwal dan Lab
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('mahasiswa.updateJadwal', $kelompok->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Mode Switch Toggle --}}
                            <div class="mb-4">
                                <label class="form-label d-block">Mode Presentasi</label>
                                <div class="mode-toggle-wrapper">
                                    <input type="hidden" id="modeInput" value="true" disabled>
                                    <div class="mode-toggle" data-mode="false">
                                        <div class="toggle-option offline active" data-mode="false">
                                            <i class="fas fa-building me-2"></i>
                                            Offline
                                        </div>
                                        <div class="toggle-option online" data-mode="true">
                                            <i class="fas fa-video me-2"></i>
                                            Online
                                        </div>
                                        <div class="slider"></div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="mb-3 d-flex flex-column">
                                <label for="lab_id" class="form-label">
                                    <i class="fas fa-flask me-1"></i> Link Gmeet
                                </label>
                                <a href="{{ $kelompok->link }}" class="d-grid text-white" target="_blank">
                                    <div class="btn" style="background-color: #26bd6c; color: #fff">
                                        {{ $kelompok->link }}
                                    </div>
                                </a>
                            </div> --}}

                            <div class="mb-4">
                                <label for="jadwal_presentasi_id" class="form-label">
                                    <i class="fas fa-clock me-1"></i> Jadwal
                                </label>
                                <div class="select-wrapper">
                                    <select name="jadwal_presentasi_id" id="jadwal_presentasi_id"
                                        class="form-select custom-select" style="cursor: pointer" required>
                                        <option value="">Pilih Jadwal</option>
                                        @foreach ($jadwals as $jadwal)
                                            <option value="{{ $jadwal->id }}">
                                                {{ \Carbon\Carbon::parse($jadwal->tanggal_presentasi)->isoFormat('dddd, D MMMM Y') }}
                                                - {{ $jadwal->waktu_presentasi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="submit-button">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    <span>Ajukan Jadwal</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Wrapper untuk custom select */
        .select-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: '\f107';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            pointer-events: none;
        }

        /* Custom select styling */
        .custom-select {
            appearance: none;
            padding: 10px 15px;
            border: 1.5px solid #e2e8f0;
            border-radius: 6px;
            width: 100%;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background-color: white;
            color: #333;
        }

        .custom-select:hover {
            border-color: #09191F;
        }

        .custom-select:focus {
            outline: none;
            border-color: #09191F;
            box-shadow: 0 0 0 3px rgba(9, 25, 31, 0.1);
        }

        .custom-select option {
            color: #333;
            background-color: white;
        }

        .custom-select option:disabled {
            color: #94a3b8;
            background-color: #f1f5f9;
        }

        /* Button styling */
        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background-color: #09191F;
            color: #fff;
            border: 1.5px solid #09191F;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }

        .back-button:hover {
            background-color: transparent;
            color: #09191F;
            transform: translateX(-5px);
        }

        .back-button i {
            margin-right: 8px;
        }

        .submit-button {
            width: 100%;
            padding: 12px;
            background-color: #09191F;
            color: #fff;
            border: 1.5px solid #09191F;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .submit-button:hover {
            background-color: transparent;
            color: #09191F;
            transform: translateY(-2px);
        }

        /* Form styling */
        .form-label {
            font-weight: 500;
            font-size: 0.95rem;
            color: #333;
            margin-bottom: 6px;
        }

        /* Card styling */
        .card {
            border: none;
            border-radius: 8px;
        }

        .card-header {
            background-color: #09191F;
            color: #fff;
            padding: 15px 20px;
            border-bottom: none;
            border-radius: 8px 8px 0 0 !important;
        }

        .card-body {
            background-color: #fff;
            color: #333;
            border-radius: 0 0 8px 8px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .col-md-7 {
                padding: 0 15px;
            }

            .container {
                margin-top: 1rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jadwalSelect = document.getElementById('jadwal_presentasi_id');
            const usedJadwals = @json($usedJadwals);

            jadwalSelect.querySelectorAll('option').forEach(option => {
                const jadwalId = parseInt(option.value);
                if (usedJadwals.includes(jadwalId)) {
                    option.disabled = true;
                    option.style.color = '#94a3b8'; // Gaya teks disabled
                }
            });
        });
    </script>
@endsection

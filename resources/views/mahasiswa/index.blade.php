@extends('layouts.app')

@section('style')
    <style>
        /* Logout Button Style */
        .logout-btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 24px;
            background: white;
            border: 2px solid var(--bs-primary);
            border-radius: 50px;
            color: var(--bs-primary);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .logout-btn:hover {
            background: var(--bs-primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(var(--bs-primary-rgb), 0.2);
        }

        .logout-btn:active {
            transform: translateY(0);
        }

        .logout-btn i {
            transition: transform 0.3s ease;
        }

        .logout-btn:hover i {
            transform: translateX(3px);
        }

        /* User Info Style */
        .user-info {
            padding: 10px 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .user-info:hover {
            background: rgba(var(--bs-primary-rgb), 0.1);
            transform: translateX(5px);
        }

        /* Cursor adaptations for new elements */
        .logout-btn:hover~.custom-cursor .cursor-dot {
            background-color: var(--bs-primary) !important;
        }

        .logout-btn:hover~.custom-cursor .cursor-outline {
            border-color: var(--bs-primary) !important;
        }

        .user-info:hover~.custom-cursor .cursor-dot {
            transform: scale(1.5);
        }

        /* Cursor styling untuk area tabel */
        .table-responsive,
        .table,
        .table tbody,
        .table tr,
        .table td {
            background-color: white;
            position: relative;
            z-index: 1;
        }

        /* Style untuk baris tabel */
        .table tbody tr {
            transition: all 0.3s ease;
        }

        /* Cursor style untuk area tabel */
        .table-responsive *,
        .table *,
        .table tbody *,
        .table tr *,
        .table td * {
            cursor: none !important;
        }

        /* Mengubah warna cursor saat di atas area tabel */
        .table-responsive:hover ~ .custom-cursor .cursor-dot,
        .table:hover ~ .custom-cursor .cursor-dot,
        .table tbody:hover ~ .custom-cursor .cursor-dot,
        .table tr:hover ~ .custom-cursor .cursor-dot,
        .table td:hover ~ .custom-cursor .cursor-dot {
            background-color: #09191F !important;
            mix-blend-mode: normal !important;
        }

        .table-responsive:hover ~ .custom-cursor .cursor-outline,
        .table:hover ~ .custom-cursor .cursor-outline,
        .table tbody:hover ~ .custom-cursor .cursor-outline,
        .table tr:hover ~ .custom-cursor .cursor-outline,
        .table td:hover ~ .custom-cursor .cursor-outline {
            border-color: #09191F !important;
            mix-blend-mode: normal !important;
        }

        /* Khusus untuk link dan button di dalam tabel */
        .table a,
        .table button {
            cursor: pointer !important;
            position: relative;
            z-index: 2;
        }

        /* Style untuk row yang aktif */
        .table-active {
            background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
        }

        /* Style untuk hover pada row */
        .table tbody tr:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.05);
        }

        /* Override untuk badges dan icons */
        .badge, 
        .fas {
            position: relative;
            z-index: 2;
        }

        /* Style khusus untuk baris tabel */
        .table tbody tr {
            position: relative;
            z-index: 1;
        }

        /* Mengubah warna cursor saat di atas baris tabel */
        .table tbody tr:hover ~ .custom-cursor .cursor-dot,
        .table tbody tr:hover ~ .custom-cursor .cursor-outline,
        .table-responsive:hover ~ .custom-cursor .cursor-dot,
        .table-responsive:hover ~ .custom-cursor .cursor-outline {
            --cursor-color: #09191F !important;
            mix-blend-mode: normal !important;
        }

        .table tbody tr:hover ~ .custom-cursor .cursor-dot {
            background-color: #09191F !important;
        }

        .table tbody tr:hover ~ .custom-cursor .cursor-outline {
            border-color: #09191F !important;
        }

        /* Memastikan cursor terlihat di atas background putih */
        .table-body {
            background-color: white;
        }

        .table-body tr {
            transition: all 0.3s ease;
        }

        .table-body tr:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.1);
        }

        /* Override mix-blend-mode untuk area tabel */
        .table-responsive *,
        .table tbody tr * {
            mix-blend-mode: normal !important;
        }

        /* Memastikan cursor kontras pada area tabel */
        .table-responsive * {
            cursor: none !important;
        }

        .table-responsive a,
        .table-responsive button {
            cursor: pointer !important;
        }

        /* Tambahkan style untuk cell tabel */
        .table td, 
        .table th {
            position: relative;
            z-index: 2;
        }
    </style>
@endsection

@section('content')
    {{--  --}}

    <section class="pc-container" style="margin: 40px 40px 0px 40px !important; ">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="user-info bg-light">
                        <h5 class="mb-1" style="color: var(--bs-primary);">
                            <i class="fas fa-user-circle me-2"></i>
                            {{ Auth::user()->name }}
                        </h5>
                        <small class="text-muted">{{ Auth::user()->email }}</small>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <span class="btn-text">Logout</span>
                            <i class="fas fa-sign-out-alt ms-2"></i>
                        </button>
                    </form>
                </div>
                <div class="card border-0 shadow-sm overflow-hidden wow fadeInUp">
                    <div class="card-header text-white p-4 d-flex justify-content-between align-items-center" style="background-color: white;">
                        <div class="header-content">
                            <h5 class=" title-animation" style="color: var(--bs-primary);">
                                <span class="line-wrapper">
                                    <span class="line" style="font-size: 1.5rem;">Tugas Akhir Mobile Programming</span>
                                </span>
                            </h5>
                            <p class="mb-0 description-animation" style="color: var(--bs-primary);">
                                Ajukan presentasi tugas akhir Mobile Programming Anda dengan mudah di sini.
                            </p>
                        </div>
                        <a class="btn create-btn" href="{{ route('mahasiswa.create') }}"
                            style="background-color: var(--bs-primary); color: white;">
                            <span>Buat Pengajuan</span>
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <!-- Filter Section -->
                        {{-- <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end">
                                   
                                </div>
                            </div>
                        </div> --}}

                        <!-- Table Section -->
                        <div class="table-responsive rounded-3 wow fadeInUp" data-wow-delay="0.3s">
                            <table id="complex-header" class="table table-hover">
                                <thead style="color: var(--bs-primary);">
                                    <tr>
                                        <th>Judul Proyek</th>
                                        <th>Ketua & Anggota</th>
                                        <th>Lab</th>
                                        <th>Jadwal Presentasi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($kelompok->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <img src="https://icons.veryicon.com/png/o/business/financial-category/no-data-6.png"
                                                    alt="Data Kosong" class="empty-state-img mb-3"
                                                    style="max-width: 200px;">
                                                <h5 class="text-muted">Data Kosong</h5>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($kelompok as $k)
                                            <tr class="project-row {{ $k->user_id === Auth::id() ? 'table-active' : '' }}">
                                                <td class="align-middle">
                                                    {{ $k->judul_proyek }}
                                                    @if ($k->user_id === Auth::id())
                                                        <span class="badge bg-info"></span>
                                                    @endif
                                                    @if ($k->selesai == 1)
                                                        <img src="{{ asset('verified.png') }}" width="20"
                                                            height="20">
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $k->ketua }} [ {{ $k->npm_ketua }} ]</strong>
                                                    <br>
                                                    @php
                                                        $anggotaCount = !empty($k->anggota)
                                                            ? count(json_decode($k->anggota))
                                                            : 0;
                                                        $slotsLeft = 4 - $anggotaCount;
                                                    @endphp

                                                    <span class="badge {{ $slotsLeft > 0 ? 'bg-success' : 'bg-danger' }}">
                                                        @if ($slotsLeft > 0)
                                                            {{ $slotsLeft }} slot tersedia
                                                        @else
                                                            Kelompok Penuh
                                                        @endif
                                                    </span>

                                                    @if (!empty($k->anggota) && !empty($k->npm_anggota))
                                                        @php
                                                            $anggotaList = json_decode($k->anggota);
                                                            $npmList = json_decode($k->npm_anggota);
                                                        @endphp
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($k->lab)
                                                        {{ $k->lab->nama_lab }}
                                                    @else
                                                        <span class="badge bg-secondary">Belum memilih lab</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($k->jadwalPresentasi)
                                                        <span>{{ $k->jadwalPresentasi->tanggal_presentasi }}</span><br>
                                                        <small>{{ $k->jadwalPresentasi->waktu_presentasi }}</small>
                                                    @else
                                                        <span class="badge bg-secondary">Belum diatur</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($k->status == 'Pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @elseif($k->status == 'Diterima')
                                                        <span class="badge bg-success">Diterima</span>
                                                    @elseif($k->status == 'Ditolak')
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($k->isOwnedByUser(Auth::id()))
                                                        @if ($k->jadwal_lab_opened && !$k->jadwal_presentasi_id)
                                                            <a href="{{ route('mahasiswa.jadwalForm', $k->id) }}"
                                                                class="set-jadwal-btn">
                                                                <span class="btn-text">Set Jadwal</span>
                                                                <span class="btn-icon">
                                                                    <i class="fas fa-calendar-alt"></i>
                                                                </span>
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('mahasiswa.edit', $k->id) }}"
                                                            class="btn btn-warning btn-sm ms-1">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @else
                                                        <span class="badge bg-light text-dark">No Access</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Text Animation Styles */
        .title-animation {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .line-wrapper {
            display: block;
            overflow: hidden;
            padding: 4px 0;
        }

        .line {
            display: block;
            transform: translateY(100%);
            opacity: 0;
        }

        .description-animation {
            transform: translateY(20px);
            opacity: 0;
            font-size: 1.1rem;
        }

        /* Cursor transition */
        .cursor-dot,
        .cursor-outline {
            transition: background-color 0.3s ease, border-color 0.3s ease !important;
        }

        /* Table row hover effect */
        .project-row:hover {
            background-color: var(--bs-primary);
            color: white;
        }

        /* Status badges hover */
        .btn.disabled:hover~.custom-cursor .cursor-dot {
            background-color: white !important;
        }

        .btn.disabled:hover~.custom-cursor .cursor-outline {
            border-color: rgba(255, 255, 255, 0.5) !important;
        }

        /* Card hover */
        .card:hover~.custom-cursor .cursor-dot {
            background-color: var(--bs-primary) !important;
        }

        .card:hover~.custom-cursor .cursor-outline {
            border-color: rgba(var(--bs-primary-rgb), 0.5) !important;
        }

        .create-btn {
            padding: 12px 35px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .create-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg,
                    transparent,
                    rgba(255, 255, 255, 0.6),
                    transparent);
            transition: all 0.4s;
        }

        .create-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .create-btn:hover:before {
            left: 100%;
        }

        .set-jadwal-btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 20px;
            background: linear-gradient(45deg, #09191F, #1e3a44);
            border: none;
            border-radius: 25px;
            color: white;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(9, 25, 31, 0.2);
        }

        .set-jadwal-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(9, 25, 31, 0.4);
            color: white;
            background: linear-gradient(45deg, #1e3a44, #09191F);
        }

        .set-jadwal-btn:active {
            transform: translateY(0);
            background: linear-gradient(45deg, #061216, #152b33);
        }

        .set-jadwal-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg,
                    transparent,
                    rgba(255, 255, 255, 0.6),
                    transparent);
            transition: all 0.6s;
        }

        .set-jadwal-btn:hover::before {
            left: 100%;
        }

        .btn-text {
            position: relative;
            z-index: 1;
            margin-right: 8px;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .btn-icon {
            position: relative;
            z-index: 1;
            opacity: 0;
            width: 0;
            transition: all 0.3s ease;
        }

        .set-jadwal-btn:hover .btn-icon {
            opacity: 1;
            width: 20px;
            margin-left: 4px;
        }

        @keyframes buttonPop {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .set-jadwal-btn {
            animation: buttonPop 0.3s ease-out forwards;
        }

        /* Efek ripple saat diklik */
        .set-jadwal-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .set-jadwal-btn:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }

            100% {
                transform: scale(100, 100);
                opacity: 0;
            }
        }

        /* Styling untuk filter section */
        .form-select {
            border-color: var(--bs-primary);
            color: var(--bs-primary);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-select:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.1);
        }

        .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
        }

        .btn-group .btn {
            transition: all 0.3s ease;
        }

        .btn-group .btn:hover {
            transform: translateY(-2px);
        }

        /* Highlight row milik user yang login */
        .table-row-mine {
            background-color: rgba(var(--bs-primary-rgb), 0.1);
        }
    </style>

    <script>
        // Definisikan fungsi inisialisasi animasi halaman
        window.initPageAnimations = function() {
            gsap.to('.line', {
                y: '0%',
                opacity: 1,
                duration: 1,
                stagger: 0.2,
                ease: 'power3.out'
            });

            gsap.to('.description-animation', {
                y: 0,
                opacity: 1,
                duration: 0.8,
                delay: 0.5,
                ease: 'power3.out'
            });

            // Adaptive cursor
            const cursor = document.querySelector('.cursor-dot');
            const cursorOutline = document.querySelector('.cursor-outline');

            // Function to check if background is dark
            function isDarkBackground(element) {
                const bgcolor = window.getComputedStyle(element).backgroundColor;
                const rgb = bgcolor.match(/\d+/g);
                if (rgb) {
                    // Calculate relative luminance
                    const brightness = (parseInt(rgb[0]) * 299 + parseInt(rgb[1]) * 587 + parseInt(rgb[2]) * 114) /
                        1000;
                    return brightness < 128;
                }
                return false;
            }

            // Function to update cursor color
            function updateCursorColor(element) {
                const isDark = isDarkBackground(element);

                if (isDark) {
                    cursor.style.backgroundColor = 'white';
                    cursorOutline.style.borderColor = 'rgba(255, 255, 255, 0.5)';
                } else {
                    cursor.style.backgroundColor = 'var(--bs-primary)';
                    cursorOutline.style.borderColor = 'rgba(var(--bs-primary-rgb), 0.5)';
                }
            }

            // Update cursor color on mouseover
            document.addEventListener('mouseover', (e) => {
                const element = e.target;
                updateCursorColor(element);
            });

            // Special handling for table rows
            document.querySelectorAll('tr').forEach(row => {
                row.addEventListener('mouseenter', () => {
                    updateCursorColor(row);
                });
            });

            // Reset cursor color when leaving elements
            document.addEventListener('mouseleave', () => {
                cursor.style.backgroundColor = 'var(--bs-primary)';
                cursorOutline.style.borderColor = 'rgba(var(--bs-primary-rgb), 0.5)';
            });

            // Button hover animation
            const button = document.querySelector('.create-btn');

            button.addEventListener('mouseenter', () => {
                gsap.to(button, {
                    scale: 1.1,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            button.addEventListener('mouseleave', () => {
                gsap.to(button, {
                    scale: 1,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });
        };

        // Script untuk handle perubahan filter
        document.querySelectorAll('select[name]').forEach(select => {
            select.addEventListener('change', function() {
                const form = document.getElementById('filterForm');
                form[this.name].value = this.value;
                form.submit();
            });
        });

        // Tambahkan animasi untuk filter
        gsap.from('.btn-group .btn, .form-select', {
            y: -20,
            opacity: 0,
            duration: 0.5,
            stagger: 0.1,
            ease: 'power2.out'
        });

        // Update event listener untuk area tabel
        document.querySelectorAll('.table tbody tr').forEach(row => {
            row.addEventListener('mouseenter', () => {
                const cursor = document.querySelector('.cursor-dot');
                const outline = document.querySelector('.cursor-outline');
                
                cursor.style.backgroundColor = '#09191F';
                cursor.style.mixBlendMode = 'normal';
                outline.style.borderColor = '#09191F';
                outline.style.mixBlendMode = 'normal';
            });

            row.addEventListener('mouseleave', () => {
                const cursor = document.querySelector('.cursor-dot');
                const outline = document.querySelector('.cursor-outline');
                
                cursor.style.backgroundColor = '';
                cursor.style.mixBlendMode = 'difference';
                outline.style.borderColor = '';
                outline.style.mixBlendMode = 'difference';
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const tableElements = document.querySelectorAll('.table *, .table-responsive *');
            
            tableElements.forEach(element => {
                element.addEventListener('mouseenter', () => {
                    const cursor = document.querySelector('.cursor-dot');
                    const outline = document.querySelector('.cursor-outline');
                    
                    if (cursor && outline) {
                        cursor.style.backgroundColor = '#09191F';
                        cursor.style.mixBlendMode = 'normal';
                        outline.style.borderColor = '#09191F';
                        outline.style.mixBlendMode = 'normal';
                    }
                });
            });
        });
    </script>
@endsection

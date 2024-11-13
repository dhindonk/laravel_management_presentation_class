@extends('layouts.app')

@section('content')
    <section class="pc-container" style="margin: 40px !important; ">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10">
                <div class="card border-0 shadow-sm overflow-hidden wow fadeInUp">
                    <div class="card-header text-white p-4" style="background-color: white;">
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
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-center mb-4 wow fadeInUp" data-wow-delay="0.2s">
                            <a class="btn create-btn" href="{{ route('mahasiswa.create') }}"
                                style=" background-color: var(--bs-primary); color: white;">
                                <span>Buat Pengajuan</span>
                            </a>
                        </div>

                        <div class="table-responsive rounded-3 wow fadeInUp" data-wow-delay="0.3s">
                            <table id="complex-header" class="table table-hover">
                                <thead style="color: var(--bs-primary);">
                                    <tr>
                                        <th>Judul Proyek</th>
                                        <th>Ketua & Anggota</th>
                                        <th>Lab</th>
                                        <th>Jadwal Presentasi</th>
                                        <th>Status</th>
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
                                            <tr class="project-row">
                                                <td class="align-middle">
                                                    {{ $k->judul_proyek }}
                                                    @if ($k->selesai == 1)
                                                        <img src="{{ asset('verified.png') }}" width="20"
                                                            height="20">
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $k->ketua }} [ {{ $k->npm_ketua }} ]</strong>
                                                    <br>
                                                    @php
                                                        $anggotaCount = !empty($k->anggota) ? count(json_decode($k->anggota)) : 0;
                                                        $slotsLeft = 4 - $anggotaCount;
                                                    @endphp
                                                    
                                                    <span class="badge {{ $slotsLeft > 0 ? 'bg-success' : 'bg-danger' }}">
                                                        @if ($slotsLeft > 0)
                                                            {{ $slotsLeft }} slot tersedia
                                                        @else
                                                            Kelompok Penuh
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>{{ $k->lab->nama_lab }}</td>
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
                                                        <span class="btn disabled"
                                                            style="background-color: var(--bs-warning); color: white;">Pending</span>
                                                    @elseif($k->status == 'Diterima')
                                                        <span class="btn disabled"
                                                            style="background-color: var(--bs-success); color: white;">Diterima</span>
                                                    @elseif($k->status == 'Ditolak')
                                                        <span class="btn disabled"
                                                            style="background-color: var(--bs-danger); color: white;">Ditolak</span>
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
        .cursor-dot, .cursor-outline {
            transition: background-color 0.3s ease, border-color 0.3s ease !important;
        }

        /* Table row hover effect */
        .project-row:hover {
            background-color: var(--bs-primary);
            color: white;
        }

        /* Status badges hover */
        .btn.disabled:hover ~ .custom-cursor .cursor-dot {
            background-color: white !important;
        }

        .btn.disabled:hover ~ .custom-cursor .cursor-outline {
            border-color: rgba(255, 255, 255, 0.5) !important;
        }

        /* Card hover */
        .card:hover ~ .custom-cursor .cursor-dot {
            background-color: var(--bs-primary) !important;
        }

        .card:hover ~ .custom-cursor .cursor-outline {
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
                const brightness = (parseInt(rgb[0]) * 299 + parseInt(rgb[1]) * 587 + parseInt(rgb[2]) * 114) / 1000;
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
    </script>
@endsection

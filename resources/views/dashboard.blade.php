<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Presentation Mobile Programming</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('logo.png') }}">

        <!-- Custom CSS -->
        <link href="{{ asset('frontend/assets/css/styles.css') }}" rel="stylesheet">
        <style>
            .btn-letsgo {
                transition: .3s;
            }

            .btn-letsgo:hover {
                transform: rotate(-3deg) scale(1.1);
                color: white !important;
            }

            .split-text {
                overflow: hidden;
                opacity: 0;
            }

            .card {
                transform-style: preserve-3d;
                perspective: 1000px;
            }

            .gradient-overlay {
                position: absolute;
                width: 100%;
                height: 100%;
                background: linear-gradient(45deg, rgba(66, 133, 244, 0.3), rgba(219, 68, 55, 0.3));
                opacity: 0;
                top: 0;
                left: 0;
                pointer-events: none;
            }

            .line-wrapper {
                display: block;
                padding: 5px 0;
            }

            .line {
                display: block;
                transform: translateY(100%);
                opacity: 0;
                background: linear-gradient(to right,
                        rgba(255, 255, 255, 0.9) 0%,
                        rgba(255, 255, 255, 1) 20%,
                        var(--bs-primary) 50%,
                        rgba(255, 255, 255, 1) 80%,
                        rgba(255, 255, 255, 0.9) 100%);
                background-size: 300% auto;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                animation: elegantShineRightToLeft 8s cubic-bezier(0.445, 0.05, 0.55, 0.95) infinite;
                transform-style: preserve-3d;
                overflow: visible;
                transition: all 0.5s ease;
            }

            @keyframes elegantShineRightToLeft {
                0% {
                    background-position: 100% center;
                }

                50% {
                    background-position: -50% center;
                }

                100% {
                    background-position: -200% center;
                }
            }

            .magnetic-text:hover .line {
                transform: translateY(0);
                opacity: 1;
            }

            .gradient-text {
                background: linear-gradient(to bottom, #fff, var(--bs-primary));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                display: inline-block;
                padding: 10px 0;
            }

            .hero-description .word {
                display: inline-block;
                opacity: 0;
                transform: translateY(20px);
                margin-right: 5px;
                color: white;
                transform-style: preserve-3d;
                overflow: visible;
            }

            .hero-title {
                font-size: 3.5rem;
                font-weight: 700;
                line-height: 1.2;
                margin: 20px 0;
                overflow: visible;
            }

            @media (max-width: 768px) {
                .hero-title {
                    font-size: 2.5rem;
                }
            }

            .floating-animation {
                animation: float 2s ease-in-out infinite;
            }

            @keyframes float {
                0% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(8px);
                }

                100% {
                    transform: translateY(0px);
                }
            }

            gsap.to('.gradient-text', {
                duration: 2,
                y: "8px",
                ease: "sine.inOut",
                repeat: -1,
                yoyo: true
            });

            .magnetic-text {
                position: relative;
                display: inline-block;
                cursor: default;
                padding: 20px;
                overflow: visible;
                text-align: center;
            }

            .magnetic-text::after {
                content: '';
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                width: 300px;
                /* Ukuran diameter lingkaran */
                height: 300px;
                /* Ukuran diameter lingkaran */
                background: radial-gradient(circle at center,
                        rgba(79, 159, 255, 0.15) 0%,
                        rgba(79, 159, 255, 0.1) 30%,
                        transparent 70%);
                border-radius: 50%;
                pointer-events: none;
                opacity: 0;
                transition: all 0.3s ease;
            }

            .magnetic-text:hover::after {
                opacity: 1;
            }

            .line,
            .magnetic-word {
                transition: background-position 0.3s ease-out, filter 0.3s ease;
            }

            .btn-letsgo {
                background: white;
                color: var(--bs-primary);
                padding: 12px 35px;
                border-radius: 50px;
                text-decoration: none;
                font-weight: bold;
                font-size: 18px;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                position: relative;
                overflow: hidden;
                opacity: 0;
                transform: translateY(20px);
            }

            .btn-letsgo:before {
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

            .btn-letsgo:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
                color: var(--bs-primary);
            }

            .btn-letsgo:hover:before {
                left: 100%;
            }

            /* Scroll Indicator */
            .scroll-indicator {
                position: absolute;
                bottom: -60px;
                left: 50%;
                transform: translateX(-50%) scale(0.8);
                text-align: center;
                opacity: 0;
            }

            .mouse {
                width: 30px;
                height: 50px;
                border: 2px solid rgba(255, 255, 255, 0.272);
                border-radius: 20px;
                margin: 0 auto 10px;
            }

            .wheel {
                width: 4px;
                height: 8px;
                background: white;
                border-radius: 2px;
                margin: 8px auto;
                animation: scrollWheel 1.5s infinite;
            }

            .scroll-text {
                color: rgba(255, 255, 255, 0.272);
                font-size: 14px;
                letter-spacing: 1px;
            }

            @keyframes scrollWheel {
                0% {
                    transform: translateY(0);
                    opacity: 1;
                }

                100% {
                    transform: translateY(20px);
                    opacity: 0;
                }
            }

            /* Mockup Animations */
            .mockup-container {
                perspective: 1000px;
                cursor: pointer;
            }

            .mockup-phone {
                transform-style: preserve-3d;
                transition: transform 0.5s ease;
                will-change: transform;
            }

            .mockup-phone-hover {
                opacity: 0;
                transition: opacity 0.5s ease;
            }

            .mockup-bg {
                background: whitesmoke;
                height: 95%;
                border-radius: 100rem 100rem 10rem 10rem;
                transition: all 0.5s ease;
            }

            .mockup-glow {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%),
                        rgba(255, 255, 255, 0.3),
                        transparent 50%);
                pointer-events: none;
                opacity: 0;
                transition: opacity 0.3s ease;
                z-index: 3;
            }

            .mockup-container:hover .mockup-glow {
                opacity: 1;
            }

            /* Scroll Indicator Positioning */
            .scroll-indicator-wrapper {
                position: absolute;
                bottom: 30px;
                left: 0;
                right: 0;
                z-index: 10;
            }

            .scroll-indicator {
                position: relative;
                text-align: center;
                opacity: 0;
            }

            /* Button Styling */
            .btn-letsgo {
                margin-top: 1.2rem;
                /* margin-bottom: 6rem; */
                */
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .scroll-indicator-wrapper {
                    bottom: 20px;
                }

                .btn-letsgo {
                    margin-bottom: 5rem;
                }
            }

            @media (max-height: 700px) {
                .btn-letsgo {
                    margin-bottom: 4rem;
                }

                .scroll-indicator-wrapper {
                    bottom: 15px;
                }
            }

            .body-button-letsgo {
                position: fixed;
                bottom: 0;
                right: 0;
                width: 200px;
                height: 100px;
                z-index: 1000;
                opacity: 1;
                border-radius: 80px 0 0 0;
                pointer-events: auto;
                box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            }

            /* Mockup Container Styles */
            .mockup-container {
                perspective: 1000px;
                cursor: pointer;
            }

            .mockup-phone {
                transform-style: preserve-3d;
                transition: transform 0.5s ease;
                will-change: transform;
            }

            .mockup-phone-hover {
                opacity: 0;
                transition: opacity 0.5s ease;
            }

            .mockup-bg {
                background: whitesmoke;
                height: 95%;
                border-radius: 100rem 100rem 10rem 10rem;
                transition: all 0.5s ease;
            }

            /* Glow Effect */
            .mockup-glow {
                position: absolute;
                width: 100%;
                height: 100%;
                background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%),
                        rgba(255, 255, 255, 0.3),
                        transparent 50%);
                pointer-events: none;
                opacity: 0;
                transition: opacity 0.3s ease;
                z-index: 3;
            }

            .mockup-container:hover .mockup-glow {
                opacity: 1;
            }

            /* Custom Animation Classes */
            .floating {
                animation: floating 3s ease-in-out infinite;
            }

            @keyframes floating {
                0% {
                    transform: translateY(0px) rotateY(0deg);
                }

                50% {
                    transform: translateY(-15px) rotateY(5deg);
                }

                100% {
                    transform: translateY(0px) rotateY(0deg);
                }
            }

            .image-transition {
                animation: imageTransition 0.5s ease-out forwards;
            }

            @keyframes imageTransition {
                0% {
                    transform: scale(1) rotateY(0deg);
                }

                50% {
                    transform: scale(1.05) rotateY(180deg);
                }

                100% {
                    transform: scale(1) rotateY(360deg);
                }
            }

            /* Hide default cursor */
            * {
                cursor: none !important;
            }

            /* Custom Cursor Styles */
            .custom-cursor {
                pointer-events: none;
                position: fixed;
                z-index: 9999;
            }

            .cursor-dot {
                width: 8px;
                height: 8px;
                background-color: white;
                border-radius: 50%;
                position: fixed;
                pointer-events: none;
                transition: transform 0.1s;
                left: 0;
                top: 0;
                transform: translate(-50%, -50%);
            }

            .cursor-outline {
                width: 40px;
                height: 40px;
                border: 2px solid rgba(255, 255, 255, 0.5);
                border-radius: 50%;
                position: fixed;
                pointer-events: none;
                transition: transform 0.2s ease-out;
                left: 0;
                top: 0;
                transform: translate(-50%, -50%);
            }

            /* Hover effects */
            a:hover~.custom-cursor .cursor-dot,
            button:hover~.custom-cursor .cursor-dot {
                transform: translate(-50%, -50%) scale(2);
                background-color: var(--bs-primary);
            }

            a:hover~.custom-cursor .cursor-outline,
            button:hover~.custom-cursor .cursor-outline {
                transform: translate(-50%, -50%) scale(1.5);
                border-color: var(--bs-primary);
                background-color: rgba(255, 255, 255, 0.1);
            }

            .magnetic-text:hover~.custom-cursor .cursor-outline {
                transform: scale(2);
                border-style: dashed;
                animation: rotate 3s linear infinite;
            }

            @keyframes rotate {
                from {
                    transform: scale(2) rotate(0deg);
                }

                to {
                    transform: scale(2) rotate(360deg);
                }
            }

            /* Hide cursor on mobile */
            @media (max-width: 768px) {
                .custom-cursor {
                    display: none;
                }

                * {
                    cursor: auto !important;
                }
            }
        </style>

        <!-- GSAP Scripts - Letakkan sebelum closing head tag -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollToPlugin.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/CustomEase.min.js"></script>
    </head>

    <body style="background-color: var(--bs-primary);">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div id="preloader">
            <div class="preloader"><span></span><span></span></div>
        </div>

        <div class="custom-cursor">
            <div class="cursor-dot"></div>
            <div class="cursor-outline"></div>
        </div>

        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            {{-- Floating Button Container --}}
            <div class="body-button-letsgo">
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-letsgo">
                    Let's Go !!
                </a>
            </div>

            <!-- End Navigation -->
            <div class="clearfix"></div>
            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->

            <!-- ============================ Hero Banner  Start================================== -->
            <div class="image-cover hero-header-auto bg-primary pb-0" data-overlay="0">
                <div class="position-absolute top-0 end-0 z-0"style="user-select: none !important;">
                    <img src="{{ asset('frontend/assets/img/shape-3-soft-light.svg') }}" alt="SVG" width="500">
                </div>
                <div class="position-absolute top-0 start-0 me-10 z-0" style="user-select: none !important;">
                    <img src="{{ asset('frontend/assets/img/shape-1-soft-light.svg') }}" alt="SVG" width="250">
                </div>
                <div class="container">
                    <div class="row justify-content-center align-items-center min-vh-80 position-relative">
                        <!-- Hero Content -->
                        <div class="col-xl-9 col-lg-11 col-md-12 col-sm-12 wow animated fadeInUp">
                            <div class="elcoss-excort text-center magnetic-text"
                                style="user-select: none !important; cursor: crosshair;">
                                <h1 class="mb-4 hero-title">
                                    <span class="line-wrapper">
                                        <span class="line">Pengajuan Presentasi</span>
                                    </span>
                                    <span class="line-wrapper" style="margin-bottom: 10px;">
                                        <span class="line">Mobile Programming</span>
                                    </span>
                                </h1>
                                <p class="fs-5 fw-light fs-mob hero-description">
                                    <span class="word magnetic-word">Ajukan</span>
                                    <span class="word magnetic-word">presentasi</span>
                                    <span class="word magnetic-word">proyek</span>
                                    <span class="word magnetic-word">Mobile</span>
                                    <span class="word magnetic-word">Programming</span>
                                    <span class="word magnetic-word">Anda</span>
                                    <span class="word magnetic-word">sekarang</span>
                                    <span class="word magnetic-word">dan</span>
                                    <span class="word magnetic-word">tunjukkan</span>
                                    <span class="word magnetic-word">hasil</span>
                                    <span class="word magnetic-word">kerja</span>
                                    <span class="word magnetic-word">keras</span>
                                    <span class="word magnetic-word">Anda.</span>
                                </p>
                            </div>
                        </div>
                        {{-- Scroll Indicator - Positioned absolutely --}}
                        <div class="scroll-indicator-container">
                            <div class="scroll-indicator">
                                <div class="mouse">
                                    <div class="wheel"></div>
                                </div>
                                <div class="scroll-text">Scroll untuk melihat aturan</div>
                            </div>
                        </div>

                    </div>

                    <div class="position-absolute bottom-0 start-0 z-0">
                        <img src="{{ asset('frontend/assets/img/shape-2-soft-light.svg') }}" alt="SVG"
                            width="400">
                    </div>
                </div>

                <!-- ============================ Hero Banner End ================================== -->

                <!-- ============================ Our Features Start ================================== -->
                <section class="pt-5 mt-5 position-relative">
                    <div class="container mt-5">
                        <div class="row align-items-center justify-content-center">

                            <div class="text-center text-md-start pt-3 mt-3 wow animated fadeInLeft">
                                <h2 class="mb-1">Aturan Tugas Akhir</h2>
                                <p class="fs-6 text-muted mb-2">Panduan lengkap untuk presentasi Tugas Akhir Mobile
                                    Programming</p>
                            </div>

                            <div class="col-md-5">
                                <div class="mockup-container">
                                    <div class="position-relative wow animated fadeInLeft">
                                        <img class="mockup-phone d-block position-relative z-2 img-fluid"
                                            src="{{ asset('mockup.png') }}" alt="Tugas Akhir">
                                        <img class="mockup-phone-hover d-block position-absolute top-0 left-0 z-2 img-fluid"
                                            src="{{ asset('mockup-hover.png') }}" alt="Tugas Akhir Hover">
                                        <div class="mockup-bg position-absolute z-1 start-0 bottom-0 w-100"></div>
                                        <div class="mockup-glow"></div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-7 col-lg-6 col-xxl-5 offset-lg-1 offset-xxl-2">
                                <div class="ps-md-4 ps-lg-0">

                                    <!-- Poin 1 -->
                                    <div
                                        class="position-relative d-flex justify-content-end my-3 py-1 wow animated fadeInRight">
                                        <div
                                            class="bg-primary square--60 text-light fs-5 fw-bold rounded-circle position-absolute top-50 start-0 translate-middle-y z-2">
                                            01</div>
                                        <div class="card border ps-4" style="width: calc(100% - 1.75rem);">
                                            <div class="card-body ps-4">
                                                <h3 class="h5 pb-2 text-dark fw-semibold mb-1">Durasi Presentasi</h3>
                                                <p class="card-text text-dark">Presentasi dilakukan secara online selama
                                                    20 menit,
                                                    dengan 15 menit presentasi dan 5 menit tanya jawab.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Poin 2 -->
                                    <div
                                        class="position-relative d-flex justify-content-end my-3 py-1 wow animated fadeInRight">
                                        <div
                                            class="bg-primary square--60 text-light fs-5 fw-bold rounded-circle position-absolute top-50 start-0 translate-middle-y z-2">
                                            02</div>
                                        <div class="card border ps-4" style="width: calc(100% - 1.75rem);">
                                            <div class="card-body ps-4">
                                                <h3 class="h5 pb-2 text-dark fw-semibold mb-1">Sifat Presentasi</h3>
                                                <p class="card-text text-dark">Presentasi bersifat tertutup dan hanya
                                                    dihadiri
                                                    oleh
                                                    tim serta asisten praktikum.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Poin 3 -->
                                    <div
                                        class="position-relative d-flex justify-content-end my-3 py-1 wow animated fadeInRight">
                                        <div
                                            class="bg-primary square--60 text-light fs-5 fw-bold rounded-circle position-absolute top-50 start-0 translate-middle-y z-2">
                                            03</div>
                                        <div class="card border ps-4" style="width: calc(100% - 1.75rem);">
                                            <div class="card-body ps-4">
                                                <h3 class="h5 pb-2 text-dark fw-semibold mb-1">Keterlambatan</h3>
                                                <p class="card-text text-dark">Keterlambatan maksimal adalah 5 menit
                                                    dari jadwal
                                                    yang
                                                    telah ditentukan. Melebihi waktu ini akan berakibat pengurangan
                                                    nilai.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Poin 4 -->
                                    <div
                                        class="position-relative d-flex justify-content-end my-3 py-1 wow animated fadeInRight">
                                        <div
                                            class="bg-primary square--60 text-light fs-5 fw-bold rounded-circle position-absolute top-50 start-0 translate-middle-y z-2">
                                            04</div>
                                        <div class="card border ps-4" style="width: calc(100% - 1.75rem);">
                                            <div class="card-body ps-4">
                                                <h3 class="h5 pb-2 text-dark fw-semibold mb-1">Komposisi Tim</h3>
                                                <p class="card-text text-dark">Setiap tim terdiri dari maksimal 4
                                                    orang, dengan
                                                    syarat
                                                    berasal dari 1 kelas teori yang sama</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Poin 5 -->
                                    <div
                                        class="position-relative d-flex justify-content-end my-3 py-1 wow animated fadeInRight">
                                        <div
                                            class="bg-primary square--60 text-light fs-5 fw-bold rounded-circle position-absolute top-50 start-0 translate-middle-y z-2">
                                            05</div>
                                        <div class="card border ps-4" style="width: calc(100% - 1.75rem);">
                                            <div class="card-body ps-4">
                                                <h3 class="h5 pb-2 text-dark fw-semibold mb-1">Ketentuan Aplikasi</h3>
                                                <p class="card-text text-dark">Aplikasi harus memiliki setidaknya 3
                                                    halaman,
                                                    menggunakan 3 library, menerapkan 6 komponen/widgets, serta
                                                    memanfaatkan
                                                    1 API (Get).</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </section>

                <div class="clearfix"></div>
                <!-- ============================ Our Features End ================================== -->

                <!-- ============================ Footer Start ================================== -->
                <footer class="footer" style=" background-color: var(--bs-primary);">
                    <div class="footer-bottom h-100">
                        <div class="container h-100">
                            <div class="d-flex align-items-center justify-content-end h-100">
                                <p class="">© 2024 DhinTech® [ MaroonLabkom ]</p>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- ============================ Footer End ================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Wrapper -->
            <!-- ============================================================== -->


            <!-- ============================================================== -->
            <!-- All Jquery -->
            <!-- ============================================================== -->
            <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
            <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
            <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
            <script src="{{ asset('frontend/assets/js/rangeslider.js') }}"></script>
            <script src="{{ asset('frontend/assets/js/slick.js') }}"></script>
            <script src="{{ asset('frontend/assets/js/counterup.min.js') }}"></script>
            <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
            <script src="{{ asset('frontend/assets/js/imagesloaded.pkgd.min.js') }}"></script>
            <script src="{{ asset('frontend/assets/js/shuffle.min.js') }}"></script>
            <script src="{{ asset('frontend/assets/js/wow.js') }}"></script>
            <script src="{{ asset('frontend/assets/js/lunar.js') }}"></script>

            <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
            <!-- ============================================================== -->
            <!-- This page plugins -->
            <!-- ============================================================== -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const cursor = {
                        dot: document.querySelector('.cursor-dot'),
                        outline: document.querySelector('.cursor-outline'),
                        init: function() {
                            // Set initial position
                            this.pos = {
                                x: 0,
                                y: 0
                            };
                            this.mouse = {
                                x: 0,
                                y: 0
                            };
                            this.speed = 0.5; // Turunkan speed dari 0.35 ke 0.15 untuk efek lebih berat
                            this.outlineSpeed = 0.1; // Tambah variable khusus untuk outline yang lebih lambat
                            this.outlinePos = {
                                x: 0,
                                y: 0
                            };

                            this.addListeners();
                            this.animate();
                        },
                        addListeners: function() {
                            document.addEventListener('mousemove', (e) => {
                                this.mouse.x = e.clientX;
                                this.mouse.y = e.clientY;
                            });

                            // Add hover effects
                            document.querySelectorAll('a, button, .magnetic-text').forEach(el => {
                                el.addEventListener('mouseenter', () => {
                                    this.dot.style.transform = 'translate(-50%, -50%) scale(2)';
                                    this.outline.style.transform =
                                        'translate(-50%, -50%) scale(1.5)';
                                });

                                el.addEventListener('mouseleave', () => {
                                    this.dot.style.transform = 'translate(-50%, -50%) scale(1)';
                                    this.outline.style.transform = 'translate(-50%, -50%) scale(1)';
                                });
                            });
                        },
                        animate: function() {
                            // Smooth easing untuk dot
                            this.pos.x += (this.mouse.x - this.pos.x) * this.speed;
                            this.pos.y += (this.mouse.y - this.pos.y) * this.speed;

                            // Easing yang lebih lambat untuk outline
                            this.outlinePos.x += (this.mouse.x - this.outlinePos.x) * this.outlineSpeed;
                            this.outlinePos.y += (this.mouse.y - this.outlinePos.y) * this.outlineSpeed;

                            // Apply positions
                            this.dot.style.left = this.pos.x + 'px';
                            this.dot.style.top = this.pos.y + 'px';

                            this.outline.style.left = this.outlinePos.x + 'px';
                            this.outline.style.top = this.outlinePos.y + 'px';

                            requestAnimationFrame(() => this.animate());
                        }
                    };

                    cursor.init();
                });
            </script>
            <script>
                // Tunggu sampai DOM sepenuhnya dimuat
                document.addEventListener('DOMContentLoaded', function() {
                    // Register plugins
                    gsap.registerPlugin(ScrollTrigger, CustomEase);

                    // Preloader Animation
                    const preloader = document.getElementById('preloader');
                    gsap.to(preloader, {
                        opacity: 0,
                        duration: 1,
                        onComplete: () => preloader.style.display = 'none'
                    });

                    // Hero Section Animation
                    const heroTl = gsap.timeline();

                    heroTl.from('.elcoss-excort h1', {
                            y: 100,
                            opacity: 0,
                            duration: 1,
                            ease: 'power4.out'
                        })
                        .from('.elcoss-excort p', {
                            y: 50,
                            opacity: 0,
                            duration: 1,
                            ease: 'power3.out'
                        }, '-=0.5')
                        .to('.btn-letsgo', {
                            opacity: 1,
                            scale: 1,
                            duration: 1,
                            ease: 'back.out(1.7)',
                            y: 0
                        }, '-=0.5');

                    // Hover animation for button
                    const button = document.querySelector('.btn-letsgo');

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

                    // Card Animations on Scroll
                    gsap.utils.toArray('.card').forEach((card, i) => {
                        gsap.from(card, {
                            scrollTrigger: {
                                trigger: card,
                                start: 'top 80%',
                                toggleActions: 'play none none reverse'
                            },
                            y: 100,
                            opacity: 0,
                            duration: 0.8,
                            delay: i * 0.2
                        });
                    });

                    // Numbered Circles Animation
                    gsap.utils.toArray('.square--60').forEach((circle, i) => {
                        gsap.from(circle, {
                            scrollTrigger: {
                                trigger: circle,
                                start: 'top 80%',
                                toggleActions: 'play none none reverse'
                            },
                            scale: 0,
                            rotation: 180,
                            opacity: 0,
                            duration: 0.8,
                            delay: i * 0.2,
                            ease: 'back.out(1.7)'
                        });
                    });

                    // Mockup Image Animation
                    const mockup = document.querySelector('img[alt="Tugas Akhir"]');
                    if (mockup) {
                        gsap.from(mockup, {
                            scrollTrigger: {
                                trigger: mockup,
                                start: 'top 80%',
                                toggleActions: 'play none none reverse'
                            },
                            x: -100,
                            opacity: 0,
                            duration: 1,
                            ease: 'power3.out'
                        });
                    }

                    // Background Shapes Animation
                    gsap.utils.toArray('img[src*="shape-"]').forEach(shape => {
                        gsap.to(shape, {
                            y: 'random(-20, 20)',
                            rotation: 'random(-10, 10)',
                            duration: 'random(2, 4)',
                            repeat: -1,
                            yoyo: true,
                            ease: 'sine.inOut'
                        });
                    });

                    // 3D Card Hover Effect
                    const cards = document.querySelectorAll('.card');
                    cards.forEach(card => {
                        card.addEventListener('mousemove', (e) => {
                            const rect = card.getBoundingClientRect();
                            const x = e.clientX - rect.left;
                            const y = e.clientY - rect.top;

                            const centerX = rect.width / 2;
                            const centerY = rect.height / 2;

                            const rotateX = ((y - centerY) / centerY) * 10;
                            const rotateY = ((x - centerX) / centerX) * 10;

                            gsap.to(card, {
                                rotateX: -rotateX,
                                rotateY: rotateY,
                                duration: 0.5,
                                ease: 'power2.out',
                                transformPerspective: 1000,
                                transformOrigin: 'center'
                            });
                        });

                        card.addEventListener('mouseleave', () => {
                            gsap.to(card, {
                                rotateX: 0,
                                rotateY: 0,
                                duration: 0.5,
                                ease: 'power2.out'
                            });
                        });
                    });

                    // Text reveal and magnetic effect
                    const textAnimation = () => {
                        const heroTl = gsap.timeline({
                            defaults: {
                                ease: "power4.out",
                            }
                        });

                        // Animate title lines
                        heroTl.to('.line', {
                                duration: 1.2,
                                y: 0,
                                opacity: 1,
                                stagger: 0.1,
                                ease: "power4.out"
                            })
                            // Animate description words
                            .to('.hero-description .word', {
                                duration: 0.8,
                                opacity: 1,
                                y: 0,
                                stagger: 0.05,
                                ease: "back.out(1.7)"
                            }, "-=0.5");

                        // Magnetic effect for entire text block
                        const magneticText = document.querySelector('.magnetic-text');
                        const allLines = document.querySelectorAll('.line');
                        const allWords = document.querySelectorAll('.magnetic-word');

                        magneticText.addEventListener('mousemove', (e) => {
                            const bounds = magneticText.getBoundingClientRect();
                            const mouseX = e.clientX - bounds.left;
                            const mouseY = e.clientY - bounds.top;
                            const centerX = bounds.width / 2;
                            const centerY = bounds.height / 2;

                            const deltaX = (mouseX - centerX) / centerX;
                            const deltaY = (mouseY - centerY) / centerY;

                            // Animate title lines
                            allLines.forEach(line => {
                                gsap.to(line, {
                                    duration: 0.3,
                                    x: deltaX * 30,
                                    y: deltaY * 15,
                                    rotation: deltaX * 5,
                                    ease: "power2.out"
                                });
                            });

                            // Animate description words
                            allWords.forEach((word, index) => {
                                gsap.to(word, {
                                    duration: 0.3,
                                    x: deltaX * 20,
                                    y: deltaY * 10,
                                    rotation: deltaX * 3,
                                    ease: "power2.out",
                                    delay: index * 0.02
                                });
                            });
                        });

                        magneticText.addEventListener('mouseleave', () => {
                            // Reset title lines
                            allLines.forEach(line => {
                                gsap.to(line, {
                                    duration: 0.6,
                                    x: 0,
                                    y: 0,
                                    rotation: 0,
                                    ease: "elastic.out(1, 0.3)"
                                });
                            });

                            // Reset description words
                            allWords.forEach(word => {
                                gsap.to(word, {
                                    duration: 0.6,
                                    x: 0,
                                    y: 0,
                                    rotation: 0,
                                    ease: "elastic.out(1, 0.3)"
                                });
                            });
                        });

                        // Smooth hover effect
                        magneticText.addEventListener('mouseenter', () => {
                            gsap.to([allLines, allWords], {
                                duration: 0.3,
                                scale: 1.05,
                                ease: "power2.out"
                            });
                        });

                        magneticText.addEventListener('mouseleave', () => {
                            gsap.to([allLines, allWords], {
                                duration: 0.3,
                                scale: 1,
                                ease: "power2.out"
                            });
                        });
                    }

                    // Initialize text animation
                    textAnimation();

                    // Words animation for description
                    const wordsAnimation = () => {
                        gsap.to('.hero-description .word', {
                            duration: 0.8,
                            opacity: 1,
                            y: 0,
                            stagger: 0.05,
                            ease: "back.out(1.7)"
                        });
                    }

                    // Initialize words animation
                    wordsAnimation();

                    // Add some particles in the background (optional)
                    const particles = gsap.utils.toArray('.particle');
                    particles.forEach(particle => {
                        gsap.to(particle, {
                            duration: "random(2, 4)",
                            y: "random(-100, 100)",
                            x: "random(-100, 100)",
                            rotation: "random(-360, 360)",
                            opacity: 0,
                            repeat: -1,
                            ease: "none"
                        });
                    });

                    // Button animation
                    const buttonAnimation = () => {
                        const button = document.querySelector('.btn-letsgo');

                        gsap.to(button, {
                            opacity: 1,
                            y: 0,
                            duration: 0.8,
                            ease: "back.out(1.7)",
                            delay: 0.5
                        });

                        button.addEventListener('mouseenter', () => {
                            gsap.to(button, {
                                scale: 1.05,
                                duration: 0.3,
                                ease: "power2.out"
                            });
                        });

                        button.addEventListener('mouseleave', () => {
                            gsap.to(button, {
                                scale: 1,
                                duration: 0.3,
                                ease: "power2.out"
                            });
                        });

                        // Pulse animation
                        gsap.to(button, {
                            scale: 1.05,
                            duration: 0.8,
                            repeat: -1,
                            yoyo: true,
                            ease: "power1.inOut"
                        });
                    }

                    // Initialize button animation
                    buttonAnimation();

                    // Scroll Indicator Animation
                    gsap.to('.scroll-indicator', {
                        opacity: 1,
                        duration: 1,
                        delay: 2,
                        ease: 'power2.out'
                    });

                    // Hide scroll indicator on scroll
                    window.addEventListener('scroll', () => {
                        if (window.scrollY > 100) {
                            gsap.to('.scroll-indicator', {
                                opacity: 0,
                                duration: 0.3
                            });
                        }
                    });

                    // Mockup Animation
                    const mockupContainer = document.querySelector('.mockup-container');
                    const mockupPhone = document.querySelector('.mockup-phone');
                    const mockupPhoneHover = document.querySelector('.mockup-phone-hover');
                    const mockupBg = document.querySelector('.mockup-bg');

                    // Initial floating animation
                    gsap.to(mockupContainer, {
                        y: "20px",
                        duration: 2,
                        repeat: -1,
                        yoyo: true,
                        ease: "power1.inOut"
                    });

                    // Mouse move effect
                    mockupContainer.addEventListener('mousemove', (e) => {
                        const rect = mockupContainer.getBoundingClientRect();
                        const mouseX = e.clientX - rect.left;
                        const mouseY = e.clientY - rect.top;

                        // Update CSS variables for glow effect
                        mockupContainer.style.setProperty('--mouse-x', `${(mouseX / rect.width) * 100}%`);
                        mockupContainer.style.setProperty('--mouse-y', `${(mouseY / rect.height) * 100}%`);

                        // 3D rotation effect
                        const rotateY = gsap.utils.mapRange(0, rect.width, -10, 10, mouseX);
                        const rotateX = gsap.utils.mapRange(0, rect.height, 10, -10, mouseY);

                        gsap.to(mockupPhone, {
                            rotateY: rotateY,
                            rotateX: rotateX,
                            duration: 0.3,
                            ease: "power2.out"
                        });
                    });

                    // Hover effect
                    mockupContainer.addEventListener('mouseenter', () => {
                        gsap.to(mockupBg, {
                            scale: 1.05,
                            duration: 0.3
                        });

                        gsap.to(mockupPhone, {
                            scale: 1.05,
                            duration: 0.3
                        });

                        // Fade in hover image
                        gsap.to(mockupPhoneHover, {
                            opacity: 1,
                            duration: 0.3
                        });
                    });

                    // Reset on mouse leave
                    mockupContainer.addEventListener('mouseleave', () => {
                        gsap.to([mockupPhone, mockupBg], {
                            scale: 1,
                            rotateX: 0,
                            rotateY: 0,
                            duration: 0.5,
                            ease: "power2.out"
                        });

                        gsap.to(mockupPhoneHover, {
                            opacity: 0,
                            duration: 0.3
                        });
                    });

                    // Click effect
                    mockupContainer.addEventListener('click', () => {
                        gsap.to(mockupPhone, {
                            scale: 0.95,
                            duration: 0.1,
                            yoyo: true,
                            repeat: 1,
                            ease: "power2.inOut"
                        });

                        // Flash effect
                        const flash = document.createElement('div');
                        flash.style.cssText = `
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            bottom: 0;
                            background: white;
                            opacity: 0;
                            z-index: 4;
                        `;
                        mockupContainer.appendChild(flash);

                        gsap.to(flash, {
                            opacity: 0.3,
                            duration: 0.1,
                            yoyo: true,
                            repeat: 1,
                            onComplete: () => flash.remove()
                        });
                    });
                });
            </script>
    </body>

</html>

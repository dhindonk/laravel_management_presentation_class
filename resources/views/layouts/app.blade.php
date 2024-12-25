<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manajemen Presentasi</title>

        <!-- Core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/plugins/dataTables.bootstrap5.min.css') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/inter/inter.css') }}" id="main-font-link" />
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/tabler-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/fontawesome.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/material.css') }}">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('backend/assets/css/style-preset.css') }}">
        <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon">

        <!-- GSAP -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

        <!-- Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-14K1GBX9FG"></script>

        <style>
            /* Custom Cursor Base Styles */
            .custom-cursor {
                pointer-events: none;
                position: fixed;
                z-index: 9999;
            }

            .cursor-dot {
                width: 8px;
                height: 8px;
                background-color: var(--cursor-color, #09191F);
                border-radius: 50%;
                position: fixed;
                pointer-events: none;
                transition: transform 0.2s ease;
                transform: translate(-50%, -50%);
                mix-blend-mode: difference;
            }

            .cursor-outline {
                width: 40px;
                height: 40px;
                border: 2px solid var(--cursor-color, #09191F);
                border-radius: 50%;
                position: fixed;
                pointer-events: none;
                transition: transform 0.3s ease;
                transform: translate(-50%, -50%);
                mix-blend-mode: difference;
            }

            /* Adaptive cursor behavior */
            [data-theme="light"] .cursor-dot,
            .bg-white ~ .custom-cursor .cursor-dot {
                background-color: #000000;
                mix-blend-mode: difference;
            }

            [data-theme="light"] .cursor-outline,
            .bg-white ~ .custom-cursor .cursor-outline {
                border-color: #000000;
                mix-blend-mode: difference;
            }

            [data-theme="dark"] .cursor-dot,
            .bg-dark ~ .custom-cursor .cursor-dot {
                background-color: #ffffff;
                mix-blend-mode: difference;
            }

            [data-theme="dark"] .cursor-outline,
            .bg-dark ~ .custom-cursor .cursor-outline {
                border-color: #ffffff;
                mix-blend-mode: difference;
            }

            /* Hover effects */
            a:hover ~ .custom-cursor .cursor-dot,
            button:hover ~ .custom-cursor .cursor-dot {
                transform: translate(-50%, -50%) scale(1.5);
                background-color: #ffffff;
            }

            a:hover ~ .custom-cursor .cursor-outline,
            button:hover ~ .custom-cursor .cursor-outline {
                transform: translate(-50%, -50%) scale(0.8);
                border-color: #ffffff;
            }

            .magnetic-text:hover ~ .custom-cursor .cursor-outline {
                transform: scale(1.5);
                border-style: dashed;
                animation: rotate 3s linear infinite;
                border-color: #ffffff;
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

        @yield('style')
    </head>

    <body style="background-color: var(--bs-primary);">
        <!-- Preloader -->
        <div id="preloader">
            <div class="preloader">
                <span></span>
                <span></span>
            </div>
        </div>

        <!-- Custom Cursor -->
        <div class="custom-cursor">
            <div class="cursor-dot"></div>
            <div class="cursor-outline"></div>
        </div>

        <!-- Page Transition -->
        <div class="page-transition"></div>

        <main>
            @yield('content')
        </main>

        <!-- Core Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // GSAP Registration
                gsap.registerPlugin(ScrollTrigger);

                // Preloader Animation dengan Promise
                const preloaderAnimation = () => {
                    return new Promise((resolve) => {
                        const preloader = document.getElementById('preloader');
                        const mainContent = document.querySelector('main');

                        // Set main content opacity 0 di awal
                        gsap.set(mainContent, {
                            opacity: 0
                        });

                        // Animate preloader
                        gsap.to(preloader, {
                            opacity: 0,
                            duration: 0.5,
                            onComplete: () => {
                                preloader.style.display = 'none';

                                // Fade in main content setelah preloader hilang
                                gsap.to(mainContent, {
                                    opacity: 1,
                                    duration: 0.5,
                                    onComplete: resolve
                                });
                            }
                        });
                    });
                };

                // Initialize all animations
                const initAnimations = async () => {
                    await preloaderAnimation();

                    // Setelah preloader selesai, jalankan animasi lainnya
                    if (window.initPageAnimations) {
                        window.initPageAnimations();
                    }
                };

                initAnimations();

                // Custom Cursor
                const cursor = {
                    dot: document.querySelector('.cursor-dot'),
                    outline: document.querySelector('.cursor-outline'),
                    init: function() {
                        this.pos = {
                            x: 0,
                            y: 0
                        };
                        this.mouse = {
                            x: 0,
                            y: 0
                        };
                        this.speed = 0.5;
                        this.outlineSpeed = 0.1;
                        this.outlinePos = {
                            x: 0,
                            y: 0
                        };

                        this.addListeners();
                        this.animate();
                        this.adaptiveCursor();
                    },
                    addListeners: function() {
                        document.addEventListener('mousemove', (e) => {
                            this.mouse.x = e.clientX;
                            this.mouse.y = e.clientY;
                        });

                        // Hover effects for interactive elements
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
                        // Smooth easing for dot
                        this.pos.x += (this.mouse.x - this.pos.x) * this.speed;
                        this.pos.y += (this.mouse.y - this.pos.y) * this.speed;

                        // Slower easing for outline
                        this.outlinePos.x += (this.mouse.x - this.outlinePos.x) * this.outlineSpeed;
                        this.outlinePos.y += (this.mouse.y - this.outlinePos.y) * this.outlineSpeed;

                        // Apply positions
                        this.dot.style.left = this.pos.x + 'px';
                        this.dot.style.top = this.pos.y + 'px';
                        this.outline.style.left = this.outlinePos.x + 'px';
                        this.outline.style.top = this.outlinePos.y + 'px';

                        requestAnimationFrame(() => this.animate());
                    },
                    adaptiveCursor: function() {
                        document.addEventListener('mousemove', (e) => {
                            const element = document.elementFromPoint(e.clientX, e.clientY);
                            if (element) {
                                const bgColor = window.getComputedStyle(element).backgroundColor;
                                const rgb = bgColor.match(/\d+/g);
                                
                                if (rgb) {
                                    const brightness = (0.299 * rgb[0] + 0.587 * rgb[1] + 0.114 * rgb[2]) / 255;
                                    if (brightness > 0.5) {
                                        this.dot.style.backgroundColor = '#000000';
                                        this.outline.style.borderColor = '#000000';
                                    } else {
                                        this.dot.style.backgroundColor = '#ffffff';
                                        this.outline.style.borderColor = '#ffffff';
                                    }
                                }
                            }
                        });
                    }
                };

                // Initialize custom cursor
                cursor.init();

                // Page Transition
                const pageTransition = document.querySelector('.page-transition');
                document.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', (e) => {
                        if (!link.hasAttribute('target') && !link.hasAttribute('data-no-transition')) {
                            e.preventDefault();
                            const href = link.href;

                            gsap.to(pageTransition, {
                                scaleY: 1,
                                duration: 0.5,
                                ease: 'power2.inOut',
                                onComplete: () => {
                                    window.location = href;
                                }
                            });
                        }
                    });
                });
            });

            // SweetAlert Notifications
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'animated fadeInDown'
                    }
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'animated fadeInDown'
                    }
                });
            @endif

            // Bootstrap Tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        </script>
    </body>

</html>

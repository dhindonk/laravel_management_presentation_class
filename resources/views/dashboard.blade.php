<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Presentation</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('logo.png') }}">

        <!-- Custom CSS -->
        <link href="{{ asset('frontend/assets/css/styles.css') }}" rel="stylesheet">
        <style>
            .btn-letsgo {
                transition: .3s;
            }

            .btn-letsgo:hover {
                transform: rotate(-3deg) scale(1.1);
            }
        </style>
    </head>

    <body>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div id="preloader">
            <div class="preloader"><span></span><span></span></div>
        </div>

        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">

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
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-9 col-lg-11 col-md-12 col-sm-12 wow animated fadeInUp">
                            <div class="elcoss-excort text-center"
                                style="user-select: none !important; cursor: crosshair;">
                                <h1 class="mb-4">Pengajuan Presentasi <br><span>Mobile Programming</span></h1>
                                <p class="fs-5 fw-light fs-mob">Ajukan presentasi proyek Mobile Programming Anda
                                    sekarang dan tunjukkan hasil kerja keras Anda. Kami menghadirkan platform yang
                                    memudahkan untuk pengajuan, penjadwalan, dan evaluasi proyek Anda.</p>
                            </div>
                        </div>

                        <div class=" col-xl-10 col-lg-11 col-md-12 col-sm-12">
                            <div
                                class="d-flex align-items-center justify-content-center sng-dash mt-5 wow animated fadeInUp">
                                <a href="{{ route('mahasiswa.index') }}" class="btn btn-letsgo"
                                    style="background: white">Let's Go !!</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="position-absolute bottom-0 start-0 z-0">
                    <img src="{{ asset('frontend/assets/img/shape-2-soft-light.svg') }}" alt="SVG" width="400">
                </div>
            </div>
            <!-- ============================ Hero Banner End ================================== -->

            <!-- ============================ Our Features Start ================================== -->
            <section class="pt-5">
                <div class="container">

                    <div class="row align-items-center justify-content-center">

                        <div class="text-center text-md-start pt-3 mt-3 wow animated fadeInLeft">
                            <h2 class="mb-1">Aturan Tugas Akhir</h2>
                            <p class="fs-6 text-muted mb-2">Panduan lengkap untuk presentasi Tugas Akhir Mobile
                                Programming</p>
                        </div>

                        <div class="col-md-5">
                            <div class="position-relative wow animated fadeInLeft">
                                <img class="d-block position-relative z-2 img-fluid " src="{{ asset('mockup.png') }}"
                                    alt="Tugas Akhir">
                                <div class=" position-absolute z-1 start-0 bottom-0 w-100"
                                    style="background: whitesmoke; height:95%; border-radius: 100rem 100rem 10rem 10rem;">
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
                                            <p class="card-text">Presentasi dilakukan secara offline selama 15 menit,
                                                dengan 10 menit presentasi dan 5 menit tanya jawab.</p>
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
                                            <p class="card-text">Presentasi bersifat tertutup dan hanya dihadiri oleh
                                                tim serta dosen pembimbing.</p>
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
                                            <p class="card-text">Keterlambatan maksimal adalah 5 menit dari jadwal yang
                                                telah ditentukan. Melebihi waktu ini akan berakibat pengurangan nilai.
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
                                            <p class="card-text">Setiap tim terdiri dari maksimal 4 orang, dengan syarat
                                                berasal dari 1 kelas gabungan praktikum.</p>
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
                                            <p class="card-text">Aplikasi harus memiliki setidaknya 3 halaman,
                                                menggunakan 3 library, menerapkan 6 komponen/widgets, serta memanfaatkan
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
            <footer class="footer skin-light-footer">
                <div class="footer-bottom">
                    <div class="container">
                        <div class="d-flex align-items-center justify-content-end">
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

    </body>

</html>

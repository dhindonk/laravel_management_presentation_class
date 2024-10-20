{{-- <!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manajemen Presentasi</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
        <!-- data tables css -->
        <link rel="stylesheet" href="{{ asset('backend/assets/css/plugins/dataTables.bootstrap5.min.css') }}">
        <!-- [Page specific CSS] end -->
        <!-- [Font] Family -->
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/inter/inter.css') }}" id="main-font-link" />
        <!-- [Tabler Icons] https://tablericons.com -->
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/tabler-icons.min.css') }}">
        <!-- [Feather Icons] https://feathericons.com -->
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather.css') }}">
        <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/fontawesome.css') }}">
        <!-- [Material Icons] https://fonts.google.com/icons -->
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/material.css') }}">
        <!-- [Template CSS Files] -->
        <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}" id="main-style-link">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/style-preset.css') }}">
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-14K1GBX9FG"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"> <!-- [Font] Family -->
       
    </head>

    <body>
        <main>
            @yield('content')
        </main>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false,
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false,
                });
            </script>
        @endif

        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
    </body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manajemen Presentasi</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
        <!-- data tables css -->
        <link rel="stylesheet" href="{{ asset('backend/assets/css/plugins/dataTables.bootstrap5.min.css') }}">
        <!-- [Font] Family -->
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/inter/inter.css') }}" id="main-font-link" />
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/tabler-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/fontawesome.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/fonts/material.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/style-preset.css') }}">
        <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon">
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-14K1GBX9FG"></script>
        @yield('style')
    </head>

    <body>
        <main>
            @yield('content')
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false,
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false,
                });
            </script>
        @endif

        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        </script>
    </body>

</html>

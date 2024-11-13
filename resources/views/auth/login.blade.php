@extends('layouts.app')

@section('content')

    <body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme_contrast=""
        data-pc-theme="light">
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <!-- [ Pre-loader ] End -->

        <div class="auth-main">
            <div class="auth-wrapper v1">
                <div class="auth-form">
                    <div class="card my-5">
                        <div class="card-body">
                            <h4 class="text-center f-w-500 mb-3">Login with your email</h4>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="email" name="email" class="form-control" id="floatingInput"
                                        placeholder="Email Address">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" name="password" class="form-control" id="floatingInput1"
                                        placeholder="Password">
                                </div>
                                <div class="d-flex mt-1 justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input input-primary" type="checkbox" id="customCheckc1"
                                            checked="">
                                        <label class="form-check-label text-muted" for="customCheckc1">Inget ga?</label>
                                    </div>
                                    {{-- <h6 class="text-secondary f-w-400 mb-0">Forgot Password?</h6> --}}
                                </div>
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn login-btn">Login</button>
                                </div>
                                @if ($errors->any())
                                    <div>
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-14K1GBX9FG');
    </script>
    <!-- WiserNotify -->
    <script>
        !(function() {
            if (window.t4hto4) console.log('WiserNotify pixel installed multiple time in this page');
            else {
                window.t4hto4 = !0;
                var t = document,
                    e = window,
                    n = function() {
                        var e = t.createElement('script');
                        (e.type = 'text/javascript'),
                        (e.async = !0),
                        (e.src = 'https://pt.wisernotify.com/pixel.js?ti=1jclj6jkfc4hhry'),
                        document.body.appendChild(e);
                    };
                'complete' === t.readyState ? n() : window.attachEvent ? e.attachEvent('onload', n) : e
                    .addEventListener('load', n, !1);
            }
        })();
    </script>
    <!-- Microsoft clarity -->
    <script type="text/javascript">
        (function(c, l, a, r, i, t, y) {
            c[a] =
                c[a] ||
                function() {
                    (c[a].q = c[a].q || []).push(arguments);
                };
            t = l.createElement(r);
            t.async = 1;
            t.src = 'https://www.clarity.ms/tag/' + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, 'clarity', 'script', 'gkn6wuhrtb');
    </script>

@endsection

<style>
    .login-btn {
        background-color: var(--bs-primary) !important;
        color: white !important;
        border: 2px solid var(--bs-primary) !important;
        transition: .3s;
    }

    .login-btn:hover {
        background-color: white !important;
        color: var(--bs-primary) !important;
        border: 2px solid var(--bs-primary) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(var(--bs-primary-rgb), 0.2);
    }

    .login-btn:active {
        transform: translateY(0);
    }
</style>

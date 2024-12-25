@extends('layouts.app')

@section('content')
<div class="auth-main">
    <div class="auth-wrapper v1">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h4 class="mb-2" style="color: #09191F;">Register Akun Mahasiswa</h4>
                        <p class="text-muted">Silahkan lengkapi data diri Anda</p>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="input-wrapper">
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" class="form-control custom-input" placeholder="Nama Lengkap" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-wrapper">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" class="form-control custom-input" placeholder="Email Address" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-wrapper">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" class="form-control custom-input" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="input-wrapper">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password_confirmation" class="form-control custom-input" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="register-btn">
                                <span>Register</span>
                                <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                        <div class="text-center mt-4">
                            <span class="text-muted">Sudah punya akun? </span>
                            <a href="{{ route('login') }}" class="login-link">Login</a>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Input styling */
.input-wrapper {
    position: relative;
}

.input-wrapper i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #09191F;
    opacity: 0.5;
    transition: all 0.3s ease;
}

.custom-input {
    padding: 12px 15px 12px 45px;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    transition: all 0.3s ease;
    font-size: 0.95rem;
    width: 100%;
    color: #09191F;
}

.custom-input:hover {
    border-color: #09191F;
}

.custom-input:focus {
    outline: none;
    border-color: #09191F;
    box-shadow: 0 0 0 3px rgba(9, 25, 31, 0.1);
}

.custom-input:focus + i {
    opacity: 1;
}

/* Button styling */
.register-btn {
    padding: 12px 24px;
    background: linear-gradient(45deg, #09191F, #1e3a44);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.register-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(9, 25, 31, 0.2);
}

.register-btn:active {
    transform: translateY(0);
}

/* Link styling */
.login-link {
    color: #09191F;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.login-link:hover {
    color: #1e3a44;
    text-decoration: underline;
}

/* Card styling */
.card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(9, 25, 31, 0.1);
}

/* Cursor styling */
* {
    cursor: default;
}

input, 
button, 
a, 
select, 
textarea {
    cursor: pointer !important;
}

input[type="text"],
input[type="email"],
input[type="password"],
textarea {
    cursor: text !important;
}

/* Custom cursor for dark theme */
[data-theme="dark"] * {
    cursor:
</style>
@endsection 
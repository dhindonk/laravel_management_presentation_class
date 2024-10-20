// resources/views/errors/403.blade.php
@extends('layouts.app')

@section('content')
<h2>Akses Ditolak</h2>
<p>Anda tidak memiliki akses ke halaman ini.</p>
<a href="{{ route('dashboard') }}">Kembali ke Dashboard</a>
@endsection

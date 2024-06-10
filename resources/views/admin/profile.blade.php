@extends('admin.main')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h1">Profile</h1>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Informasi Pengguna</h5>
        <p class="card-text"><strong>Nama:</strong> {{ $user->name }}</p>
        <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
        <p class="card-text"><strong>Password:</strong> **********</p> <!-- Tidak menampilkan password secara langsung -->
        <a href="{{ route('admin.change.password') }}" class="btn btn-primary">Ganti Password</a>
    </div>
</div>

@endsection

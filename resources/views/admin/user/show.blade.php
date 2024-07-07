@extends('admin.main')
@section('content')
<div class="container">
    <div class="card">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom mt-5">
            <h2 class="text-center">Detail User</h2>
        </div>

        <div class="card-body">
            <p class="card-text">Nama: {{ $user->name }}</p>
            <p class="card-text">Email: {{ $user->email }}</p>
            <p class="card-text">Role: {{ $user->role }}</p>
            <p class="card-text">Dibuat pada: {{ $user->created_at->format('d M Y H:i:s') }}</p>

            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection

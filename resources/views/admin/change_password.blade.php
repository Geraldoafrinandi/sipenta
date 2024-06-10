<!-- resources/views/admin/change_password.blade.php -->

@extends('admin.main')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h1">Ganti Password</h1>
</div>

<div class="card">
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.change.password') }}">
            @csrf

            <div class="mb-3">
                <label for="current_password" class="form-label">Password Saat Ini</label>
                <input id="current_password" type="password" class="form-control" name="current_password" required>
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label">Password Baru</label>
                <input id="new_password" type="password" class="form-control" name="new_password" required>
            </div>

            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>

@endsection

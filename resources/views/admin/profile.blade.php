@extends('admin.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h1">Profile</h1>
    </div>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                {{-- <div class="col-md-3 text-center">
                <img src="{{ asset('path-to-your-avatar.jpg') }}" class="rounded-circle img-fluid" style="max-width: 150px;" alt="Avatar">
            </div> --}}
                <div class="col-md-9 mb-3">
                    <h5 class="card-title">Informasi Pengguna</h5>
                    <p class="card-text"><strong>Nama:</strong> {{ $user->name }}</p>
                    <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="card-text"><strong>Password:</strong> **********</p>
                    <!-- Tidak menampilkan password secara langsung -->
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                        data-target="#changePasswordModal">Ganti Password</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ganti Password -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
        aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Ganti Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-3">
                    <!-- Form ganti password bisa dimasukkan di sini -->
                    <form action="{{ route('admin.change.password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="mb-2" for="current_password">Password Saat Ini</label>
                            <input type="password" class="form-control" id="current_password" name="current_password"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2" for="new_password">Password Baru</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2" for="new_password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="new_password_confirmation"
                                name="new_password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

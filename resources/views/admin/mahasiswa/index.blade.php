@extends('admin.main')
@section('title', 'Data Mahasiswa')
@section('navMhs', 'active')

@section('content')

    @if (session()->has('succes'))
        <div class="alert alert-primary" role="alert">
            {{ session('succes') }}
        </div>
    @endif

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Mahasiswa TI</h1>
    </div>


    <h1 class="text-center mb-3">Daftar Mahasiswa TI</h1>

    <div class="mb-2 d-flex justify-content-between">
        <a href="/admin-mahasiswa/create" class="btn btn-primary mb-2">Create Mahasiswa</a>
        <div>
            <a class="btn btn-success" href="{{ url('/admin-mahasiswa/export/excel') }}">Export</a>
            <!-- Tidak menggunakan parameter perPage -->
            {{-- <a class="btn btn-primary" href="{{ url('/admin-mahasiswa/import') }}">Import</a> <!-- Tidak menggunakan parameter perPage --> --}}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importModal">Import</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mahasiswa.import.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Pilih File Excel</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @include('admin.mahasiswa.table', ['mahasiswas' => $mahasiswas])

    <div class="d-flex justify-content-between align-items-center mt-3">
        <form method="GET" action="{{ url()->current() }}">
            <label for="perPage">Show</label>
            <select id="perPage" name="perPage" onchange="this.form.submit()">
                <option value="10"{{ request('perPage') == 10 ? ' selected' : '' }}>10</option>
                <option value="25"{{ request('perPage') == 25 ? ' selected' : '' }}>25</option>
                <option value="50"{{ request('perPage') == 50 ? ' selected' : '' }}>50</option>
                <option value="100"{{ request('perPage') == 100 ? ' selected' : '' }}>100</option>
            </select>
            <span>entries</span>
        </form>
        <div class="pagination">
            {{ $mahasiswas->appends(['perPage' => request('perPage')])->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

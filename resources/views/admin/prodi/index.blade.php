@extends('admin.main')
@section('title', 'Dataprodi')
@section('navMhs', 'active')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Prodi </h1>
    </div>

    <h1 class="text-center mb-3">Daftar Prodi</h1>

    @if (session()->has('succes'))
        <div class="alert alert-primary" role="alert">
            {{ session('succes') }}
        </div>
    @endif

    <a href="/admin-prodi/create" class="btn btn-primary mb-3">Create Prodi</a>
    <table class="table table-ordered table-striped">
        <tr>
            <th>Nama Prodi</th>
            <th>Aksi</th>
        </tr>
        <tbody>
            @foreach ($prodis as $prodi)
                <tr>
                    <td>{{ $prodi->nama_prodi }}</td>
                    <td>
                        <!-- Form untuk menghapus data -->
                        <form action="{{ route('prodi.destroy', $prodi->id_prodi) }}" method="POST"
                            class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin akan menghapus data?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $prodis->links() }}
@endsection

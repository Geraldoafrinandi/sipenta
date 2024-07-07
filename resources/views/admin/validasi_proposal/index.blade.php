<!-- resources/views/admin/validasi_proposal/index.blade.php -->

@extends('admin.main')

@section('content')
<div class="container">
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Validasi Proposal</h1>
        </div>

        <h1 class="text-center">Validasi Proposal</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- <a href="{{ route('validasi_proposal.create') }}" class="btn btn-primary mb-3">Tambah Validasi Proposal</a> --}}

    <table class="table table-bordered">
        <thead>
            <tr>

                <th>Mahasiswa</th>
                <th>Judul</th>
                <th>Status Validasi</th>
                <th>Tanggal Validasi</th>
                <th>Catatan</th>
                <th>Download Proposal</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($validasiProposals as $validasiProposal)
                <tr>
                    <td>{{ $validasiProposal->tugasAkhir->nama_mahasiswa }} - {{$validasiProposal->tugasAkhir->nim}}</td>
                    <td>{{ $validasiProposal->tugasAkhir->judul }}</td>
                    <td>{{ $validasiProposal->status_validasi }}</td>
                    <td>{{ $validasiProposal->tanggal_validasi }}</td>
                    <td>{{ $validasiProposal->catatan }}</td>
                    <td>
                        <a href="{{ route('validasi_proposal.download', $validasiProposal->id_validasiProposal) }}" class="btn btn-success">Download Proposal</a>
                    </td>
                    <td>
                        {{-- <a href="{{ route('validasi_proposal.show', $validasiProposal->id_validasiProposal) }}"
                            class="btn btn-info">Lihat</a> --}}
                        <a href="{{ route('validasi_proposal.edit', $validasiProposal->id_validasiProposal) }}"
                            class="btn btn-warning">Edit</a>
                        <form action="{{ route('validasi_proposal.destroy', $validasiProposal->id_validasiProposal) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

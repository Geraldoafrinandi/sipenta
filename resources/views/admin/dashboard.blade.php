<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <h1 class="mt-3 text-center">Dashboard</h1>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>

                        <th>Nomor Ruangan</th>
                        <th>Jam Sidang</th>
                        <th>Tanggal Sidang</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ruangans as $ruangan)
                        <tr>
                            <td>{{ $ruangan->no_ruangan }}</td>
                            <td>{{ $ruangan->jam_sidang }}</td>
                            <td>{{ \Carbon\Carbon::parse($ruangan->tanggal_sidang)->format('d-m-Y') }}</td>
                            <td>
                                @if ($ruangan->keterangan == 'Tersedia')
                                    <span class="badge bg-success">{{ $ruangan->keterangan }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $ruangan->keterangan }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Tidak ada data ruangan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

<style>
    /* public/css/styles.css */

.my-4 {
    margin-top: 1.5rem;
    margin-bottom: 1.5rem;
}

.card {
    margin-bottom: 1.5rem;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
}

.badge {
    font-size: 0.875rem;
    padding: 0.3rem 0.5rem;
    border-radius: 0.25rem;
}

.bg-success {
    background-color: #28a745;
    color: #fff;
}

.bg-danger {
    background-color: #dc3545;
    color: #fff;
}

</style>

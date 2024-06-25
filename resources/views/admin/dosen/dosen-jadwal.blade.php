@extends('admin.main')

@section('content')
    <div class="container">
        <h1>Dosen dengan Jadwal Sidang</h1>

        <table class="table table-ordered table-striped">
            <thead>
                <tr>
                    <th>Nama Dosen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sidangs as $sidang)
                    <tr>
                        <td>{{ $sidang->ketuaSidang->nama }} <br> {{ $sidang->penguji1->nama }} <br> {{ $sidang->penguji2->nama }} <br>{{ $sidang->sekretaris->nama }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

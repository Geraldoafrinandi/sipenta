@extends('admin.main')
@section('title', 'Data Penilaian')
@section('navMhs', 'active')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Penilaian Tugas Akhir</h1>
</div>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="table-responsive">
    <form action="{{ route('admin.penilaian.store') }}" method="post" name="signupForm" class="cmxform" id="signupForm" autocomplete="off">
        @csrf
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Materi Penilaian</th>
                    <th>Bobot(%)</th>
                    <th>Skor</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td colspan="4">BIMBINGAN</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Sikap dan Penampilan</td>
                    <td style="text-align:right;">
                        5
                        <input type="hidden" id="bobot_1" name="bobot[]" value="5">
                    </td>
                    <td>
                        <div class="form">
                            <input id="1" class="required" size="5" type="text" value="" name="nilai[]" oninput="calculateTotal()">
                        </div>
                    </td>
                    <td><input id="nm_1" type="text" class="total" name="total[]" size="3" readonly="readonly" style="text-align:center; background-color:#D0F5A9; font-weight:bold;"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Komunikasi dan Sistematika</td>
                    <td style="text-align:right;">
                        5
                        <input type="hidden" id="bobot_2" name="bobot[]" value="5">
                    </td>
                    <td>
                        <div class="form">
                            <input id="2" class="required" size="5" type="text" value="" name="nilai[]" oninput="calculateTotal()">
                        </div>
                    </td>
                    <td><input id="nm_2" type="text" class="total" name="total[]" size="3" readonly="readonly" style="text-align:center; background-color:#D0F5A9; font-weight:bold;"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Penguasaan Materi</td>
                    <td style="text-align:right;">
                        20
                        <input type="hidden" id="bobot_3" name="bobot[]" value="20">
                    </td>
                    <td>
                        <div class="form">
                            <input id="3" class="required" size="5" type="text" value="" name="nilai[]" oninput="calculateTotal()">
                        </div>
                    </td>
                    <td><input id="nm_3" type="text" class="total" name="total[]" size="3" readonly="readonly" style="text-align:center; background-color:#D0F5A9; font-weight:bold;"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td colspan="4">MAKALAH</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Identifikasi Masalah, tujuan dan kontribusi penelitian</td>
                    <td style="text-align:right;">
                        5
                        <input type="hidden" id="bobot_4" name="bobot[]" value="5">
                    </td>
                    <td>
                        <div class="form">
                            <input id="4" class="required" size="5" type="text" value="" name="nilai[]" oninput="calculateTotal()">
                        </div>
                    </td>
                    <td><input id="nm_4" type="text" class="total" name="total[]" size="3" readonly="readonly" style="text-align:center; background-color:#D0F5A9; font-weight:bold;"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Relevansi teori/referensi pustaka dan konsep dengan masalah penelitian</td>
                    <td style="text-align:right;">
                        5
                        <input type="hidden" id="bobot_5" name="bobot[]" value="5">
                    </td>
                    <td>
                        <div class="form">
                            <input id="5" class="required" size="5" type="text" value="" name="nilai[]" oninput="calculateTotal()">
                        </div>
                    </td>
                    <td><input id="nm_5" type="text" class="total" name="total[]" size="3" readonly="readonly" style="text-align:center; background-color:#D0F5A9; font-weight:bold;"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Metoda/Algoritma yang digunakan</td>
                    <td style="text-align:right;">
                        10
                        <input type="hidden" id="bobot_6" name="bobot[]" value="10">
                    </td>
                    <td>
                        <div class="form">
                            <input id="6" class="required" size="5" type="text" value="" name="nilai[]" oninput="calculateTotal()">
                        </div>
                    </td>
                    <td><input id="nm_6" type="text" class="total" name="total[]" size="3" readonly="readonly" style="text-align:center; background-color:#D0F5A9; font-weight:bold;"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Hasil dan Pembahasan</td>
                    <td style="text-align:right;">
                        15
                        <input type="hidden" id="bobot_7" name="bobot[]" value="15">
                    </td>
                    <td>
                        <div class="form">
                            <input id="7" class="required" size="5" type="text" value="" name="nilai[]" oninput="calculateTotal()">
                        </div>
                    </td>
                    <td><input id="nm_7" type="text" class="total" name="total[]" size="3" readonly="readonly" style="text-align:center; background-color:#D0F5A9; font-weight:bold;"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Kesimpulan dan Saran</td>
                    <td style="text-align:right;">
                        5
                        <input type="hidden" id="bobot_8" name="bobot[]" value="5">
                    </td>
                    <td>
                        <div class="form">
                            <input id="8" class="required" size="5" type="text" value="" name="nilai[]" oninput="calculateTotal()">
                        </div>
                    </td>
                    <td><input id="nm_8" type="text" class="total" name="total[]" size="3" readonly="readonly" style="text-align:center; background-color:#D0F5A9; font-weight:bold;"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Penggunaan Bahasa dan Tata tulis</td>
                    <td style="text-align:right;">
                        5
                        <input type="hidden" id="bobot_9" name="bobot[]" value="5">
                    </td>
                    <td>
                        <div class="form">
                            <input id="9" class="required" size="5" type="text" value="" name="nilai[]" oninput="calculateTotal()">
                        </div>
                    </td>
                    <td><input id="nm_9" type="text" class="total" name="total[]" size="3" readonly="readonly" style="text-align:center; background-color:#D0F5A9; font-weight:bold;"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td colspan="4">PRODUK</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Kesesuaian fungsionalitas sistem</td>
                    <td style="text-align:right;">
                        25
                        <input type="hidden" id="bobot_10" name="bobot[]" value="25">
                    </td>
                    <td>
                        <div class="form">
                            <input id="10" class="required" size="5" type="text" value="" name="nilai[]" oninput="calculateTotal()">
                        </div>
                    </td>
                    <td><input id="nm_10" type="text" class="total" name="total[]" size="3" readonly="readonly" style="text-align:center; background-color:#D0F5A9; font-weight:bold;"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>UI/UX dan Dokumentasi</td>
                    <td style="text-align:right;">
                        10
                        <input type="hidden" id="bobot_11" name="bobot[]" value="10">
                    </td>
                    <td>
                        <div class="form">
                            <input id="11" class="required" size="5" type="text" value="" name="nilai[]" oninput="calculateTotal()">
                        </div>
                    </td>
                    <td><input id="nm_11" type="text" class="total" name="total[]" size="3" readonly="readonly" style="text-align:center; background-color:#D0F5A9; font-weight:bold;"></td>
                </tr>
                <tr>
                    <td colspan="3" rowspan="3"></td>
                    <td>Total</td>
                    <td>
                        <input type="text" id="totals" name="totals" style="background-color:#D0F5A9;" readonly="readonly">
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>

<script>
    function calculateTotal() {
        const bobot = document.getElementsByName('bobot[]');
        const nilai = document.getElementsByName('nilai[]');
        const total = document.getElementsByName('total[]');
        let grandTotal = 0;

        for (let i = 0; i < nilai.length; i++) {
            const score = parseFloat(nilai[i].value) || 0;
            const weight = parseFloat(bobot[i].value);
            const weightedScore = score * weight / 100;
            total[i].value = weightedScore.toFixed(2);
            grandTotal += weightedScore;
        }

        document.getElementById('totals').value = grandTotal.toFixed(2);
    }
</script>
@endsection

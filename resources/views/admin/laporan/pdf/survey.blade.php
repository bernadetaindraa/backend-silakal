<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        .header {
            width: 100%;
            margin-bottom: 15px;
        }

        .logo {
            width: 80px;
        }

        .judul {
            text-align: center;
        }

        .judul h2,
        .judul h3,
        .judul p {
            margin: 0;
        }

        hr {
            border: 1px solid #000;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .info {
            margin-bottom: 15px;
        }

        .statistik {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .statistik td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .statistik-ikm {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .statistik-ikm td {
            border: 1px solid #000;
            padding: 12px;
            text-align: center;
        }

        .nilai {
            font-size: 18px;
            font-weight: bold;
            margin-top: 5px;
        }

        .label {
            font-size: 10px;
            font-weight: bold;
        }

        table.laporan {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.laporan th,
        table.laporan td {
            border: 1px solid #000;
            padding: 6px;
        }

        table.laporan th {
            background: #f2f2f2;
            text-align: center;
        }

        .section-title {
            margin-top: 15px;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: bold;
        }

        .ttd {
            width: 250px;
            float: right;
            text-align: center;
            margin-top: 40px;
        }
    </style>

</head>

<body>

    {{-- HEADER --}}
    <table class="header">

        <tr>

            <td width="90">
                <img
                    src="{{ public_path('images/logo-kabupaten.png') }}"
                    class="logo">
            </td>

            <td class="judul">

                <h2>PEMERINTAH KALURAHAN HARGOBINANGUN</h2>

                <h3>
                    LAPORAN SURVEI KEPUASAN MASYARAKAT (IKM)
                </h3>

                <p>
                    Jalan Kaliurang Km 20, Sawungan, Hargobinangun,
                    Pakem, Sleman, Yogyakarta 55582
                </p>

            </td>

        </tr>

    </table>

    <hr>

    {{-- INFO --}}
    <div class="info">

        <strong>Periode Laporan :</strong>

        @if(request('tanggal_awal') && request('tanggal_akhir'))

            {{ \Carbon\Carbon::parse(request('tanggal_awal'))->translatedFormat('d F Y') }}
            s/d
            {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->translatedFormat('d F Y') }}

        @else

            Seluruh Data

        @endif

        <br>

        <strong>Tanggal Cetak :</strong>
        {{ now()->translatedFormat('d F Y H:i') }}

    </div>

    {{-- RESPONDEN --}}
    <table class="statistik">

        <tr>

            <td>
                <strong>Total Responden</strong>
                <br>
                {{ $data->count() }}
            </td>

            <td>
                <strong>Laki-laki</strong>
                <br>
                {{ $lakiLaki }}
            </td>

            <td>
                <strong>Perempuan</strong>
                <br>
                {{ $perempuan }}
            </td>

        </tr>

    </table>

    {{-- PENDIDIKAN --}}
    <table class="statistik">

        <tr>

            @foreach($pendidikan as $nama => $jumlah)

                <td>
                    <strong>{{ $nama }}</strong>
                    <br>
                    {{ $jumlah }}
                </td>

            @endforeach

        </tr>

    </table>

    {{-- IKM --}}
    <table class="statistik-ikm">

        <tr>

            <td width="33%">

                <div class="label">
                    NILAI IKM
                </div>

                <div class="nilai">
                    {{ number_format($nilaiIkm, 2) }}
                </div>

            </td>

            <td width="33%">

                <div class="label">
                    MUTU PELAYANAN
                </div>

                <div class="nilai">
                    {{ $mutu }}
                </div>

            </td>

            <td width="34%">

                <div class="label">
                    KINERJA UNIT PELAYANAN
                </div>

                <div
                    class="nilai"
                    style="font-size:14px;"
                >
                    {{ $kinerja }}
                </div>

            </td>

        </tr>

    </table>

    {{-- UNSUR IKM --}}
    <div class="section-title">
        Nilai Per Unsur Pelayanan
    </div>

    <table class="laporan">

        <thead>

            <tr>

                <th width="8%">
                    No
                </th>

                <th>
                    Unsur Pelayanan
                </th>

                <th width="20%">
                    Nilai Rata-rata
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($hasilUnsur as $index => $unsur)

                <tr>

                    <td align="center">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $unsur['pertanyaan'] }}
                    </td>

                    <td align="center">
                        {{ number_format($unsur['rata_rata'], 2) }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3" align="center">
                        Tidak ada data unsur pelayanan
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    {{-- DATA RESPONDEN --}}
    <div class="section-title">
        Data Responden Survey
    </div>

    <table class="laporan">

        <thead>

            <tr>

                <th width="5%">
                    No
                </th>

                <th width="10%">
                    Umur
                </th>

                <th width="12%">
                    Gender
                </th>

                <th width="18%">
                    Pendidikan
                </th>

                <th width="20%">
                    Pekerjaan
                </th>

                <th width="20%">
                    Jenis Layanan
                </th>

                <th width="15%">
                    Tanggal
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($data as $item)

                <tr>

                    <td align="center">
                        {{ $loop->iteration }}
                    </td>

                    <td align="center">
                        {{ $item->umur_responden }}
                    </td>

                    <td align="center">
                        {{ $item->jenis_kelamin_responden }}
                    </td>

                    <td>
                        {{ $item->pendidikan_responden }}
                    </td>

                    <td>
                        {{ $item->pekerjaan_responden }}
                    </td>

                    <td>
                        {{ $item->jenis_layanan }}
                    </td>

                    <td align="center">
                        {{ \Carbon\Carbon::parse($item->tanggal_survey)->format('d/m/Y') }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" align="center">
                        Tidak ada data responden
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    {{-- TTD --}}
    <div class="ttd">

        <p>
            Hargobinangun,
            {{ now()->translatedFormat('d F Y') }}
        </p>

        <strong>
            Lurah Kalurahan Hargobinangun
        </strong>

        <br><br><br><br><br>

        <strong>
            Amin Sarjito, S.H.
        </strong>

    </div>

</body>

</html>
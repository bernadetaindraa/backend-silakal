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
            padding: 10px;
            text-align: center;
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
                    LAPORAN POTENSI & PRODUK KALURAHAN
                </h3>

                <p>
                    Jalan Kaliurang Km 20, Sawungan,
                    Hargobinangun, Pakem, Sleman,
                    Yogyakarta 55582
                </p>

            </td>

        </tr>

    </table>

    <hr>

    {{-- INFO --}}
    <div class="info">

        <strong>Kategori :</strong>

        @if(request('kategori_potensi_produk'))

            {{ request('kategori_potensi_produk') }}

        @else

            Semua Kategori

        @endif

        <br>

        <strong>Tanggal Cetak :</strong>
        {{ now()->translatedFormat('d F Y H:i') }}

    </div>

    {{-- STATISTIK --}}
    <table class="statistik">

        <tr>

            <td>
                <strong>Total Data</strong>
                <br>
                {{ $totalPotensiProduk }}
            </td>

            <td>
                <strong>Potensi Daerah</strong>
                <br>
                {{ $potensiDaerah }}
            </td>

            <td>
                <strong>Produk Usaha Daerah</strong>
                <br>
                {{ $produkUsaha }}
            </td>

        </tr>

    </table>

    {{-- PER KATEGORI --}}
    <div class="section-title">
        Data Per Kategori
    </div>

    <table class="laporan">

        <thead>

            <tr>
                <th>Kategori</th>
                <th width="20%">Jumlah</th>
            </tr>

        </thead>

        <tbody>

            @foreach($perKategori as $kategori => $jumlah)

                <tr>

                    <td>
                        {{ $kategori }}
                    </td>

                    <td align="center">
                        {{ $jumlah }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    {{-- DATA --}}
    <div class="section-title">
        Data Potensi & Produk
    </div>

    <table class="laporan">

        <thead>

            <tr>

                <th width="5%">No</th>
                <th width="25%">Judul</th>
                <th width="20%">Nama Potensi/Produk</th>
                <th width="20%">Kategori</th>
                <th width="10%">Tanggal</th>
                <th width="20%">Artikel</th>

            </tr>

        </thead>

        <tbody>

            @forelse($data as $item)

                <tr>

                    <td align="center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->judul_potensi_produk }}
                    </td>

                    <td>
                        {{ $item->nama_potensi_produk }}
                    </td>

                    <td>
                        {{ $item->kategori_potensi_produk }}
                    </td>

                    <td align="center">
                        {{ \Carbon\Carbon::parse($item->tanggal_potensi_produk)->format('d/m/Y') }}
                    </td>

                    <td>
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->artikel_potensi_produk), 100) }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" align="center">
                        Tidak ada data potensi & produk
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
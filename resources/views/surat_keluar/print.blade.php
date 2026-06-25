<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak - {{ $suratKeluar->no_surat }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
            padding: 2cm 2.5cm;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header h1 {
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .header h2 {
            font-size: 11pt;
            font-weight: normal;
            margin-top: 3px;
        }
        .header p {
            font-size: 10pt;
            margin-top: 2px;
        }
        .nomor-surat {
            text-align: center;
            margin: 20px 0;
            font-size: 12pt;
        }
        .nomor-surat strong {
            font-size: 13pt;
        }
        .content {
            margin: 20px 0;
        }
        .content p {
            text-indent: 0;
            margin-bottom: 8px;
            text-align: justify;
        }
        .field {
            margin-bottom: 5px;
        }
        .field .label {
            font-weight: bold;
        }
        .ttd {
            margin-top: 50px;
            text-align: right;
        }
        .ttd .city-date {
            margin-bottom: 80px;
        }
        .ttd .nama {
            font-weight: bold;
            text-decoration: underline;
        }
        .ttd .nip {
            font-size: 11pt;
        }
        .btn-print {
            display: block;
            margin: 20px auto 0;
            padding: 10px 30px;
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
        }
        .btn-print:hover { background: #4338ca; }
        @media print {
            .btn-print { display: none; }
            body { padding: 0; }
            @page { margin: 2cm 2.5cm; }
        }
    </style>
</head>
<body>
    <button class="btn-print" onclick="window.print()">Cetak / Print</button>

    <div class="header">
        <h1>PERUSAHAAN DAERAH AIR MINUM</h1>
        <h2>KOTA SURAKARTA</h2>
        <p>Jl. Nyi Ageng Serang No. 1, Surakarta 57155 | Telp. (0271) 123456</p>
        <p>Email: admin@pdam.com | Website: www.pdam.co.id</p>
    </div>

    <div class="nomor-surat">
        <strong>{{ $suratKeluar->no_surat }}</strong>
    </div>

    <div class="content">
        @if($suratKeluar->masterSurat)
            <div class="field">
                <span class="label">Jenis Surat:</span>
                {{ $suratKeluar->masterSurat->kode }} — {{ $suratKeluar->masterSurat->nama }}
            </div>
        @endif
        <div class="field">
            <span class="label">Tanggal:</span>
            {{ $suratKeluar->tanggal_surat->format('d F Y') }}
        </div>
        <div class="field">
            <span class="label">Tujuan:</span>
            {{ $suratKeluar->tujuan }}
        </div>
        <div class="field">
            <span class="label">Perihal:</span>
            {{ $suratKeluar->perihal }}
        </div>

        @if($suratKeluar->isi_ringkas)
            <div style="margin-top: 20px;">
                <p>{{ $suratKeluar->isi_ringkas }}</p>
            </div>
        @endif
    </div>

    <div class="ttd">
        <div class="city-date">Surakarta, {{ $suratKeluar->tanggal_surat->format('d F Y') }}</div>
        <div>Direktur Utama,</div>
        <br><br><br>
        <div class="nama">( ______________________________ )</div>
        <div class="nip">NIP. ______________________________</div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 15px;
        }
        
        .logo img {
            max-height: 60px;
            display: inline-block;
        }

        h1 {
            font-size: 18px;
            margin: 5px 0;
            color: #040181;
        }

        .date {
            font-size: 12px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            padding: 8px 5px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
        }

        td {
            padding: 6px 5px;
            font-size: 10px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .page-number {
            text-align: right;
            font-size: 10px;
            color: #666;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('assets/img/logoppa.png') }}" alt="Logo PPA" style="max-height: 60px;">
        </div>
        <h1>Daftar Anggota Partai Perjuangan Aceh</h1>
        <div class="date">Tanggal: {{ date('d/m/Y') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Nama</th>
                <th width="15%">No. KTA</th>
                <th width="15%">Provinsi</th>
                <th width="15%">Kabupaten/Kota</th>
                <th width="15%">Kecamatan</th>
                <th width="15%">Tgl Daftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $index => $member)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->kta_new ?? $member->kta_old ?? '-' }}</td>
                <td>{{ $member->provinsi ?? '-' }}</td>
                <td>{{ $member->kotakab ?? '-' }}</td>
                <td>{{ $member->kecamatan ?? '-' }}</td>
                <td>{{ $member->created_at ? $member->created_at->format('d/m/Y') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>© {{ date('Y') }} Partai Perjuangan Aceh. Semua hak dilindungi.</p>
    </div>

    <div class="page-number">
        Halaman {{ $page }} dari {{ $totalPages }}
    </div>
</body>
</html>

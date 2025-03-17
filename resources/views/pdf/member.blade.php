<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Member Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 15px;
        }
        
        .logo img {
            max-height: 80px;
            display: inline-block;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            background-color: #f0f0f0;
            padding: 5px 10px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .grid {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .grid-item {
            display: table-row;
        }

        .label {
            display: table-cell;
            width: 200px;
            padding: 5px;
            font-weight: bold;
        }

        .value {
            display: table-cell;
            padding: 5px;
        }

        .image-container {
            text-align: center;
            margin: 20px 0;
        }

        .image-container img {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('assets/img/logoppa.png') }}" alt="Logo PPA" style="max-height: 80px; margin-bottom: 10px;">
        </div>
        <h1>Data Anggota</h1>
        <p>{{ date('d/m/Y') }}</p>
    </div>

    <div class="section">
        <div class="section-title">Dokumen</div>
        
        <div style="display: table; width: 100%;">
            <div style="display: table-cell; width: 50%; vertical-align: top; padding-right: 10px;">
                <div class="section-title" style="background-color: #e8e8e8; font-size: 14px; margin-bottom: 10px;">Foto Anggota</div>
                <div class="image-container" style="text-align: center;">
                    @if ($member->foto)
                        <img src="{{ public_path('storage/' . $member->foto) }}" alt="Foto" style="max-width: 150px; max-height: 200px;">
                    @else
                        <p>Foto tidak tersedia</p>
                    @endif
                </div>
            </div>
            
            <div style="display: table-cell; width: 50%; vertical-align: top; padding-left: 10px;">
                <div class="section-title" style="background-color: #e8e8e8; font-size: 14px; margin-bottom: 10px;">Foto KTP</div>
                <div class="image-container" style="text-align: center;">
                    @if ($member->ktp)
                        <img src="{{ public_path('storage/' . $member->ktp) }}" alt="KTP" style="max-width: 300px; max-height: 200px;">
                    @else
                        <p>Foto KTP tidak tersedia</p>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="grid">
            <div class="grid-item">
                <div class="label">Konfirmasi Alamat KTP:</div>
                <div class="value">{{ $member->is_conf_ktp_addr_valid ? 'Valid' : 'Tidak Valid' }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Informasi KTA</div>
        <div class="grid">
            <div class="grid-item">
                <div class="label">Nomor KTA Lama:</div>
                <div class="value">{{ $member->kta_old }}</div>
            </div>
            <div class="grid-item">
                <div class="label">Nomor KTA Baru:</div>
                <div class="value">{{ $member->kta_new }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Informasi Pribadi</div>
        <div class="grid">
            <div class="grid-item">
                <div class="label">Nama Lengkap:</div>
                <div class="value">{{ $member->name }}</div>
            </div>
            <div class="grid-item">
                <div class="label">Nama Panggilan:</div>
                <div class="value">{{ $member->nickname }}</div>
            </div>
            <div class="grid-item">
                <div class="label">Nama Istri/Suami:</div>
                <div class="value">{{ $member->couple_name }}</div>
            </div>
            <div class="grid-item">
                <div class="label">Pendidikan Terakhir:</div>
                <div class="value">{{ $member->last_education }}</div>
            </div>
            <div class="grid-item">
                <div class="label">Pekerjaan:</div>
                <div class="value">{{ $member->pekerjaan }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Informasi Rekomendasi</div>
        <div class="grid">
            <div class="grid-item">
                <div class="label">Nama:</div>
                <div class="value">{{ $member->recomend_name }}</div>
            </div>
            <div class="grid-item">
                <div class="label">Jabatan:</div>
                <div class="value">{{ $member->recomend_jabatan }}</div>
            </div>
            <div class="grid-item">
                <div class="label">Telepon:</div>
                <div class="value">{{ $member->recomend_telp }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Media Sosial</div>
        <div class="grid">
            <div class="grid-item">
                <div class="label">Platform:</div>
                <div class="value">{{ $member->social_media }}</div>
            </div>
            <div class="grid-item">
                <div class="label">Link:</div>
                <div class="value">{{ $member->social_media_link }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Informasi Pengurusan</div>
        <div class="grid">
            <div class="grid-item">
                <div class="label">Level:</div>
                <div class="value">{{ $member->level_pengurusan }}</div>
            </div>
            <div class="grid-item">
                <div class="label">Jabatan:</div>
                <div class="value">{{ $member->jabatan }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Alamat</div>
        <div class="grid">
            <div class="grid-item">
                <div class="label">Provinsi:</div>
                <div class="value">{{ $member->provinsi }}</div>
            </div>
            <div class="grid-item">
                <div class="label">Kota/Kabupaten:</div>
                <div class="value">{{ $member->kotakab }}</div>
            </div>
            <div class="grid-item">
                <div class="label">Kecamatan:</div>
                <div class="value">{{ $member->kecamatan }}</div>
            </div>
            <div class="grid-item">
                <div class="label">Desa:</div>
                <div class="value">{{ $member->desa }}</div>
            </div>
        </div>
    </div>
</body>

</html>

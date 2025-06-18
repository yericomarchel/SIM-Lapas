<!DOCTYPE html>
<html>
<head>
    <title>Bukti Persetujuan Kunjungan</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; }
        .header p { margin: 0; font-size: 14px; }
        .content { margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; font-size: 12px; }
        th { background-color: #f2f2f2; text-align: left; }
        .footer { margin-top: 40px; text-align: center; font-size: 10px; color: #888; }
    </style>
</head>
<body>
    <div class="header">
        <h1>BUKTI PERSETUJUAN KUNJUNGAN</h1>
        <p>Rutan Kelas IIA Batam</p>
    </div>
    <hr>
    <div class="content">
        <p style="font-size:12px;">Berikut adalah detail persetujuan kunjungan Anda:</p>
        <table>
            <tr>
                <th style="width: 30%;">Nomor Kunjungan</th>
                <td>KJN-{{ $kunjungan->id }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td style="font-weight: bold; color: green;">DISETUJUI</td>
            </tr>
            <tr>
                <th>Diverifikasi oleh</th>
                <td>{{ $kunjungan->approver->name ?? 'Staf Rutan' }}</td>
            </tr>
            <tr><th colspan="2">DETAIL KUNJUNGAN</th></tr>
            <tr>
                <th>Nama Warga Binaan</th>
                <td>{{ $kunjungan->wargaBinaan->nama_lengkap }}</td>
            </tr>
            <tr>
                <th>Tanggal Kunjungan</th>
                <td>{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->isoFormat('dddd, D MMMM Y') }}</td>
            </tr>
            <tr>
                <th>Sesi Kunjungan</th>
                <td>{{ $kunjungan->sesi_kunjungan }}</td>
            </tr>
             <tr><th colspan="2">DETAIL PENGUNJUNG</th></tr>
            <tr>
                <th>Nama Penanggung Jawab</th>
                <td>{{ $kunjungan->user->name }}</td>
            </tr>
            <tr>
                <th>Nama Pengikut</th>
                <td>{{ $kunjungan->nama_pengikut ?? '-' }}</td>
            </tr>
        </table>

        <p style="font-size:12px; margin-top:20px;">
            <strong>Perhatian:</strong> Harap tunjukkan bukti ini kepada petugas di lokasi. Bukti ini hanya berlaku untuk tanggal dan sesi yang tertera.
        </p>
    </div>

    <div class="footer">
        Dokumen ini dibuat oleh sistem secara otomatis pada {{ now()->isoFormat('D MMMM Y, HH:mm:ss') }}
    </div>
</body>
</html>

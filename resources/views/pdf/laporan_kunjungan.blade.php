<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kunjungan</title>
    <style>
        body { font-family: sans-serif; }
        h1, h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px;}
        th, td { border: 1px solid #333; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Laporan Kunjungan</h1>
    <h2>Rutan Kelas IIA Batam</h2>
    @if ($tanggalMulai && $tanggalSelesai)
        <p style="text-align:center; font-size:12px;">Periode: {{ $tanggalMulai->format('d M Y') }} - {{ $tanggalSelesai->format('d M Y') }}</p>
    @endif
    <hr>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Tgl. Kunjungan</th>
                <th>Pengunjung</th>
                <th>Warga Binaan</th>
                <th>Status</th>
                <th>Diverifikasi oleh</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kunjunganData as $kunjungan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d/m/Y') }}</td>
                    <td>{{ $kunjungan->user->name }}</td>
                    <td>{{ $kunjungan->wargaBinaan->nama_lengkap }}</td>
                    <td>{{ $kunjungan->status }}</td>
                    <td>{{ $kunjungan->approver->name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

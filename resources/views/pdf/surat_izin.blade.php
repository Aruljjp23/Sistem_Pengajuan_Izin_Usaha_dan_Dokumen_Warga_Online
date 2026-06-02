<!DOCTYPE html>
<html>
<head>
    <title>Surat Izin</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid black; padding-bottom: 10px; margin-bottom: 20px; }
        .content { line-height: 1.5; }
    </style>
</head>
<body>
    <div class="header">
        <h2>PEMERINTAH KOTA MADIUN</h2>
        <h3>SURAT IZIN RESMI</h3>
        <p>Nomor Registrasi: {{ $pengajuan->nomor_registrasi }}</p>
    </div>

    <div class="content">
        <p>Dengan ini menyatakan bahwa:</p>
        <table style="width: 100%; margin-left: 20px;">
            <tr><td style="width: 150px;">Nama Pemohon</td><td>: {{ $pengajuan->pemohon->nama ?? '-' }}</td></tr>
            <tr><td>NIK</td><td>: {{ $pengajuan->pemohon->nik ?? '-' }}</td></tr>
            <tr><td>Jenis Izin</td><td>: {{ $pengajuan->jenisIzin->nama_izin ?? '-' }}</td></tr>
        </table>
        
        <p>Telah memenuhi semua persyaratan dan dinyatakan <strong>DISETUJUI</strong> untuk menjalankan aktivitas sesuai dengan izin yang diajukan.</p>
        
        <p style="text-align: right; margin-top: 50px;">
            Dikeluarkan pada: {{ \Carbon\Carbon::now()->format('d F Y') }}<br><br><br><br>
            <strong>Kepala Dinas Perizinan</strong>
        </p>
    </div>
</body>
</html>
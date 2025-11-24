<!DOCTYPE html>
<html>
<head>
    <title>Update Lamaran</title>
</head>
<body>
    <h2>Halo, {{ $application->user->name }}</h2>

    @if ($status == 'Accepted')
        <p>Selamat! Lamaran Anda untuk posisi <b>{{ $application->job->title }}</b> telah <b>DITERIMA</b>.</p>
        <p>Tim HR kami akan segera menghubungi Anda untuk langkah selanjutnya.</p>
    @else
        <p>Terima kasih atas ketertarikan Anda pada posisi <b>{{ $application->job->title }}</b>.</p>
        <p>Setelah proses peninjauan, kami sampaikan bahwa lamaran Anda <b>DITOLAK</b>.</p>
        <p>Kami menghargai waktu Anda dan semoga sukses untuk pencarian kerja selanjutnya.</p>
    @endif

    <br>
    <p>Salam,</p>
    <p><b>Tim {{ config('app.name') }}</b></p>
</body>
</html>
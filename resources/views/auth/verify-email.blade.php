<!doctype html>
<html>
<head><meta charset="utf-8"><title>Verifikasi Email</title></head>
<body>
  <h1>Verifikasi Email Diperlukan</h1>
  <p>Silakan cek kotak masuk email Anda & klik tautan verifikasi.</p>

  @if (session('status') === 'verification-link-sent'))
    <p><strong>Link verifikasi baru telah dikirim.</strong></p>
  @endif

  <form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">Kirim Ulang Email Verifikasi</button>
  </form>
</body>
</html>

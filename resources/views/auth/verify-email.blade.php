<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Verifikasi Email - Pitstop</title>
  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
        Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
      background-color: #f9fafb;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      background: white;
      padding: 2rem 3rem;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      max-width: 420px;
      width: 90%;
      text-align: center;
    }
    h1 {
      color: #1a202c;
      margin-bottom: 1rem;
    }
    p {
      color: #4a5568;
      font-size: 1rem;
      margin-bottom: 2rem;
    }
    .alert {
      background-color: #e6fffa;
      border: 1px solid #b2f5ea;
      color: #2c7a7b;
      padding: 0.75rem 1rem;
      border-radius: 6px;
      margin-bottom: 1.5rem;
      font-weight: 600;
    }
    button {
      background-color: #2563eb;
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.2s ease;
      width: 100%;
    }
    button:hover {
      background-color: #1d4ed8;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Verifikasi Email Diperlukan</h1>
    <p>Terima kasih telah mendaftar! Silakan cek kotak masuk email Anda dan klik tautan verifikasi untuk mengaktifkan akun Anda.</p>

    @if (session('status') === 'verification-link-sent')
      <div class="alert">
        Link verifikasi baru telah dikirim ke alamat email Anda.
      </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
      @csrf
      <button type="submit">Kirim Ulang Email Verifikasi</button>
    </form>
  </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      margin: 0;
      padding: 0;
      background: url('{{ asset('images/museumm.jpeg') }}') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
    }

    .header-custom {
      width: 100%;
      background: linear-gradient(to right, #2c2b2b, #c3a077);
      padding: 14px 40px;
      display: flex;
      align-items: center;
      color: white;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      position: absolute;
      top: 0;
      left: 0;
      height: 64px;
      z-index: 10;
    }

    .header-custom i {
      font-size: 26px;
      margin-right: 10px;
    }

    .header-custom .title {
      font-size: 20px;
      font-weight: bold;
      letter-spacing: 0.5px;
    }

    .register-wrapper {
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .form-card {
      background-color: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.25);
      min-width: 350px;
      max-width: 400px;
      width: 100%;
      margin-top: 100px;
    }

    .btn-green {
      background-color: #2ecc40;
      border: none;
    }

    .btn-green:hover {
      background-color: #27ae3b;
    }

    .form-control:focus {
      box-shadow: none;
    }
  </style>
</head>
<body>

  <div class="header-custom">
    <i class="fa-solid fa-landmark"></i>
    <div class="title">Sistem Manajemen Barang Museum</div>
  </div>

  <div class="register-wrapper">
    <div class="form-card">
      <h5 class="text-center mb-4">Register</h5>

      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <form method="POST" action="{{ url('/register') }}">
        @csrf

        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" required>
          @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" required>
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
          @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-green w-100 text-white">Register</button>

        <div class="text-center mt-3">
          <small>Sudah punya akun? <a href="{{ url('/login') }}">Login di sini</a></small>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

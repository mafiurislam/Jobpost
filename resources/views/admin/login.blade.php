<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Bright Future Consultancy</title>
  <link rel="icon" type="image/png" href="{{ asset($siteLogo ?? 'assets/images/logo.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #063c1f 0%, #0d8a43 50%, #08612e 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.98);
      border-radius: 24px;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 440px;
      overflow: hidden;
    }

    .login-header {
      background: #e8f4e6;
      padding: 2.5rem 2rem 2rem;
      text-align: center;
      border-bottom: 1px solid #d1e7dd;
    }

    .brand-logo-login {
      height: 60px;
      object-fit: contain;
      margin-bottom: 1rem;
      background: #ffffff;
      padding: 6px 16px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .btn-login {
      background-color: #0d8a43;
      color: #ffffff;
      font-weight: 700;
      border-radius: 12px;
      padding: 0.8rem;
      font-size: 1rem;
      border: none;
      transition: all 0.25s;
    }
    .btn-login:hover {
      background-color: #08612e;
      color: #ffffff;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(13, 138, 67, 0.3);
    }

    .form-control {
      border-radius: 12px;
      padding: 0.75rem 1rem 0.75rem 2.5rem;
      border: 1.5px solid #cbd5e1;
    }
    .form-control:focus {
      border-color: #0d8a43;
      box-shadow: 0 0 0 4px rgba(13, 138, 67, 0.15);
    }

    .input-icon-wrapper {
      position: relative;
    }
    .input-icon-wrapper i {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: #64748b;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <div class="login-header">
      <img src="{{ asset($siteLogo ?? 'assets/images/logo.png') }}" alt="{{ $siteName ?? 'Bright Future Consultancy' }}" class="brand-logo-login">
      <h4 class="fw-bold text-dark mb-1">Admin Portal Login</h4>
      <p class="text-muted small mb-0">Manage Job Posts & Placements Dynamically</p>
    </div>

    <div class="p-4 p-md-5">

      @if(session('info'))
        <div class="alert alert-info py-2 small rounded-3 mb-3">
          <i class="fas fa-info-circle me-1"></i> {{ session('info') }}
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger py-2 small rounded-3 mb-3">
          <i class="fas fa-exclamation-circle me-1"></i> {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
          <label class="form-label fw-semibold text-secondary small">Admin Email Address</label>
          <div class="input-icon-wrapper">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" class="form-control" placeholder="admin@brightfuture.com" value="{{ old('email', 'admin@brightfuture.com') }}" required autofocus>
          </div>
        </div>

        <!-- Password -->
        <div class="mb-4">
          <label class="form-label fw-semibold text-secondary small">Password</label>
          <div class="input-icon-wrapper">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" class="form-control" placeholder="••••••••" value="admin123" required>
          </div>
        </div>

        <!-- Remember Me -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="rememberCheck" checked>
            <label class="form-check-label small text-muted" for="rememberCheck">
              Keep me signed in
            </label>
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-login w-100 mb-3">
          Sign In to Dashboard <i class="fas fa-arrow-right ms-2"></i>
        </button>

        <div class="text-center">
          <a href="{{ url('/') }}" class="text-decoration-none small text-muted">
            ← Back to Public Website
          </a>
        </div>
      </form>

    </div>
  </div>

</body>
</html>

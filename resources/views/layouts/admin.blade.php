<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin Dashboard - Bright Future Consultancy')</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

  <!-- Bootstrap 5 CSS & FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  
  <!-- Google Fonts: Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-teal: #0d6efd;
      --brand-green: #0d8a43;
      --brand-green-dark: #08612e;
      --brand-green-light: #e8f4e6;
      --bg-dark: #0f172a;
      --card-bg: #ffffff;
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      background-color: #f1f5f9;
      color: #334155;
    }

    .admin-navbar {
      background: linear-gradient(135deg, #063c1f 0%, #0d8a43 100%);
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.12);
    }

    .brand-logo-admin {
      height: 42px;
      object-fit: contain;
      background: #ffffff;
      padding: 4px 10px;
      border-radius: 8px;
    }

    .stat-card {
      border: none;
      border-radius: 16px;
      transition: all 0.25s ease-in-out;
      box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }
    .stat-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }

    .stat-icon {
      width: 54px;
      height: 54px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.4rem;
    }

    .job-table-card {
      border: none;
      border-radius: 20px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      background: #ffffff;
    }

    .table > :not(caption) > * > * {
      padding: 1rem 1.25rem;
      vertical-align: middle;
    }

    .badge-active {
      background-color: #dcfce7;
      color: #15803d;
      border: 1px solid #bbf7d0;
      font-weight: 600;
    }

    .badge-inactive {
      background-color: #fef2f2;
      color: #b91c1c;
      border: 1px solid #fecaca;
      font-weight: 600;
    }

    .btn-brand {
      background-color: var(--brand-green);
      color: #ffffff;
      border-radius: 10px;
      font-weight: 600;
      border: none;
      padding: 0.6rem 1.4rem;
      transition: all 0.2s;
    }
    .btn-brand:hover {
      background-color: var(--brand-green-dark);
      color: #ffffff;
      transform: translateY(-1px);
    }

    .modal-content {
      border: none;
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .form-control, .form-select {
      border-radius: 10px;
      padding: 0.65rem 1rem;
      border: 1.5px solid #e2e8f0;
    }
    .form-control:focus, .form-select:focus {
      border-color: var(--brand-green);
      box-shadow: 0 0 0 4px rgba(13, 138, 67, 0.15);
    }

    .action-btn {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border: none;
      transition: all 0.2s;
    }
    .action-btn-edit {
      background-color: #e0f2fe;
      color: #0369a1;
    }
    .action-btn-edit:hover {
      background-color: #0284c7;
      color: #ffffff;
    }
    .action-btn-delete {
      background-color: #fee2e2;
      color: #b91c1c;
    }
    .action-btn-delete:hover {
      background-color: #dc2626;
      color: #ffffff;
    }
    .action-btn-toggle {
      background-color: #f1f5f9;
      color: #475569;
    }
    .action-btn-toggle:hover {
      background-color: #cbd5e1;
    }
  </style>

  @yield('styles')
</head>
<body>

  <!-- Admin Top Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark admin-navbar sticky-top py-2">
    <div class="container-fluid px-4">
      <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="brand-logo-admin">
        <div class="lh-sm">
          <div class="fw-bold text-white fs-5" style="letter-spacing: 0.5px;">ADMIN DASHBOARD</div>
          <small class="text-white-50 fs-7" style="font-size: 0.75rem;">Bright Future Consultancy Placement Cell</small>
        </div>
      </a>

      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="adminNavbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold active" href="{{ route('admin.dashboard') }}">
              <i class="fas fa-briefcase me-1"></i> Job Posts Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white-50 fw-medium" href="{{ url('/jobs.html') }}" target="_blank">
              <i class="fas fa-external-link-alt me-1"></i> View Live Website
            </a>
          </li>
        </ul>

        <div class="d-flex align-items-center gap-3">
          <div class="text-end text-white d-none d-md-block">
            <div class="fw-bold fs-6">{{ Auth::user()->name ?? 'Administrator' }}</div>
            <small class="text-white-50" style="font-size: 0.75rem;">{{ Auth::user()->email ?? 'admin@brightfuture.com' }}</small>
          </div>

          <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-light rounded-pill px-3 py-1 btn-sm fw-semibold">
              <i class="fas fa-sign-out-alt me-1"></i> Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </nav>

  <!-- Flash Alerts -->
  <div class="container-fluid px-4 mt-3">
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle fa-lg me-2"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('info'))
      <div class="alert alert-info alert-dismissible fade show rounded-4 shadow-sm border-0 d-flex align-items-center" role="alert">
        <i class="fas fa-info-circle fa-lg me-2"></i>
        <div>{{ session('info') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm border-0" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> <strong>Please resolve errors:</strong>
        <ul class="mb-0 mt-1 ps-3">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
  </div>

  <!-- Main Content Area -->
  <main class="py-4">
    @yield('content')
  </main>

  <footer class="text-center py-4 text-secondary fs-7 border-top bg-white mt-5">
    <div class="container">
      <p class="mb-1">© {{ date('Y') }} <strong>Bright Future Consultancy</strong>. Dynamic Job Management System.</p>
      <small class="text-muted">ISO 9001:2015 Certified Agency | Registered under Govt. UDYAM-WB-11-0035754</small>
    </div>
  </footer>

  <!-- Bootstrap 5 Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  @yield('scripts')
</body>
</html>

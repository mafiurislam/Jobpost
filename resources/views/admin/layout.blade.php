<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard - Bright Future Consultancy')</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 & FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <style>
    :root {
      --admin-sidebar-bg: #0f172a;
      --admin-sidebar-color: #94a3b8;
      --admin-active-color: #22c55e;
    }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: #f8fafc;
      color: #1e293b;
    }

    .admin-wrapper {
      display: flex;
      min-height: 100vh;
    }

    .admin-sidebar {
      width: 280px;
      background-color: var(--admin-sidebar-bg);
      color: var(--admin-sidebar-color);
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
    }

    .admin-brand {
      padding: 1.5rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .admin-brand img {
      max-height: 40px;
      background: #ffffff;
      padding: 4px;
      border-radius: 8px;
    }

    .admin-nav {
      padding: 1rem 0;
      flex-grow: 1;
      overflow-y: auto;
    }

    .nav-section-title {
      font-size: 0.7rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: #64748b;
      padding: 1rem 1.5rem 0.4rem;
      margin-top: 0.5rem;
    }

    .admin-nav .nav-link {
      color: #94a3b8;
      font-weight: 600;
      font-size: 0.9rem;
      padding: 0.65rem 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      transition: all 0.2s ease;
    }

    .admin-nav .nav-link:hover, .admin-nav .nav-link.active {
      color: #ffffff;
      background-color: rgba(255, 255, 255, 0.05);
      border-left: 4px solid var(--admin-active-color);
    }

    .admin-nav .nav-link i {
      width: 20px;
      text-align: center;
    }

    .admin-content {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .admin-topbar {
      background-color: #ffffff;
      border-bottom: 1px solid #e2e8f0;
      padding: 1rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .admin-main {
      padding: 2rem;
      flex-grow: 1;
    }

    .card-custom {
      border: 1px solid #e2e8f0;
      border-radius: 16px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
      background-color: #ffffff;
    }

    .section-separator {
      border-bottom: 2px solid #e2e8f0;
      padding-bottom: 0.75rem;
      margin-bottom: 1.5rem;
    }

    /* Universal SVG Constraint for Admin */
    .pagination svg, 
    nav svg,
    .page-item svg {
      max-width: 18px !important;
      max-height: 18px !important;
      width: 16px !important;
      height: 16px !important;
      display: inline-block !important;
      vertical-align: middle !important;
    }
  </style>

  @stack('styles')
</head>

<body>

  <div class="admin-wrapper">

    <!-- Admin Sidebar with Clear Section Separators -->
    <aside class="admin-sidebar">
      <div class="admin-brand">
        <img src="{{ asset(App\Models\SiteSetting::get('site_logo', 'assets/images/logo.png')) }}" alt="Logo">
        <div>
          <h6 class="text-white fw-bold mb-0">Bright Future</h6>
          <small class="text-success fw-semibold">ADMIN PANEL</small>
        </div>
      </div>

      <nav class="admin-nav">
        <!-- SEPARATOR 1: OVERVIEW -->
        <div class="nav-section-title">Overview</div>
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
          <i class="fas fa-chart-line"></i> Dashboard
        </a>

        <!-- SEPARATOR 2: LOGO MANAGEMENT -->
        <div class="nav-section-title">Logo Management</div>
        <a class="nav-link {{ request()->routeIs('admin.logo.*') ? 'active' : '' }}" href="{{ route('admin.logo.index') }}">
          <i class="fas fa-image"></i> Logo Upload
        </a>

        <!-- SEPARATOR 3: HOME PAGE SECTIONS -->
        <div class="nav-section-title">Home Page Sections</div>
        <a class="nav-link {{ request()->routeIs('admin.home.*') ? 'active' : '' }}" href="{{ route('admin.home.index') }}">
          <i class="fas fa-layer-group"></i> Manage All Sections
        </a>

        <!-- SEPARATOR 4: JOBS MANAGEMENT -->
        <div class="nav-section-title">Jobs & Vacancies CRUD</div>
        <a class="nav-link {{ request()->routeIs('admin.jobs.index') ? 'active' : '' }}" href="{{ route('admin.jobs.index') }}">
          <i class="fas fa-briefcase"></i> All Job Posts
        </a>
        <a class="nav-link {{ request()->routeIs('admin.jobs.create') ? 'active' : '' }}" href="{{ route('admin.jobs.create') }}">
          <i class="fas fa-plus-circle"></i> Add New Single Job
        </a>

        <!-- SEPARATOR 5: INQUIRIES & APPLICATIONS -->
        <div class="nav-section-title">Inquiries & Candidates</div>
        <a class="nav-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}" href="{{ route('admin.applications.index') }}">
          <i class="fas fa-user-graduate"></i> Job Applications
        </a>
        <a class="nav-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}" href="{{ route('admin.inquiries.index') }}">
          <i class="fas fa-envelope-open-text"></i> Contact Messages
        </a>

        <!-- SEPARATOR 6: WEBSITE SETTINGS -->
        <div class="nav-section-title">Website Settings</div>
        <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
          <i class="fas fa-sliders-h"></i> General Settings
        </a>
      </nav>

      <div class="p-3 border-top border-secondary border-opacity-25">
        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-light btn-sm w-100 mb-2">
          <i class="fas fa-external-link-alt me-1"></i> Visit Live Website
        </a>
        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-danger btn-sm w-100 fw-semibold">
            <i class="fas fa-sign-out-alt me-1"></i> Logout
          </button>
        </form>
      </div>
    </aside>

    <!-- Admin Content Area -->
    <div class="admin-content">
      <header class="admin-topbar">
        <h5 class="fw-bold mb-0">@yield('page_header', 'Admin Dashboard')</h5>
        <div class="d-flex align-items-center gap-3">
          <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-2 rounded-pill">
            <i class="fas fa-check-circle me-1"></i> System Online
          </span>
          <div class="fw-semibold text-dark">
            <i class="fas fa-user-circle me-1 text-secondary"></i> {{ auth()->user()->name ?? 'Administrator' }}
          </div>
        </div>
      </header>

      <main class="admin-main">
        <!-- Flash Alert Messages -->
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4 shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        @yield('content')
      </main>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>

</html>

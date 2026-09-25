<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>@yield('title', 'Admin Dashboard - Bright Future Consultancy')</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset($siteLogo ?? 'assets/images/logo.png') }}">

  <!-- Google Fonts: Plus Jakarta Sans -->
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
      --admin-active-bg: rgba(34, 197, 94, 0.12);
      --admin-border-color: rgba(255, 255, 255, 0.08);
      --admin-topbar-height: 64px;
      --admin-mobile-nav-height: 60px;
    }

    * {
      box-sizing: border-box;
    }

    html, body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: #f8fafc;
      color: #1e293b;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      max-width: 100vw;
    }

    /* Admin Wrapper */
    .admin-wrapper {
      display: flex;
      min-height: 100vh;
      width: 100%;
      overflow-x: hidden;
      position: relative;
    }

    /* Sidebar Styling */
    .admin-sidebar {
      width: 270px;
      background-color: var(--admin-sidebar-bg);
      color: var(--admin-sidebar-color);
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
      height: 100vh;
      position: sticky;
      top: 0;
      z-index: 1040;
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .admin-brand {
      padding: 1.25rem 1.5rem;
      border-bottom: 1px solid var(--admin-border-color);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 0.75rem;
    }

    .admin-brand-content {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      text-decoration: none;
    }

    .admin-brand img {
      max-height: 42px;
      width: auto;
      background: #ffffff;
      padding: 4px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .admin-nav {
      padding: 0.75rem 0 1.5rem;
      flex-grow: 1;
      overflow-y: auto;
      scrollbar-width: thin;
      scrollbar-color: rgba(255, 255, 255, 0.15) transparent;
    }

    .nav-section-title {
      font-size: 0.68rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: #64748b;
      padding: 0.85rem 1.5rem 0.35rem;
      margin-top: 0.35rem;
    }

    .admin-nav .nav-link {
      color: #94a3b8;
      font-weight: 600;
      font-size: 0.88rem;
      padding: 0.7rem 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.85rem;
      transition: all 0.2s ease;
      text-decoration: none;
      border-left: 4px solid transparent;
    }

    .admin-nav .nav-link:hover {
      color: #ffffff;
      background-color: rgba(255, 255, 255, 0.05);
    }

    .admin-nav .nav-link.active {
      color: #ffffff;
      background-color: var(--admin-active-bg);
      border-left-color: var(--admin-active-color);
    }

    .admin-nav .nav-link i {
      width: 20px;
      text-align: center;
      font-size: 1rem;
    }

    /* Content Area */
    .admin-content {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      min-width: 0;
      width: calc(100% - 270px);
      overflow-x: hidden;
      background-color: #f8fafc;
    }

    /* Desktop Topbar */
    .admin-topbar {
      background-color: #ffffff;
      border-bottom: 1px solid #e2e8f0;
      padding: 0.85rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      min-height: var(--admin-topbar-height);
      position: sticky;
      top: 0;
      z-index: 1020;
    }

    /* Mobile Header (Hidden on Desktop) */
    .admin-mobile-header {
      display: none;
      background-color: #0f172a;
      color: #ffffff;
      padding: 0.75rem 1rem;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 1030;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
    }

    .admin-main {
      padding: 1.75rem 2rem;
      flex-grow: 1;
      width: 100%;
      max-width: 100%;
      overflow-x: hidden;
    }

    /* Responsive Cards */
    .card-custom {
      border: 1px solid #e2e8f0;
      border-radius: 16px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
      background-color: #ffffff;
      max-width: 100%;
      overflow: hidden;
    }

    /* Tables in Admin */
    .table-responsive {
      border-radius: 12px;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      margin-bottom: 0;
    }

    .table-responsive table {
      min-width: 600px;
    }

    /* Sidebar Mobile Backdrop */
    .admin-sidebar-backdrop {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(15, 23, 42, 0.6);
      backdrop-filter: blur(3px);
      z-index: 1035;
      transition: opacity 0.3s ease;
    }

    /* Universal Crisp White Text Color on All Green Buttons (#FFFFFF) */
    .btn-success,
    .btn-brand,
    .btn-teal,
    .btn-emerald,
    .btn-outline-success,
    a.btn-success,
    button.btn-success,
    a.btn-outline-success,
    button.btn-outline-success {
      background-color: #15803d !important;
      color: #ffffff !important;
      border-color: #15803d !important;
      font-weight: 700;
      text-decoration: none !important;
    }

    .btn-success:hover,
    .btn-outline-success:hover,
    .btn-outline-success:active,
    .btn-outline-success:focus {
      background-color: #166534 !important;
      color: #ffffff !important;
      border-color: #166534 !important;
    }

    .btn-success *,
    .btn-outline-success * {
      color: #ffffff !important;
    }

    /* Mobile Bottom Navigation Bar (App-like feel) */
    .admin-mobile-bottom-nav {
      display: none;
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100vw;
      height: var(--admin-mobile-nav-height);
      background: #ffffff;
      border-top: 1px solid #e2e8f0;
      z-index: 1025;
      padding: 0;
      box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.05);
    }

    .admin-mobile-bottom-nav ul {
      display: flex;
      list-style: none;
      margin: 0;
      padding: 0;
      height: 100%;
      align-items: center;
      justify-content: space-around;
    }

    .admin-mobile-bottom-nav .nav-item {
      flex: 1;
      text-align: center;
      height: 100%;
    }

    .admin-mobile-bottom-nav .nav-link-bottom {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%;
      color: #64748b;
      font-size: 0.7rem;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s ease;
      gap: 3px;
    }

    .admin-mobile-bottom-nav .nav-link-bottom i {
      font-size: 1.15rem;
    }

    .admin-mobile-bottom-nav .nav-link-bottom.active {
      color: #15803d;
      font-weight: 700;
    }

    /* ==========================================================================
       MOBILE RESPONSIVE BREAKPOINTS (< 992px)
       ========================================================================== */
    @media (max-width: 991.98px) {
      .admin-content {
        width: 100% !important;
      }

      .admin-topbar {
        display: none !important;
      }

      .admin-mobile-header {
        display: flex !important;
      }

      .admin-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 280px;
        max-width: 85vw;
        height: 100vh;
        z-index: 1040;
        transform: translateX(-100%);
        box-shadow: 10px 0 30px rgba(0, 0, 0, 0.4);
      }

      .admin-sidebar.sidebar-open {
        transform: translateX(0);
      }

      .admin-sidebar-backdrop.active {
        display: block;
      }

      .admin-main {
        padding: 1.25rem 0.85rem calc(var(--admin-mobile-nav-height) + 1.25rem) !important;
      }

      .admin-mobile-bottom-nav {
        display: block !important;
      }

      .card-custom {
        padding: 1.25rem !important;
        border-radius: 14px;
      }
    }

    /* Small Screen (< 576px) Refinements */
    @media (max-width: 575.98px) {
      .admin-main {
        padding: 1rem 0.65rem calc(var(--admin-mobile-nav-height) + 1rem) !important;
      }

      h4, .h4 {
        font-size: 1.25rem;
      }

      h5, .h5 {
        font-size: 1.05rem;
      }

      .btn {
        min-height: 40px;
      }
    }

    /* Universal SVG Constraint for Admin */
    .pagination svg, 
    nav svg,
    .page-item svg {
      max-width: 16px !important;
      max-height: 16px !important;
      width: 16px !important;
      height: 16px !important;
      display: inline-block !important;
      vertical-align: middle !important;
    }
  </style>

  @stack('styles')
</head>

<body>

  <!-- Sidebar Backdrop for Mobile Screens -->
  <div class="admin-sidebar-backdrop" id="sidebarBackdrop"></div>

  <!-- Mobile Top Sticky Header -->
  <header class="admin-mobile-header">
    <div class="d-flex align-items-center gap-2">
      <button class="btn btn-outline-light btn-sm border-0 px-2 py-1 fs-5" id="btnToggleSidebar" type="button" aria-label="Toggle Navigation Menu">
        <i class="fas fa-bars"></i>
      </button>
      <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none">
        <img src="{{ asset($siteLogo ?? 'assets/images/logo.png') }}" alt="Logo" style="height: 32px; background: #ffffff; padding: 2px; border-radius: 6px;">
        <span class="text-white fw-bold small">Admin Panel</span>
      </a>
    </div>

    <div class="d-flex align-items-center gap-2">
      <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-30 rounded-pill px-2 py-1 extra-small">
        <i class="fas fa-circle fa-2xs me-1"></i> Live
      </span>
      <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-light btn-sm rounded-pill px-2 py-1 extra-small" title="View Live Website">
        <i class="fas fa-external-link-alt"></i>
      </a>
    </div>
  </header>

  <div class="admin-wrapper">

    <!-- Admin Sidebar (Offcanvas on Mobile, Static on Desktop) -->
    <aside class="admin-sidebar" id="adminSidebar">
      <div class="admin-brand">
        <a href="{{ route('admin.dashboard') }}" class="admin-brand-content">
          <img src="{{ asset($siteLogo ?? 'assets/images/logo.png') }}" alt="Logo">
          <div>
            <h6 class="text-white fw-bold mb-0">Bright Future</h6>
            <small class="text-success fw-bold">ADMIN PORTAL</small>
          </div>
        </a>
        <button class="btn btn-outline-light btn-sm border-0 d-lg-none p-1" id="btnCloseSidebar" type="button" aria-label="Close Sidebar">
          <i class="fas fa-times fa-lg"></i>
        </button>
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

      <div class="p-3 border-top border-secondary border-opacity-25 mt-auto">
        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-light btn-sm w-100 mb-2 rounded-pill">
          <i class="fas fa-external-link-alt me-1"></i> Visit Live Website
        </a>
        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-danger btn-sm w-100 fw-semibold rounded-pill">
            <i class="fas fa-sign-out-alt me-1"></i> Logout
          </button>
        </form>
      </div>
    </aside>

    <!-- Admin Content Area -->
    <div class="admin-content">
      <!-- Desktop Topbar -->
      <header class="admin-topbar">
        <div class="d-flex align-items-center gap-3">
          <h5 class="fw-bold mb-0 text-dark">@yield('page_header', 'Admin Dashboard')</h5>
        </div>
        <div class="d-flex align-items-center gap-3">
          <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-2 rounded-pill">
            <i class="fas fa-check-circle me-1"></i> System Online
          </span>
          <div class="fw-semibold text-dark small">
            <i class="fas fa-user-circle me-1 text-secondary"></i> {{ auth()->user()->name ?? 'Administrator' }}
          </div>
          <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
              <i class="fas fa-sign-out-alt me-1"></i> Logout
            </button>
          </form>
        </div>
      </header>

      <main class="admin-main">
        <!-- Flash Alert Messages -->
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-3 shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        @yield('content')
      </main>
    </div>

  </div>

  <!-- Mobile Bottom Quick Navigation Bar -->
  <nav class="admin-mobile-bottom-nav" aria-label="Mobile Quick Navigation">
    <ul>
      <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link-bottom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <i class="fas fa-chart-line"></i>
          <span>Overview</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.jobs.index') }}" class="nav-link-bottom {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
          <i class="fas fa-briefcase"></i>
          <span>Jobs</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.logo.index') }}" class="nav-link-bottom {{ request()->routeIs('admin.logo.*') ? 'active' : '' }}">
          <i class="fas fa-image"></i>
          <span>Logo</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.settings.index') }}" class="nav-link-bottom {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
          <i class="fas fa-sliders-h"></i>
          <span>Settings</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="javascript:void(0)" class="nav-link-bottom" id="btnBottomMenuToggle">
          <i class="fas fa-bars"></i>
          <span>Menu</span>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Mobile Sidebar Interaction Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const sidebar = document.getElementById('adminSidebar');
      const backdrop = document.getElementById('sidebarBackdrop');
      const btnToggle = document.getElementById('btnToggleSidebar');
      const btnClose = document.getElementById('btnCloseSidebar');
      const btnBottomMenu = document.getElementById('btnBottomMenuToggle');

      function openSidebar() {
        sidebar.classList.add('sidebar-open');
        backdrop.classList.add('active');
        document.body.style.overflow = 'hidden';
      }

      function closeSidebar() {
        sidebar.classList.remove('sidebar-open');
        backdrop.classList.remove('active');
        document.body.style.overflow = '';
      }

      if (btnToggle) btnToggle.addEventListener('click', openSidebar);
      if (btnBottomMenu) btnBottomMenu.addEventListener('click', openSidebar);
      if (btnClose) btnClose.addEventListener('click', closeSidebar);
      if (backdrop) backdrop.addEventListener('click', closeSidebar);

      // Auto close on clicking nav-links in mobile drawer
      const navLinks = sidebar.querySelectorAll('.nav-link');
      navLinks.forEach(link => {
        link.addEventListener('click', function() {
          if (window.innerWidth < 992) {
            closeSidebar();
          }
        });
      });
    });
  </script>

  @stack('scripts')
</body>

</html>

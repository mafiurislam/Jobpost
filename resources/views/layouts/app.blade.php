<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Bright Future Consultancy - HR & Educational Consulting')</title>
  <meta name="description" content="@yield('meta_description', 'Bright Future Consultancy is a premier HR and educational consulting agency in West Bengal. We provide 100% free job updates and manpower solutions.')">

  <!-- Dynamic Favicon -->
  <link rel="icon" type="image/png" href="{{ asset($siteLogo ?? 'assets/images/logo.png') }}">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- CSS Dependencies -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <style>
    html, body {
      overflow-x: hidden;
      max-width: 100vw;
    }

    .site-logo-img {
      max-height: 52px;
      width: auto;
      object-fit: contain;
      display: block;
      transition: all 0.25s ease;
    }

    @media (max-width: 767.98px) {
      .site-logo-img {
        max-height: 44px;
      }
    }

    @media (max-width: 480px) {
      .site-logo-img {
        max-height: 38px;
      }
    }

    /* Universal Crisp White Text Color on All Green Buttons (#FFFFFF) */
    .btn-success,
    .btn-brand,
    .btn-teal,
    .btn-emerald,
    .btn-whatsapp,
    .btn-outline-success,
    a.btn-success,
    button.btn-success,
    a.btn-brand,
    button.btn-brand,
    a.btn-outline-success,
    button.btn-outline-success,
    .hero-btn-primary,
    .btn-apply-header {
      background-color: #15803d !important;
      color: #ffffff !important;
      border-color: #15803d !important;
      font-weight: 700;
      text-decoration: none !important;
    }

    .btn-success:hover,
    .btn-brand:hover,
    .btn-teal:hover,
    .btn-emerald:hover,
    .btn-outline-success:hover,
    .btn-outline-success:focus,
    .btn-outline-success:active,
    .hero-btn-primary:hover,
    .btn-apply-header:hover {
      background-color: #166534 !important;
      color: #ffffff !important;
      border-color: #166534 !important;
      transform: translateY(-2px);
      box-shadow: 0 8px 18px rgba(21, 128, 61, 0.35);
    }

    .btn-success *,
    .btn-brand *,
    .btn-teal *,
    .btn-emerald *,
    .btn-outline-success *,
    .hero-btn-primary *,
    .btn-apply-header * {
      color: #ffffff !important;
    }

    /* Fixed Floating Contact Buttons (Bottom-Right) */
    .floating-contact-actions {
      position: fixed;
      bottom: 24px;
      right: 20px;
      z-index: 1050;
      display: flex;
      flex-direction: column;
      gap: 12px;
      align-items: flex-end;
      pointer-events: none;
    }

    .floating-btn {
      pointer-events: auto;
      display: inline-flex;
      align-items: center;
      gap: 9px;
      padding: 10px 18px;
      border-radius: 50px;
      color: #ffffff !important;
      font-weight: 700;
      font-size: 0.88rem;
      text-decoration: none !important;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.22);
      transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
      border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .floating-btn i {
      font-size: 1.1rem;
      color: #ffffff !important;
    }

    .floating-btn-call {
      background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
    }

    .floating-btn-call:hover {
      background: linear-gradient(135deg, #15803d 0%, #166534 100%);
      transform: translateY(-3px) scale(1.03);
      box-shadow: 0 10px 25px rgba(22, 163, 74, 0.45);
      color: #ffffff !important;
    }

    .floating-btn-email {
      background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
    }

    .floating-btn-email:hover {
      background: linear-gradient(135deg, #0369a1 0%, #075985 100%);
      transform: translateY(-3px) scale(1.03);
      box-shadow: 0 10px 25px rgba(2, 132, 199, 0.45);
      color: #ffffff !important;
    }

    /* Mobile Floating Buttons */
    @media (max-width: 575.98px) {
      .floating-contact-actions {
        bottom: 18px;
        right: 14px;
        gap: 10px;
      }

      .floating-btn {
        width: 48px;
        height: 48px;
        padding: 0;
        border-radius: 50%;
        justify-content: center;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.28);
      }

      .floating-btn .floating-btn-label {
        display: none;
      }

      .floating-btn i {
        font-size: 1.2rem;
      }
    }

    .top-bar {
      background: #0f172a;
      color: #94a3b8;
      font-size: 0.875rem;
      padding: 0.5rem 0;
    }

    .top-bar a {
      color: #cbd5e1;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .top-bar a:hover {
      color: #22c55e;
    }

    .top-bar-badge {
      background: rgba(34, 197, 94, 0.15);
      color: #4ade80;
      padding: 0.25rem 0.75rem;
      border-radius: 50px;
      font-weight: 600;
      font-size: 0.75rem;
      border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .main-header {
      background: #ffffff;
      box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.05);
      position: sticky;
      top: 0;
      z-index: 1030;
    }

    .navbar-nav .nav-link {
      color: #334155;
      font-weight: 600;
      font-size: 0.95rem;
      padding: 0.6rem 1rem;
      transition: all 0.2s ease;
    }

    .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active {
      color: #15803d;
    }

    .btn-brand {
      background-color: #15803d;
      color: #ffffff;
      font-weight: 700;
      padding: 0.6rem 1.4rem;
      border-radius: 50px;
      border: none;
      transition: all 0.3s ease;
    }

    .btn-brand:hover {
      background-color: #166534;
      color: #ffffff;
      transform: translateY(-2px);
      box-shadow: 0 10px 20px -5px rgba(21, 128, 61, 0.4);
    }

    .main-footer {
      background: #0f172a;
      color: #94a3b8;
      padding-top: 4rem;
      padding-bottom: 2rem;
    }

    .footer-title {
      color: #ffffff;
      font-weight: 700;
      margin-bottom: 1.25rem;
      font-size: 1.1rem;
    }

    .footer-links {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .footer-links li {
      margin-bottom: 0.75rem;
    }

    .footer-links a {
      color: #94a3b8;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .footer-links a:hover {
      color: #4ade80;
    }

    /* Section Styling */
    .section-tag {
      color: #15803d;
      font-weight: 700;
      font-size: 0.85rem;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      display: inline-block;
      margin-bottom: 0.5rem;
    }

    .section-title {
      font-weight: 800;
      color: #0f172a;
      letter-spacing: -0.5px;
    }

    /* Job Card Styling matching Image 2 */
    .job-card {
      background: #ffffff;
      border-radius: 20px;
      overflow: hidden;
      border: 1px solid #e2e8f0;
      transition: all 0.3s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .job-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 30px -10px rgba(0,0,0,0.1);
      border-color: #cbd5e1;
    }

    .job-card-header {
      background: #19140a;
      color: #ffffff;
      padding: 1.5rem;
      position: relative;
      min-height: 200px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .job-card-header .logo-badge {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 4px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .job-card-header .logo-badge img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .job-card-header .pill-badge {
      background: #00b894;
      color: #ffffff;
      font-weight: 800;
      padding: 0.4rem 1.2rem;
      border-radius: 50px;
      font-size: 0.85rem;
      display: inline-block;
      text-align: center;
    }

    .job-card-header .avatar-illustration {
      position: absolute;
      right: 15px;
      bottom: 0;
      height: 140px;
    }

    .job-card-body {
      padding: 1.5rem;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      flex-grow: 1;
    }

    .job-card-title {
      font-weight: 800;
      font-size: 1.35rem;
      color: #0f172a;
      margin-bottom: 1.25rem;
      line-height: 1.3;
    }

    .btn-view-vacancies {
      color: #15803d;
      font-weight: 800;
      font-size: 1rem;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: gap 0.2s ease;
    }

    .btn-view-vacancies:hover {
      color: #166534;
      gap: 0.75rem;
    }

    /* Custom Pagination Styling */
    .custom-pagination-nav {
      width: 100%;
    }

    .pagination-custom {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .pagination-custom .page-item .page-link {
      color: #334155;
      background-color: #ffffff;
      border: 1px solid #e2e8f0;
      padding: 0.55rem 0.95rem;
      border-radius: 12px;
      font-weight: 700;
      font-size: 0.9rem;
      transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 42px;
      height: 42px;
      text-decoration: none;
    }

    .pagination-custom .page-item.active .page-link,
    .pagination-custom .page-item .page-link.active {
      background: linear-gradient(135deg, #15803d 0%, #16a34a 100%) !important;
      color: #ffffff !important;
      border-color: #15803d !important;
      box-shadow: 0 4px 14px rgba(21, 128, 61, 0.35);
      transform: translateY(-2px);
    }

    .pagination-custom .page-item:not(.active):not(.disabled) .page-link:hover {
      background-color: #f8fafc;
      color: #15803d;
      border-color: #cbd5e1;
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    .pagination-custom .page-item.disabled .page-link {
      color: #94a3b8;
      background-color: #f8fafc;
      border-color: #e2e8f0;
      cursor: not-allowed;
      box-shadow: none;
      opacity: 0.6;
    }

    /* Universal SVG Constraint: Never allow pagination or nav SVGs to explode in size */
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

    /* Sector Quick Chip Filter Styles */
    .sector-chip {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.45rem 1rem;
      border-radius: 50px;
      background: #ffffff;
      color: #475569;
      font-size: 0.85rem;
      font-weight: 600;
      border: 1px solid #e2e8f0;
      text-decoration: none;
      transition: all 0.2s ease;
      white-space: nowrap;
    }

    .sector-chip:hover, .sector-chip.active {
      background: #15803d;
      color: #ffffff;
      border-color: #15803d;
      box-shadow: 0 4px 10px rgba(21, 128, 61, 0.25);
      transform: translateY(-1px);
    }
  </style>

  @stack('styles')
</head>

<body>

  <!-- Top Announcement Bar -->
  <div class="top-bar">
    <div class="container d-flex justify-content-center align-items-center text-center">
      <span class="top-bar-badge"><i class="fas fa-certificate me-1"></i> ISO Certified | UDYAM-WB-11-0035754</span>
    </div>
  </div>

  <!-- Main Header & Dynamic Navigation -->
  <header class="main-header">
    <nav class="navbar navbar-expand-lg py-3">
      <div class="container">
        <a class="navbar-brand py-0 d-flex align-items-center" href="{{ route('home') }}" aria-label="{{ $siteName ?? 'Bright Future Consultancy' }}">
          <img src="{{ asset($siteLogo ?? 'assets/images/logo.png') }}" alt="{{ $siteName ?? 'Bright Future Consultancy' }}" class="site-logo-img">
        </a>
        <button class="navbar-toggler border-0 shadow-none px-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
          <ul class="navbar-nav mx-auto mb-3 mb-lg-0 py-2 py-lg-0">
            <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('jobs.*') ? 'active' : '' }}" href="{{ route('jobs.index') }}">Jobs & Vacancies</a></li>
            <li class="nav-item"><a class="nav-link px-3" href="{{ url('/categories.html') }}">Manpower Sectors</a></li>
            <li class="nav-item"><a class="nav-link px-3" href="{{ url('/companies.html') }}">Companies</a></li>
            <li class="nav-item"><a class="nav-link px-3" href="{{ url('/about.html') }}">About Us</a></li>
            <li class="nav-item"><a class="nav-link px-3" href="{{ url('/contact.html') }}">Contact</a></li>
          </ul>
          <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-lg-center gap-2 gap-lg-3 pt-2 pt-lg-0 border-top border-lg-0">
            <a href="https://wa.me/91{{ $whatsappNumber ?? '7001420469' }}" target="_blank" class="btn btn-brand text-center">
              <i class="fab fa-whatsapp me-1"></i> WhatsApp Jobs
            </a>
            <a href="{{ route('admin.login') }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 btn-sm fw-semibold text-center">
              <i class="fas fa-user-lock me-1"></i> Admin Portal
            </a>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <!-- Page Main Content -->
  <main>
    @yield('content')
  </main>

  <!-- Dynamic Main Footer -->
  <footer class="main-footer">
    <div class="container">
      <div class="row g-4 mb-5">
        <div class="col-lg-4">
          <div class="d-flex align-items-center gap-3 mb-3">
            <img src="{{ asset($siteLogo ?? 'assets/images/logo.png') }}" alt="{{ $siteName ?? 'Bright Future Consultancy' }}" class="site-logo-img bg-white p-2 rounded-3 shadow-sm" style="max-height: 52px; width: auto;">
            <div class="d-flex flex-column text-start">
              <span class="fw-bold text-white fs-5 leading-tight">{{ $siteName ?? 'Bright Future Consultancy' }}</span>
              <small class="text-success fw-semibold">{{ $siteTagline ?? 'HR & Educational Consulting' }}</small>
            </div>
          </div>
          <p class="text-secondary mb-4">{{ $footerAbout ?? 'Bright Future Consultancy is a premier HR and educational consulting agency in West Bengal, providing 100% genuine job updates and career guidance.' }}</p>
          <div class="d-flex gap-2">
            <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="btn btn-outline-light btn-sm rounded-circle" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/91{{ $whatsappNumber ?? '7001420469' }}" target="_blank" class="btn btn-outline-light btn-sm rounded-circle" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;"><i class="fab fa-whatsapp"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-md-4">
          <h5 class="footer-title">Quick Links</h5>
          <ul class="footer-links">
            <li><a href="{{ route('home') }}">Home Page</a></li>
            <li><a href="{{ route('jobs.index') }}">Browse Jobs</a></li>
            <li><a href="{{ url('/categories.html') }}">Manpower Sectors</a></li>
            <li><a href="{{ url('/about.html') }}">About Our Agency</a></li>
            <li><a href="{{ url('/contact.html') }}">Get in Touch</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-4">
          <h5 class="footer-title">Manpower Sectors</h5>
          <ul class="footer-links">
            <li><a href="{{ route('jobs.index', ['sector' => 'overseas']) }}">Overseas Jobs (Gulf & Europe)</a></li>
            <li><a href="{{ route('jobs.index', ['sector' => 'airlines']) }}">Airlines Ground Staff</a></li>
            <li><a href="{{ route('jobs.index', ['sector' => 'backoffice']) }}">Back Office & Data Entry</a></li>
            <li><a href="{{ route('jobs.index', ['sector' => 'logistics']) }}">Driver & Logistics Jobs</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-4">
          <h5 class="footer-title">Official Contact</h5>
          <ul class="footer-links text-secondary">
            <li class="d-flex align-items-start gap-2">
              <i class="fas fa-map-marker-alt text-success mt-1"></i>
              <span>Barrackpore, Kolkata-700121, West Bengal</span>
            </li>
            <li class="d-flex align-items-center gap-2">
              <i class="fas fa-phone-alt text-success"></i>
              <span>{{ $contactPhone ?? '+91 7001420469' }}</span>
            </li>
            <li class="d-flex align-items-center gap-2">
              <i class="fas fa-envelope text-success"></i>
              <span>{{ $contactEmail ?? 'brightfutureconsultancybwn@gmail.com' }}</span>
            </li>
          </ul>
        </div>
      </div>
      <hr class="border-secondary opacity-25 my-4">
      <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 text-secondary text-sm">
        <p class="mb-0">&copy; {{ date('Y') }} Bright Future Consultancy. All rights reserved.</p>
        <p class="mb-0">Designed for 100% Dynamic Management</p>
      </div>
    </div>
  </footer>

  <!-- Fixed Floating Contact Action Buttons (Bottom-Right) -->
  <div class="floating-contact-actions" aria-label="Quick Contact">
    <!-- Call Button -->
    <a href="tel:{{ str_replace(' ', '', $contactPhone ?? '7001420469') }}" class="floating-btn floating-btn-call" title="Call Helpline (+91 7001420469)" aria-label="Call Helpline">
      <i class="fas fa-phone-alt"></i>
      <span class="floating-btn-label">Call Us</span>
    </a>

    <!-- Email Button -->
    <a href="mailto:{{ $contactEmail ?? 'brightfutureconsultancybwn@gmail.com' }}" class="floating-btn floating-btn-email" title="Send Email" aria-label="Send Email">
      <i class="fas fa-envelope"></i>
      <span class="floating-btn-label">Email Us</span>
    </a>
  </div>

  <!-- Candidate Registration Modal (Apply Now Flow) -->
  @include('frontend.partials.apply-modal')

  <!-- JS Dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>

</html>

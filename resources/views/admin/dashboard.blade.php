@extends('admin.layout')

@section('title', 'Dashboard Overview - Admin Portal')
@section('page_header', 'Dashboard Overview')

@section('content')

<!-- Quick Statistics Row (Responsive 2x2 Grid on Mobile, 4-col on Desktop) -->
<div class="row g-2 g-md-3 mb-4">
  <!-- Stat 1: Total Jobs -->
  <div class="col-6 col-lg-3">
    <div class="card card-custom p-3 p-md-4 bg-white h-100 shadow-sm border-0">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <span class="text-secondary small fw-bold text-uppercase d-block" style="font-size: 0.72rem; letter-spacing: 0.5px;">Total Jobs</span>
          <h3 class="fw-extrabold text-dark mb-0 mt-1 fs-3 fs-md-2">{{ \App\Models\Job::count() }}</h3>
        </div>
        <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 p-md-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px;">
          <i class="fas fa-briefcase fa-lg"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Stat 2: Active Vacancies -->
  <div class="col-6 col-lg-3">
    <div class="card card-custom p-3 p-md-4 bg-white h-100 shadow-sm border-0">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <span class="text-secondary small fw-bold text-uppercase d-block" style="font-size: 0.72rem; letter-spacing: 0.5px;">Active Vacancies</span>
          <h3 class="fw-extrabold text-success mb-0 mt-1 fs-3 fs-md-2">{{ \App\Models\Job::active()->count() }}</h3>
        </div>
        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 p-md-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px;">
          <i class="fas fa-check-circle fa-lg"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Stat 3: Job Applications -->
  <div class="col-6 col-lg-3">
    <div class="card card-custom p-3 p-md-4 bg-white h-100 shadow-sm border-0">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <span class="text-secondary small fw-bold text-uppercase d-block" style="font-size: 0.72rem; letter-spacing: 0.5px;">Applications</span>
          <h3 class="fw-extrabold text-warning mb-0 mt-1 fs-3 fs-md-2">{{ \App\Models\JobApplication::count() }}</h3>
        </div>
        <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-2 p-md-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px;">
          <i class="fas fa-user-graduate fa-lg"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Stat 4: Contact Messages -->
  <div class="col-6 col-lg-3">
    <div class="card card-custom p-3 p-md-4 bg-white h-100 shadow-sm border-0">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <span class="text-secondary small fw-bold text-uppercase d-block" style="font-size: 0.72rem; letter-spacing: 0.5px;">Inquiries</span>
          <h3 class="fw-extrabold text-info mb-0 mt-1 fs-3 fs-md-2">{{ \App\Models\ContactInquiry::count() }}</h3>
        </div>
        <div class="bg-info bg-opacity-10 text-info rounded-circle p-2 p-md-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px;">
          <i class="fas fa-envelope-open-text fa-lg"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Admin Management Sections with Clear Title Separators -->
<div class="row g-3 g-md-4">

  <!-- SEPARATOR: JOBS CRUD -->
  <div class="col-12 col-md-6">
    <div class="card card-custom p-3 p-md-4 h-100 shadow-sm border-0">
      <div class="d-flex align-items-center gap-3 mb-3">
        <div class="bg-warning text-dark rounded-3 p-2 p-md-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px;">
          <i class="fas fa-briefcase fa-lg"></i>
        </div>
        <div>
          <h5 class="fw-bold text-dark mb-0">Jobs & Vacancies (CRUD)</h5>
          <small class="text-secondary">Full Create, View, Edit, Update, Delete</small>
        </div>
      </div>
      <p class="text-secondary small mb-4">
        Create Single Job posts, update salary/qualifications, replace job card poster images, and manage vacancy listings.
      </p>
      <div class="mt-auto d-flex flex-column flex-sm-row gap-2">
        <a href="{{ route('admin.jobs.index') }}" class="btn btn-dark fw-bold rounded-pill px-4 text-center">
          <i class="fas fa-list me-1"></i> All Jobs List
        </a>
        <a href="{{ route('admin.jobs.create') }}" class="btn btn-success fw-bold rounded-pill px-4 text-center">
          <i class="fas fa-plus-circle me-1"></i> Add New Job
        </a>
      </div>
    </div>
  </div>

  <!-- SEPARATOR: CANDIDATE APPLICATIONS -->
  <div class="col-12 col-md-6">
    <div class="card card-custom p-3 p-md-4 h-100 shadow-sm border-0">
      <div class="d-flex align-items-center gap-3 mb-3">
        <div class="bg-primary text-white rounded-3 p-2 p-md-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px;">
          <i class="fas fa-user-graduate fa-lg"></i>
        </div>
        <div>
          <h5 class="fw-bold text-dark mb-0">Candidate Applications</h5>
          <small class="text-secondary">Registered jobseekers profiles</small>
        </div>
      </div>
      <p class="text-secondary small mb-4">
        Review candidate registration forms, qualification details, preferred job sectors, and connect on WhatsApp.
      </p>
      <div class="mt-auto d-flex flex-column flex-sm-row gap-2">
        <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-primary fw-bold rounded-pill px-4 text-center">
          <i class="fas fa-users me-1"></i> View Applications ({{ \App\Models\JobApplication::count() }})
        </a>
      </div>
    </div>
  </div>

  <!-- SEPARATOR: CONTACT INQUIRIES -->
  <div class="col-12 col-md-6">
    <div class="card card-custom p-3 p-md-4 h-100 shadow-sm border-0">
      <div class="d-flex align-items-center gap-3 mb-3">
        <div class="bg-danger text-white rounded-3 p-2 p-md-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px;">
          <i class="fas fa-envelope-open-text fa-lg"></i>
        </div>
        <div>
          <h5 class="fw-bold text-dark mb-0">Contact Inquiries</h5>
          <small class="text-secondary">Messages from Contact Us page</small>
        </div>
      </div>
      <p class="text-secondary small mb-4">
        Read incoming messages from job candidates, students, and employers looking to partner with Bright Future.
      </p>
      <div class="mt-auto d-flex flex-column flex-sm-row gap-2">
        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline-danger fw-bold rounded-pill px-4 text-center">
          <i class="fas fa-inbox me-1"></i> View Messages ({{ \App\Models\ContactInquiry::count() }})
        </a>
      </div>
    </div>
  </div>

  <!-- SEPARATOR: HOME PAGE SECTIONS -->
  <div class="col-12 col-md-6">
    <div class="card card-custom p-3 p-md-4 h-100 shadow-sm border-0">
      <div class="d-flex align-items-center gap-3 mb-3">
        <div class="bg-info text-white rounded-3 p-2 p-md-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px;">
          <i class="fas fa-layer-group fa-lg"></i>
        </div>
        <div>
          <h5 class="fw-bold text-dark mb-0">Home Page Sections</h5>
          <small class="text-secondary">Dynamic Section Customization</small>
        </div>
      </div>
      <p class="text-secondary small mb-4">
        Edit section titles, text, buttons, CEO card details, and upload section banners live.
      </p>
      <div class="mt-auto d-flex flex-column flex-sm-row gap-2">
        <a href="{{ route('admin.home.index') }}" class="btn btn-outline-info fw-bold rounded-pill px-4 text-center">
          <i class="fas fa-edit me-1"></i> Manage Home Sections
        </a>
      </div>
    </div>
  </div>

  <!-- SEPARATOR: LOGO MANAGEMENT -->
  <div class="col-12 col-md-6">
    <div class="card card-custom p-3 p-md-4 h-100 shadow-sm border-0">
      <div class="d-flex align-items-center gap-3 mb-3">
        <div class="bg-success text-white rounded-3 p-2 p-md-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px;">
          <i class="fas fa-image fa-lg"></i>
        </div>
        <div>
          <h5 class="fw-bold text-dark mb-0">Logo Management</h5>
          <small class="text-secondary">Upload & update site logo (PNG/JPG/SVG/WEBP)</small>
        </div>
      </div>
      <p class="text-secondary small mb-4">
        Change the agency logo displayed across all website pages including header, footer, and mobile navigation.
      </p>
      <div class="mt-auto d-flex flex-column flex-sm-row gap-2">
        <a href="{{ route('admin.logo.index') }}" class="btn btn-success fw-bold rounded-pill px-4 text-center">
          <i class="fas fa-upload me-1"></i> Manage Site Logo
        </a>
      </div>
    </div>
  </div>

  <!-- SEPARATOR: WEBSITE SETTINGS -->
  <div class="col-12 col-md-6">
    <div class="card card-custom p-3 p-md-4 h-100 shadow-sm border-0">
      <div class="d-flex align-items-center gap-3 mb-3">
        <div class="bg-secondary text-white rounded-3 p-2 p-md-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px;">
          <i class="fas fa-sliders-h fa-lg"></i>
        </div>
        <div>
          <h5 class="fw-bold text-dark mb-0">Website Settings</h5>
          <small class="text-secondary">Helpline phone, Email & Address</small>
        </div>
      </div>
      <p class="text-secondary small mb-4">
        Update agency title, contact phone number, official email, address, and WhatsApp contact link.
      </p>
      <div class="mt-auto d-flex flex-column flex-sm-row gap-2">
        <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary fw-bold rounded-pill px-4 text-center">
          <i class="fas fa-cog me-1"></i> Edit Settings
        </a>
      </div>
    </div>
  </div>

</div>

@endsection

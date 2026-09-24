@extends('admin.layout')

@section('title', 'Dashboard Overview - Admin Portal')
@section('page_header', 'Dashboard Overview')

@section('content')

<!-- Quick Statistics Row -->
<div class="row g-4 mb-4">
  <div class="col-md-3">
    <div class="card card-custom p-4 bg-white">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <span class="text-secondary small fw-bold text-uppercase">Total Job Posts</span>
          <h2 class="fw-extrabold text-dark mb-0 mt-1">{{ \App\Models\Job::count() }}</h2>
        </div>
        <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
          <i class="fas fa-briefcase fa-lg"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card card-custom p-4 bg-white">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <span class="text-secondary small fw-bold text-uppercase">Active Vacancies</span>
          <h2 class="fw-extrabold text-success mb-0 mt-1">{{ \App\Models\Job::active()->count() }}</h2>
        </div>
        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
          <i class="fas fa-check-circle fa-lg"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card card-custom p-4 bg-white">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <span class="text-secondary small fw-bold text-uppercase">Job Applications</span>
          <h2 class="fw-extrabold text-warning mb-0 mt-1">{{ \App\Models\JobApplication::count() }}</h2>
        </div>
        <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
          <i class="fas fa-user-graduate fa-lg"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card card-custom p-4 bg-white">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <span class="text-secondary small fw-bold text-uppercase">Contact Messages</span>
          <h2 class="fw-extrabold text-info mb-0 mt-1">{{ \App\Models\ContactInquiry::count() }}</h2>
        </div>
        <div class="bg-info bg-opacity-10 text-info rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
          <i class="fas fa-envelope-open-text fa-lg"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Admin Management Sections with Clear Title Separators -->
<div class="row g-4">

  <!-- SEPARATOR: JOBS CRUD -->
  <div class="col-md-6">
    <div class="card card-custom p-4 h-100">
      <div class="d-flex align-items-center gap-3 mb-3">
        <div class="bg-warning text-dark rounded-3 p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
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
      <div class="mt-auto d-flex gap-2">
        <a href="{{ route('admin.jobs.index') }}" class="btn btn-dark fw-bold rounded-pill px-4">All Jobs List</a>
        <a href="{{ route('admin.jobs.create') }}" class="btn btn-success fw-bold rounded-pill px-4">+ Add New Single Job</a>
      </div>
    </div>
  </div>

  <!-- SEPARATOR: CANDIDATE APPLICATIONS -->
  <div class="col-md-6">
    <div class="card card-custom p-4 h-100">
      <div class="d-flex align-items-center gap-3 mb-3">
        <div class="bg-primary text-white rounded-3 p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
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
      <div class="mt-auto">
        <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-primary fw-bold rounded-pill px-4">
          <i class="fas fa-users me-1"></i> View Applications ({{ \App\Models\JobApplication::count() }})
        </a>
      </div>
    </div>
  </div>

  <!-- SEPARATOR: CONTACT INQUIRIES -->
  <div class="col-md-6">
    <div class="card card-custom p-4 h-100">
      <div class="d-flex align-items-center gap-3 mb-3">
        <div class="bg-danger text-white rounded-3 p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
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
      <div class="mt-auto">
        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline-danger fw-bold rounded-pill px-4">
          <i class="fas fa-inbox me-1"></i> View Messages ({{ \App\Models\ContactInquiry::count() }})
        </a>
      </div>
    </div>
  </div>

  <!-- SEPARATOR: HOME PAGE SECTIONS -->
  <div class="col-md-6">
    <div class="card card-custom p-4 h-100">
      <div class="d-flex align-items-center gap-3 mb-3">
        <div class="bg-info text-white rounded-3 p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
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
      <div class="mt-auto">
        <a href="{{ route('admin.home.index') }}" class="btn btn-outline-info fw-bold rounded-pill px-4">
          <i class="fas fa-edit me-1"></i> Manage Home Sections
        </a>
      </div>
    </div>
  </div>

  <!-- SEPARATOR: LOGO MANAGEMENT -->
  <div class="col-md-6">
    <div class="card card-custom p-4 h-100">
      <div class="d-flex align-items-center gap-3 mb-3">
        <div class="bg-success text-white rounded-3 p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
          <i class="fas fa-image fa-lg"></i>
        </div>
        <div>
          <h5 class="fw-bold text-dark mb-0">Logo Management</h5>
          <small class="text-secondary">Upload & update site logo (PNG/JPG/SVG)</small>
        </div>
      </div>
      <p class="text-secondary small mb-4">
        Change the agency logo displayed across all website pages including header, footer, and mobile navigation.
      </p>
      <div class="mt-auto">
        <a href="{{ route('admin.logo.index') }}" class="btn btn-outline-success fw-bold rounded-pill px-4">
          <i class="fas fa-upload me-1"></i> Manage Site Logo
        </a>
      </div>
    </div>
  </div>

  <!-- SEPARATOR: WEBSITE SETTINGS -->
  <div class="col-md-6">
    <div class="card card-custom p-4 h-100">
      <div class="d-flex align-items-center gap-3 mb-3">
        <div class="bg-secondary text-white rounded-3 p-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
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
      <div class="mt-auto">
        <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary fw-bold rounded-pill px-4">
          <i class="fas fa-cog me-1"></i> Edit Settings
        </a>
      </div>
    </div>
  </div>

</div>

@endsection

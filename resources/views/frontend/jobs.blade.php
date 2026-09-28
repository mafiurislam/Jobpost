@extends('layouts.app')

@section('title', 'Jobs & Vacancies - Bright Future Consultancy')
@section('meta_description', 'Browse all 100% free verified job vacancies across Airlines, Overseas, IT, Banking, Logistics, and Supermarket retail in West Bengal and Pan-India.')

@section('content')

<!-- Header Banner -->
<section class="py-5 text-white text-center position-relative" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
  <div class="container py-3">
    <div class="d-inline-flex align-items-center gap-2 mb-3">
      <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-30 rounded-pill px-3 py-2 fw-bold">
        <i class="fas fa-check-circle me-1"></i> 100% VERIFIED VACANCIES
      </span>
      <span class="badge bg-light bg-opacity-10 text-light border border-light border-opacity-20 rounded-pill px-3 py-2 fw-semibold">
        Zero Registration Fee
      </span>
    </div>
    <h1 class="display-5 fw-extrabold text-white mb-2" style="letter-spacing: -0.5px;">All Jobs & Vacancies</h1>
    <p class="lead text-light opacity-90 mx-auto mb-0" style="max-width: 650px; font-size: 1.1rem;">
      Browse open positions across West Bengal & Pan-India. Connect directly with employers on company payroll.
    </p>
  </div>
</section>

<!-- Filter & Search Section -->
<section class="py-4 bg-white border-bottom shadow-sm sticky-top" style="top: 76px; z-index: 1020;">
  <div class="container">
    <form action="{{ route('jobs.index') }}" method="GET" class="row g-2 align-items-center">
      
      <!-- Keyword Input -->
      <div class="col-lg-4 col-md-6">
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-search"></i></span>
          <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control bg-light border-start-0" placeholder="Job title, company, or keyword...">
        </div>
      </div>

      <!-- Sector Dropdown with All Major Sectors -->
      <div class="col-lg-3 col-md-6">
        <select name="sector" class="form-select bg-light">
          <option value="">All Manpower Sectors</option>
          <option value="overseas" {{ request('sector') == 'overseas' ? 'selected' : '' }}>Overseas Vacancies (Gulf & Europe)</option>
          <option value="airlines" {{ request('sector') == 'airlines' ? 'selected' : '' }}>Airlines Ground Staff & Cargo</option>
          <option value="backoffice" {{ request('sector') == 'backoffice' ? 'selected' : '' }}>Back Office & Data Entry</option>
          <option value="logistics" {{ request('sector') == 'logistics' ? 'selected' : '' }}>Driver & Logistics</option>
          <option value="banking" {{ request('sector') == 'banking' ? 'selected' : '' }}>Banking & Financial Services</option>
          <option value="supermarket" {{ request('sector') == 'supermarket' ? 'selected' : '' }}>Supermarket & Retail Store</option>
          <option value="technical" {{ request('sector') == 'technical' ? 'selected' : '' }}>AC & Refrigeration Maintenance</option>
          <option value="medical" {{ request('sector') == 'medical' ? 'selected' : '' }}>Medical & Hospital Staff</option>
          <option value="auto" {{ request('sector') == 'auto' ? 'selected' : '' }}>Automobile & Manufacturing</option>
          <option value="security" {{ request('sector') == 'security' ? 'selected' : '' }}>Security Guard & Forces</option>
          <option value="bpo" {{ request('sector') == 'bpo' ? 'selected' : '' }}>Call Centre & BPO</option>
          <option value="naps" {{ request('sector') == 'naps' ? 'selected' : '' }}>Apprenticeship (NAPS Scheme)</option>
          <option value="govt" {{ request('sector') == 'govt' ? 'selected' : '' }}>Govt. Contractual Staff</option>
        </select>
      </div>

      <!-- Location Input -->
      <div class="col-lg-3 col-md-8">
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-map-marker-alt"></i></span>
          <input type="text" name="location" value="{{ request('location') }}" class="form-control bg-light border-start-0" placeholder="Location (e.g. Barddhaman, Kolkata)...">
        </div>
      </div>

      <!-- Filter Button -->
      <div class="col-lg-2 col-md-4 d-grid">
        <button type="submit" class="btn btn-brand fw-bold shadow-sm">
          <i class="fas fa-filter me-1"></i> Filter Jobs
        </button>
      </div>
    </form>

    <!-- Quick Category Filter Chips -->
    <div class="d-flex align-items-center gap-2 mt-3 overflow-auto pb-1" style="scrollbar-width: none;">
      <span class="text-secondary small fw-bold text-uppercase me-1" style="font-size: 0.75rem; letter-spacing: 1px;">Quick:</span>
      <a href="{{ route('jobs.index') }}" class="sector-chip {{ !request('sector') ? 'active' : '' }}">
        All Jobs
      </a>
      <a href="{{ route('jobs.index', ['sector' => 'overseas']) }}" class="sector-chip {{ request('sector') == 'overseas' ? 'active' : '' }}">
        <i class="fas fa-plane"></i> Overseas
      </a>
      <a href="{{ route('jobs.index', ['sector' => 'airlines']) }}" class="sector-chip {{ request('sector') == 'airlines' ? 'active' : '' }}">
        <i class="fas fa-ticket-alt"></i> Airlines
      </a>
      <a href="{{ route('jobs.index', ['sector' => 'backoffice']) }}" class="sector-chip {{ request('sector') == 'backoffice' ? 'active' : '' }}">
        <i class="fas fa-laptop"></i> Back Office
      </a>
      <a href="{{ route('jobs.index', ['sector' => 'logistics']) }}" class="sector-chip {{ request('sector') == 'logistics' ? 'active' : '' }}">
        <i class="fas fa-truck"></i> Logistics
      </a>
      <a href="{{ route('jobs.index', ['sector' => 'banking']) }}" class="sector-chip {{ request('sector') == 'banking' ? 'active' : '' }}">
        <i class="fas fa-university"></i> Banking
      </a>
      <a href="{{ route('jobs.index', ['sector' => 'supermarket']) }}" class="sector-chip {{ request('sector') == 'supermarket' ? 'active' : '' }}">
        <i class="fas fa-shopping-basket"></i> Supermarket
      </a>
      <a href="{{ route('jobs.index', ['sector' => 'technical']) }}" class="sector-chip {{ request('sector') == 'technical' ? 'active' : '' }}">
        <i class="fas fa-wrench"></i> Technical / AC
      </a>
      <a href="{{ route('jobs.index', ['sector' => 'medical']) }}" class="sector-chip {{ request('sector') == 'medical' ? 'active' : '' }}">
        <i class="fas fa-hospital-user"></i> Medical
      </a>
    </div>

  </div>
</section>

<!-- Dynamic Job Cards Listing Grid -->
<section class="py-5 bg-light">
  <div class="container">
    
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
      <div>
        <h4 class="fw-extrabold text-dark mb-0">Open Vacancies</h4>
        <span class="text-secondary small">Showing verified placement opportunities</span>
      </div>
      <div class="text-secondary small">
        Found <strong class="text-dark">{{ $jobs->total() }}</strong> total opportunities
      </div>
    </div>

    <div class="row g-4">
      @forelse($jobs as $job)
      <div class="col-md-6 col-lg-4">
        <div class="job-card shadow-sm">
          
          <!-- Job Card Graphic Header -->
          @if($job->poster_image)
            <div class="job-card-header p-0 overflow-hidden text-center bg-dark position-relative" style="min-height: 200px;">
              <img src="{{ $job->image_url }}" alt="{{ $job->title }}" class="w-100 h-100 object-fit-cover" style="min-height: 200px; max-height: 220px;">
              <span class="pill-badge position-absolute top-0 end-0 m-3 shadow-sm">
                {{ $job->badge_tag ?? '100% FREE PLACEMENT' }}
              </span>
            </div>
          @else
            <div class="job-card-header">
              <div class="d-flex justify-content-between align-items-start">
                <div class="logo-badge">
                  <img src="{{ asset($siteLogo ?? 'assets/images/logo.png') }}" alt="{{ $siteName }}">
                </div>
                <span class="pill-badge">{{ $job->badge_tag ?? '100% FREE JOBS' }}</span>
              </div>
              <div class="mt-3">
                <p class="text-warning fw-bold mb-0 text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">
                  JOB VACANCY {{ date('Y') }} • {{ $job->location }}
                </p>
                <p class="text-white-50 small mb-0">{{ $job->qualification }}</p>
              </div>
              <div class="avatar-illustration opacity-75 d-none d-sm-block">
                <i class="fas fa-user-tie fa-7x text-white-50 opacity-20"></i>
              </div>
            </div>
          @endif

          <!-- Job Card Body -->
          <div class="job-card-body p-4">
            <div>
              <h4 class="job-card-title mb-2" style="font-size: 1.25rem;">
                <a href="{{ route('jobs.show', $job->id) }}" class="text-dark text-decoration-none">
                  {{ $job->title }}
                </a>
              </h4>
              <p class="text-secondary small mb-3">
                <i class="fas fa-building text-success me-1"></i> {{ $job->company }}
              </p>

              <!-- Salary & Qualification Pills -->
              <div class="d-flex flex-wrap gap-2 mb-3">
                <span class="badge px-3 py-2 rounded-pill fw-bold" style="background-color: #e6f4ea; color: #15803d; border: 1px solid rgba(22, 163, 74, 0.3); font-size: 0.85rem;">
                  <i class="fas fa-rupee-sign me-1"></i> {{ $job->salary }}
                </span>
                <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill fw-semibold" style="font-size: 0.8rem;">
                  <i class="fas fa-user-graduate me-1"></i> {{ $job->qualification }}
                </span>
                <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill fw-semibold" style="font-size: 0.8rem;">
                  <i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ Str::limit($job->location, 20) }}
                </span>
              </div>

              <p class="text-muted small mb-0" style="line-height: 1.6;">
                {{ Str::limit($job->description, 95) }}
              </p>
            </div>

            <!-- Card Action Footer -->
            <div class="pt-3 mt-3 border-top border-light d-flex align-items-center justify-content-between">
              <a href="{{ route('jobs.show', $job->id) }}" class="btn-view-vacancies">
                View Details <i class="fas fa-arrow-right"></i>
              </a>

              <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold btn-open-apply-modal"
                      data-job-title="{{ $job->title }}"
                      data-job-sector="{{ $job->sector_name ?? $job->sector_slug }}"
                      data-job-location="{{ $job->location }}"
                      style="border-color: #15803d; color: #15803d;">
                APPLY NOW
              </button>
            </div>

          </div>

        </div>
      </div>
      @empty
      <div class="col-12 text-center py-5">
        <div class="bg-white p-5 rounded-4 shadow-sm max-w-lg mx-auto">
          <i class="fas fa-search fa-3x text-muted mb-3"></i>
          <h4 class="fw-bold text-dark">No jobs matching your filter</h4>
          <p class="text-secondary mb-4">Try searching with different keywords or reset filters to browse all open vacancies.</p>
          <a href="{{ route('jobs.index') }}" class="btn btn-brand">View All Jobs</a>
        </div>
      </div>
      @endforelse
    </div>

    <!-- Polished Custom Pagination -->
    <div class="mt-5 pt-3 d-flex justify-content-center">
      {{ $jobs->withQueryString()->links('vendor.pagination.custom') }}
    </div>

  </div>
</section>

@endsection

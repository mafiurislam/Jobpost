@extends('layouts.app')

@section('title', 'Our Services - Bright Future Consultancy')
@section('meta_description', 'Explore 100% free job placement, corporate manpower staffing, skill courses, certificate verification, and career counseling in West Bengal.')

@section('content')

<!-- Page Banner Header -->
<section class="py-5 text-center" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff;">
  <div class="container py-4">
    <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-30 rounded-pill px-3 py-2 fw-bold mb-2">SOLUTIONS WE OFFER</span>
    <h1 class="display-5 fw-extrabold text-white mb-3" style="letter-spacing: -0.5px;">Our Consulting Services</h1>
    <p class="lead text-light opacity-90 mx-auto mb-0" style="max-width: 700px; font-size: 1.15rem;">
      Empowering students and jobseekers with comprehensive career guidance, training, and 100% free job placement solutions.
    </p>
  </div>
</section>

<!-- 6 Core Services Grid -->
<section class="py-5 bg-white">
  <div class="container py-4">
    <div class="row g-4">
      
      <!-- Service 1 -->
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 border-top border-4 border-success bg-light">
          <div class="bg-success text-white p-3 rounded-circle d-inline-flex mb-3 align-self-start" style="width: 54px; height: 54px; align-items: center; justify-content: center;">
            <i class="fas fa-user-tie fa-lg"></i>
          </div>
          <h4 class="fw-bold text-dark mb-2">100% Free Job Placement</h4>
          <p class="text-secondary small mb-4" style="line-height: 1.7;">
            We connect jobseekers in West Bengal with top verified employers across 19+ industries with zero registration or placement fees.
          </p>
          <a href="{{ route('jobs.index') }}" class="text-success fw-bold text-decoration-none mt-auto d-inline-flex align-items-center">
            Browse Jobs <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
      </div>

      <!-- Service 2 -->
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 border-top border-4 border-success bg-light">
          <div class="bg-primary text-white p-3 rounded-circle d-inline-flex mb-3 align-self-start" style="width: 54px; height: 54px; align-items: center; justify-content: center;">
            <i class="fas fa-building fa-lg"></i>
          </div>
          <h4 class="fw-bold text-dark mb-2">Corporate Manpower Supply</h4>
          <p class="text-secondary small mb-4" style="line-height: 1.7;">
            Providing pre-screened manpower for retail supermarkets, banking, IT, logistics, and technical manufacturing plants.
          </p>
          <a href="{{ url('/companies.html') }}" class="text-success fw-bold text-decoration-none mt-auto d-inline-flex align-items-center">
            Hiring Solutions <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
      </div>

      <!-- Service 3 -->
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 border-top border-4 border-success bg-light">
          <div class="bg-warning text-dark p-3 rounded-circle d-inline-flex mb-3 align-self-start" style="width: 54px; height: 54px; align-items: center; justify-content: center;">
            <i class="fas fa-graduation-cap fa-lg"></i>
          </div>
          <h4 class="fw-bold text-dark mb-2">Skill Courses & Training</h4>
          <p class="text-secondary small mb-4" style="line-height: 1.7;">
            Job-oriented vocational training in MS Excel, Computer Operator, Back Office, Spoken English, and Technical Trades.
          </p>
          <a href="{{ url('/join.html') }}" class="text-success fw-bold text-decoration-none mt-auto d-inline-flex align-items-center">
            Join Program <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
      </div>

      <!-- Service 4 -->
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 border-top border-4 border-success bg-light">
          <div class="bg-info text-white p-3 rounded-circle d-inline-flex mb-3 align-self-start" style="width: 54px; height: 54px; align-items: center; justify-content: center;">
            <i class="fas fa-certificate fa-lg"></i>
          </div>
          <h4 class="fw-bold text-dark mb-2">Certificate Verification</h4>
          <p class="text-secondary small mb-4" style="line-height: 1.7;">
            ISO 9001:2015 certified candidate credential authentication and official student roll number validation service.
          </p>
          <a href="{{ url('/certificate.html') }}" class="text-success fw-bold text-decoration-none mt-auto d-inline-flex align-items-center">
            Verify Certificate <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
      </div>

      <!-- Service 5 -->
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 border-top border-4 border-success bg-light">
          <div class="bg-danger text-white p-3 rounded-circle d-inline-flex mb-3 align-self-start" style="width: 54px; height: 54px; align-items: center; justify-content: center;">
            <i class="fas fa-comments fa-lg"></i>
          </div>
          <h4 class="fw-bold text-dark mb-2">Career Counseling</h4>
          <p class="text-secondary small mb-4" style="line-height: 1.7;">
            One-on-one resume building, interview etiquette coaching, and industry alignment consulting for freshers and professionals.
          </p>
          <a href="{{ url('/contact.html') }}" class="text-success fw-bold text-decoration-none mt-auto d-inline-flex align-items-center">
            Get Counseling <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
      </div>

      <!-- Service 6 -->
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 border-top border-4 border-success bg-light">
          <div class="bg-secondary text-white p-3 rounded-circle d-inline-flex mb-3 align-self-start" style="width: 54px; height: 54px; align-items: center; justify-content: center;">
            <i class="fas fa-school fa-lg"></i>
          </div>
          <h4 class="fw-bold text-dark mb-2">NIOS Schooling Support</h4>
          <p class="text-secondary small mb-4" style="line-height: 1.7;">
            Guidance and registration assistance for open schooling programs (10th & 12th standard) to help candidates qualify for corporate jobs.
          </p>
          <a href="{{ url('/contact.html') }}" class="text-success fw-bold text-decoration-none mt-auto d-inline-flex align-items-center">
            Contact Support <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Step-by-Step Placement Process -->
<section class="py-5 bg-light">
  <div class="container py-4">
    <div class="text-center max-w-xl mx-auto mb-5">
      <span class="text-success fw-bold text-uppercase small" style="letter-spacing: 1.5px;">HOW IT WORKS</span>
      <h2 class="fw-extrabold text-dark mt-1" style="font-size: 2.2rem;">Our 4-Step Placement Process</h2>
      <p class="text-secondary">Transparent, seamless, and completely free of agent commission.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center bg-white">
          <div class="bg-success bg-opacity-10 text-success rounded-circle mx-auto p-3 mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
            <span class="fw-bold fs-4">1</span>
          </div>
          <h5 class="fw-bold text-dark mb-2">Online Application</h5>
          <p class="text-secondary small mb-0">Submit your registration form online or connect directly via our official WhatsApp helpline.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center bg-white">
          <div class="bg-primary bg-opacity-10 text-primary rounded-circle mx-auto p-3 mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
            <span class="fw-bold fs-4">2</span>
          </div>
          <h5 class="fw-bold text-dark mb-2">Profile Screening</h5>
          <p class="text-secondary small mb-0">Our career counselors review your skills and match you with suitable corporate job vacancies.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center bg-white">
          <div class="bg-warning bg-opacity-10 text-warning rounded-circle mx-auto p-3 mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
            <span class="fw-bold fs-4">3</span>
          </div>
          <h5 class="fw-bold text-dark mb-2">Interview Call Letter</h5>
          <p class="text-secondary small mb-0">Receive a verified spot interview call letter directly for company payroll recruitment drives.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center bg-white">
          <div class="bg-info bg-opacity-10 text-info rounded-circle mx-auto p-3 mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
            <span class="fw-bold fs-4">4</span>
          </div>
          <h5 class="fw-bold text-dark mb-2">Direct Joining</h5>
          <p class="text-secondary small mb-0">Join your new job with official company appointment letter, PF, ESI, and fixed monthly salary.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

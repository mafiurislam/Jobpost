@extends('layouts.app')

@section('title', 'Corporate Partners & Companies - Bright Future Consultancy')
@section('meta_description', 'Partner with Bright Future Consultancy for corporate manpower supply, mass recruitment drives, and pre-screened talent across West Bengal.')

@section('content')

<!-- Page Banner Header -->
<section class="py-5 text-center" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff;">
  <div class="container py-4">
    <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-30 rounded-pill px-3 py-2 fw-bold mb-2">FOR EMPLOYERS & PARTNERS</span>
    <h1 class="display-5 fw-extrabold text-white mb-3" style="letter-spacing: -0.5px;">Hire Faster, Hire Better</h1>
    <p class="lead text-light opacity-90 mx-auto mb-0" style="max-width: 700px; font-size: 1.15rem;">
      Reliable manpower staffing solutions and talent pipeline connecting top companies with verified candidates across West Bengal.
    </p>
  </div>
</section>

<!-- Company Partnerships Overview -->
<section class="py-5 bg-white">
  <div class="container py-4">
    <div class="row align-items-center g-5">
      
      <!-- Left: Hex Collage Image -->
      <div class="col-lg-6 text-center">
        <img src="{{ asset('assets/images/companies/hex_collage.svg') }}" alt="Corporate Partnerships" class="img-fluid rounded-4 shadow-sm" style="max-height: 480px; width: auto;">
      </div>

      <!-- Right: Manpower Solutions Details -->
      <div class="col-lg-6">
        <span class="text-success fw-bold text-uppercase small" style="letter-spacing: 1.5px;">ENTERPRISE RECRUITMENT</span>
        <h2 class="fw-extrabold text-dark mt-1 mb-3" style="font-size: 2.2rem;">Complete Staffing Solutions</h2>
        <p class="text-secondary mb-4" style="font-size: 1.05rem; line-height: 1.8;">
          Bright Future Consultancy partners with leading organizations in retail, aviation, banking, IT, logistics, and healthcare to fulfill high-volume and specialized staffing requirements rapidly and cost-effectively.
        </p>

        <div class="row g-3">
          <div class="col-sm-6">
            <div class="p-3 rounded-3 bg-light border border-light">
              <i class="fas fa-check-circle text-success fs-5 mb-2"></i>
              <h6 class="fw-bold text-dark mb-1">Pre-Screened Candidates</h6>
              <p class="text-secondary extra-small mb-0" style="font-size: 0.85rem;">Every profile is vetted for educational credentials, background, and practical trade skills.</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="p-3 rounded-3 bg-light border border-light">
              <i class="fas fa-bolt text-warning fs-5 mb-2"></i>
              <h6 class="fw-bold text-dark mb-1">Spot Interview Drives</h6>
              <p class="text-secondary extra-small mb-0" style="font-size: 0.85rem;">Organize walk-in interview camps at our Barddhaman facility with complete infrastructure.</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="p-3 rounded-3 bg-light border border-light">
              <i class="fas fa-shield-alt text-primary fs-5 mb-2"></i>
              <h6 class="fw-bold text-dark mb-1">100% Free for Candidates</h6>
              <p class="text-secondary extra-small mb-0" style="font-size: 0.85rem;">Zero candidate fees ensures maximum turnout and genuine, highly motivated job applicants.</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="p-3 rounded-3 bg-light border border-light">
              <i class="fas fa-globe-asia text-info fs-5 mb-2"></i>
              <h6 class="fw-bold text-dark mb-1">Domestic & Overseas</h6>
              <p class="text-secondary extra-small mb-0" style="font-size: 0.85rem;">Pan-India logistics manpower as well as GCC/Europe certified trade test assistance.</p>
            </div>
          </div>
        </div>

        <div class="mt-4 pt-2">
          <a href="{{ url('/contact.html') }}" class="btn btn-success btn-lg rounded-pill px-4 py-3 fw-bold">
            <i class="fas fa-handshake me-2"></i> Request Manpower Quotation
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Sectors We Hire For Grid -->
<section class="py-5 bg-light">
  <div class="container py-4">
    <div class="text-center max-w-xl mx-auto mb-5">
      <span class="text-success fw-bold text-uppercase small" style="letter-spacing: 1.5px;">INDUSTRIES SERVED</span>
      <h2 class="fw-extrabold text-dark mt-1" style="font-size: 2.2rem;">Industries We Staff For</h2>
      <p class="text-secondary">Providing skilled, semi-skilled, and administrative workforce across key Indian economic sectors.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white">
          <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle d-inline-flex mb-3" style="width: 54px; height: 54px; align-items: center; justify-content: center;">
            <i class="fas fa-plane-departure fa-lg"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Aviation & Ground Staff</h5>
          <p class="text-secondary small mb-0">Customer service agents, luggage baggage handlers, passenger check-in counter staff for airport terminals.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white">
          <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle d-inline-flex mb-3" style="width: 54px; height: 54px; align-items: center; justify-content: center;">
            <i class="fas fa-truck-loading fa-lg"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">E-Commerce & Logistics</h5>
          <p class="text-secondary small mb-0">Delivery partners, warehouse package pickers, dispatch supervisors for Flipkart, Snapdeal & Amazon vendors.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white">
          <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-circle d-inline-flex mb-3" style="width: 54px; height: 54px; align-items: center; justify-content: center;">
            <i class="fas fa-shopping-cart fa-lg"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Retail & Supermarkets</h5>
          <p class="text-secondary small mb-0">Store helpers, counter cashiers, barcode scanning executives for supermarket chains like More and Reliance Retail.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white">
          <div class="bg-info bg-opacity-10 text-info p-3 rounded-circle d-inline-flex mb-3" style="width: 54px; height: 54px; align-items: center; justify-content: center;">
            <i class="fas fa-university fa-lg"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Banking & Cash Logistics</h5>
          <p class="text-secondary small mb-0">ATM cash custodians, vault handlers, loan verification agents for private banking partners and security transit.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white">
          <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-circle d-inline-flex mb-3" style="width: 54px; height: 54px; align-items: center; justify-content: center;">
            <i class="fas fa-clinic-medical fa-lg"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Hospitality & Healthcare</h5>
          <p class="text-secondary small mb-0">Hospital attendants, nursing aides, pharmacy counter staff, hotel stewards, front desk executives.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white">
          <div class="bg-secondary bg-opacity-10 text-dark p-3 rounded-circle d-inline-flex mb-3" style="width: 54px; height: 54px; align-items: center; justify-content: center;">
            <i class="fas fa-tools fa-lg"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2">Technical & Manufacturing</h5>
          <p class="text-secondary small mb-0">ITI fitters, electricians, AC technicians, assembly operators for industrial manufacturing and automobile plants.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

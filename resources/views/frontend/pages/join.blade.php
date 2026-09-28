@extends('layouts.app')

@section('title', 'Join Us / Apply Now - Bright Future Consultancy')
@section('meta_description', 'Submit your free candidate application form at Bright Future Consultancy to get placed in top companies across West Bengal and India.')

@section('content')

<!-- Page Banner Header -->
<section class="py-5 text-center" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff;">
  <div class="container py-4">
    <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-30 rounded-pill px-3 py-2 fw-bold mb-2">100% FREE CANDIDATE REGISTRATION</span>
    <h1 class="display-5 fw-extrabold text-white mb-3" style="letter-spacing: -0.5px;">Candidate Application Form</h1>
    <p class="lead text-light opacity-90 mx-auto mb-0" style="max-width: 700px; font-size: 1.15rem;">
      Register once to receive direct call-letter updates for verified corporate interview drives.
    </p>
  </div>
</section>

<!-- Application Form Section -->
<section class="py-5 bg-light">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show p-4 rounded-4 shadow-sm mb-4" role="alert">
          <div class="d-flex align-items-center gap-3">
            <i class="fas fa-check-circle fa-2x text-success"></i>
            <div>
              <h5 class="fw-bold mb-1">Application Submitted Successfully!</h5>
              <p class="mb-0">{{ session('success') }}</p>
            </div>
          </div>
          <div class="mt-3 pt-3 border-top border-success border-opacity-25">
            <a href="https://wa.me/91{{ $whatsappNumber ?? '7001420469' }}?text=Hi,%20I%20have%20submitted%20my%20application%20on%20Bright%20Future%20Consultancy" target="_blank" class="btn btn-success fw-bold rounded-pill px-4">
              <i class="fab fa-whatsapp me-2"></i> Confirm on WhatsApp Now
            </a>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4 bg-white">
          <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
            <div class="bg-success text-white p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
              <i class="fas fa-user-plus fa-lg"></i>
            </div>
            <div>
              <h3 class="fw-bold text-dark mb-0">Free Job Application Form</h3>
              <span class="text-secondary small">Fill out your details to get placed in top companies near you</span>
            </div>
          </div>

          <form action="{{ route('join.submit') }}" method="POST">
            @csrf
            
            <div class="row g-4">
              <div class="col-md-4">
                <label for="application_date" class="form-label fw-bold text-dark">Date <span class="text-danger">*</span></label>
                <input type="date" name="application_date" id="application_date" value="{{ old('application_date', date('Y-m-d')) }}" class="form-control form-control-lg bg-light" required>
              </div>

              <div class="col-md-8">
                <label for="name" class="form-label fw-bold text-dark">Candidate Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control form-control-lg bg-light @error('name') is-invalid @enderror" placeholder="Enter your full name" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="phone" class="form-label fw-bold text-dark">WhatsApp / Mobile Number <span class="text-danger">*</span></label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="form-control form-control-lg bg-light @error('phone') is-invalid @enderror" placeholder="e.g. 7001420469" required>
                @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="email" class="form-label fw-bold text-dark">Email Address <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control form-control-lg bg-light @error('email') is-invalid @enderror" placeholder="Enter your email ID" required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="qualification" class="form-label fw-bold text-dark">Highest Educational Qualification</label>
                <select name="qualification" id="qualification" class="form-select form-select-lg bg-light">
                  <option value="10th Pass">10th Standard Pass</option>
                  <option value="12th Pass">12th Standard / Higher Secondary</option>
                  <option value="Diploma / ITI">Diploma / ITI Trade</option>
                  <option value="Graduate">Graduate (BA, BSc, BCom, BTech)</option>
                  <option value="Post Graduate">Post Graduate (MA, MSc, MBA)</option>
                  <option value="Below 10th">5th / 8th Pass</option>
                </select>
              </div>

              <div class="col-md-6">
                <label for="preferred_sector" class="form-label fw-bold text-dark">Preferred Job Sector</label>
                <select name="preferred_sector" id="preferred_sector" class="form-select form-select-lg bg-light">
                  <option value="Overseas Jobs">Overseas Placement (Gulf & Europe)</option>
                  <option value="Airlines Ground Staff">Airlines Ground Staff & Cargo</option>
                  <option value="Back Office & Data Entry">Back Office & Data Entry</option>
                  <option value="Banking & Finance">Banking & Financial Services</option>
                  <option value="E-Commerce & Delivery">E-Commerce Delivery & Logistics</option>
                  <option value="Supermarket Retail">Supermarket Retail Store</option>
                  <option value="Hospitality & Hotel">Hospitality & Hotel Staff</option>
                  <option value="Medical & Healthcare">Medical & Hospital Staff</option>
                  <option value="Automobile Industry">Automobile & Manufacturing</option>
                  <option value="AC & HVAC Technician">AC & Refrigeration Technician</option>
                  <option value="Driver & Commercial Fleet">Commercial Driver</option>
                  <option value="Security Forces">Security Guard & Escort</option>
                </select>
              </div>

              <div class="col-md-6">
                <label for="preferred_location" class="form-label fw-bold text-dark">Preferred Work Location</label>
                <input type="text" name="preferred_location" id="preferred_location" value="{{ old('preferred_location') }}" class="form-control form-control-lg bg-light" placeholder="e.g. Barddhaman, Kolkata, Durgapur, Overseas">
              </div>

              <div class="col-md-8">
                <label for="experience" class="form-label fw-bold text-dark">Experience Summary / Work History</label>
                <textarea name="experience" id="experience" rows="2" class="form-control bg-light" placeholder="Mention total experience if any. If fresher, write 'Fresher'.">{{ old('experience') }}</textarea>
              </div>

              <div class="col-md-4">
                <label for="connect_preference" class="form-label fw-bold text-dark">Preferred Connect Method</label>
                <select name="connect_preference" id="connect_preference" class="form-select form-select-lg bg-light">
                  <option value="WhatsApp" selected>Connect via WhatsApp</option>
                  <option value="Phone Call">Direct Phone Call</option>
                  <option value="Email">Email Communication</option>
                </select>
              </div>

              <div class="col-12 text-muted small">
                <i class="fas fa-lock text-success me-1"></i> Bright Future Consultancy does not charge any registration fees. Your application data is kept 100% confidential.
              </div>

              <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg rounded-pill px-5 py-3 fw-bold shadow">
                  Submit Free Application <i class="fas fa-paper-plane ms-2"></i>
                </button>
              </div>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</section>

@endsection

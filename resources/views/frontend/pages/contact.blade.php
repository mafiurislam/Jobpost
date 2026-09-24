@extends('layouts.app')

@section('title', 'Contact Us - Bright Future Consultancy | Golapbagh, Barddhaman')
@section('meta_description', 'Contact Bright Future Consultancy at Golapbagh, Barddhaman, West Bengal. Helpline: +91 7001420469, Email: brightfutureconsultancybwn@gmail.com.')

@section('content')

<!-- Page Banner Header -->
<section class="py-5 text-center" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff;">
  <div class="container py-4">
    <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-30 rounded-pill px-3 py-2 fw-bold mb-2">OFFICIAL HELP DESK</span>
    <h1 class="display-5 fw-extrabold text-white mb-3" style="letter-spacing: -0.5px;">Let's Start Your Career</h1>
    <p class="lead text-light opacity-90 mx-auto mb-0" style="max-width: 700px; font-size: 1.15rem;">
      Get in touch with our career counselors or visit our office in Barddhaman for direct placement assistance.
    </p>
  </div>
</section>

<!-- Contact Map & Office Address -->
<section class="py-5 bg-white">
  <div class="container py-4">
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show p-4 rounded-4 shadow-sm mb-5" role="alert">
      <div class="d-flex align-items-center gap-3">
        <i class="fas fa-check-circle fa-2x text-success"></i>
        <div>
          <h5 class="fw-bold mb-1">Message Received!</h5>
          <p class="mb-0">{{ session('success') }}</p>
        </div>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row g-5 align-items-center mb-5">
      <!-- Map Embed -->
      <div class="col-lg-7">
        <div class="card border-0 shadow-sm overflow-hidden rounded-4">
          <iframe 
            title="Bright Future Consultancy Location Map"
            src="https://maps.google.com/maps?q=Golapbagh,%20Barddhaman,%20West%20Bengal,%20India&t=&z=14&ie=UTF8&iwloc=&output=embed" 
            style="width: 100%; height: 420px; border: 0;"
            allowfullscreen="" 
            loading="lazy">
          </iframe>
        </div>
      </div>

      <!-- Office Details Card -->
      <div class="col-lg-5">
        <div class="p-4 p-md-5 rounded-4 shadow-sm bg-light border border-light">
          <h3 class="fw-bold text-dark mb-4">Office Address</h3>
          
          <ul class="list-unstyled mb-4">
            <li class="d-flex align-items-start gap-3 mb-4">
              <div class="bg-success text-white p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <div>
                <strong class="d-block text-dark">Office Location</strong>
                <span class="text-secondary small">{{ $siteAddress ?? 'Golapbagh, Barddhaman, West Bengal, India' }}</span>
              </div>
            </li>

            <li class="d-flex align-items-start gap-3 mb-4">
              <div class="bg-success text-white p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                <i class="fas fa-phone-alt"></i>
              </div>
              <div>
                <strong class="d-block text-dark">Helpline & WhatsApp</strong>
                <a href="https://wa.me/91{{ $whatsappNumber ?? '7001420469' }}" target="_blank" class="text-success fw-bold text-decoration-none">
                  {{ $contactPhone ?? '+91 7001420469' }}
                </a>
              </div>
            </li>

            <li class="d-flex align-items-start gap-3">
              <div class="bg-success text-white p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                <i class="fas fa-envelope"></i>
              </div>
              <div>
                <strong class="d-block text-dark">Official Email</strong>
                <a href="mailto:{{ $contactEmail ?? 'brightfutureconsultancybwn@gmail.com' }}" class="text-success fw-bold text-decoration-none">
                  {{ $contactEmail ?? 'brightfutureconsultancybwn@gmail.com' }}
                </a>
              </div>
            </li>
          </ul>

          <div class="d-grid gap-2">
            <a href="https://maps.google.com/maps?q=Golapbagh,%20Barddhaman,%20West%20Bengal" target="_blank" class="btn btn-dark rounded-pill py-3 fw-bold">
              Get Directions <i class="fas fa-external-link-alt ms-1"></i>
            </a>
            <a href="https://wa.me/91{{ $whatsappNumber ?? '7001420469' }}" target="_blank" class="btn btn-outline-success rounded-pill py-3 fw-bold">
              <i class="fab fa-whatsapp me-2"></i> Chat on WhatsApp
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Interactive Contact Form -->
    <div class="row justify-content-center mt-5">
      <div class="col-lg-10">
        <div class="bg-light p-4 p-md-5 rounded-4 shadow-sm border border-light">
          <div class="text-center mb-4">
            <h3 class="fw-bold text-dark mb-2">Send Us A Message</h3>
            <p class="text-secondary small">Have questions about specific job openings, certificates, or company hiring? Drop us a note below.</p>
          </div>

          <form action="{{ route('contact.submit') }}" method="POST">
            @csrf

            <div class="row g-4">
              <div class="col-md-6">
                <label for="name" class="form-label fw-bold text-dark">Your Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control form-control-lg bg-white @error('name') is-invalid @enderror" placeholder="Enter full name" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="email" class="form-label fw-bold text-dark">Your Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control form-control-lg bg-white @error('email') is-invalid @enderror" placeholder="Enter email address" required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="phone" class="form-label fw-bold text-dark">Phone Number <span class="text-danger">*</span></label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="form-control form-control-lg bg-white @error('phone') is-invalid @enderror" placeholder="Enter phone/WhatsApp number" required>
                @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="subject" class="form-label fw-bold text-dark">Inquiry Subject</label>
                <select name="subject" id="subject" class="form-select form-select-lg bg-white">
                  <option value="Job Placement Inquiry">Job Placement / Vacancy Inquiry</option>
                  <option value="Overseas Jobs Inquiry">Overseas Jobs (Gulf & Europe)</option>
                  <option value="Certificate Verification">Certificate Verification</option>
                  <option value="Corporate Manpower Hiring">Corporate Manpower Hiring</option>
                  <option value="General Question">General Counseling Question</option>
                </select>
              </div>

              <div class="col-12">
                <label for="message" class="form-label fw-bold text-dark">Your Message <span class="text-danger">*</span></label>
                <textarea name="message" id="message" rows="4" class="form-control bg-white @error('message') is-invalid @enderror" placeholder="Describe your inquiry in detail..." required>{{ old('message') }}</textarea>
                @error('message')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-12 text-end">
                <button type="submit" class="btn btn-success btn-lg rounded-pill px-5 py-3 fw-bold shadow">
                  Send Message <i class="fas fa-paper-plane ms-2"></i>
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

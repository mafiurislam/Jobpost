@extends('layouts.app')

@section('title', 'About Us & Leadership - Bright Future Consultancy')
@section('meta_description', 'Learn about Bright Future Consultancy, our visionary leadership team, ISO 9001:2015 certifications, and 100% free placement mission in West Bengal.')

@section('content')

<!-- Page Banner Header -->
<section class="py-5 text-center" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff;">
  <div class="container py-4">
    <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-30 rounded-pill px-3 py-2 fw-bold mb-2">ABOUT OUR AGENCY</span>
    <h1 class="display-5 fw-extrabold text-white mb-3" style="letter-spacing: -0.5px;">Building Futures, Empowering Careers</h1>
    <p class="lead text-light opacity-90 mx-auto mb-0" style="max-width: 700px; font-size: 1.15rem;">
      Premier HR and educational consulting agency based in West Bengal, dedicated to 100% genuine and free career placements.
    </p>
  </div>
</section>

<!-- Our Story & Hexagonal Collage Section -->
<section class="py-5 bg-white">
  <div class="container py-4">
    <div class="row align-items-center g-5">
      
      <!-- Left Side: Hexagonal Collage Graphic -->
      <div class="col-lg-6 text-center">
        <div class="position-relative d-inline-block">
          <img src="{{ asset('assets/images/companies/hex_collage.svg') }}" alt="Our Story & ISO MSME Certifications" class="img-fluid rounded-4 shadow-sm" style="max-height: 480px; width: auto;">
        </div>
      </div>

      <!-- Right Side: Our Story, Vision & Mission Accordion -->
      <div class="col-lg-6">
        <span class="text-success fw-bold text-uppercase small" style="letter-spacing: 1.5px;">OUR JOURNEY</span>
        <h2 class="fw-extrabold text-dark mt-1 mb-3" style="font-size: 2.2rem;">Our Story</h2>
        <p class="text-secondary mb-4" style="font-size: 1.05rem; line-height: 1.8;">
          {{ $sections['our_story']->description ?? 'Bright Future Consultancy is a premier HR and educational consulting agency based in West Bengal, specializing in providing comprehensive job updates and career guidance across a variety of sectors. With a firm commitment to helping jobseekers secure their ideal positions, we offer tailored solutions and expert advice to meet the evolving needs of both individuals and businesses.' }}
        </p>

        <!-- Collapsible Vision & Mission Accordion -->
        <div class="accordion border-0" id="storyAccordion">
          
          <!-- Our Vision -->
          <div class="accordion-item border-0 mb-3 rounded-3 shadow-sm overflow-hidden border-start border-4 border-success">
            <h2 class="accordion-header" id="visionHeading">
              <button class="accordion-button fw-bold text-dark bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#visionCollapse" aria-expanded="true" aria-controls="visionCollapse">
                <i class="fas fa-eye text-success me-2"></i> Our Vision
              </button>
            </h2>
            <div id="visionCollapse" class="accordion-collapse collapse show" aria-labelledby="visionHeading" data-bs-parent="#storyAccordion">
              <div class="accordion-body text-secondary small" style="line-height: 1.7;">
                To empower every candidate across West Bengal with transparent, 100% free job opportunities and to build a trusted, reliable hiring ecosystem for corporate partners nationwide and abroad.
              </div>
            </div>
          </div>

          <!-- Our Mission -->
          <div class="accordion-item border-0 mb-3 rounded-3 shadow-sm overflow-hidden border-start border-4 border-success">
            <h2 class="accordion-header" id="missionHeading">
              <button class="accordion-button collapsed fw-bold text-dark bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#missionCollapse" aria-expanded="false" aria-controls="missionCollapse">
                <i class="fas fa-bullseye text-success me-2"></i> Our Mission
              </button>
            </h2>
            <div id="missionCollapse" class="accordion-collapse collapse" aria-labelledby="missionHeading" data-bs-parent="#storyAccordion">
              <div class="accordion-body text-secondary small" style="line-height: 1.7;">
                To eliminate fraudulent recruitment fees by providing direct interview drives, transparent career counseling, practical job skills development, and verified candidate-to-company placements.
              </div>
            </div>
          </div>

          <!-- Certification Credential -->
          <div class="accordion-item border-0 mb-3 rounded-3 shadow-sm overflow-hidden border-start border-4 border-success">
            <h2 class="accordion-header" id="certHeading">
              <button class="accordion-button collapsed fw-bold text-dark bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#certCollapse" aria-expanded="false" aria-controls="certCollapse">
                <i class="fas fa-certificate text-success me-2"></i> Govt. Recognized & ISO Certified
              </button>
            </h2>
            <div id="certCollapse" class="accordion-collapse collapse" aria-labelledby="certHeading" data-bs-parent="#storyAccordion">
              <div class="accordion-body text-secondary small" style="line-height: 1.7;">
                Registered under MSME UDYAM Registration: <strong>UDYAM-WB-11-0035754</strong> and conforming to ISO 9001:2015 quality management standards for human resource placement and vocational training support.
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</section>

<!-- Leadership & Management Team Section -->
<section class="py-5 bg-light">
  <div class="container py-4">
    <div class="text-center max-w-xl mx-auto mb-5">
      <span class="text-success fw-bold text-uppercase small" style="letter-spacing: 1.5px;">LEADERSHIP & EXPERTISE</span>
      <h2 class="fw-extrabold text-dark mt-1" style="font-size: 2.2rem;">Meet Our Leadership Team</h2>
      <p class="text-secondary">Dedicated counselors and HR professionals helping you take the next big step in your career.</p>
    </div>

    <div class="row g-4 justify-content-center">
      
      <!-- CEO / Founder -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center bg-white">
          <div class="mx-auto mb-3" style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #16a34a; padding: 4px; overflow: hidden; background: #ffffff;">
            <img src="{{ asset('assets/images/team/manirul.svg') }}" alt="Mohammad Manirul" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
          </div>
          <h5 class="fw-bold text-dark mb-1">Mohammad Manirul</h5>
          <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-3 py-1 rounded-pill mb-3" style="font-size: 0.85rem;">Founder & CEO</span>
          <p class="text-secondary small mb-0" style="line-height: 1.6;">
            Visionary founder dedicated to transparent placement services, youth empowerment, and student career transformation across West Bengal.
          </p>
        </div>
      </div>

      <!-- Director / Operations -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center bg-white">
          <div class="mx-auto mb-3" style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #16a34a; padding: 4px; overflow: hidden; background: #ffffff;">
            <img src="{{ asset('assets/images/team/hafijur.svg') }}" alt="Hafijur Mondal" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
          </div>
          <h5 class="fw-bold text-dark mb-1">Hafijur Mondal</h5>
          <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-3 py-1 rounded-pill mb-3" style="font-size: 0.85rem;">Director & Operations</span>
          <p class="text-secondary small mb-0" style="line-height: 1.6;">
            Spearheading company recruitment drives, employer tie-ups, logistics, and verification protocols for verified spot hiring drives.
          </p>
        </div>
      </div>

      <!-- Placement Head -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center bg-white">
          <div class="mx-auto mb-3" style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #16a34a; padding: 4px; overflow: hidden; background: #ffffff;">
            <img src="{{ asset('assets/images/team/samim.svg') }}" alt="Sk Samim" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
          </div>
          <h5 class="fw-bold text-dark mb-1">Sk Samim</h5>
          <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-3 py-1 rounded-pill mb-3" style="font-size: 0.85rem;">Placement Head</span>
          <p class="text-secondary small mb-0" style="line-height: 1.6;">
            Guiding candidates through interview rounds, aptitude test coaching, and securing direct corporate payroll job contracts.
          </p>
        </div>
      </div>

      <!-- Overseas Coordinator -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center bg-white">
          <div class="mx-auto mb-3" style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #16a34a; padding: 4px; overflow: hidden; background: #ffffff;">
            <img src="{{ asset('assets/images/team/sahil.svg') }}" alt="Sahil Sk" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
          </div>
          <h5 class="fw-bold text-dark mb-1">Sahil Sk</h5>
          <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-3 py-1 rounded-pill mb-3" style="font-size: 0.85rem;">Overseas Coordinator</span>
          <p class="text-secondary small mb-0" style="line-height: 1.6;">
            Managing Gulf and Europe trade test verification, visa documentation assistance, and airport departure orientation.
          </p>
        </div>
      </div>

      <!-- Training Lead -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center bg-white">
          <div class="mx-auto mb-3" style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #16a34a; padding: 4px; overflow: hidden; background: #ffffff;">
            <img src="{{ asset('assets/images/team/dhiman.svg') }}" alt="Dhiman Das" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
          </div>
          <h5 class="fw-bold text-dark mb-1">Dhiman Das</h5>
          <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-3 py-1 rounded-pill mb-3" style="font-size: 0.85rem;">Training & Skill Head</span>
          <p class="text-secondary small mb-0" style="line-height: 1.6;">
            Conducting vocational skill development, computer operator training, and interview grooming sessions for students.
          </p>
        </div>
      </div>

      <!-- Candidate Relations -->
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 text-center bg-white">
          <div class="mx-auto mb-3" style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #16a34a; padding: 4px; overflow: hidden; background: #ffffff;">
            <img src="{{ asset('assets/images/team/prasanna.svg') }}" alt="Prasanna Ghosh" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
          </div>
          <h5 class="fw-bold text-dark mb-1">Prasanna Ghosh</h5>
          <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-3 py-1 rounded-pill mb-3" style="font-size: 0.85rem;">Public Relations</span>
          <p class="text-secondary small mb-0" style="line-height: 1.6;">
            Assisting candidates with inquiry resolution, helpline queries, document upload support, and WhatsApp job subscriptions.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Call to Action Banner -->
<section class="py-5 text-white text-center" style="background: linear-gradient(135deg, #15803d 0%, #166534 100%);">
  <div class="container py-3">
    <h2 class="display-6 fw-extrabold text-white mb-3">Ready to Start Your Career Journey?</h2>
    <p class="lead opacity-90 mx-auto mb-4" style="max-width: 650px;">
      Explore our latest verified job openings or contact our career counselors today for free guidance.
    </p>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
      <a href="{{ route('jobs.index') }}" class="btn btn-light btn-lg rounded-pill px-4 py-3 fw-bold text-success shadow">
        Browse All Vacancies <i class="fas fa-arrow-right ms-2"></i>
      </a>
      <a href="{{ url('/contact.html') }}" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 fw-semibold">
        Contact Our Office
      </a>
    </div>
  </div>
</section>

@endsection

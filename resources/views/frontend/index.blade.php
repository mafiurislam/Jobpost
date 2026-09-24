@extends('layouts.app')

@section('title', ($sections['hero']->title ?? 'Bright Future Consultancy') . ' - HR & Educational Consulting Agency')

@section('content')

{{-- Section 01: Hero Banner --}}
@if(isset($sections['hero']) && $sections['hero']->is_visible)
<section class="hero-section py-5 position-relative text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); overflow: hidden;">
  <div class="container py-lg-5">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-30 rounded-pill px-3 py-2 fw-bold mb-3">
          <i class="fas fa-sparkles me-1"></i> {{ $sections['hero']->tagline ?? 'WELCOME TO BRIGHT FUTURE CONSULTANCY' }}
        </span>
        <h1 class="display-4 fw-extrabold text-white mb-3" style="letter-spacing: -1px; line-height: 1.15;">
          {{ $sections['hero']->title ?? 'Building Futures, Empowering Careers' }}
        </h1>
        <p class="lead text-light opacity-90 mb-4 fs-5" style="max-width: 600px;">
          {{ $sections['hero']->subtitle ?? 'Your Trusted HR & Educational Placement Partner in West Bengal' }}
        </p>
        <p class="text-secondary mb-4 fs-6">
          {{ $sections['hero']->description ?? 'We help jobseekers secure 100% genuine, free placement opportunities across Airlines, IT, Overseas, Back Office, and Industrial sectors.' }}
        </p>
        <div class="d-flex flex-wrap gap-3 align-items-center">
          <a href="{{ $sections['hero']->button_url ?? route('jobs.index') }}" class="btn btn-success btn-lg rounded-pill px-4 py-3 fw-bold shadow-lg">
            {{ $sections['hero']->button_text ?? 'Explore All Jobs' }} <i class="fas fa-arrow-right ms-2"></i>
          </a>
          <a href="tel:{{ str_replace(' ', '', $contactPhone ?? '7001420469') }}" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 fw-semibold">
            <i class="fas fa-phone-alt me-2 text-success"></i> Call Helpline
          </a>
        </div>
      </div>
      <div class="col-lg-5 text-center">
        <div class="position-relative d-inline-block">
          @if(!empty($sections['hero']->image_path))
            <img src="{{ asset($sections['hero']->image_path) }}" alt="Hero Banner" class="img-fluid rounded-4 shadow-2xl" style="max-height: 420px; object-fit: cover;">
          @else
            <div class="p-5 bg-dark bg-opacity-50 border border-secondary border-opacity-25 rounded-4 text-center">
              <i class="fas fa-user-graduate fa-5x text-success mb-3"></i>
              <h4 class="text-white">100% Free Placement Services</h4>
              <p class="text-secondary mb-0">Barrackpore & Pan India</p>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
@endif

{{-- Section 02: Our Story & Leadership Card (Matching Image 1) --}}
@if(isset($sections['our_story']) && $sections['our_story']->is_visible)
<section class="py-5 bg-white text-center">
  <div class="container py-lg-4">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="fw-extrabold text-uppercase text-dark mb-3" style="letter-spacing: 1px; font-size: 2.2rem;">
          {{ $sections['our_story']->title ?? 'OUR STORY' }}
        </h2>
        <p class="text-secondary fs-6 mb-4" style="line-height: 1.7; font-weight: 500;">
          {{ $sections['our_story']->description ?? 'Bright Future Consultancy is a premier HR and educational consulting agency based in West Bengal, specializing in providing comprehensive job updates and career guidance across a variety of sectors. With a firm commitment to helping jobseekers secure their ideal positions, we offer tailored solutions and expert advice to meet the evolving needs of both individuals and businesses.' }}
        </p>

        <a href="{{ $sections['our_story']->button_url ?? url('/about.html') }}" class="btn btn-outline-success rounded-pill px-4 py-2 fw-bold text-success mb-5" style="border-width: 1.5px;">
          {{ $sections['our_story']->button_text ?? 'Read more about us' }} <i class="fas fa-arrow-right ms-1"></i>
        </a>
      </div>
    </div>

    <!-- Leadership CEO Profile Card (As rendered in Image 1 design) -->
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        <div class="p-4 rounded-4 shadow-sm text-center" style="background: #f8fafc; border: 1px solid #f1f5f9;">
          <div class="mx-auto mb-3" style="width: 110px; height: 110px; border-radius: 50%; border: 3px solid #16a34a; padding: 4px; overflow: hidden; background: #ffffff;">
            @if(!empty($sections['our_story']->extra_image_path))
              <img src="{{ asset($sections['our_story']->extra_image_path) }}" alt="{{ $sections['our_story']->content_json['leader_name'] ?? 'Mohammad Manirul' }}" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
            @elseif(!empty($sections['our_story']->image_path))
              <img src="{{ asset($sections['our_story']->image_path) }}" alt="{{ $sections['our_story']->content_json['leader_name'] ?? 'Mohammad Manirul' }}" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
            @else
              <div class="w-100 h-100 rounded-circle bg-light d-flex align-items-center justify-content-center">
                <i class="fas fa-user-tie fa-3x text-secondary"></i>
              </div>
            @endif
          </div>
          <h5 class="fw-bold text-dark mb-1">{{ $sections['our_story']->content_json['leader_name'] ?? 'Mohammad Manirul' }}</h5>
          <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-3 py-1 rounded-pill" style="font-size: 0.8rem;">
            {{ $sections['our_story']->content_json['leader_role'] ?? 'Founder & CEO' }}
          </span>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

{{-- Section 03: Manpower Sectors & Recent Jobs --}}
@if(isset($sections['sectors']) && $sections['sectors']->is_visible)
<section class="py-5" style="background-color: #f1f5f9;">
  <div class="container py-lg-4">
    <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
      <div>
        <span class="section-tag">{{ $sections['sectors']->tagline ?? 'SECTORS WE COVER' }}</span>
        <h2 class="section-title fs-2 mb-0">{{ $sections['sectors']->title ?? 'We Provide Manpower for those Sectors' }}</h2>
      </div>
      <a href="{{ route('jobs.index') }}" class="btn btn-brand">View All Jobs & Vacancies <i class="fas fa-arrow-right ms-1"></i></a>
    </div>

    <!-- Jobs Cards Grid matching Image 2 -->
    <div class="row g-4">
      @forelse($jobs->take(6) as $job)
      <div class="col-md-6 col-lg-4">
        <div class="job-card">
          @if($job->poster_image)
            <div class="job-card-header p-0 overflow-hidden text-center bg-dark" style="min-height: 200px;">
              <img src="{{ $job->image_url }}" alt="{{ $job->title }}" class="w-100 h-100 object-fit-cover" style="min-height: 200px; max-height: 240px;">
            </div>
          @else
            <div class="job-card-header">
              <div class="d-flex justify-content-between align-items-start">
                <div class="logo-badge">
                  <img src="{{ asset($siteLogo) }}" alt="{{ $siteName }}">
                </div>
                <span class="pill-badge">{{ $job->badge_tag ?? '100% FREE JOBS' }}</span>
              </div>
              <div class="mt-3">
                <p class="text-warning fw-bold mb-0 text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">
                  JOB VACANCY {{ date('Y') }} • {{ $job->location }}
                </p>
                <p class="text-white-50 small mb-0">{{ $job->qualification }}</p>
              </div>
              <!-- Illustration avatar overlay -->
              <div class="avatar-illustration opacity-75 d-none d-sm-block">
                <i class="fas fa-user-md fa-7x text-white-50 opacity-25"></i>
              </div>
            </div>
          @endif
          <div class="job-card-body">
            <div>
              <h4 class="job-card-title">{{ $job->title }}</h4>
              <p class="text-muted small mb-3">
                <i class="fas fa-building text-success me-1"></i> {{ $job->company }}
              </p>
            </div>
            <div>
              <a href="{{ route('jobs.show', $job->id) }}" class="btn-view-vacancies">
                View Vacancies <i class="fas fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center py-5">
        <p class="text-muted">No active job vacancies published yet.</p>
      </div>
      @endforelse
    </div>
  </div>
</section>
@endif

{{-- Section 04: Placement Success Stories (Matching Image 1) --}}
@if(isset($sections['placements']) && $sections['placements']->is_visible)
<section class="py-5" style="background-color: #e6f4ea;">
  <div class="container py-lg-4">
    <div class="row align-items-center g-4">
      <div class="col-lg-4">
        <span class="section-tag text-success fw-bold text-uppercase mb-2 d-block" style="font-size: 0.85rem; letter-spacing: 1.5px;">
          {{ $sections['placements']->tagline ?? 'SUCCESS STORIES' }}
        </span>
        <h2 class="fw-extrabold text-dark mb-3" style="font-size: 2.2rem; line-height: 1.2;">
          {{ $sections['placements']->title ?? 'Successful joining candidate' }}
        </h2>
        <p class="text-secondary mb-4" style="line-height: 1.6;">
          {{ $sections['placements']->description ?? 'Our "Success Stories" proudly displays messages from happy clients and successful job-seekers highlighting their experience with Bright Future.' }}
        </p>

        <!-- Carousel navigation buttons as in Image 1 design -->
        <div class="d-flex gap-2 mb-4 mb-lg-0">
          <button class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; border: 1px solid #cbd5e1;" type="button" data-bs-target="#successCarousel" data-bs-slide="prev">
            <i class="fas fa-arrow-left text-dark"></i>
          </button>
          <button class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; border: 1px solid #cbd5e1;" type="button" data-bs-slide="next" data-bs-target="#successCarousel">
            <i class="fas fa-arrow-right text-dark"></i>
          </button>
        </div>
      </div>

      <div class="col-lg-8">
        <div id="successCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            @php
              $stories = $sections['placements']->content_json ?? [
                ['name' => 'Rahul Sharma', 'sector' => 'Airlines Ground Staff', 'company' => 'IndiGo Airlines', 'testimonial' => 'Got selected as ground staff at Kolkata Airport without paying any fake agent fees. Thank you Bright Future!'],
                ['name' => 'Sk. Sameer', 'sector' => 'Overseas HVAC Technician', 'company' => 'Gulf Placement UAE', 'testimonial' => 'Secured free visa and overseas technician job in Dubai. Mohammad sir guided me personally.']
              ];
            @endphp

            @foreach(array_chunk($stories, 2) as $index => $chunk)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
              <div class="row g-3">
                @foreach($chunk as $story)
                <div class="col-md-6">
                  <div class="bg-white p-4 rounded-4 shadow-sm border border-light h-100 d-flex flex-direction-column justify-content-between">
                    <div>
                      <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center fw-bold fs-4" style="width: 50px; height: 50px;">
                          {{ strtoupper(substr($story['name'] ?? 'C', 0, 1)) }}
                        </div>
                        <div>
                          <h6 class="fw-bold text-dark mb-0">{{ $story['name'] ?? 'Joined Candidate' }}</h6>
                          <small class="text-success fw-semibold">{{ $story['sector'] ?? 'Selected Candidate' }}</small>
                        </div>
                      </div>
                      <p class="text-secondary small fst-italic mb-3">"{{ $story['testimonial'] ?? 'Great experience getting placed through Bright Future Consultancy.' }}"</p>
                    </div>
                    <div class="pt-2 border-top border-light">
                      <span class="badge bg-light text-dark fw-normal"><i class="fas fa-building text-success me-1"></i> {{ $story['company'] ?? 'Partner Company' }}</span>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

{{-- Section 05: FAQs Section --}}
@if(isset($sections['faqs']) && $sections['faqs']->is_visible)
<section class="py-5 bg-white">
  <div class="container py-lg-4">
    <div class="text-center max-w-2xl mx-auto mb-5">
      <span class="section-tag">{{ $sections['faqs']->tagline ?? 'GOT QUESTIONS?' }}</span>
      <h2 class="section-title fs-2">{{ $sections['faqs']->title ?? 'How can we help you?' }}</h2>
      <p class="text-secondary">{{ $sections['faqs']->description ?? 'Everything you need to know about our recruitment process.' }}</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="accordion accordion-flush" id="faqAccordion">
          @php
            $faqs = $sections['faqs']->content_json ?? [
              ['q' => 'Are all jobs on Bright Future 100% free?', 'a' => 'Yes! We do not charge jobseekers any registration fees for genuine placement opportunities.'],
              ['q' => 'How do I apply for Overseas Jobs?', 'a' => 'Click on View Vacancies in Overseas section or send your resume directly to our official WhatsApp number.'],
              ['q' => 'Where is your office located?', 'a' => 'Our main office is located in Barrackpore, Kolkata - 700121, West Bengal.']
            ];
          @endphp

          @foreach($faqs as $i => $faq)
          <div class="accordion-item border rounded-3 mb-3 overflow-hidden">
            <h2 class="accordion-header" id="heading{{ $i }}">
              <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }} fw-bold text-dark py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}">
                <i class="fas fa-question-circle text-success me-2"></i> {{ $faq['q'] ?? 'Question' }}
              </button>
            </h2>
            <div id="collapse{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
              <div class="accordion-body text-secondary">
                {{ $faq['a'] ?? 'Answer details.' }}
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endif

@endsection

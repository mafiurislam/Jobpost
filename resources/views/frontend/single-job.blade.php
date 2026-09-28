@extends('layouts.app')

@section('title', $job->title . ' - Bright Future Consultancy')

@section('content')

<!-- Header Banner matching Image 3 -->
<section class="py-4 text-center" style="background-color: #e6f4ea;">
  <div class="container py-2">
    <span class="text-uppercase fw-bold text-success opacity-75 d-block mb-1" style="font-size: 0.8rem; letter-spacing: 1.5px;">JOB REPORT</span>
    <h1 class="fw-extrabold text-dark mb-0" style="font-size: 2.2rem; letter-spacing: -0.5px;">
      {{ $job->title }}
    </h1>
  </div>
</section>

<!-- Main Single Job Content Grid matching Image 3 -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">

      <!-- Left Column: Search Sidebar (Image 3) -->
      <div class="col-lg-3">
        <div class="bg-white p-4 rounded-4 shadow-sm border border-light">
          <h5 class="fw-extrabold text-dark mb-3 text-center" style="font-size: 1.1rem;">Search Your Dream Jobs</h5>
          <form action="{{ route('jobs.index') }}" method="GET">
            <div class="mb-3">
              <input type="text" name="keyword" class="form-control form-control-sm bg-light" placeholder="Keyword...">
            </div>
            <div class="mb-3">
              <input type="text" name="location" class="form-control form-control-sm bg-light" placeholder="Location...">
            </div>
            <div class="mb-3">
              <select name="sector" class="form-select form-select-sm bg-light">
                <option value="">Select Category...</option>
                <option value="overseas">Overseas Jobs</option>
                <option value="airlines">Airlines</option>
                <option value="backoffice">Back Office</option>
              </select>
            </div>
            <button type="submit" class="btn btn-dark w-100 fw-bold rounded-pill mb-3 py-2">Search</button>
            <div class="text-center">
              <a href="{{ route('jobs.index') }}" class="text-secondary small text-decoration-none">— Back to All Categories</a>
            </div>
          </form>
        </div>
      </div>

      <!-- Middle Column: Main Dynamic Job Details (Image 3) -->
      <div class="col-lg-6">
        <p class="fw-bold text-secondary small mb-2">Job Details: {{ $job->title }}</p>

        <div class="bg-white rounded-4 shadow-sm overflow-hidden border border-light">

          <!-- Job Banner Header Graphic (Matching Image 3) -->
          @if($job->poster_image)
            <div class="job-banner-header text-center bg-dark rounded-top-4 overflow-hidden position-relative" style="background-color: #19140a;">
              <img src="{{ $job->image_url }}" alt="{{ $job->title }}" class="w-100 h-auto object-fit-contain" style="max-height: 420px; width: 100%;">
            </div>
          @else
            <div class="p-4 position-relative text-center text-white" style="background: #000000; min-height: 220px;">
              <div class="position-absolute top-0 start-0 p-3">
                <div class="bg-white rounded-circle p-1 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                  <img src="{{ asset($siteLogo ?? 'assets/images/logo.png') }}" alt="{{ $siteName }}" class="w-100 h-100 object-fit-contain">
                </div>
              </div>

              <div class="py-2">
                <h3 class="fw-extrabold text-uppercase text-white mb-2" style="letter-spacing: 1px;">{{ $job->title }}</h3>
                <span class="badge bg-emerald text-white rounded-pill px-4 py-2 fw-bold text-uppercase mb-2" style="background-color: #00b894; font-size: 0.9rem;">
                  {{ $job->badge_tag ?? 'OVERSEAS VACANCY' }}
                </span>
                <p class="text-warning fw-bold small mb-1">JOB VACANCY {{ date('Y') }} • ALL OVER INDIA & OVERSEAS</p>
                <p class="text-white-50 extra-small mb-2" style="font-size: 0.8rem;">{{ $job->qualification }}</p>
                <p class="text-info fw-semibold small mb-2">www.bfconsultancy.in</p>
                <p class="text-white-50 extra-small mb-3" style="font-size: 0.75rem;">{{ $job->location }}</p>

                <button type="button" class="btn btn-danger rounded-pill px-5 py-2 fw-bold text-uppercase shadow btn-open-apply-modal"
                        data-job-title="{{ $job->title }}"
                        data-job-sector="{{ $job->sector_name ?? $job->sector_slug }}"
                        data-job-location="{{ $job->location }}"
                        style="background-color: #d63031;">
                  APPLY NOW
                </button>
              </div>

              <div class="position-absolute bottom-0 end-0 p-2 d-none d-sm-block opacity-75">
                <i class="fas fa-user-tie fa-6x text-white-50"></i>
              </div>
            </div>
          @endif

          <!-- Main Details Body matching Image 3 -->
          <div class="p-4">
            <div class="d-flex align-items-start gap-3 mb-3">
              <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; flex-shrink: 0;">
                <i class="fas fa-briefcase fa-lg text-dark"></i>
              </div>
              <div>
                <h4 class="fw-bold text-dark mb-1" style="font-size: 1.35rem;">{{ $job->title }}</h4>
                <p class="text-secondary small mb-0">{{ $job->company }} • {{ $job->location }}</p>
              </div>
            </div>

            <!-- Dynamic Badges Row (Salary, Qualification, Placement tag) -->
            <div class="d-flex flex-wrap gap-2 mb-4">
              <span class="badge px-3 py-2 rounded-2 fw-bold" style="background-color: #e6f4ea; color: #15803d; border: 1.5px solid #16a34a; font-size: 0.95rem;">
                {{ $job->salary }}
              </span>
              <span class="badge bg-light text-dark border px-3 py-2 rounded-2 fw-semibold">
                {{ $job->qualification }}
              </span>
              <span class="badge bg-light text-dark border px-3 py-2 rounded-2 fw-semibold">
                {{ $job->badge_tag ?? '100% FREE PLACEMENT' }}
              </span>
            </div>

            <!-- Description -->
            <div class="mb-4">
              <h6 class="fw-bold text-dark mb-2">Job Description:</h6>
              <p class="text-secondary small" style="line-height: 1.7;">
                {!! nl2br(e($job->description)) !!}
              </p>
            </div>

            <!-- Requirements if available -->
            @if(!empty($job->requirements))
            <div class="mb-4 p-3 bg-light rounded-3 border border-light">
              <h6 class="fw-bold text-dark mb-2"><i class="fas fa-check-circle text-success me-1"></i> Candidate Requirements:</h6>
              <div class="text-secondary small" style="line-height: 1.7;">
                {!! nl2br(e($job->requirements)) !!}
              </div>
            </div>
            @endif

            <!-- Responsibilities if available -->
            @if(!empty($job->duties))
            <div class="mb-4 p-3 bg-light rounded-3 border border-light">
              <h6 class="fw-bold text-dark mb-2"><i class="fas fa-tasks text-primary me-1"></i> Key Responsibilities:</h6>
              <div class="text-secondary small" style="line-height: 1.7;">
                {!! nl2br(e($job->duties)) !!}
              </div>
            </div>
            @endif

            <!-- Bottom Action Buttons matching Image 3 -->
            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light">
              <button type="button" onclick="shareCurrentJob('{{ e($job->title) }}')" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
                <i class="fas fa-share-alt me-1"></i> Share
              </button>

              <button type="button" class="btn btn-success fw-bold rounded-pill px-4 py-2 btn-open-apply-modal"
                      data-job-title="{{ $job->title }}"
                      data-job-sector="{{ $job->sector_name ?? $job->sector_slug }}"
                      data-job-location="{{ $job->location }}"
                      style="background-color: #15803d;">
                APPLY NOW
              </button>
            </div>
          </div>

        </div>
      </div>

      <!-- Right Column: Stay Connected Sidebar (Image 3) -->
      <div class="col-lg-3">
        <div class="bg-white p-4 rounded-4 shadow-sm text-center border border-light">
          <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
            <i class="fas fa-paper-plane fa-2x"></i>
          </div>
          <h5 class="fw-bold text-dark mb-2" style="font-size: 1.1rem;">Stay connected with your job process</h5>
          <p class="text-secondary extra-small mb-4" style="font-size: 0.85rem; line-height: 1.5;">
            Get instant free job alerts, candidate registration status & interview updates directly on WhatsApp or Email.
          </p>

          <a href="https://wa.me/91{{ $whatsappNumber ?? '7001420469' }}?text=Please%20subscribe%20me%20for%20free%20job%20alerts" target="_blank" class="btn btn-danger w-100 fw-bold rounded-pill py-2 text-uppercase shadow-sm" style="background-color: #e17055; border: none;">
            Subscribe Now
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Job Share Modal -->
<div class="modal fade" id="jobShareModal" tabindex="-1" aria-labelledby="jobShareModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 border-0 shadow-lg" style="background-color: #1e293b; color: #ffffff;">
      <div class="modal-header border-bottom border-secondary border-opacity-25 pb-3">
        <h5 class="modal-title fw-bold text-white" id="jobShareModalLabel">
          <i class="fas fa-share-alt me-2 text-success"></i> Share Job Vacancy
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <p class="text-light small mb-3">Share this opportunity with your friends and colleagues:</p>
        
        <!-- Copy URL Input -->
        <div class="input-group mb-3">
          <input type="text" id="shareUrlInput" class="form-control bg-dark text-white border-secondary" readonly>
          <button class="btn btn-success fw-bold px-3" type="button" onclick="copyShareUrl()">
            <i class="fas fa-copy me-1"></i> Copy Link
          </button>
        </div>

        <div id="copySuccessAlert" class="alert alert-success py-2 small d-none mb-3 text-center rounded-3">
          <i class="fas fa-check-circle me-1"></i> Link copied to clipboard!
        </div>

        <!-- Social Share Icons Grid -->
        <div class="row g-2 text-center mt-2">
          <div class="col-3">
            <a href="#" id="shareWhatsAppBtn" target="_blank" class="btn btn-outline-light w-100 p-2 rounded-3 border-secondary text-success">
              <i class="fab fa-whatsapp fa-2x mb-1 d-block"></i>
              <span style="font-size: 0.75rem;" class="text-white d-block">WhatsApp</span>
            </a>
          </div>
          <div class="col-3">
            <a href="#" id="shareFacebookBtn" target="_blank" class="btn btn-outline-light w-100 p-2 rounded-3 border-secondary text-primary">
              <i class="fab fa-facebook-f fa-2x mb-1 d-block"></i>
              <span style="font-size: 0.75rem;" class="text-white d-block">Facebook</span>
            </a>
          </div>
          <div class="col-3">
            <a href="#" id="shareTelegramBtn" target="_blank" class="btn btn-outline-light w-100 p-2 rounded-3 border-secondary text-info">
              <i class="fab fa-telegram-plane fa-2x mb-1 d-block"></i>
              <span style="font-size: 0.75rem;" class="text-white d-block">Telegram</span>
            </a>
          </div>
          <div class="col-3">
            <a href="#" id="shareTwitterBtn" target="_blank" class="btn btn-outline-light w-100 p-2 rounded-3 border-secondary text-light">
              <i class="fab fa-twitter fa-2x mb-1 d-block"></i>
              <span style="font-size: 0.75rem;" class="text-white d-block">Twitter</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
function shareCurrentJob(title) {
  const currentUrl = window.location.href;
  const shareText = `Check out this job opening: ${title} on Bright Future Consultancy`;

  if (navigator.share && /Android|iPhone|iPad|iPod/i.test(navigator.userAgent)) {
    navigator.share({
      title: title,
      text: shareText,
      url: currentUrl
    }).catch(function() {
      openShareModal(title, currentUrl);
    });
  } else {
    openShareModal(title, currentUrl);
  }
}

function openShareModal(title, url) {
  document.getElementById('shareUrlInput').value = url;
  document.getElementById('shareWhatsAppBtn').href = `https://api.whatsapp.com/send?text=${encodeURIComponent('Check out this job: ' + title + '\n' + url)}`;
  document.getElementById('shareFacebookBtn').href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
  document.getElementById('shareTelegramBtn').href = `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`;
  document.getElementById('shareTwitterBtn').href = `https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`;

  const modalEl = document.getElementById('jobShareModal');
  const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
  modal.show();
}

function copyShareUrl() {
  const input = document.getElementById('shareUrlInput');
  input.select();
  input.setSelectionRange(0, 99999);

  if (navigator.clipboard && window.isSecureContext) {
    navigator.clipboard.writeText(input.value).then(function() {
      showCopyAlert();
    }).catch(function() {
      fallbackCopy(input);
    });
  } else {
    fallbackCopy(input);
  }
}

function fallbackCopy(input) {
  try {
    document.execCommand('copy');
    showCopyAlert();
  } catch (err) {
    alert('Link copied: ' + input.value);
  }
}

function showCopyAlert() {
  const alertBox = document.getElementById('copySuccessAlert');
  alertBox.classList.remove('d-none');
  setTimeout(function() {
    alertBox.classList.add('d-none');
  }, 2500);
}
</script>
@endpush

@endsection

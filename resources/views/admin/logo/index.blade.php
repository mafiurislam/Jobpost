@extends('admin.layout')

@section('title', 'Logo Management - Admin Dashboard')
@section('page_header', 'Logo Management')

@section('content')

<div class="row justify-content-center">
  <div class="col-12 col-xl-9">
    <div class="card card-custom p-3 p-md-4 shadow-sm border-0">
      
      <!-- Header Banner -->
      <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4 pb-3 border-bottom">
        <div>
          <h4 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
            <span class="badge bg-success bg-opacity-10 text-success p-2 rounded-3">
              <i class="fas fa-image fa-sm"></i>
            </span>
            <span>Logo Upload & Brand Customization</span>
          </h4>
          <p class="text-secondary small mb-0">Upload a new agency logo. Updates instantly across header, footer, mobile navigation, and admin panel.</p>
        </div>
        <div>
          <span class="badge bg-success bg-opacity-15 text-success px-3 py-2 rounded-pill fw-bold border border-success border-opacity-25">
            <i class="fas fa-bolt me-1"></i> Live Dynamic
          </span>
        </div>
      </div>

      <!-- Current Active Logo Display Card -->
      <div class="mb-4 p-3 p-md-4 bg-light rounded-4 border">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 mb-3">
          <h6 class="fw-bold text-secondary text-uppercase small mb-0 tracking-wide">
            <i class="fas fa-check-circle text-success me-1"></i> Current Active Website Logo
          </h6>
          <form action="{{ route('admin.logo.reset') }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to reset to the default official logo?');">
            @csrf
            <button type="submit" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
              <i class="fas fa-undo me-1"></i> Reset to Default
            </button>
          </form>
        </div>

        <div class="row g-3">
          <!-- Light Background Preview -->
          <div class="col-12 col-sm-6">
            <div class="bg-white p-3 rounded-3 shadow-sm border text-center h-100 d-flex flex-column align-items-center justify-content-center">
              <span class="text-muted extra-small text-uppercase fw-bold mb-2">On Light Background</span>
              <div style="min-height: 90px;" class="d-flex align-items-center justify-content-center w-100">
                <img src="{{ asset($currentLogo) }}" alt="{{ $siteName }}" class="img-fluid" style="max-height: 85px; max-width: 100%; object-fit: contain;">
              </div>
            </div>
          </div>

          <!-- Dark Background Preview -->
          <div class="col-12 col-sm-6">
            <div class="p-3 rounded-3 shadow-sm border text-center h-100 d-flex flex-column align-items-center justify-content-center" style="background-color: #0f172a;">
              <span class="text-secondary extra-small text-uppercase fw-bold mb-2">On Dark Background</span>
              <div style="min-height: 90px;" class="d-flex align-items-center justify-content-center w-100">
                <img src="{{ asset($currentLogo) }}" alt="{{ $siteName }}" class="img-fluid" style="max-height: 85px; max-width: 100%; object-fit: contain;">
              </div>
            </div>
          </div>
        </div>

        <div class="mt-3 d-flex flex-wrap align-items-center justify-content-between gap-2 pt-2 border-top">
          <small class="text-muted text-break">
            <i class="fas fa-folder-open me-1"></i> Current file: <code>{{ $currentLogo }}</code>
          </small>
          @if($logoExists)
            <span class="badge bg-success bg-opacity-10 text-success fw-semibold"><i class="fas fa-check me-1"></i> Verified on Disk</span>
          @else
            <span class="badge bg-warning bg-opacity-15 text-warning fw-semibold"><i class="fas fa-exclamation-triangle me-1"></i> Fallback Active</span>
          @endif
        </div>
      </div>

      <!-- Upload Form -->
      <form action="{{ route('admin.logo.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
          <label for="logoInput" class="form-label fw-bold text-dark fs-6">
            <i class="fas fa-cloud-upload-alt text-success me-1"></i> Choose New Logo File
          </label>
          
          <div class="input-group input-group-lg">
            <input type="file" name="logo" id="logoInput" class="form-control @error('logo') is-invalid @enderror" accept=".png,.jpg,.jpeg,.svg,.webp,.gif,.ico,image/png,image/jpeg,image/svg+xml,image/webp" required>
          </div>

          @error('logo')
            <div class="text-danger small mt-2 fw-semibold">
              <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
            </div>
          @enderror

          <div class="form-text mt-2 text-muted">
            <i class="fas fa-info-circle me-1"></i> Supported: <strong>PNG, JPG, JPEG, SVG, WEBP</strong>. Max size: <strong>8MB</strong>. Transparent PNG or SVG recommended.
          </div>
        </div>

        <!-- Live Preview Area (Hidden by default, shown when user selects a file) -->
        <div id="newLogoPreviewContainer" class="mb-4 d-none">
          <div class="p-3 bg-mint-soft rounded-3 border border-success border-opacity-30">
            <h6 class="fw-bold text-success mb-2 small text-uppercase">
              <i class="fas fa-eye me-1"></i> Selected Image Preview (Before Upload):
            </h6>
            <div class="bg-white p-3 rounded-3 border text-center d-inline-block" style="min-width: 160px;">
              <img id="newLogoPreviewImg" src="" alt="Preview" style="max-height: 80px; max-width: 240px; object-fit: contain;">
              <div id="fileInfoText" class="text-muted extra-small mt-2"></div>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex flex-column-reverse flex-sm-row justify-content-end gap-2 pt-3 border-top">
          <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4 py-2 fw-semibold text-center">
            <i class="fas fa-times me-1"></i> Cancel
          </a>
          <button type="submit" class="btn btn-success px-4 py-2 fw-bold rounded-pill shadow-sm text-center">
            <i class="fas fa-upload me-1"></i> Upload & Apply Logo
          </button>
        </div>
      </form>

    </div>
  </div>
</div>

@push('scripts')
<script>
  // Live Client-side Image Preview
  const logoInput = document.getElementById('logoInput');
  const previewContainer = document.getElementById('newLogoPreviewContainer');
  const previewImg = document.getElementById('newLogoPreviewImg');
  const fileInfoText = document.getElementById('fileInfoText');

  if (logoInput) {
    logoInput.addEventListener('change', function(e) {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
          previewImg.src = event.target.result;
          previewContainer.classList.remove('d-none');
          const sizeKb = (file.size / 1024).toFixed(1);
          fileInfoText.textContent = `${file.name} (${sizeKb} KB)`;
        };
        reader.readAsDataURL(file);
      } else {
        previewContainer.classList.add('d-none');
      }
    });
  }
</script>
@endpush

@endsection

@extends('admin.layout')

@section('title', 'Add Leadership Team Member - Admin Dashboard')
@section('page_header', 'Add Team Member')

@section('content')

<div class="row justify-content-center">
  <div class="col-12 col-lg-8">
    <div class="card card-custom p-3 p-md-4 shadow-sm border-0">
      
      <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4">
        <div>
          <h4 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
            <span class="badge bg-success bg-opacity-10 text-success p-2 rounded-3">
              <i class="fas fa-user-plus fa-sm"></i>
            </span>
            <span>Add Leadership Team Member</span>
          </h4>
          <small class="text-secondary">Enter executive details to display in the "Meet Our Leadership Team" section</small>
        </div>
        <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary rounded-pill px-3 py-1 fw-semibold small">
          <i class="fas fa-arrow-left me-1"></i> Back to List
        </a>
      </div>

      <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
          <!-- Member Name -->
          <div class="col-md-7">
            <label class="form-label fw-bold text-dark">Full Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Mohammad Manirul" required autofocus>
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Role / Designation -->
          <div class="col-md-5">
            <label class="form-label fw-bold text-dark">Role / Designation <span class="text-danger">*</span></label>
            <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role') }}" placeholder="e.g. Founder & CEO" required>
            @error('role')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Bio / Description -->
          <div class="col-12">
            <label class="form-label fw-bold text-dark">Bio / Role Description</label>
            <textarea name="bio" rows="3" class="form-control @error('bio') is-invalid @enderror" placeholder="Describe this leader's background, core responsibilities, or guidance for jobseekers...">{{ old('bio') }}</textarea>
            <div class="form-text">This description appears directly underneath the role badge on the website card.</div>
            @error('bio')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Photo / Avatar Upload & Live Preview -->
          <div class="col-12">
            <label class="form-label fw-bold text-dark">Profile Photo / Avatar</label>
            
            <div class="p-3 bg-light rounded-4 border d-flex flex-column flex-sm-row align-items-center gap-4">
              <!-- Live Preview Ring -->
              <div class="flex-shrink-0 text-center">
                <div id="avatarPreviewContainer" style="width: 100px; height: 100px; border-radius: 50%; border: 3px solid #16a34a; padding: 3px; overflow: hidden; background: #ffffff; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                  <img id="avatarPreviewImg" src="" alt="Preview" class="w-100 h-100 rounded-circle d-none" style="object-fit: cover;">
                  <span id="avatarPreviewFallback" class="text-success fw-bold fs-4">
                    <i class="fas fa-user"></i>
                  </span>
                </div>
                <small class="text-muted d-block mt-1">Live Card Preview</small>
              </div>

              <!-- File Input -->
              <div class="flex-grow-1">
                <input type="file" name="image" id="avatarInput" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/webp,image/svg+xml">
                <div class="form-text mt-1">
                  Supported formats: <strong>PNG, JPG, JPEG, WEBP, SVG</strong> (Max 4MB). If left empty, initials will be generated automatically.
                </div>
                @error('image')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <!-- Sort Order & Active Switch -->
          <div class="col-md-6">
            <label class="form-label fw-bold text-dark">Display Order</label>
            <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $nextSortOrder) }}" min="1">
            <div class="form-text">Determines the card sequence order (1 = first card, 2 = second, etc.)</div>
            @error('sort_order')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6 d-flex align-items-center">
            <div class="form-check form-switch mt-3">
              <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActiveCheck" {{ old('is_active', true) ? 'checked' : '' }} style="cursor: pointer; width: 2.5em; height: 1.3em;">
              <label class="form-check-label ms-2 fw-bold text-dark" for="isActiveCheck">
                Publish on Live Website
              </label>
              <div class="form-text">Active members will be displayed immediately in the Leadership section.</div>
            </div>
          </div>

          <!-- Form Actions -->
          <div class="col-12 border-top pt-3 mt-4 d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
              Cancel
            </a>
            <button type="submit" class="btn btn-success fw-bold rounded-pill px-5 text-white">
              <i class="fas fa-check-circle me-1 text-white"></i> Save Team Member
            </button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const avatarInput = document.getElementById('avatarInput');
    const previewImg = document.getElementById('avatarPreviewImg');
    const fallback = document.getElementById('avatarPreviewFallback');

    avatarInput.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          previewImg.src = e.target.result;
          previewImg.classList.remove('d-none');
          fallback.classList.add('d-none');
        };
        reader.readAsDataURL(file);
      } else {
        previewImg.src = '';
        previewImg.classList.add('d-none');
        fallback.classList.remove('d-none');
      }
    });
  });
</script>
@endpush

@endsection

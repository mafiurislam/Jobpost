@extends('admin.layout')

@section('title', 'Logo Management - Admin Dashboard')
@section('page_header', 'Logo Management')

@section('content')

<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card card-custom p-4">
      <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
          <h4 class="fw-bold text-dark mb-1"><i class="fas fa-image text-success me-2"></i> Logo Upload & Management</h4>
          <p class="text-secondary small mb-0">Upload a new site logo (JPG, JPEG, PNG). The logo will automatically update across the entire live website.</p>
        </div>
        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold">Live Dynamic</span>
      </div>

      <div class="mb-4 text-center p-4 bg-light rounded-4 border">
        <h6 class="fw-bold text-secondary mb-3">CURRENT ACTIVE WEBSITE LOGO:</h6>
        <div class="d-inline-block bg-white p-3 rounded-3 shadow-sm border mb-2">
          <img src="{{ asset($currentLogo) }}" alt="{{ $siteName }}" style="max-height: 80px; object-fit: contain;">
        </div>
        <p class="text-muted extra-small mb-0">Path: <code>{{ $currentLogo }}</code></p>
      </div>

      <form action="{{ route('admin.logo.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
          <label for="logo" class="form-label fw-bold">Select New Logo Image (JPG, JPEG, PNG)</label>
          <input type="file" name="logo" id="logo" class="form-control form-control-lg @error('logo') is-invalid @enderror" accept="image/jpeg,image/jpg,image/png" required>
          @error('logo')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          <div class="form-text mt-2 text-muted">
            <i class="fas fa-info-circle me-1"></i> Recommended format: Transparent PNG or high-res JPG. Maximum file size: 4MB.
          </div>
        </div>

        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
          <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4 fw-semibold">Cancel</a>
          <button type="submit" class="btn btn-success px-5 fw-bold rounded-pill">
            <i class="fas fa-upload me-1"></i> Upload & Update Logo
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

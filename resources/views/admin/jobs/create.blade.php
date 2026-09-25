@extends('admin.layout')

@section('title', 'Create Single Job - Admin Dashboard')
@section('page_header', 'Add New Single Job')

@section('content')

<div class="row justify-content-center">
  <div class="col-lg-10">
    <div class="card card-custom p-4">
      <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
          <h4 class="fw-bold text-dark mb-1"><i class="fas fa-plus-circle text-success me-2"></i> Create Single Job Post</h4>
          <p class="text-secondary small mb-0">Fill in the fields below according to your Job Card & Single Job design. Once saved, it will immediately appear live on the website.</p>
        </div>
        <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
          <i class="fas fa-arrow-left me-1"></i> Back to Jobs List
        </a>
      </div>

      <form action="{{ route('admin.jobs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3 mb-4">
          <div class="col-md-8">
            <label class="form-label fw-bold">Job Title <span class="text-danger">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="e.g. ALL OVERSEAS JOBS (Gulf & Europe Placement)" required>
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="col-md-4">
            <label class="form-label fw-bold">Sector / Category Name <span class="text-danger">*</span></label>
            <input type="text" name="sector_name" value="{{ old('sector_name') }}" class="form-control @error('sector_name') is-invalid @enderror" placeholder="e.g. Overseas Vacancy / Airlines" required>
            @error('sector_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <label class="form-label fw-bold">Company / Partner Name <span class="text-danger">*</span></label>
            <input type="text" name="company" value="{{ old('company', 'Bright Future Consultancy') }}" class="form-control" required>
          </div>

          <div class="col-md-4">
            <label class="form-label fw-bold">Job Location <span class="text-danger">*</span></label>
            <input type="text" name="location" value="{{ old('location') }}" class="form-control" placeholder="e.g. UAE & Qatar / Barrackpore, Kolkata" required>
          </div>

          <div class="col-md-4">
            <label class="form-label fw-bold">Salary / CTC Offered <span class="text-danger">*</span></label>
            <input type="text" name="salary" value="{{ old('salary') }}" class="form-control" placeholder="e.g. ₹ 45,000 – ₹ 90,000" required>
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label class="form-label fw-bold">Qualifications Needed <span class="text-danger">*</span></label>
            <input type="text" name="qualification" value="{{ old('qualification') }}" class="form-control" placeholder="e.g. ITI / Diploma / Experienced / 10th, 12th Pass" required>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-bold">Badge Tag Text (e.g. 100% FREE PLACEMENT)</label>
            <input type="text" name="badge_tag" value="{{ old('badge_tag', '100% FREE PLACEMENT') }}" class="form-control" placeholder="e.g. 100% FREE PLACEMENT or OVERSEAS VACANCY">
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Job Card / Header Poster Image Upload</label>
          <input type="file" name="poster_image" class="form-control" accept="image/*">
          <div class="form-text">Select a JPG/PNG poster image for the card header. If left empty, default sector graphic will be used.</div>
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Detailed Job Description <span class="text-danger">*</span></label>
          <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Write full job summary, placement highlights, visa info, etc." required>{{ old('description') }}</textarea>
          @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label class="form-label fw-bold">Candidate Requirements (List)</label>
            <textarea name="requirements" rows="4" class="form-control" placeholder="1. Valid Passport&#10;2. ITI or Diploma certificate&#10;3. Minimum 2 years experience">{{ old('requirements') }}</textarea>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Key Responsibilities / Duties</label>
            <textarea name="duties" rows="4" class="form-control" placeholder="1. Technical maintenance and panel wiring&#10;2. Adhere to safety standards">{{ old('duties') }}</textarea>
          </div>
        </div>

        <div class="row g-3 mb-4 p-3 bg-light rounded-3 border">
          <div class="col-md-6">
            <label class="form-label fw-bold">Contact Helpline Phone</label>
            <input type="text" name="contact_phone" value="{{ old('contact_phone', '+91 7001420469') }}" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Contact Official Email</label>
            <input type="email" name="contact_email" value="{{ old('contact_email', 'brightfutureconsultancybwn@gmail.com') }}" class="form-control">
          </div>
        </div>

        <div class="d-flex align-items-center gap-4 mb-4">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" checked>
            <label class="form-check-label fw-bold" for="is_active">Publish Live Immediately</label>
          </div>

          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1" checked>
            <label class="form-check-label fw-bold" for="is_featured">Feature on Home Page</label>
          </div>
        </div>

        <div class="d-flex flex-column-reverse flex-sm-row justify-content-end gap-2 pt-3 border-top">
          <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-secondary px-4 py-2 text-center">Cancel</a>
          <button type="submit" class="btn btn-success px-4 py-2 fw-bold rounded-pill text-center text-white shadow-sm">
            <i class="fas fa-save me-1 text-white"></i> Save & Publish Job Post
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

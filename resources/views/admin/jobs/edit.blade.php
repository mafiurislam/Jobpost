@extends('admin.layout')

@section('title', 'Edit Job - ' . $job->title)
@section('page_header', 'Edit Single Job')

@section('content')

<div class="row justify-content-center">
  <div class="col-lg-10">
    <div class="card card-custom p-4">
      <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
          <h4 class="fw-bold text-dark mb-1"><i class="fas fa-pencil-alt text-warning me-2"></i> Edit Job Post</h4>
          <p class="text-secondary small mb-0">Updating details for: <strong>{{ $job->title }}</strong></p>
        </div>
        <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
          <i class="fas fa-arrow-left me-1"></i> Back to Jobs List
        </a>
      </div>

      <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3 mb-4">
          <div class="col-md-8">
            <label class="form-label fw-bold">Job Title <span class="text-danger">*</span></label>
            <input type="text" name="title" value="{{ old('title', $job->title) }}" class="form-control" required>
          </div>

          <div class="col-md-4">
            <label class="form-label fw-bold">Sector / Category Name <span class="text-danger">*</span></label>
            <input type="text" name="sector_name" value="{{ old('sector_name', $job->sector_name) }}" class="form-control" required>
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <label class="form-label fw-bold">Company / Partner Name <span class="text-danger">*</span></label>
            <input type="text" name="company" value="{{ old('company', $job->company) }}" class="form-control" required>
          </div>

          <div class="col-md-4">
            <label class="form-label fw-bold">Job Location <span class="text-danger">*</span></label>
            <input type="text" name="location" value="{{ old('location', $job->location) }}" class="form-control" required>
          </div>

          <div class="col-md-4">
            <label class="form-label fw-bold">Salary / CTC Offered <span class="text-danger">*</span></label>
            <input type="text" name="salary" value="{{ old('salary', $job->salary) }}" class="form-control" required>
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label class="form-label fw-bold">Qualifications Needed <span class="text-danger">*</span></label>
            <input type="text" name="qualification" value="{{ old('qualification', $job->qualification) }}" class="form-control" required>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-bold">Badge Tag Text</label>
            <input type="text" name="badge_tag" value="{{ old('badge_tag', $job->badge_tag) }}" class="form-control">
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Job Card / Header Poster Image</label>
          <input type="file" name="poster_image" class="form-control" accept="image/*">
          @if(!empty($job->poster_image))
            <div class="mt-2">
              <span class="small text-muted me-2">Current Poster Image:</span>
              <img src="{{ $job->image_url }}" alt="Poster Image" style="max-height: 90px; object-fit: contain;" class="rounded border p-1 bg-light">
            </div>
          @endif
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Detailed Job Description <span class="text-danger">*</span></label>
          <textarea name="description" rows="5" class="form-control" required>{{ old('description', $job->description) }}</textarea>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label class="form-label fw-bold">Candidate Requirements</label>
            <textarea name="requirements" rows="4" class="form-control">{{ old('requirements', $job->requirements) }}</textarea>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Key Responsibilities / Duties</label>
            <textarea name="duties" rows="4" class="form-control">{{ old('duties', $job->duties) }}</textarea>
          </div>
        </div>

        <div class="row g-3 mb-4 p-3 bg-light rounded-3 border">
          <div class="col-md-6">
            <label class="form-label fw-bold">Contact Helpline Phone</label>
            <input type="text" name="contact_phone" value="{{ old('contact_phone', $job->contact_phone) }}" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Contact Official Email</label>
            <input type="email" name="contact_email" value="{{ old('contact_email', $job->contact_email) }}" class="form-control">
          </div>
        </div>

        <div class="d-flex align-items-center gap-4 mb-4">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ $job->is_active ? 'checked' : '' }}>
            <label class="form-check-label fw-bold" for="is_active">Publish Live Immediately</label>
          </div>

          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1" {{ $job->is_featured ? 'checked' : '' }}>
            <label class="form-check-label fw-bold" for="is_featured">Feature on Home Page</label>
          </div>
        </div>

        <div class="d-flex flex-column-reverse flex-sm-row justify-content-end gap-2 pt-3 border-top">
          <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-secondary px-4 py-2 text-center">Cancel</a>
          <button type="submit" class="btn btn-success px-4 py-2 fw-bold rounded-pill text-center text-white shadow-sm">
            <i class="fas fa-save me-1 text-white"></i> Update Job Post
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

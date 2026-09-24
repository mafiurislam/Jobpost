@extends('admin.layout')

@section('title', 'Edit ' . $section->section_name . ' - Admin Dashboard')
@section('page_header', 'Edit ' . $section->section_name)

@section('content')

<div class="row justify-content-center">
  <div class="col-lg-10">
    <div class="card card-custom p-4">
      <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
        <div>
          <span class="badge bg-success fw-bold text-uppercase px-3 py-2 mb-2">{{ $section->section_name }}</span>
          <h4 class="fw-bold text-dark mb-1">Customize Section Content & Media</h4>
          <p class="text-secondary small mb-0">Changes saved here will automatically update the live Home Page immediately.</p>
        </div>
        <a href="{{ route('admin.home.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
          <i class="fas fa-arrow-left me-1"></i> Back to Sections
        </a>
      </div>

      <form action="{{ route('admin.home.update', $section->section_key) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-check form-switch mb-4 p-3 bg-light rounded-3 border ms-0">
          <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="is_visible" name="is_visible" value="1" {{ $section->is_visible ? 'checked' : '' }}>
          <label class="form-check-input-label fw-bold text-dark" for="is_visible">Display Section on Live Website</label>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label class="form-label fw-bold">Section Tagline / Category Tag</label>
            <input type="text" name="tagline" value="{{ old('tagline', $section->tagline) }}" class="form-control" placeholder="e.g. ABOUT US or GOT QUESTIONS?">
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Main Section Title</label>
            <input type="text" name="title" value="{{ old('title', $section->title) }}" class="form-control" placeholder="Section Heading Title">
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Section Subtitle / Short Lead Text</label>
          <input type="text" name="subtitle" value="{{ old('subtitle', $section->subtitle) }}" class="form-control" placeholder="Secondary subtitle text">
        </div>

        <div class="mb-4">
          <label class="form-label fw-bold">Detailed Description Paragraph</label>
          <textarea name="description" rows="5" class="form-control">{{ old('description', $section->description) }}</textarea>
        </div>

        <!-- Button Customization -->
        <div class="row g-3 mb-4 p-3 bg-light rounded-3 border">
          <div class="col-md-6">
            <label class="form-label fw-bold">Button Text</label>
            <input type="text" name="button_text" value="{{ old('button_text', $section->button_text) }}" class="form-control" placeholder="e.g. Read more about us">
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Button URL / Action Link</label>
            <input type="text" name="button_url" value="{{ old('button_url', $section->button_url) }}" class="form-control" placeholder="e.g. /about.html or /jobs">
          </div>
        </div>

        <!-- Special Leadership Details for Section 02: Our Story (Image 1) -->
        @if($section->section_key === 'our_story')
        <div class="mb-4 p-4 rounded-3 border border-success bg-success bg-opacity-10">
          <h5 class="fw-bold text-success mb-3"><i class="fas fa-user-tie me-2"></i> Founder & CEO Profile Card Settings (Image 1 Design)</h5>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Leader Full Name</label>
              <input type="text" name="leader_name" value="{{ old('leader_name', $section->content_json['leader_name'] ?? 'Mohammad Manirul') }}" class="form-control" placeholder="e.g. Mohammad Manirul">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Leader Designation / Role</label>
              <input type="text" name="leader_role" value="{{ old('leader_role', $section->content_json['leader_role'] ?? 'Founder & CEO') }}" class="form-control" placeholder="e.g. Founder & CEO">
            </div>
            <div class="col-md-12">
              <label class="form-label fw-bold">Leader Profile / CEO Avatar Image</label>
              <input type="file" name="extra_image" class="form-control" accept="image/*">
              @if(!empty($section->extra_image_path))
                <div class="mt-2">
                  <span class="small text-muted me-2">Current Photo:</span>
                  <img src="{{ asset($section->extra_image_path) }}" alt="CEO Avatar" style="height: 50px; width: 50px; border-radius: 50%; object-fit: cover;">
                </div>
              @endif
            </div>
          </div>
        </div>
        @endif

        <!-- Media Upload -->
        <div class="mb-4">
          <label class="form-label fw-bold">Upload / Replace Section Main Image</label>
          <input type="file" name="image" class="form-control" accept="image/*">
          @if(!empty($section->image_path))
            <div class="mt-2">
              <span class="small text-muted me-2">Current Image:</span>
              <img src="{{ asset($section->image_path) }}" alt="Current Image" style="max-height: 80px; object-fit: contain;" class="rounded border p-1 bg-white">
            </div>
          @endif
        </div>

        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
          <a href="{{ route('admin.home.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
          <button type="submit" class="btn btn-success px-5 fw-bold rounded-pill">
            <i class="fas fa-save me-1"></i> Save Section Changes
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

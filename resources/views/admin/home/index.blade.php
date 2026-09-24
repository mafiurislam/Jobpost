@extends('admin.layout')

@section('title', 'Home Page Sections Management - Admin Dashboard')
@section('page_header', 'Home Page Sections Manager')

@section('content')

<div class="card card-custom p-4 mb-4">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <div>
      <h4 class="fw-bold text-dark mb-1"><i class="fas fa-layer-group text-success me-2"></i> Dynamic Home Page Sections</h4>
      <p class="text-secondary small mb-0">Every section on the live Home Page is listed below with clear **section-name separators**. Click **Edit Section** to customize titles, text, images, or leadership details.</p>
    </div>
  </div>
</div>

<div class="row g-4">
  @foreach($sections as $section)
  <div class="col-12">
    <div class="card card-custom overflow-hidden">
      <!-- Section-Name Separator Header -->
      <div class="bg-dark text-white p-3 d-flex align-items-center justify-content-between" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;">
        <div class="d-flex align-items-center gap-2">
          <span class="badge bg-success fw-bold text-uppercase px-3 py-2" style="font-size: 0.85rem;">{{ $section->section_name }}</span>
          <span class="text-white-50 small ms-2">Key: <code>{{ $section->section_key }}</code></span>
        </div>
        <div>
          @if($section->is_visible)
            <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-30 rounded-pill px-3 py-1 fw-bold">Live Visible</span>
          @else
            <span class="badge bg-secondary rounded-pill px-3 py-1 fw-bold">Hidden</span>
          @endif
        </div>
      </div>

      <div class="card-body p-4">
        <div class="row align-items-center g-4">
          <div class="col-md-8">
            <h5 class="fw-bold text-dark mb-2">{{ $section->title ?? 'Untitled Section' }}</h5>
            <p class="text-secondary small mb-3">{{ Str::limit($section->description, 180) }}</p>
            
            <div class="d-flex flex-wrap gap-3 small text-muted">
              @if(!empty($section->tagline))
                <span><i class="fas fa-tag me-1 text-success"></i> Tagline: <strong>{{ $section->tagline }}</strong></span>
              @endif
              @if(!empty($section->button_text))
                <span><i class="fas fa-link me-1 text-primary"></i> Button: <strong>{{ $section->button_text }}</strong> ({{ $section->button_url }})</span>
              @endif
              @if($section->section_key === 'our_story' && !empty($section->content_json['leader_name']))
                <span><i class="fas fa-user-tie me-1 text-warning"></i> Leader: <strong>{{ $section->content_json['leader_name'] }}</strong> ({{ $section->content_json['leader_role'] ?? 'CEO' }})</span>
              @endif
            </div>
          </div>

          <div class="col-md-4 text-end">
            <a href="{{ route('admin.home.edit', $section->section_key) }}" class="btn btn-success fw-bold rounded-pill px-4 py-2">
              <i class="fas fa-edit me-1"></i> Edit Section Content & Image
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>

@endsection

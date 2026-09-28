@extends('admin.layout')

@section('title', 'Leadership Team Management - Admin Dashboard')
@section('page_header', 'Leadership Team (CRUD)')

@section('content')

<!-- Header Banner Card -->
<div class="card card-custom p-3 p-md-4 mb-3 mb-md-4 shadow-sm border-0">
  <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
    <div>
      <h4 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
        <span class="badge bg-success bg-opacity-10 text-success p-2 rounded-3">
          <i class="fas fa-users-cog fa-sm"></i>
        </span>
        <span>Meet Our Leadership Team (CRUD)</span>
      </h4>
      <p class="text-secondary small mb-0">
        Create, edit, reorder, and manage leadership profiles and customize the section live on the website.
      </p>
    </div>
    <div class="d-flex align-items-center gap-2 flex-wrap">
      <a href="{{ route('about') }}" target="_blank" class="btn btn-outline-dark fw-bold rounded-pill px-3 py-2 text-center" title="View live about page">
        <i class="fas fa-external-link-alt me-1"></i> Preview Live
      </a>
      <a href="{{ route('admin.team.create') }}" class="btn btn-success fw-bold rounded-pill px-4 py-2 text-center text-white">
        <i class="fas fa-user-plus me-1 text-white"></i> Add New Member
      </a>
    </div>
  </div>
</div>

<!-- Section Header & Visibility Customization Form -->
<div class="card card-custom p-3 p-md-4 mb-3 mb-md-4 shadow-sm border-0">
  <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
    <div>
      <h5 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
        <i class="fas fa-sliders-h text-success"></i> Section Header & Appearance
      </h5>
      <small class="text-secondary">Customize the tagline, heading, and subtitle displayed above the team cards</small>
    </div>
    <span class="badge {{ $sectionVisible ? 'bg-success text-white' : 'bg-secondary text-white' }} px-3 py-2 rounded-pill">
      <i class="fas {{ $sectionVisible ? 'fa-eye' : 'fa-eye-slash' }} me-1"></i>
      Section {{ $sectionVisible ? 'Visible on Website' : 'Hidden from Website' }}
    </span>
  </div>

  <form action="{{ route('admin.team.section-settings') }}" method="POST">
    @csrf
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label fw-bold text-dark small">Section Tagline</label>
        <input type="text" name="team_section_tagline" value="{{ old('team_section_tagline', $sectionTagline) }}" class="form-control" placeholder="e.g. LEADERSHIP & EXPERTISE">
        <div class="form-text">Small uppercase badge text above main heading</div>
      </div>

      <div class="col-md-5">
        <label class="form-label fw-bold text-dark small">Main Heading / Title <span class="text-danger">*</span></label>
        <input type="text" name="team_section_title" value="{{ old('team_section_title', $sectionTitle) }}" class="form-control" required placeholder="e.g. Meet Our Leadership Team">
        <div class="form-text">The primary heading of the section</div>
      </div>

      <div class="col-md-3">
        <label class="form-label fw-bold text-dark small d-block">Section Visibility</label>
        <div class="form-check form-switch mt-2">
          <input class="form-check-input" type="checkbox" name="team_section_visible" value="1" id="sectionVisibleSwitch" {{ $sectionVisible ? 'checked' : '' }} style="cursor: pointer; width: 2.5em; height: 1.3em;">
          <label class="form-check-label ms-2 fw-semibold text-dark" for="sectionVisibleSwitch">
            Display this section
          </label>
        </div>
      </div>

      <div class="col-12">
        <label class="form-label fw-bold text-dark small">Section Subtitle / Description</label>
        <textarea name="team_section_subtitle" rows="2" class="form-control" placeholder="e.g. Dedicated counselors and HR professionals helping you take the next big step in your career.">{{ old('team_section_subtitle', $sectionSubtitle) }}</textarea>
      </div>

      <div class="col-12 d-flex justify-content-end">
        <button type="submit" class="btn btn-success fw-bold rounded-pill px-4 text-white">
          <i class="fas fa-save me-1 text-white"></i> Update Section Header
        </button>
      </div>
    </div>
  </form>
</div>

<!-- Search & Filter Bar -->
<div class="card card-custom p-3 mb-3 mb-md-4 shadow-sm border-0">
  <form action="{{ route('admin.team.index') }}" method="GET" class="row g-2 align-items-center">
    <div class="col-12 col-md-9">
      <div class="input-group">
        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-search"></i></span>
        <input type="text" name="search" value="{{ request('search') }}" class="form-control bg-light border-start-0" placeholder="Search team member by name, role, or bio...">
      </div>
    </div>
    <div class="col-12 col-md-3 d-flex gap-2">
      <button type="submit" class="btn btn-dark fw-bold w-100">Search</button>
      @if(request('search'))
      <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary" title="Reset filter">Reset</a>
      @endif
    </div>
  </form>
</div>

<!-- Team Members Table -->
<div class="card card-custom overflow-hidden shadow-sm border-0">
  <div class="d-flex d-md-none justify-content-end p-2 bg-light border-bottom text-muted extra-small">
    <i class="fas fa-arrows-alt-h me-1"></i> Swipe table horizontally to see all columns
  </div>
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0" style="min-width: 750px;">
      <thead class="bg-light text-secondary small text-uppercase fw-bold border-bottom">
        <tr>
          <th class="ps-4 py-3" style="width: 32%;">Member & Avatar</th>
          <th class="py-3" style="width: 22%;">Role / Designation</th>
          <th class="py-3" style="width: 26%;">Bio Description</th>
          <th class="py-3 text-center" style="width: 8%;">Order</th>
          <th class="py-3 text-center" style="width: 12%;">Status</th>
          <th class="text-end pe-4 py-3" style="width: 15%;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($members as $member)
        <tr>
          <td class="ps-4 py-3">
            <div class="d-flex align-items-center gap-3">
              <!-- Avatar Ring Matching Reference Design -->
              <div class="flex-shrink-0" style="width: 54px; height: 54px; border-radius: 50%; border: 2.5px solid #16a34a; padding: 2px; overflow: hidden; background: #ffffff;">
                @if($member->image_url)
                  <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
                @else
                  <div class="w-100 h-100 rounded-circle bg-success bg-opacity-10 text-success fw-bold d-flex align-items-center justify-content-center" style="font-size: 0.95rem;">
                    {{ $member->initials }}
                  </div>
                @endif
              </div>
              <div>
                <h6 class="fw-bold text-dark mb-0">{{ $member->name }}</h6>
                <small class="text-muted">ID: #{{ $member->id }}</small>
              </div>
            </div>
          </td>

          <td class="py-3">
            <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-3 py-1 rounded-pill" style="font-size: 0.85rem; border: 1px solid rgba(22, 163, 74, 0.2);">
              {{ $member->role }}
            </span>
          </td>

          <td class="py-3">
            <p class="text-secondary small mb-0" style="line-height: 1.5; max-width: 280px;">
              {{ Str::limit($member->bio ?? 'No bio description provided.', 85) }}
            </p>
          </td>

          <td class="py-3 text-center">
            <span class="badge bg-light text-dark border px-2 py-1 fw-bold">
              {{ $member->sort_order }}
            </span>
          </td>

          <td class="py-3 text-center">
            <form action="{{ route('admin.team.toggle-status', $member) }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-sm {{ $member->is_active ? 'btn-success text-white' : 'btn-outline-secondary' }} rounded-pill px-3 py-1 fw-semibold" title="Click to toggle status">
                <i class="fas {{ $member->is_active ? 'fa-check-circle' : 'fa-ban' }} me-1"></i>
                {{ $member->is_active ? 'Active' : 'Inactive' }}
              </button>
            </form>
          </td>

          <td class="text-end pe-4 py-3">
            <div class="d-flex align-items-center justify-content-end gap-2">
              <a href="{{ route('admin.team.edit', $member) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold" title="Edit Member">
                <i class="fas fa-edit me-1"></i> Edit
              </a>

              <form action="{{ route('admin.team.destroy', $member) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete \'{{ $member->name }}\'? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2" title="Delete Member">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center py-5">
            <div class="py-4">
              <div class="bg-light text-muted rounded-circle d-inline-flex p-3 mb-3">
                <i class="fas fa-users-slash fa-2x"></i>
              </div>
              <h6 class="fw-bold text-dark">No team members found</h6>
              <p class="text-secondary small mb-3">Get started by creating your first leadership team member.</p>
              <a href="{{ route('admin.team.create') }}" class="btn btn-success fw-bold rounded-pill px-4 text-white">
                <i class="fas fa-plus me-1 text-white"></i> Add Team Member
              </a>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($members->hasPages())
  <div class="p-3 border-top bg-light d-flex justify-content-center">
    {{ $members->links() }}
  </div>
  @endif
</div>

@endsection

@extends('admin.layout')

@section('title', 'Jobs Management - Admin Dashboard')
@section('page_header', 'Jobs Management (CRUD)')

@section('content')

<div class="card card-custom p-4 mb-4">
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
    <div>
      <h4 class="fw-bold text-dark mb-1"><i class="fas fa-briefcase text-success me-2"></i> All Job Posts & Single Job Listings</h4>
      <p class="text-secondary small mb-0">Create, edit, view, update, or delete job posts live on the website.</p>
    </div>
    <a href="{{ route('admin.jobs.create') }}" class="btn btn-success fw-bold rounded-pill px-4 py-2">
      <i class="fas fa-plus-circle me-1"></i> Add New Single Job
    </a>
  </div>
</div>

<!-- Search Bar -->
<div class="card card-custom p-3 mb-4">
  <form action="{{ route('admin.jobs.index') }}" method="GET" class="row g-2 align-items-center">
    <div class="col-md-9">
      <div class="input-group">
        <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
        <input type="text" name="search" value="{{ request('search') }}" class="form-control bg-light border-start-0" placeholder="Search by title, sector, company, location...">
      </div>
    </div>
    <div class="col-md-3 d-grid">
      <button type="submit" class="btn btn-dark fw-bold">Search Jobs</button>
    </div>
  </form>
</div>

<!-- Job Posts Table -->
<div class="card card-custom overflow-hidden">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="bg-light text-secondary small text-uppercase fw-bold border-bottom">
        <tr>
          <th class="ps-4 py-3">Job Title & Sector</th>
          <th class="py-3">Salary / CTC</th>
          <th class="py-3">Badge Tag</th>
          <th class="py-3">Status</th>
          <th class="text-end pe-4 py-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($jobs as $job)
        <tr>
          <td class="ps-4 py-3">
            <div class="d-flex align-items-center gap-3">
              <div class="bg-light p-2 rounded-3 border d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; flex-shrink: 0;">
                <i class="fas fa-briefcase text-success"></i>
              </div>
              <div>
                <a href="{{ route('jobs.show', $job->id) }}" target="_blank" class="fw-bold text-dark text-decoration-none d-block mb-1">
                  {{ $job->title }}
                </a>
                <span class="badge bg-light text-secondary border fw-normal">{{ $job->sector_name }}</span>
                <small class="text-muted ms-2"><i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $job->location }}</small>
              </div>
            </div>
          </td>
          <td class="fw-bold text-success">{{ $job->salary }}</td>
          <td>
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-1 rounded-pill">
              {{ $job->badge_tag ?? '100% FREE JOBS' }}
            </span>
          </td>
          <td>
            <form action="{{ route('admin.jobs.toggle-status', $job->id) }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-sm p-0 border-0">
                @if($job->is_active)
                  <span class="badge bg-success rounded-pill px-3 py-1"><i class="fas fa-check-circle me-1"></i> Active</span>
                @else
                  <span class="badge bg-secondary rounded-pill px-3 py-1"><i class="fas fa-pause-circle me-1"></i> Inactive</span>
                @endif
              </button>
            </form>
          </td>
          <td class="text-end pe-4 py-3">
            <div class="d-flex justify-content-end gap-2">
              <a href="{{ route('jobs.show', $job->id) }}" target="_blank" class="btn btn-outline-info btn-sm rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;" title="View Live Single Job Page">
                <i class="fas fa-eye"></i>
              </a>
              <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-outline-warning btn-sm rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;" title="Edit Job Post">
                <i class="fas fa-pencil-alt"></i>
              </a>
              <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this job post?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;" title="Delete Job">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center py-5 text-muted">
            No job posts found. Click <strong>Add New Single Job</strong> to publish a new vacancy.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
    {{ $jobs->withQueryString()->links() }}
  </div>
</div>

@endsection

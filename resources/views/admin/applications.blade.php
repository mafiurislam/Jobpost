@extends('admin.layout')

@section('title', 'Candidate Job Applications - Admin Portal')
@section('page_header', 'Job Applications')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-extrabold text-dark mb-1">Candidate Registrations</h4>
    <p class="text-secondary small mb-0">Candidate profiles registered through the Join Us / Application page</p>
  </div>
</div>

<div class="card card-custom p-4 bg-white">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>Date</th>
          <th>Candidate</th>
          <th>Contact</th>
          <th>Sector & Location</th>
          <th>Qualification & Exp</th>
          <th>Connect</th>
        </tr>
      </thead>
      <tbody>
        @forelse($applications as $app)
        <tr>
          <td class="text-secondary small" style="white-space: nowrap;">
            {{ $app->created_at->format('d M Y, h:i A') }}
          </td>
          <td>
            <strong class="text-dark">{{ $app->name }}</strong>
          </td>
          <td>
            <div class="small">
              <a href="tel:{{ $app->phone }}" class="text-success text-decoration-none d-block"><i class="fas fa-phone-alt me-1"></i> {{ $app->phone }}</a>
              <a href="mailto:{{ $app->email }}" class="text-secondary text-decoration-none d-block"><i class="fas fa-envelope me-1"></i> {{ $app->email }}</a>
            </div>
          </td>
          <td>
            <div>
              <span class="badge bg-success bg-opacity-10 text-success fw-bold">{{ $app->preferred_sector ?? 'General' }}</span>
              <span class="text-secondary small d-block mt-1"><i class="fas fa-map-marker-alt me-1"></i> {{ $app->preferred_location ?? 'Any' }}</span>
            </div>
          </td>
          <td>
            <div class="small">
              <span class="fw-semibold text-dark">{{ $app->qualification ?? '10th/12th' }}</span>
              <p class="text-muted mb-0" style="max-width: 250px;">{{ Str::limit($app->experience ?? 'Fresher', 50) }}</p>
            </div>
          </td>
          <td>
            <a href="https://wa.me/91{{ preg_replace('/[^0-9]/', '', $app->phone) }}?text=Hi%20{{ urlencode($app->name) }},%20regarding%20your%20application%20on%20Bright%20Future%20Consultancy" target="_blank" class="btn btn-sm btn-success rounded-pill px-3">
              <i class="fab fa-whatsapp me-1"></i> WhatsApp
            </a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center py-5 text-secondary">
            <i class="fas fa-user-friends fa-3x mb-3 text-muted opacity-50"></i>
            <p class="mb-0">No candidate applications submitted yet.</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($applications->hasPages())
  <div class="mt-4 pt-3 border-top">
    {{ $applications->links() }}
  </div>
  @endif
</div>

@endsection

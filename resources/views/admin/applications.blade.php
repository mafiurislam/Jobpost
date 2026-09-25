@extends('admin.layout')

@section('title', 'Candidate Job Applications - Admin Portal')
@section('page_header', 'Job Applications')

@section('content')

<div class="card card-custom p-3 p-md-4 mb-3 mb-md-4 shadow-sm border-0">
  <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
    <div>
      <h4 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
        <span class="badge bg-warning bg-opacity-15 text-warning p-2 rounded-3">
          <i class="fas fa-user-graduate fa-sm"></i>
        </span>
        <span>Candidate Registrations</span>
      </h4>
      <p class="text-secondary small mb-0">Candidate profiles submitted through the Join Us / Application page.</p>
    </div>
    <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill fw-bold align-self-start align-self-sm-auto">
      Total: {{ $applications->total() }} Candidates
    </span>
  </div>
</div>

<div class="card card-custom overflow-hidden shadow-sm border-0">
  <div class="d-flex d-md-none justify-content-end p-2 bg-light border-bottom text-muted extra-small">
    <i class="fas fa-arrows-alt-h me-1"></i> Swipe table horizontally to see all columns
  </div>
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0" style="min-width: 680px;">
      <thead class="bg-light text-secondary small text-uppercase fw-bold border-bottom">
        <tr>
          <th class="ps-4 py-3">Date</th>
          <th class="py-3">Candidate</th>
          <th class="py-3">Contact</th>
          <th class="py-3">Sector & Location</th>
          <th class="py-3">Qualification & Exp</th>
          <th class="text-end pe-4 py-3">Connect</th>
        </tr>
      </thead>
      <tbody>
        @forelse($applications as $app)
        <tr>
          <td class="ps-4 py-3 text-secondary small text-nowrap">
            {{ $app->created_at->format('d M Y') }}<br>
            <span class="text-muted extra-small">{{ $app->created_at->format('h:i A') }}</span>
          </td>
          <td>
            <strong class="text-dark d-block">{{ $app->name }}</strong>
          </td>
          <td>
            <div class="small">
              <a href="tel:{{ $app->phone }}" class="text-success text-decoration-none fw-semibold d-block"><i class="fas fa-phone-alt me-1"></i> {{ $app->phone }}</a>
              <a href="mailto:{{ $app->email }}" class="text-secondary text-decoration-none d-block"><i class="fas fa-envelope me-1"></i> {{ $app->email }}</a>
            </div>
          </td>
          <td>
            <div>
              <span class="badge bg-success bg-opacity-10 text-success fw-bold">{{ $app->preferred_sector ?? 'General' }}</span>
              <span class="text-secondary small d-block mt-1"><i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $app->preferred_location ?? 'Any' }}</span>
            </div>
          </td>
          <td>
            <div class="small">
              <span class="fw-semibold text-dark">{{ $app->qualification ?? '10th/12th' }}</span>
              <p class="text-muted mb-0" style="max-width: 220px;">{{ Str::limit($app->experience ?? 'Fresher', 50) }}</p>
            </div>
          </td>
          <td class="text-end pe-4 py-3">
            <a href="https://wa.me/91{{ preg_replace('/[^0-9]/', '', $app->phone) }}?text=Hi%20{{ urlencode($app->name) }},%20regarding%20your%20application%20on%20Bright%20Future%20Consultancy" target="_blank" class="btn btn-sm btn-success rounded-pill px-3 text-white fw-bold shadow-sm">
              <i class="fab fa-whatsapp me-1 text-white"></i> WhatsApp
            </a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center py-5 text-secondary">
            <i class="fas fa-user-friends fa-3x mb-3 text-muted opacity-50 d-block"></i>
            <p class="mb-0">No candidate applications submitted yet.</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($applications->hasPages())
  <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
    {{ $applications->links() }}
  </div>
  @endif
</div>

@endsection

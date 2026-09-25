@extends('admin.layout')

@section('title', 'Contact Inquiries - Admin Portal')
@section('page_header', 'Contact Inquiries')

@section('content')

<div class="card card-custom p-3 p-md-4 mb-3 mb-md-4 shadow-sm border-0">
  <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
    <div>
      <h4 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
        <span class="badge bg-danger bg-opacity-15 text-danger p-2 rounded-3">
          <i class="fas fa-envelope-open-text fa-sm"></i>
        </span>
        <span>Messages & Inquiries</span>
      </h4>
      <p class="text-secondary small mb-0">Messages submitted by jobseekers and employers via Contact Us page.</p>
    </div>
    <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill fw-bold align-self-start align-self-sm-auto">
      Total: {{ $inquiries->total() }} Inquiries
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
          <th class="py-3">Name</th>
          <th class="py-3">Contact Info</th>
          <th class="py-3">Subject</th>
          <th class="py-3">Message</th>
          <th class="text-end pe-4 py-3">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($inquiries as $inq)
        <tr>
          <td class="ps-4 py-3 text-secondary small text-nowrap">
            {{ $inq->created_at->format('d M Y') }}<br>
            <span class="text-muted extra-small">{{ $inq->created_at->format('h:i A') }}</span>
          </td>
          <td>
            <strong class="text-dark d-block">{{ $inq->name }}</strong>
          </td>
          <td>
            <div class="small">
              <a href="tel:{{ $inq->phone }}" class="text-success text-decoration-none fw-semibold d-block"><i class="fas fa-phone-alt me-1"></i> {{ $inq->phone }}</a>
              <a href="mailto:{{ $inq->email }}" class="text-secondary text-decoration-none d-block"><i class="fas fa-envelope me-1"></i> {{ $inq->email }}</a>
            </div>
          </td>
          <td>
            <span class="badge bg-light text-dark border">{{ $inq->subject ?? 'General' }}</span>
          </td>
          <td>
            <div class="small text-secondary" style="max-width: 300px;">
              {{ $inq->message }}
            </div>
          </td>
          <td class="text-end pe-4 py-3">
            <a href="https://wa.me/91{{ preg_replace('/[^0-9]/', '', $inq->phone) }}?text=Hi%20{{ urlencode($inq->name) }},%20responding%20to%20your%20inquiry%20on%20Bright%20Future%20Consultancy" target="_blank" class="btn btn-sm btn-success rounded-pill px-3 text-white fw-bold shadow-sm">
              <i class="fab fa-whatsapp me-1 text-white"></i> Reply
            </a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center py-5 text-secondary">
            <i class="fas fa-inbox fa-3x mb-3 text-muted opacity-50 d-block"></i>
            <p class="mb-0">No contact inquiries received yet.</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($inquiries->hasPages())
  <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
    {{ $inquiries->links() }}
  </div>
  @endif
</div>

@endsection

@extends('admin.layout')

@section('title', 'Contact Inquiries - Admin Portal')
@section('page_header', 'Contact Inquiries')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-extrabold text-dark mb-1">Messages & Inquiries</h4>
    <p class="text-secondary small mb-0">Messages submitted by jobseekers and employers via Contact Us page</p>
  </div>
</div>

<div class="card card-custom p-4 bg-white">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>Date</th>
          <th>Name</th>
          <th>Contact Info</th>
          <th>Subject</th>
          <th>Message</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($inquiries as $inq)
        <tr>
          <td class="text-secondary small" style="white-space: nowrap;">
            {{ $inq->created_at->format('d M Y, h:i A') }}
          </td>
          <td>
            <strong class="text-dark">{{ $inq->name }}</strong>
          </td>
          <td>
            <div class="small">
              <a href="tel:{{ $inq->phone }}" class="text-success text-decoration-none d-block"><i class="fas fa-phone-alt me-1"></i> {{ $inq->phone }}</a>
              <a href="mailto:{{ $inq->email }}" class="text-secondary text-decoration-none d-block"><i class="fas fa-envelope me-1"></i> {{ $inq->email }}</a>
            </div>
          </td>
          <td>
            <span class="badge bg-light text-dark border">{{ $inq->subject ?? 'General' }}</span>
          </td>
          <td>
            <div class="small text-secondary" style="max-width: 320px;">
              {{ $inq->message }}
            </div>
          </td>
          <td>
            <a href="https://wa.me/91{{ preg_replace('/[^0-9]/', '', $inq->phone) }}?text=Hi%20{{ urlencode($inq->name) }},%20responding%20to%20your%20inquiry%20on%20Bright%20Future%20Consultancy" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3">
              <i class="fab fa-whatsapp me-1"></i> Reply
            </a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center py-5 text-secondary">
            <i class="fas fa-inbox fa-3x mb-3 text-muted opacity-50"></i>
            <p class="mb-0">No contact inquiries received yet.</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($inquiries->hasPages())
  <div class="mt-4 pt-3 border-top">
    {{ $inquiries->links() }}
  </div>
  @endif
</div>

@endsection

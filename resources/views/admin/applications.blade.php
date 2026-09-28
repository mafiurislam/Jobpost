@extends('admin.layout')

@section('title', 'Candidate Job Applications - Admin Portal')
@section('page_header', 'Job Applications')

@section('content')

<!-- Header Banner Card -->
<div class="card card-custom p-3 p-md-4 mb-3 mb-md-4 shadow-sm border-0">
  <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
    <div>
      <h4 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
        <span class="badge bg-warning bg-opacity-15 text-warning p-2 rounded-3">
          <i class="fas fa-user-graduate fa-sm"></i>
        </span>
        <span>Candidate Job Applications & Registrations</span>
      </h4>
      <p class="text-secondary small mb-0">Candidate profiles submitted through APPLY NOW forms and the Join Us registration portal.</p>
    </div>
    <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill fw-bold align-self-start align-self-sm-auto">
      Total: {{ $applications->total() }} Candidates
    </span>
  </div>
</div>

<!-- Search & Status Filter Bar -->
<div class="card card-custom p-3 mb-3 mb-md-4 shadow-sm border-0">
  <form action="{{ route('admin.applications.index') }}" method="GET" class="row g-2 align-items-center">
    <div class="col-12 col-md-6">
      <div class="input-group">
        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-search"></i></span>
        <input type="text" name="search" value="{{ request('search') }}" class="form-control bg-light border-start-0" placeholder="Search by name, phone, email, sector, or location...">
      </div>
    </div>
    <div class="col-6 col-md-3">
      <select name="status" class="form-select bg-light" onchange="this.form.submit()">
        <option value="">All Statuses</option>
        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Contacted</option>
        <option value="shortlisted" {{ request('status') === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
      </select>
    </div>
    <div class="col-6 col-md-3 d-flex gap-2">
      <button type="submit" class="btn btn-dark fw-bold w-100">Filter</button>
      @if(request('search') || request('status'))
      <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-secondary" title="Reset filter">Reset</a>
      @endif
    </div>
  </form>
</div>

<!-- Applications Table -->
<div class="card card-custom overflow-hidden shadow-sm border-0">
  <div class="d-flex d-md-none justify-content-end p-2 bg-light border-bottom text-muted extra-small">
    <i class="fas fa-arrows-alt-h me-1"></i> Swipe table horizontally to see all columns
  </div>
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0" style="min-width: 800px;">
      <thead class="bg-light text-secondary small text-uppercase fw-bold border-bottom">
        <tr>
          <th class="ps-4 py-3" style="width: 12%;">Date</th>
          <th class="py-3" style="width: 18%;">Candidate Name</th>
          <th class="py-3" style="width: 18%;">Candidate Contact</th>
          <th class="py-3" style="width: 20%;">Sector & Location</th>
          <th class="py-3" style="width: 18%;">Qualification & Exp</th>
          <th class="text-end pe-4 py-3" style="width: 14%;">Connect & Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($applications as $app)
        <tr>
          <!-- Date -->
          <td class="ps-4 py-3 text-secondary small text-nowrap">
            <span class="fw-semibold text-dark d-block">
              <i class="far fa-calendar-alt text-success me-1"></i> {{ $app->formatted_date }}
            </span>
            <span class="text-muted extra-small">{{ $app->created_at ? $app->created_at->format('h:i A') : '' }}</span>
          </td>

          <!-- Candidate Name -->
          <td>
            <div class="d-flex align-items-center gap-2">
              <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 38px; height: 38px; font-size: 0.85rem;">
                {{ strtoupper(substr($app->name, 0, 1)) }}
              </div>
              <div>
                <strong class="text-dark d-block mb-0">{{ $app->name }}</strong>
                <span class="badge {{ $app->status === 'shortlisted' ? 'bg-success text-white' : ($app->status === 'contacted' ? 'bg-primary text-white' : ($app->status === 'rejected' ? 'bg-danger text-white' : 'bg-warning text-dark')) }} extra-small rounded-pill">
                  {{ ucfirst($app->status ?? 'pending') }}
                </span>
              </div>
            </div>
          </td>

          <!-- Contact -->
          <td>
            <div class="small">
              <a href="tel:{{ $app->phone }}" class="text-success text-decoration-none fw-semibold d-block">
                <i class="fas fa-phone-alt me-1 text-success"></i> {{ $app->phone }}
              </a>
              <a href="mailto:{{ $app->email }}" class="text-secondary text-decoration-none d-block text-truncate" style="max-width: 160px;" title="{{ $app->email }}">
                <i class="fas fa-envelope me-1 text-muted"></i> {{ $app->email }}
              </a>
            </div>
          </td>

          <!-- Sector & Location -->
          <td>
            <div>
              @if(!empty($app->job_title))
                <span class="badge bg-dark text-white fw-bold mb-1 d-inline-block">{{ Str::limit($app->job_title, 26) }}</span>
              @endif
              <span class="badge bg-success bg-opacity-10 text-success fw-bold d-inline-block">{{ $app->preferred_sector ?? 'General Application' }}</span>
              <span class="text-secondary small d-block mt-1">
                <i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $app->preferred_location ?? 'Any Location' }}
              </span>
            </div>
          </td>

          <!-- Qualification & Experience -->
          <td>
            <div class="small">
              <span class="fw-semibold text-dark d-block">
                <i class="fas fa-graduation-cap text-primary me-1"></i> {{ $app->qualification ?? '10th/12th Pass' }}
              </span>
              <span class="text-muted d-block mt-1">
                <i class="fas fa-briefcase text-secondary me-1"></i> {{ Str::limit($app->experience ?? 'Fresher', 40) }}
              </span>
              @if(!empty($app->connect_preference))
                <span class="badge bg-light text-dark border extra-small mt-1">
                  Prefers: {{ $app->connect_preference }}
                </span>
              @endif
            </div>
          </td>

          <!-- Connect & Actions -->
          <td class="text-end pe-4 py-3">
            <div class="d-flex align-items-center justify-content-end gap-1 flex-wrap">
              <!-- Connect via WhatsApp Button -->
              @php
                $cleanPhone = preg_replace('/[^0-9]/', '', $app->phone);
                if (strlen($cleanPhone) === 10) {
                    $cleanPhone = '91' . $cleanPhone;
                }
              @endphp
              <a href="https://wa.me/{{ $cleanPhone }}?text=Hi%20{{ urlencode($app->name) }},%20regarding%20your%20application%20for%20{{ urlencode($app->job_title ?? $app->preferred_sector ?? 'job placement') }}%20at%20Bright%20Future%20Consultancy." target="_blank" class="btn btn-sm btn-success rounded-pill px-3 text-white fw-bold shadow-sm" title="Chat with candidate on WhatsApp">
                <i class="fab fa-whatsapp me-1 text-white"></i> Connect
              </a>

              <!-- View Details Trigger -->
              <button type="button" class="btn btn-sm btn-outline-dark rounded-circle p-0" style="width: 32px; height: 32px;" data-bs-toggle="modal" data-bs-target="#appDetailModal{{ $app->id }}" title="View Full Details">
                <i class="fas fa-eye"></i>
              </button>

              <!-- Delete Action -->
              <form action="{{ route('admin.applications.destroy', $app->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this application for \'{{ $app->name }}\'?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle p-0" style="width: 32px; height: 32px;" title="Delete Application">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </div>

            <!-- Application Details Modal -->
            <div class="modal fade text-start" id="appDetailModal{{ $app->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $app->id }}" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow">
                  <div class="modal-header bg-dark text-white rounded-top-4">
                    <h5 class="modal-title fw-bold" id="modalLabel{{ $app->id }}">
                      <i class="fas fa-user-circle text-success me-2"></i> {{ $app->name }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body p-4">
                    <div class="row g-3">
                      <div class="col-6">
                        <small class="text-muted d-block">Application Date</small>
                        <strong>{{ $app->formatted_date }}</strong>
                      </div>
                      <div class="col-6">
                        <small class="text-muted d-block">Current Status</small>
                        <span class="badge {{ $app->status === 'shortlisted' ? 'bg-success text-white' : ($app->status === 'contacted' ? 'bg-primary text-white' : ($app->status === 'rejected' ? 'bg-danger text-white' : 'bg-warning text-dark')) }} px-2 py-1">
                          {{ ucfirst($app->status ?? 'pending') }}
                        </span>
                      </div>
                      <div class="col-6">
                        <small class="text-muted d-block">Mobile / WhatsApp</small>
                        <a href="tel:{{ $app->phone }}" class="text-success fw-bold">{{ $app->phone }}</a>
                      </div>
                      <div class="col-6">
                        <small class="text-muted d-block">Email Address</small>
                        <a href="mailto:{{ $app->email }}">{{ $app->email }}</a>
                      </div>
                      <div class="col-6">
                        <small class="text-muted d-block">Sector / Job Applied</small>
                        <strong>{{ $app->job_title ?? $app->preferred_sector ?? 'General' }}</strong>
                      </div>
                      <div class="col-6">
                        <small class="text-muted d-block">Preferred Location</small>
                        <strong>{{ $app->preferred_location ?? 'Any' }}</strong>
                      </div>
                      <div class="col-6">
                        <small class="text-muted d-block">Highest Qualification</small>
                        <strong>{{ $app->qualification ?? 'Not specified' }}</strong>
                      </div>
                      <div class="col-6">
                        <small class="text-muted d-block">Preferred Connect Method</small>
                        <strong>{{ $app->connect_preference ?? 'WhatsApp' }}</strong>
                      </div>
                      <div class="col-12">
                        <small class="text-muted d-block">Experience Details</small>
                        <div class="p-3 bg-light rounded-3 mt-1 small">
                          {!! nl2br(e($app->experience ?? 'Fresher / None specified')) !!}
                        </div>
                      </div>
                      @if(!empty($app->notes))
                      <div class="col-12">
                        <small class="text-muted d-block">Candidate Notes / Message</small>
                        <div class="p-3 bg-light rounded-3 mt-1 small">
                          {!! nl2br(e($app->notes)) !!}
                        </div>
                      </div>
                      @endif

                      <!-- Update Status Form in Modal -->
                      <div class="col-12 pt-3 border-top mt-3">
                        <form action="{{ route('admin.applications.status', $app->id) }}" method="POST" class="d-flex align-items-center gap-2">
                          @csrf
                          @method('PATCH')
                          <label class="small fw-bold text-nowrap">Update Status:</label>
                          <select name="status" class="form-select form-select-sm">
                            <option value="pending" {{ $app->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="contacted" {{ $app->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                            <option value="shortlisted" {{ $app->status === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                            <option value="rejected" {{ $app->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                          </select>
                          <button type="submit" class="btn btn-sm btn-dark fw-bold text-nowrap">Save</button>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Close</button>
                    <a href="https://wa.me/{{ $cleanPhone }}?text=Hi%20{{ urlencode($app->name) }},%20regarding%20your%20application%20on%20Bright%20Future%20Consultancy" target="_blank" class="btn btn-success btn-sm rounded-pill px-3 text-white fw-bold">
                      <i class="fab fa-whatsapp me-1 text-white"></i> Connect on WhatsApp
                    </a>
                  </div>
                </div>
              </div>
            </div>

          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center py-5 text-secondary">
            <i class="fas fa-user-friends fa-3x mb-3 text-muted opacity-50 d-block"></i>
            <p class="mb-0">No candidate applications found.</p>
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

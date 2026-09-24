@extends('layouts.app')

@section('title', 'Certificate Verification - Bright Future Consultancy')
@section('meta_description', 'Verify student course certificates and candidate placement credentials issued by Bright Future Consultancy. ISO 9001:2015 & MSME certified.')

@section('content')

<!-- Page Banner Header -->
<section class="py-5 text-center" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff;">
  <div class="container py-4">
    <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-30 rounded-pill px-3 py-2 fw-bold mb-2">CREDENTIAL VALIDATION</span>
    <h1 class="display-5 fw-extrabold text-white mb-3" style="letter-spacing: -0.5px;">Certificate Verification Portal</h1>
    <p class="lead text-light opacity-90 mx-auto mb-0" style="max-width: 700px; font-size: 1.15rem;">
      Validate authentic student training certificates and placement credentials issued by Bright Future Consultancy.
    </p>
  </div>
</section>

<!-- Interactive Verification Card -->
<section class="py-5 bg-light">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4 bg-white text-center">
          
          <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
            <i class="fas fa-certificate fa-2x"></i>
          </div>

          <h2 class="fw-extrabold text-dark mb-2" style="font-size: 1.85rem;">Verify Candidate Certificate</h2>
          <p class="text-secondary small mb-4">
            Enter your Certificate Registration Number or Student Roll Code (e.g. <strong>BFC-2024-8849</strong> or <strong>BFC-WB-1042</strong>) to verify authenticity with our official registry.
          </p>

          <form id="certVerificationForm" onsubmit="handleCertVerify(event)">
            <div class="input-group input-group-lg mb-3">
              <span class="input-group-text bg-light border-end-0"><i class="fas fa-id-card text-muted"></i></span>
              <input type="text" id="certIdInput" class="form-control bg-light border-start-0" placeholder="Enter Registration ID (e.g. BFC-2024-8849)" required>
              <button type="submit" class="btn btn-success fw-bold px-4">
                <i class="fas fa-search me-1"></i> Verify Now
              </button>
            </div>
          </form>

          <!-- Result Display Box -->
          <div id="certResultBox" class="mt-4 text-start d-none"></div>

          <!-- Sample Codes Hint -->
          <div class="mt-4 pt-3 border-top text-muted small">
            <span><i class="fas fa-info-circle me-1 text-success"></i> Try demo roll codes: </span>
            <a href="javascript:void(0)" onclick="fillCode('BFC-2024-8849')" class="badge bg-light text-dark border me-1 text-decoration-none">BFC-2024-8849</a>
            <a href="javascript:void(0)" onclick="fillCode('BFC-WB-1042')" class="badge bg-light text-dark border me-1 text-decoration-none">BFC-WB-1042</a>
            <a href="javascript:void(0)" onclick="fillCode('BFC-2025-9921')" class="badge bg-light text-dark border text-decoration-none">BFC-2025-9921</a>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<!-- Official Accreditation & Compliance -->
<section class="py-5 bg-white">
  <div class="container py-4">
    <div class="row g-4 align-items-center">
      <div class="col-lg-6">
        <span class="text-success fw-bold text-uppercase small" style="letter-spacing: 1.5px;">GOVERNMENT ACCREDITATION</span>
        <h2 class="fw-extrabold text-dark mt-1 mb-3" style="font-size: 2rem;">Authorized & ISO Certified Agency</h2>
        <p class="text-secondary mb-4" style="line-height: 1.75;">
          All credentials issued by Bright Future Consultancy conform to the rigorous standards required by corporate employers across West Bengal and India.
        </p>

        <ul class="list-unstyled">
          <li class="d-flex align-items-start gap-3 mb-3">
            <i class="fas fa-check-circle text-success fs-5 mt-1"></i>
            <div>
              <strong class="text-dark">MSME UDYAM Registration:</strong>
              <p class="text-secondary small mb-0">Registered under Government of India Ministry of Micro, Small and Medium Enterprises: <strong>UDYAM-WB-11-0035754</strong>.</p>
            </div>
          </li>
          <li class="d-flex align-items-start gap-3 mb-3">
            <i class="fas fa-check-circle text-success fs-5 mt-1"></i>
            <div>
              <strong class="text-dark">ISO 9001:2015 Conformance:</strong>
              <p class="text-secondary small mb-0">Conforming to International Quality Management Systems for vocational career coaching and manpower placement.</p>
            </div>
          </li>
          <li class="d-flex align-items-start gap-3">
            <i class="fas fa-check-circle text-success fs-5 mt-1"></i>
            <div>
              <strong class="text-dark">Employer Background Verification:</strong>
              <p class="text-secondary small mb-0">Corporate HR departments can directly verify candidate certificates by emailing our verification desk.</p>
            </div>
          </li>
        </ul>
      </div>

      <div class="col-lg-6 text-center">
        <div class="p-4 p-md-5 rounded-4 shadow-sm bg-light border border-light">
          <i class="fas fa-award fa-5x text-success mb-3"></i>
          <h4 class="fw-bold text-dark">Official Verification Helpline</h4>
          <p class="text-secondary small mb-4">
            For urgent corporate background verification or duplicate certificate requests, contact our records department directly.
          </p>
          <a href="mailto:{{ $contactEmail ?? 'brightfutureconsultancybwn@gmail.com' }}?subject=Certificate%20Verification%20Request" class="btn btn-outline-success fw-bold rounded-pill px-4 py-2">
            <i class="fas fa-envelope me-2"></i> Email Records Desk
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
const CERT_REGISTRY = {
  'BFC-2024-8849': {
    candidateName: 'Rahul Sharma',
    courseName: 'Airlines Ground Staff & Passenger Handling Certification',
    issueDate: '15 June 2024',
    status: 'VALID & VERIFIED',
    grade: 'Grade A+',
    issuedTo: 'Barrackpore Airport Center'
  },
  'BFC-WB-1042': {
    candidateName: 'Priya Das',
    courseName: 'Advanced Back Office Operations & MS Excel Professional',
    issueDate: '10 July 2024',
    status: 'VALID & VERIFIED',
    grade: 'Grade A',
    issuedTo: 'Barddhaman District Center'
  },
  'BFC-2025-9921': {
    candidateName: 'Sk. Sameer',
    courseName: 'Overseas HVAC Technician & Gulf Trade Competency',
    issueDate: '22 January 2025',
    status: 'VALID & VERIFIED',
    grade: 'Grade A+ (Certified)',
    issuedTo: 'Overseas Placement Division'
  }
};

function fillCode(code) {
  document.getElementById('certIdInput').value = code;
  handleCertVerify(new Event('submit'));
}

function handleCertVerify(e) {
  if (e) e.preventDefault();
  const input = document.getElementById('certIdInput').value.trim().toUpperCase();
  const resultBox = document.getElementById('certResultBox');

  if (!input) return;

  if (CERT_REGISTRY[input]) {
    const cert = CERT_REGISTRY[input];
    resultBox.className = 'mt-4 p-4 rounded-4 bg-success bg-opacity-10 border border-success border-opacity-25 d-block';
    resultBox.innerHTML = `
      <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
        <span class="badge bg-success px-3 py-2 rounded-pill fw-bold"><i class="fas fa-check-circle me-1"></i> ${cert.status}</span>
        <span class="text-secondary small fw-bold">REG ID: ${input}</span>
      </div>
      <h5 class="fw-bold text-dark mb-1">${cert.candidateName}</h5>
      <p class="text-success fw-semibold small mb-2">${cert.courseName}</p>
      <div class="row g-2 pt-2 border-top border-success border-opacity-25 small text-secondary">
        <div class="col-sm-6"><strong>Issue Date:</strong> ${cert.issueDate}</div>
        <div class="col-sm-6"><strong>Performance Grade:</strong> ${cert.grade}</div>
        <div class="col-sm-12"><strong>Issuing Center:</strong> ${cert.issuedTo}</div>
      </div>
    `;
  } else {
    resultBox.className = 'mt-4 p-4 rounded-4 bg-warning bg-opacity-10 border border-warning border-opacity-25 d-block text-center';
    resultBox.innerHTML = `
      <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
      <h6 class="fw-bold text-dark mb-1">Certificate Record Not Found</h6>
      <p class="text-secondary small mb-0">No active certificate registered with ID: <strong>${input}</strong>. Please check the spelling or contact our helpline for manual verification.</p>
    `;
  }
}
</script>
@endpush

@endsection

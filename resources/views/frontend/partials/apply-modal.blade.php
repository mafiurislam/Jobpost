<!-- Candidate Registration Modal (Apply Now Flow) -->
<div class="modal fade" id="candidateApplyModal" tabindex="-1" aria-labelledby="candidateApplyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
      
      <!-- Modal Header -->
      <div class="modal-header text-white p-4" style="background: linear-gradient(135deg, #0f172a 0%, #15803d 100%);">
        <div>
          <span class="badge bg-white text-success fw-bold rounded-pill px-3 py-1 mb-2 text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">
            100% FREE CANDIDATE REGISTRATION
          </span>
          <h4 class="modal-title fw-bold mb-1" id="candidateApplyModalLabel">
            Job Candidate Registration Form
          </h4>
          <p class="text-light opacity-90 small mb-0" id="applyModalSubtitle">
            Fill in your details to apply directly and receive verified company interview call letters.
          </p>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body Form -->
      <div class="modal-body p-4 p-md-5 bg-white">
        
        <!-- Live Alert container for AJAX errors or success -->
        <div id="applyModalAlertContainer"></div>

        <form id="candidateRegistrationForm" action="{{ route('join.submit') }}" method="POST">
          @csrf
          
          <!-- Hidden Job Specific Fields (populated dynamically when opened from a card) -->
          <input type="hidden" name="job_title" id="applyJobTitleHidden" value="">

          <div class="row g-3">
            
            <!-- 1. Date Field -->
            <div class="col-md-6">
              <label for="applyDate" class="form-label fw-bold text-dark small">
                <i class="far fa-calendar-alt text-success me-1"></i> Date <span class="text-danger">*</span>
              </label>
              <input type="date" name="application_date" id="applyDate" class="form-control bg-light" value="{{ date('Y-m-d') }}" required>
              <div class="form-text">Registration / application date</div>
            </div>

            <!-- 2. Candidate Name Field -->
            <div class="col-md-6">
              <label for="applyCandidateName" class="form-label fw-bold text-dark small">
                <i class="fas fa-user text-success me-1"></i> Candidate Name <span class="text-danger">*</span>
              </label>
              <input type="text" name="name" id="applyCandidateName" class="form-control bg-light" placeholder="Enter your full name" required>
            </div>

            <!-- 3. Candidate Contact: Phone / WhatsApp -->
            <div class="col-md-6">
              <label for="applyPhone" class="form-label fw-bold text-dark small">
                <i class="fas fa-phone-alt text-success me-1"></i> Mobile / WhatsApp Number <span class="text-danger">*</span>
              </label>
              <input type="tel" name="phone" id="applyPhone" class="form-control bg-light" placeholder="e.g. 7001420469" required>
              <div class="form-text">For interview call letters and updates</div>
            </div>

            <!-- 3. Candidate Contact: Email -->
            <div class="col-md-6">
              <label for="applyEmail" class="form-label fw-bold text-dark small">
                <i class="fas fa-envelope text-success me-1"></i> Email Address <span class="text-danger">*</span>
              </label>
              <input type="email" name="email" id="applyEmail" class="form-control bg-light" placeholder="e.g. candidate@example.com" required>
            </div>

            <!-- 4. Sector & Location -->
            <div class="col-md-6">
              <label for="applySector" class="form-label fw-bold text-dark small">
                <i class="fas fa-briefcase text-success me-1"></i> Job Sector <span class="text-danger">*</span>
              </label>
              <select name="preferred_sector" id="applySector" class="form-select bg-light" required>
                <option value="General Placement">All Sectors / General Placement</option>
                <option value="Airlines Ground Staff">Airlines Ground Staff & Cargo</option>
                <option value="Overseas Jobs">Overseas Placement (Gulf & Europe)</option>
                <option value="Back Office & Data Entry">Back Office & Data Entry</option>
                <option value="Banking & Finance">Banking & Financial Services</option>
                <option value="E-Commerce & Delivery">E-Commerce & Logistics</option>
                <option value="Hospitality & Hotel">Hospitality & Hotel Staff</option>
                <option value="Medical & Healthcare">Medical & Healthcare Staff</option>
                <option value="Security Forces">Security Guard & Supervision</option>
                <option value="Supermarket Retail">Supermarket Retail Store</option>
                <option value="Driver & Commercial Fleet">Commercial Driver</option>
                <option value="AC & HVAC Technician">AC & Technical Trades</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="applyLocation" class="form-label fw-bold text-dark small">
                <i class="fas fa-map-marker-alt text-success me-1"></i> Preferred Location
              </label>
              <input type="text" name="preferred_location" id="applyLocation" class="form-control bg-light" placeholder="e.g. Kolkata, Barddhaman, Durgapur, Overseas">
            </div>

            <!-- 5. Qualification & Experience -->
            <div class="col-md-6">
              <label for="applyQualification" class="form-label fw-bold text-dark small">
                <i class="fas fa-graduation-cap text-success me-1"></i> Highest Qualification <span class="text-danger">*</span>
              </label>
              <select name="qualification" id="applyQualification" class="form-select bg-light" required>
                <option value="10th Pass">10th Standard Pass</option>
                <option value="12th Pass">12th Standard / HS Pass</option>
                <option value="Diploma / ITI">Diploma / ITI Trade</option>
                <option value="Graduate" selected>Graduate (BA / BSc / BCom / BTech)</option>
                <option value="Post Graduate">Post Graduate (MA / MSc / MBA)</option>
                <option value="Below 10th">5th / 8th Standard Pass</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="applyExperience" class="form-label fw-bold text-dark small">
                <i class="fas fa-history text-success me-1"></i> Work Experience
              </label>
              <input type="text" name="experience" id="applyExperience" class="form-control bg-light" placeholder="e.g. Fresher, or 1 Year Back Office">
            </div>

            <!-- 6. Connect Preference & Notes -->
            <div class="col-md-6">
              <label for="applyConnect" class="form-label fw-bold text-dark small">
                <i class="fas fa-comments text-success me-1"></i> Preferred Connect Method
              </label>
              <select name="connect_preference" id="applyConnect" class="form-select bg-light">
                <option value="WhatsApp" selected>Connect via WhatsApp</option>
                <option value="Phone Call">Direct Phone Call</option>
                <option value="Email">Email Communication</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="applyNotes" class="form-label fw-bold text-dark small">
                <i class="fas fa-pen text-success me-1"></i> Additional Notes (Optional)
              </label>
              <input type="text" name="notes" id="applyNotes" class="form-control bg-light" placeholder="Any specific requirements or queries...">
            </div>

            <!-- Free Service Notice -->
            <div class="col-12 mt-3">
              <div class="p-3 bg-light rounded-3 border small text-secondary d-flex align-items-center gap-2">
                <i class="fas fa-shield-alt text-success fa-lg flex-shrink-0"></i>
                <span><strong>100% Free Placement Assurance:</strong> Bright Future Consultancy never charges fees for job applications or registrations.</span>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12 text-center mt-4">
              <button type="submit" id="btnSubmitRegistration" class="btn btn-success btn-lg rounded-pill px-5 py-3 fw-bold text-white shadow w-100">
                <span id="btnSubmitText">
                  <i class="fas fa-paper-plane me-2 text-white"></i> Submit Candidate Registration
                </span>
                <span id="btnSubmitSpinner" class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
              </button>
            </div>

          </div>
        </form>

        <!-- Success View (Shown after AJAX submission) -->
        <div id="applyModalSuccessView" class="d-none text-center py-4">
          <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center p-4 mb-3" style="width: 80px; height: 80px;">
            <i class="fas fa-check-circle fa-3x text-success"></i>
          </div>
          <h3 class="fw-bold text-dark mb-2">Registration Submitted Successfully!</h3>
          <p class="text-secondary mb-4 mx-auto" style="max-width: 500px;" id="applySuccessMessage">
            Your application details have been registered in our database. Our career placement executive will contact you shortly with interview details.
          </p>
          <div class="d-flex justify-content-center gap-2 flex-wrap">
            <button type="button" class="btn btn-success rounded-pill px-4 py-2 fw-bold text-white" data-bs-dismiss="modal">
              Done
            </button>
            <a href="{{ route('jobs.index') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold">
              Browse More Jobs
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('candidateApplyModal');
    if (!modalEl) return;

    let applyModal = null;
    if (typeof bootstrap !== 'undefined') {
      applyModal = new bootstrap.Modal(modalEl);
    }

    // Function to populate and open modal
    window.openCandidateRegistrationModal = function (jobTitle, sector, location) {
      const form = document.getElementById('candidateRegistrationForm');
      const successView = document.getElementById('applyModalSuccessView');
      const alertContainer = document.getElementById('applyModalAlertContainer');
      const modalSubtitle = document.getElementById('applyModalSubtitle');
      const hiddenJobTitle = document.getElementById('applyJobTitleHidden');
      const sectorSelect = document.getElementById('applySector');
      const locationInput = document.getElementById('applyLocation');

      // Reset form states
      if (form) form.classList.remove('d-none');
      if (successView) successView.classList.add('d-none');
      if (alertContainer) alertContainer.innerHTML = '';

      // Populate prefill data if present
      if (jobTitle) {
        hiddenJobTitle.value = jobTitle;
        modalSubtitle.innerHTML = `Applying for: <strong class="text-white">${jobTitle}</strong>`;
      } else {
        hiddenJobTitle.value = '';
        modalSubtitle.textContent = 'Fill in your details to apply directly and receive verified company interview call letters.';
      }

      if (sector) {
        // Try matching select options
        let matched = false;
        for (let opt of sectorSelect.options) {
          if (opt.text.toLowerCase().includes(sector.toLowerCase()) || opt.value.toLowerCase().includes(sector.toLowerCase())) {
            opt.selected = true;
            matched = true;
            break;
          }
        }
        if (!matched && sectorSelect.options.length > 0) {
          // add option if not matching
          const newOpt = new Option(sector, sector, true, true);
          sectorSelect.add(newOpt);
        }
      }

      if (location && locationInput) {
        locationInput.value = location;
      }

      if (applyModal) {
        applyModal.show();
      } else {
        const bsModal = new bootstrap.Modal(modalEl);
        bsModal.show();
      }
    };

    // Attach click listeners to all buttons with .btn-open-apply-modal or matching APPLY NOW text
    document.querySelectorAll('.btn-open-apply-modal').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        const jobTitle = this.getAttribute('data-job-title') || '';
        const sector = this.getAttribute('data-job-sector') || '';
        const location = this.getAttribute('data-job-location') || '';
        window.openCandidateRegistrationModal(jobTitle, sector, location);
      });
    });

    // Handle AJAX form submission for smooth experience without page refresh
    const regForm = document.getElementById('candidateRegistrationForm');
    if (regForm) {
      regForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const btnSubmit = document.getElementById('btnSubmitRegistration');
        const btnText = document.getElementById('btnSubmitText');
        const btnSpinner = document.getElementById('btnSubmitSpinner');
        const alertBox = document.getElementById('applyModalAlertContainer');
        const successView = document.getElementById('applyModalSuccessView');
        const successMsg = document.getElementById('applySuccessMessage');

        btnSubmit.disabled = true;
        btnText.textContent = 'Registering Application...';
        btnSpinner.classList.remove('d-none');
        alertBox.innerHTML = '';

        const formData = new FormData(regForm);

        fetch(regForm.action, {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        })
        .then(response => {
          if (!response.ok) {
            return response.json().then(errData => { throw errData; });
          }
          return response.json();
        })
        .then(data => {
          btnSubmit.disabled = false;
          btnSpinner.classList.add('d-none');
          btnText.innerHTML = '<i class="fas fa-paper-plane me-2 text-white"></i> Submit Candidate Registration';

          // Show success view
          regForm.classList.add('d-none');
          successView.classList.remove('d-none');
          if (data.message && successMsg) {
            successMsg.textContent = data.message;
          }
          regForm.reset();
        })
        .catch(error => {
          btnSubmit.disabled = false;
          btnSpinner.classList.add('d-none');
          btnText.innerHTML = '<i class="fas fa-paper-plane me-2 text-white"></i> Submit Candidate Registration';

          let errorHtml = '<div class="alert alert-danger alert-dismissible fade show rounded-3 p-3 mb-3" role="alert"><ul class="mb-0 ps-3">';
          if (error && error.errors) {
            for (const key in error.errors) {
              error.errors[key].forEach(msg => {
                errorHtml += `<li>${msg}</li>`;
              });
            }
          } else if (error && error.message) {
            errorHtml += `<li>${error.message}</li>`;
          } else {
            errorHtml += '<li>Something went wrong. Please check your details and try again.</li>';
          }
          errorHtml += '</ul><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

          alertBox.innerHTML = errorHtml;
        });
      });
    }
  });
</script>

/* 
  Bright Future Consultancy - Interactive Frontend JS
  Green & White Theme - Live Backend Job Synchronization & Search API
*/

document.addEventListener('DOMContentLoaded', () => {
  // 1. Sticky Header Effect
  const header = document.querySelector('.main-header');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 40) {
      header?.classList.add('scrolled');
    } else {
      header?.classList.remove('scrolled');
    }
  });

  // 2. Dynamic Year Update
  const yearSpans = document.querySelectorAll('.current-year');
  const currentYear = new Date().getFullYear();
  yearSpans.forEach(span => {
    span.textContent = currentYear;
  });

  // 3. Live Sector Data Fetching & Rendering
  window.fetchLiveSectors = function() {
    fetch('/api/sectors')
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success' && Array.isArray(data.data)) {
          window.ROLE_SECTORS_DATA = data.data;
          window.renderRoleSectors(data.data);
        }
      })
      .catch(err => {
        console.warn('API sectors fetch fallback:', err);
      });
  };

  window.renderRoleSectors = function(customData) {
    const dataToRender = customData || window.ROLE_SECTORS_DATA;
    const container = document.getElementById('roleSectorsContainer');
    if (!container || !dataToRender) return;

    container.innerHTML = dataToRender.map(item => `
      <div class="col-md-6 col-lg-3" data-role-id="${item.id}">
        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden role-sector-card position-relative">
          <div class="role-card-img-wrapper">
            <img src="${item.image || 'assets/images/roles/all_new_jobs.svg'}" alt="${item.title}" class="card-img-top role-card-img">
          </div>
          <div class="card-body p-4 d-flex flex-column justify-content-between">
            <div>
              <h3 class="role-title mb-2">${item.title}</h3>
              ${item.count !== undefined ? `<span class="badge bg-success-subtle text-success border border-success fw-bold mb-3">${item.count} Active Vacancies</span>` : ''}
            </div>
            <a href="${item.link}" class="role-link fw-bold text-decoration-none d-inline-flex align-items-center mt-2">
              View Vacancies <i class="fas fa-arrow-right ms-2"></i>
            </a>
          </div>
        </div>
      </div>
    `).join('');
  };

  // Initial call for sectors
  window.fetchLiveSectors();

  // 4. Contact Form Submission
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();
      
      const name = document.getElementById('formName')?.value || '';
      const email = document.getElementById('formEmail')?.value || '';
      const phone = document.getElementById('formPhone')?.value || '';
      const message = document.getElementById('formMessage')?.value || '';

      if (!name || !phone) {
        alert('Please fill out your Name and Phone / WhatsApp number.');
        return;
      }

      const waText = `Hello Bright Future Consultancy,%0A%0AMy Name: ${encodeURIComponent(name)}%0AEmail: ${encodeURIComponent(email)}%0APhone: ${encodeURIComponent(phone)}%0AMessage: ${encodeURIComponent(message)}`;
      const waUrl = `https://wa.me/917001420469?text=${waText}`;

      const alertBox = document.getElementById('formAlert');
      if (alertBox) {
        alertBox.className = 'alert alert-success mt-3';
        alertBox.innerHTML = `<i class="fas fa-check-circle me-2"></i> Thank you, <strong>${name}</strong>! Your inquiry has been recorded. Opening WhatsApp to connect with counselor...`;
        alertBox.classList.remove('d-none');
      }

      setTimeout(() => {
        window.open(waUrl, '_blank');
      }, 1200);

      contactForm.reset();
    });
  }

  // 5. Live Backend Job Posts Synchronization for jobs.html & singlejobs.html
  window.fetchLiveJobs = function(queryObject = {}) {
    const params = new URLSearchParams();
    if (queryObject.search) params.append('search', queryObject.search);
    if (queryObject.sector && queryObject.sector !== 'all') params.append('sector', queryObject.sector);
    if (queryObject.location) params.append('location', queryObject.location);

    fetch('/api/jobs?' + params.toString())
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          renderLiveJobsFeed(data.data);
        }
      })
      .catch(err => {
        console.warn('API jobs fetch error:', err);
      });
  };

  function renderLiveJobsFeed(jobs) {
    const container = document.getElementById('otherJobsContainer');
    const headerTitle = document.getElementById('mainFeedHeaderTitle');
    const singleJobHeaderTitle = document.getElementById('singleJobPageHeaderTitle');
    const jobCountText = document.getElementById('jobCountText');

    if (headerTitle) {
      headerTitle.textContent = `${jobs.length} Active Vacancy Opening${jobs.length === 1 ? '' : 's'}`;
    }

    if (jobCountText) {
      jobCountText.textContent = `Showing ${jobs.length} job opening${jobs.length === 1 ? '' : 's'}`;
    }

    if (!container) return;

    if (!jobs || jobs.length === 0) {
      container.innerHTML = `
        <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
          <i class="fas fa-search fa-3x text-muted mb-3"></i>
          <h5 class="fw-bold text-dark">No Vacancies Found</h5>
          <p class="text-secondary small mb-0">No open positions match your search criteria. Please try another search or category.</p>
        </div>
      `;
      return;
    }

    // Set first or featured job into featured detail card if on singlejobs page
    const featuredJob = jobs.find(j => j.is_featured) || jobs[0];
    if (featuredJob && document.getElementById('featuredJobTitle')) {
      updateFeaturedJobCard(featuredJob);
    }

    // Render remaining or all jobs into feed container
    container.innerHTML = jobs.map(job => `
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white other-job-item" data-job-id="${job.id}">
        <div class="position-relative">
          <img src="${job.poster_image || 'assets/images/posters/snapdeal_poster.svg'}" alt="${job.title}" class="img-fluid w-100 job-poster-img" style="aspect-ratio: 16 / 9; object-fit: cover;">
          ${job.is_featured ? '<span class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark fw-bold px-3 py-2 shadow-sm"><i class="fas fa-star me-1"></i> FEATURED</span>' : ''}
        </div>
        <div class="p-4">
          <div class="d-flex align-items-center gap-3 mb-2">
            <img src="assets/images/logo.png" alt="Logo" style="width: 34px; height: 34px; object-fit: contain;">
            <div>
              <h4 class="fw-bold text-dark mb-0 fs-5 cursor-pointer" onclick="selectFeaturedJob(${job.id})">${job.title}</h4>
              <small class="text-muted">${job.company} • ${job.location}</small>
            </div>
          </div>
          <div class="d-flex flex-wrap align-items-center gap-2 my-2">
            <span class="badge bg-success-subtle text-success border border-success fw-bold px-3 py-2 fs-6">${job.salary}</span>
            <span class="badge bg-light text-dark border px-3 py-2">${job.qualification}</span>
            <span class="badge bg-light text-dark border px-3 py-2">${job.sector_name}</span>
          </div>
          <p class="text-muted small my-2">${job.description || ''}</p>
          <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-3">
            <button type="button" class="btn btn-outline-secondary rounded-pill btn-sm px-3 fw-bold" onclick="shareJob('${encodeURIComponent(job.title)}', 'Check out 100% Free Job Vacancy on Bright Future Consultancy!')">
              <i class="fas fa-share-alt me-1"></i> Share
            </button>
            <button type="button" class="btn btn-teal text-white rounded-pill btn-sm px-4 fw-bold" style="background-color: var(--primary-teal, #0d6efd);" onclick="openApplyModal('${encodeURIComponent(job.title)}', '${encodeURIComponent(job.company)}')">
              APPLY NOW
            </button>
          </div>
        </div>
      </div>
    `).join('');
  }

  function updateFeaturedJobCard(job) {
    const imgEl = document.getElementById('featuredJobImage');
    const titleEl = document.getElementById('featuredJobTitle');
    const companyEl = document.getElementById('featuredJobCompany');
    const salaryEl = document.getElementById('featuredJobSalary');
    const qualEl = document.getElementById('featuredJobQualification');
    const descEl = document.getElementById('featuredJobDescription');
    const applyBtn = document.getElementById('btnApplyFeatured');
    const shareBtn = document.getElementById('btnShareFeatured');

    if (imgEl) imgEl.src = job.poster_image || 'assets/images/posters/snapdeal_poster.svg';
    if (titleEl) titleEl.textContent = job.title;
    if (companyEl) companyEl.textContent = `${job.company} • ${job.location}`;
    if (salaryEl) salaryEl.textContent = job.salary;
    if (qualEl) qualEl.textContent = job.qualification;

    if (descEl) {
      descEl.innerHTML = `
        <p>${job.description || ''}</p>
        <ul class="ps-3 mb-2">
          ${job.duties ? `<li><strong>Job Duties:</strong> ${job.duties}</li>` : ''}
          ${job.requirements ? `<li><strong>Eligibility:</strong> ${job.requirements}</li>` : ''}
          ${job.benefits ? `<li><strong>Benefits:</strong> ${job.benefits}</li>` : ''}
          <li><strong>Placement Fee:</strong> 100% FREE PLACEMENT (No candidate fee).</li>
        </ul>
      `;
    }

    if (applyBtn) {
      applyBtn.onclick = () => openApplyModal(job.title, job.company);
    }
    if (shareBtn) {
      shareBtn.onclick = () => shareJob(job.title, job.description);
    }
  }

  window.selectFeaturedJob = function(jobId) {
    fetch('/api/jobs/' + jobId)
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success' && data.data) {
          updateFeaturedJobCard(data.data);
          window.scrollTo({ top: 150, behavior: 'smooth' });
        }
      });
  };

  // 6. Filter Controls Handler
  window.filterJobsFeed = function() {
    const keyword = document.getElementById('jobSearchInput')?.value || '';
    const location = document.getElementById('locationSearchInput')?.value || '';
    const sector = document.getElementById('sectorSelect')?.value || 'all';

    window.fetchLiveJobs({ search: keyword, sector: sector, location: location });
  };

  // Bind filter triggers
  const btnFilterSubmit = document.getElementById('btnFilterSubmit');
  if (btnFilterSubmit) {
    btnFilterSubmit.addEventListener('click', window.filterJobsFeed);
  }

  const jobSearchInput = document.getElementById('jobSearchInput');
  const sectorSelect = document.getElementById('sectorSelect');
  const locationSearchInput = document.getElementById('locationSearchInput');

  jobSearchInput?.addEventListener('input', window.filterJobsFeed);
  sectorSelect?.addEventListener('change', window.filterJobsFeed);
  locationSearchInput?.addEventListener('input', window.filterJobsFeed);

  // Parse URL Parameters
  const urlParams = new URLSearchParams(window.location.search);
  const sectorParam = urlParams.get('sector');
  const roleParam = urlParams.get('role');
  const jobIdParam = urlParams.get('id');

  if (sectorParam && sectorSelect) {
    sectorSelect.value = sectorParam.toLowerCase();
  }
  if (roleParam && jobSearchInput) {
    jobSearchInput.value = roleParam;
  }

  // Initial Fetch of Live Jobs
  window.fetchLiveJobs({
    sector: sectorParam || 'all',
    search: roleParam || ''
  });

  if (jobIdParam) {
    setTimeout(() => {
      window.selectFeaturedJob(jobIdParam);
    }, 400);
  }

  // 7. Application Modal Submission
  const jobAppModalForm = document.getElementById('jobAppModalForm');
  if (jobAppModalForm) {
    jobAppModalForm.addEventListener('submit', (e) => {
      e.preventDefault();

      const jobTitle = document.getElementById('appTargetJob')?.value || 'General Job Application';
      const name = document.getElementById('modalApplicantName')?.value || '';
      const phone = document.getElementById('modalApplicantPhone')?.value || '';
      const email = document.getElementById('modalApplicantEmail')?.value || '';
      const qual = document.getElementById('modalQualification')?.value || '';
      const loc = document.getElementById('modalPreferredLocation')?.value || '';
      const exp = document.getElementById('modalExperience')?.value || '';
      const message = document.getElementById('modalMessage')?.value || '';

      if (!name || !phone || !email) {
        alert('Please fill out all required fields.');
        return;
      }

      const waText = `Hello Bright Future Consultancy,%0A%0AI want to apply for the job: *${encodeURIComponent(jobTitle)}*%0A%0A*Applicant Details:*%0A• Name: ${encodeURIComponent(name)}%0A• Phone/WA: ${encodeURIComponent(phone)}%0A• Email: ${encodeURIComponent(email)}%0A• Qualification: ${encodeURIComponent(qual)}%0A• Preferred Location: ${encodeURIComponent(loc)}%0A• Experience: ${encodeURIComponent(exp)}%0A• Notes: ${encodeURIComponent(message)}`;
      const waUrl = `https://wa.me/917001420469?text=${waText}`;

      const alertBox = document.getElementById('modalAppSuccessAlert');
      if (alertBox) {
        alertBox.classList.remove('d-none');
      }

      setTimeout(() => {
        window.open(waUrl, '_blank');
        const modalEl = document.getElementById('applicationModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        if (modalInstance) modalInstance.hide();
        jobAppModalForm.reset();
        if (alertBox) alertBox.classList.add('d-none');
      }, 1200);
    });
  }

  // 8. Certificate Verification Simulator
  const certForm = document.getElementById('certForm');
  if (certForm) {
    certForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const certId = document.getElementById('certInput')?.value.trim();
      const resultContainer = document.getElementById('certResult');

      if (!certId) {
        alert('Please enter a valid Certificate Registration ID.');
        return;
      }

      if (resultContainer) {
        resultContainer.innerHTML = `
          <div class="card border-success shadow rounded-4 mt-4 p-4 text-center bg-white">
            <div class="text-success mb-2"><i class="fas fa-certificate fa-3x"></i></div>
            <h4 class="fw-bold text-dark mb-1">ISO Certificate Verified</h4>
            <span class="badge bg-success-subtle text-success border border-success mb-3 px-3 py-1">Registration ID: ${certId.toUpperCase()}</span>
            <div class="row text-start bg-light p-3 rounded-3 g-2">
              <div class="col-md-6"><strong>Candidate Name:</strong> Sample Candidate</div>
              <div class="col-md-6"><strong>Course / Placement:</strong> Digital Marketing & HR Skills</div>
              <div class="col-md-6"><strong>Issue Date:</strong> 15 Jan 2024</div>
              <div class="col-md-6"><strong>Status:</strong> <span class="badge bg-success">Active & Authentic</span></div>
              <div class="col-12 mt-2 pt-2 border-top"><strong>Issued By:</strong> Bright Future Consultancy (ISO 9001:2015 Certified Agency)</div>
            </div>
          </div>
        `;
      }
    });
  }
});

// Helper Modal Functions
function openSingleJobModal(jobId) {
  window.location.href = `singlejobs.html?id=${encodeURIComponent(jobId)}`;
}

function openApplyModal(jobTitle, companyName) {
  const decodedTitle = decodeURIComponent(jobTitle);
  const decodedCompany = companyName ? decodeURIComponent(companyName) : '';

  const modalEl = document.getElementById('applicationModal');
  if (!modalEl) {
    window.location.href = `join.html?role=${encodeURIComponent(decodedTitle)}`;
    return;
  }

  const appTargetJob = document.getElementById('appTargetJob');
  const appModalTitle = document.getElementById('appModalTitle');
  const appModalCompany = document.getElementById('appModalCompany');

  if (appTargetJob) appTargetJob.value = decodedTitle;
  if (appModalTitle) appModalTitle.textContent = `Apply for ${decodedTitle}`;
  if (appModalCompany) appModalCompany.textContent = decodedCompany ? `${decodedCompany} • 100% Free Placement` : 'Bright Future Consultancy Placement Cell';

  const modalInstance = new bootstrap.Modal(modalEl);
  modalInstance.show();
}

function safeDecode(str) {
  if (!str) return '';
  try {
    return decodeURIComponent(str);
  } catch (e) {
    return str;
  }
}

function shareJob(jobTitle = 'Featured Job Opening', jobDescription = '', customUrl = '') {
  const decodedTitle = safeDecode(jobTitle) || 'Featured Job Opening';
  const targetUrl = customUrl || window.location.href;
  const shareText = `Check out this 100% Free Job opening: ${decodedTitle} - Bright Future Consultancy!`;

  window.currentShareData = {
    title: decodedTitle,
    text: shareText,
    url: targetUrl
  };

  // 1. Set URL Input Field
  const shareInput = document.getElementById('shareUrlInput');
  if (shareInput) {
    shareInput.value = targetUrl;
  }

  // 2. Set Social Hrefs
  const shareFb = document.getElementById('shareFb');
  if (shareFb) shareFb.href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(targetUrl)}`;

  const shareGmail = document.getElementById('shareGmail');
  if (shareGmail) shareGmail.href = `https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=&su=${encodeURIComponent(decodedTitle)}&body=${encodeURIComponent(shareText + '\n\n' + targetUrl)}`;

  const shareOutlook = document.getElementById('shareOutlook');
  if (shareOutlook) shareOutlook.href = `https://outlook.live.com/mail/0/deeplink/compose?subject=${encodeURIComponent(decodedTitle)}&body=${encodeURIComponent(shareText + '\n\n' + targetUrl)}`;

  const shareWa = document.getElementById('shareWa');
  if (shareWa) shareWa.href = `https://api.whatsapp.com/send?text=${encodeURIComponent(shareText + ' ' + targetUrl)}`;

  const shareTw = document.getElementById('shareTw');
  if (shareTw) shareTw.href = `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareText)}&url=${encodeURIComponent(targetUrl)}`;

  const shareLinkedin = document.getElementById('shareLinkedin');
  if (shareLinkedin) shareLinkedin.href = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(targetUrl)}`;

  const shareTg = document.getElementById('shareTg');
  if (shareTg) shareTg.href = `https://t.me/share/url?url=${encodeURIComponent(targetUrl)}&text=${encodeURIComponent(shareText)}`;

  // 3. Set QR Code
  const qrImg = document.getElementById('qrCodeImg');
  if (qrImg) {
    qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(targetUrl)}`;
  }

  // 4. Show Share Modal
  const modalEl = document.getElementById('shareModal');
  if (modalEl && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
    try {
      const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
      modalInstance.show();
    } catch (e) {
      const modalInstance = new bootstrap.Modal(modalEl);
      modalInstance.show();
    }
  } else if (navigator.share) {
    navigator.share({
      title: decodedTitle,
      text: shareText,
      url: targetUrl,
    }).catch(() => {});
  } else {
    copyShareLink(targetUrl);
  }
}

function copyShareLink(customUrl) {
  const shareInput = document.getElementById('shareUrlInput');
  const textToCopy = customUrl || (shareInput ? shareInput.value : window.location.href);

  if (navigator.clipboard && navigator.clipboard.writeText) {
    navigator.clipboard.writeText(textToCopy).then(() => {
      showCopyToast();
    }).catch(() => {
      fallbackCopyText(textToCopy);
    });
  } else {
    fallbackCopyText(textToCopy);
  }
}

function fallbackCopyText(text) {
  const shareInput = document.getElementById('shareUrlInput');
  if (shareInput) {
    shareInput.value = text;
    shareInput.select();
    shareInput.setSelectionRange(0, 99999);
    try {
      document.execCommand('copy');
      showCopyToast();
    } catch (e) {
      alert('Copy share link: ' + text);
    }
  } else {
    alert('Copy share link: ' + text);
  }
}

function showCopyToast() {
  let toast = document.getElementById('shareToastNotification');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'shareToastNotification';
    toast.style.cssText = 'position: fixed; bottom: 24px; right: 24px; z-index: 9999; background: #10b981; color: #ffffff; padding: 12px 24px; border-radius: 50px; font-weight: 600; box-shadow: 0 10px 25px rgba(0,0,0,0.2); display: flex; align-items: center; gap: 8px; font-size: 0.95rem; transition: all 0.3s ease;';
    document.body.appendChild(toast);
  }
  toast.innerHTML = '<i class="fas fa-check-circle fs-5"></i> Link copied to clipboard!';
  toast.style.opacity = '1';
  toast.style.transform = 'translateY(0)';
  
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateY(10px)';
  }, 2500);
}

function toggleQrCode() {
  const qrContainer = document.getElementById('qrCodeContainer');
  if (!qrContainer) return;

  if (qrContainer.classList.contains('d-none')) {
    qrContainer.classList.remove('d-none');
    const qrImg = document.getElementById('qrCodeImg');
    const shareInput = document.getElementById('shareUrlInput');
    const url = shareInput ? shareInput.value : window.location.href;
    if (qrImg && (!qrImg.src || qrImg.src === '')) {
      qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(url)}`;
    }
  } else {
    qrContainer.classList.add('d-none');
  }
}

function triggerNativeShare() {
  const data = window.currentShareData || {
    title: document.title,
    text: 'Check out 100% Free Job Vacancies on Bright Future Consultancy!',
    url: window.location.href
  };

  if (navigator.share) {
    navigator.share({
      title: data.title,
      text: data.text,
      url: data.url
    }).catch(() => {});
  } else {
    copyShareLink(data.url);
  }
}

function shareDirectContact(contact, type) {
  const data = window.currentShareData || {
    title: document.title,
    text: 'Check out 100% Free Job Vacancies on Bright Future Consultancy!',
    url: window.location.href
  };

  const message = `${data.text}\n${data.url}`;

  if (type === 'whatsapp') {
    const waUrl = `https://api.whatsapp.com/send?phone=${contact}&text=${encodeURIComponent(message)}`;
    window.open(waUrl, '_blank');
  } else if (type === 'email') {
    const mailUrl = `mailto:?subject=${encodeURIComponent(data.title)}&body=${encodeURIComponent(message)}`;
    window.open(mailUrl, '_self');
  } else if (type === 'outlook') {
    const outlookUrl = `https://outlook.live.com/mail/0/deeplink/compose?subject=${encodeURIComponent(data.title)}&body=${encodeURIComponent(message)}`;
    window.open(outlookUrl, '_blank');
  }
}

function shareCopilot() {
  const data = window.currentShareData || {
    title: document.title,
    text: 'Check out 100% Free Job Vacancies on Bright Future Consultancy!',
    url: window.location.href
  };
  copyShareLink(data.url);
  window.open('https://copilot.microsoft.com/', '_blank');
}

// Make globally accessible on window object
window.shareJob = shareJob;
window.copyShareLink = copyShareLink;
window.toggleQrCode = toggleQrCode;
window.triggerNativeShare = triggerNativeShare;
window.shareDirectContact = shareDirectContact;
window.shareCopilot = shareCopilot;


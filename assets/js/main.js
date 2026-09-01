/* 
  Bright Future Consultancy - Interactive Frontend JS
  Green & White Theme - Job Search, Filtering, Share API, Application Modal & Verification Simulator
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

  // 2b. Role Sectors Dynamic Data Structure (Structured for future Admin Dashboard CRUD integration)
  window.ROLE_SECTORS_DATA = [
    { id: 1, title: "All New and Update Jobs Section", image: "assets/images/roles/all_new_jobs.svg", link: "jobs.html" },
    { id: 2, title: "ALL OVERSEAS JOBS", image: "assets/images/roles/overseas_jobs.svg", link: "jobs.html?sector=overseas" },
    { id: 3, title: "ALL JOBS UNDER NAPS", image: "assets/images/roles/naps_jobs.svg", link: "jobs.html?sector=naps" },
    { id: 4, title: "Govt. Contractual Jobs Section", image: "assets/images/roles/govt_contractual.svg", link: "jobs.html?sector=govt" },
    { id: 5, title: "AIRLINES SECTOR JOBS", image: "assets/images/roles/airlines_jobs.svg", link: "jobs.html?sector=airlines" },
    { id: 6, title: "Back Office Sector", image: "assets/images/roles/backoffice_jobs.svg", link: "jobs.html?sector=backoffice" },
    { id: 7, title: "Medical Sector", image: "assets/images/roles/medical_sector.svg", link: "jobs.html?sector=medical" },
    { id: 8, title: "Automobile Sector", image: "assets/images/roles/automobile_jobs.svg", link: "jobs.html?sector=auto" },
    { id: 9, title: "Ac Coach Attender Jobs", image: "assets/images/roles/ac_coach_attender.svg", link: "jobs.html?sector=ac_coach" },
    { id: 10, title: "Driver Jobs", image: "assets/images/roles/driver_jobs.svg", link: "jobs.html?sector=driver" },
    { id: 11, title: "Banking Sector", image: "assets/images/roles/banking_sector.svg", link: "jobs.html?sector=banking" },
    { id: 12, title: "Security Guard", image: "assets/images/roles/security_guard.svg", link: "jobs.html?sector=security" },
    { id: 13, title: "Housekeeping Stuff", image: "assets/images/roles/housekeeping_stuff.svg", link: "jobs.html?sector=housekeeping" },
    { id: 14, title: "Labour-Helper", image: "assets/images/roles/labour_helper.svg", link: "jobs.html?sector=labour" },
    { id: 15, title: "Warehouse Executive", image: "assets/images/roles/warehouse_executive.svg", link: "jobs.html?sector=warehouse" },
    { id: 16, title: "Ac Mechanic", image: "assets/images/roles/ac_mechanic.svg", link: "jobs.html?sector=ac_mechanic" },
    { id: 17, title: "Hospitality and Hotel Sector", image: "assets/images/roles/hospitality_hotel.svg", link: "jobs.html?sector=hospitality" },
    { id: 18, title: "IT sector-Hardware", image: "assets/images/roles/it_hardware.svg", link: "jobs.html?sector=it_hardware" },
    { id: 19, title: "Call Centre", image: "assets/images/roles/call_centre.svg", link: "jobs.html?sector=call_centre" }
  ];

  window.renderRoleSectors = function(customData) {
    const dataToRender = customData || window.ROLE_SECTORS_DATA;
    const container = document.getElementById('roleSectorsContainer');
    if (!container || !dataToRender) return;

    container.innerHTML = dataToRender.map(item => `
      <div class="col-md-6 col-lg-3" data-role-id="${item.id}">
        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden role-sector-card">
          <div class="role-card-img-wrapper">
            <img src="${item.image}" alt="${item.title}" class="card-img-top role-card-img">
          </div>
          <div class="card-body p-4 d-flex flex-column justify-content-between">
            <h3 class="role-title">${item.title}</h3>
            <a href="${item.link}" class="role-link fw-bold text-decoration-none d-inline-flex align-items-center">
              View Vacancies <i class="fas fa-arrow-right ms-2"></i>
            </a>
          </div>
        </div>
      </div>
    `).join('');
  };

  // 3. Contact Form Submission (for contact.html & join.html)
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

  // 4. Job Search & Sector / Location Filter (jobs.html)
  const jobSearchInput = document.getElementById('jobSearchInput');
  const sectorSelect = document.getElementById('sectorSelect');
  const locationSearchInput = document.getElementById('locationSearchInput');
  const btnResetFilter = document.getElementById('btnResetFilter');
  const jobCards = document.querySelectorAll('.job-card-item');
  const noJobsAlert = document.getElementById('noJobsAlert');
  const jobCountText = document.getElementById('jobCountText');

  function filterJobs() {
    if (!jobCards || jobCards.length === 0) return;

    const searchTerm = jobSearchInput?.value.toLowerCase().trim() || '';
    const selectedSector = sectorSelect?.value.toLowerCase().trim() || 'all';
    const locationTerm = locationSearchInput?.value.toLowerCase().trim() || '';

    let visibleCount = 0;

    jobCards.forEach(card => {
      const title = card.getAttribute('data-title')?.toLowerCase() || '';
      const company = card.getAttribute('data-company')?.toLowerCase() || '';
      const sector = card.getAttribute('data-sector')?.toLowerCase() || '';
      const location = card.getAttribute('data-location')?.toLowerCase() || '';
      const cardText = card.textContent.toLowerCase();

      const matchesKeyword = !searchTerm || title.includes(searchTerm) || company.includes(searchTerm) || cardText.includes(searchTerm);
      const matchesSector = selectedSector === 'all' || sector === selectedSector;
      const matchesLocation = !locationTerm || location.includes(locationTerm);

      if (matchesKeyword && matchesSector && matchesLocation) {
        card.classList.remove('d-none');
        card.style.display = 'block';
        visibleCount++;
      } else {
        card.classList.add('d-none');
        card.style.display = 'none';
      }
    });

    if (noJobsAlert) {
      if (visibleCount === 0) {
        noJobsAlert.classList.remove('d-none');
      } else {
        noJobsAlert.classList.add('d-none');
      }
    }

    if (jobCountText) {
      jobCountText.textContent = `Showing ${visibleCount} job opening${visibleCount === 1 ? '' : 's'}`;
    }
  }

  jobSearchInput?.addEventListener('input', filterJobs);
  sectorSelect?.addEventListener('change', filterJobs);
  locationSearchInput?.addEventListener('input', filterJobs);

  if (btnResetFilter) {
    btnResetFilter.addEventListener('click', () => {
      if (jobSearchInput) jobSearchInput.value = '';
      if (sectorSelect) sectorSelect.value = 'all';
      if (locationSearchInput) locationSearchInput.value = '';
      filterJobs();
    });
  }

  // 5. Parse URL parameters for direct deep-linking
  const urlParams = new URLSearchParams(window.location.search);
  const sectorParam = urlParams.get('sector');
  const roleParam = urlParams.get('role');
  const jobParam = urlParams.get('job');

  if (sectorParam && sectorSelect) {
    sectorSelect.value = sectorParam.toLowerCase();
    filterJobs();
  }

  if (roleParam && jobSearchInput) {
    jobSearchInput.value = roleParam;
    filterJobs();
  }

  if (jobParam) {
    setTimeout(() => {
      openSingleJobModal(jobParam);
    }, 500);
  }

  // 6. Application Modal Handler (jobAppModalForm)
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

  // 7. Certificate Verification Simulator (certificate.html)
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

// 8. Open Single Job Details Page
function openSingleJobModal(jobId) {
  window.location.href = `singlejobs.html?id=${encodeURIComponent(jobId)}`;
}
function openApplyModal(jobTitle, companyName) {
  const modalEl = document.getElementById('applicationModal');
  if (!modalEl) {
    window.location.href = `join.html?role=${encodeURIComponent(jobTitle)}`;
    return;
  }

  const appTargetJob = document.getElementById('appTargetJob');
  const appModalTitle = document.getElementById('appModalTitle');
  const appModalCompany = document.getElementById('appModalCompany');

  if (appTargetJob) appTargetJob.value = jobTitle;
  if (appModalTitle) appModalTitle.textContent = `Apply for ${jobTitle}`;
  if (appModalCompany) appModalCompany.textContent = companyName ? `${companyName} • 100% Free Placement` : 'Bright Future Consultancy Placement Cell';

  const modalInstance = new bootstrap.Modal(modalEl);
  modalInstance.show();
}

// 9. Share Job Functionality (Matching Reference Design 2)
let currentShareUrl = window.location.href;
let currentShareText = 'Check out this 100% Free Job opening on Bright Future Consultancy!';
let currentShareTitle = 'Job Vacancy Opening';

function shareJob(jobTitle = 'Featured Job Opening', jobDescription = '') {
  currentShareTitle = jobTitle;
  currentShareText = `Check out this 100% Free Job opening: ${jobTitle} - Bright Future Consultancy!`;
  currentShareUrl = window.location.href;

  showShareModal(currentShareTitle, currentShareText, currentShareUrl);
}

function showShareModal(jobTitle, shareText, shareUrl) {
  let shareModalEl = document.getElementById('shareModal');
  if (!shareModalEl) return;

  const shareUrlInput = document.getElementById('shareUrlInput');
  const shareWa = document.getElementById('shareWa');
  const shareTg = document.getElementById('shareTg');
  const shareFb = document.getElementById('shareFb');
  const shareTw = document.getElementById('shareTw');
  const shareLinkedin = document.getElementById('shareLinkedin');
  const shareGmail = document.getElementById('shareGmail');
  const shareOutlook = document.getElementById('shareOutlook');

  if (shareUrlInput) shareUrlInput.value = shareUrl;

  const encodedUrl = encodeURIComponent(shareUrl);
  const encodedText = encodeURIComponent(shareText);

  if (shareWa) shareWa.href = `https://wa.me/?text=${encodedText}%20${encodedUrl}`;
  if (shareTg) shareTg.href = `https://t.me/share/url?url=${encodedUrl}&text=${encodedText}`;
  if (shareFb) shareFb.href = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
  if (shareTw) shareTw.href = `https://twitter.com/intent/tweet?text=${encodedText}&url=${encodedUrl}`;
  if (shareLinkedin) shareLinkedin.href = `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`;
  if (shareGmail) shareGmail.href = `https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=&su=${encodeURIComponent(jobTitle)}&body=${encodedText}%20${encodedUrl}`;
  if (shareOutlook) shareOutlook.href = `mailto:?subject=${encodeURIComponent(jobTitle)}&body=${encodedText}%20${encodedUrl}`;

  // QR Code Image Generator
  const qrCodeImg = document.getElementById('qrCodeImg');
  if (qrCodeImg) {
    qrCodeImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=${encodedUrl}`;
  }

  const modalInstance = new bootstrap.Modal(shareModalEl);
  modalInstance.show();
}

function copyShareLink() {
  const shareUrlInput = document.getElementById('shareUrlInput');
  if (shareUrlInput) {
    shareUrlInput.select();
    navigator.clipboard.writeText(shareUrlInput.value).then(() => {
      alert('Link copied to clipboard!');
    }).catch(() => {
      alert('Link copied!');
    });
  }
}

function toggleQrCode() {
  const qrBox = document.getElementById('qrCodeContainer');
  if (qrBox) {
    qrBox.classList.toggle('d-none');
  }
}

function triggerNativeShare() {
  if (navigator.share) {
    navigator.share({
      title: currentShareTitle,
      text: currentShareText,
      url: currentShareUrl
    }).catch(() => {});
  } else {
    copyShareLink();
  }
}

function shareCopilot() {
  navigator.clipboard.writeText(`${currentShareText} Link: ${currentShareUrl}`);
  alert('Job link & summary copied for AI / Copilot sharing!');
}

function shareDirectContact(contactIdentifier, platform) {
  if (platform === 'whatsapp') {
    const cleanNumber = contactIdentifier.replace(/[^0-9]/g, '');
    window.open(`https://wa.me/${cleanNumber}?text=${encodeURIComponent(currentShareText + ' ' + currentShareUrl)}`, '_blank');
  } else if (platform === 'email' || platform === 'outlook') {
    window.open(`mailto:?subject=${encodeURIComponent(currentShareTitle)}&body=${encodeURIComponent(currentShareText + ' ' + currentShareUrl)}`, '_blank');
  }
}

function resetJobFilters() {
  const jobSearchInput = document.getElementById('jobSearchInput');
  const sectorSelect = document.getElementById('sectorSelect');
  const locationSearchInput = document.getElementById('locationSearchInput');
  const btnResetFilter = document.getElementById('btnResetFilter');

  if (jobSearchInput) jobSearchInput.value = '';
  if (sectorSelect) sectorSelect.value = 'all';
  if (locationSearchInput) locationSearchInput.value = '';
  if (btnResetFilter) btnResetFilter.click();
}

// 10. Single Job Details View Modal Data & Handler
const jobDataStore = {
  'job-1': {
    title: 'Snapdeal Driver & Delivery Partner',
    company: 'Snapdeal Logistics Partner',
    sector: 'Logistics Sector',
    location: 'Barddhaman Town & Suburbs',
    salary: '₹18,000 - ₹22,000 / month',
    description: 'Urgent requirement for delivery partners and commercial vehicle drivers at Snapdeal Logistics hub in Barddhaman. Responsible for daily e-commerce package deliveries, route navigation, customer verification, and package handling.',
    requirements: [
      'Education: 5th / 8th / 10th Standard Pass',
      'Valid Driving License (2-Wheeler or 4-Wheeler)',
      'Smartphone for delivery app operations',
      'Immediate joining in Barddhaman location',
      '100% Free Placement - Zero registration fee'
    ]
  },
  'job-2': {
    title: 'Registration Form For All Jobs',
    company: 'Bright Future Consultancy',
    sector: 'Multi-Sector Registration',
    location: 'Barddhaman, Durgapur, Kolkata',
    salary: '₹12,000 - ₹35,000 / month',
    description: 'One-stop direct candidate application for 50+ hiring partner companies across West Bengal. Once registered, our career executive team matches your profile with top vacancies in Banking, Retail, IT, Pharmacy, Back Office, and Technical roles.',
    requirements: [
      'Education: 10th / 12th / Diploma / Graduate',
      'Freshers and experienced candidates eligible',
      'Aadhaar card and photo ID proof',
      'Good attitude and eagerness to work',
      'Direct interview calls & free placement support'
    ]
  },
  'job-3': {
    title: 'More Supermarket Store Assistant (Floor & Billing)',
    company: 'More Supermarket Retail',
    sector: 'Retail & Supermarket',
    location: 'Barddhaman Store',
    salary: '₹14,500 - ₹20,000 / month',
    description: 'Full-time positions at More Supermarket store in Barddhaman. Duties include assisting store shoppers, cash counter billing, product price tag verification, shelf restocking, and store hygiene management.',
    requirements: [
      'Education: 10th / 12th Pass',
      'Age limit: 18 to 32 Years (Male & Female)',
      'Basic computer or billing counter knowledge helpful',
      'Friendly customer service attitude',
      'Fixed shift timings with weekly off'
    ]
  },
  'job-4': {
    title: 'ATM Cash Refilling & Operations Officer',
    company: 'CMS / Private Banking Partner',
    sector: 'Banking & Security',
    location: 'Purba Barddhaman & Bankura',
    salary: '₹18,000 - ₹26,000 / month',
    description: 'Specialized opening for ATM cash management and replenishment officers. Responsible for safe loading of currency in bank ATMs, balancing cash receipts, technical fault logging, and secure transport protocol execution.',
    requirements: [
      'Education: 12th Pass / Graduate',
      'Clean background check and verification',
      'Basic mathematical and cash counting skills',
      'Responsible and trustworthy work ethic',
      'Company uniform and travel allowance provided'
    ]
  },
  'job-5': {
    title: 'Pharmacy Assistant & Retail Trainee',
    company: 'Apollo Pharmacies Limited',
    sector: 'Pharmacy & Healthcare',
    location: 'Barddhaman & Asansol Stores',
    salary: '₹15,000 - ₹24,000 / month',
    description: 'Join Apollo Pharmacy store network as retail assistant or pharmacist trainee. Responsibilities include customer greeting, medicine prescription reading under supervision, POS billing, inventory checking, and storage maintenance.',
    requirements: [
      'Education: 10th / 12th / D.Pharm / B.Pharm',
      'Basic knowledge of medicine names & computer billing',
      'Polite communication skills with patients/customers',
      'Day and evening shift options available',
      '100% Free Placement with PF & ESIC benefits'
    ]
  },
  'job-6': {
    title: 'Escort Guard & Railway Goods Security Officer',
    company: 'Railway & Goods Security Agency',
    sector: 'Security & Escort Guard',
    location: 'Barddhaman / Howrah Cargo Yard',
    salary: '₹18,000 - ₹28,000 / month + Bonus',
    description: 'Spot joining available for security escort guards protecting railway goods cargo, industrial inventory, and site perimeters. Free company lodging/room and official security uniform provided.',
    requirements: [
      'Education: 8th / 10th / 12th Pass',
      'Physical fitness and good health',
      'Age limit: 18 to 45 Years',
      'Room & Uniform provided free by company',
      'Spot joining letter issued upon verification'
    ]
  }
};

function openSingleJobModal(jobId) {
  const modalEl = document.getElementById('singleJobModal');
  if (!modalEl) return;

  const data = jobDataStore[jobId] || {
    title: 'Featured Job Opportunity',
    company: 'Bright Future Consultancy Partner',
    sector: 'General Sector',
    location: 'Barddhaman, West Bengal',
    salary: '₹15,000 - ₹25,000 / month',
    description: 'Excellent job opening with top partner company in Purba Barddhaman. Free interview and placement assistance provided by Bright Future Consultancy.',
    requirements: ['10th / 12th Pass', 'Valid ID proof', 'Immediate joining']
  };

  const sjSectorBadge = document.getElementById('sjSectorBadge');
  const sjTitle = document.getElementById('sjTitle');
  const sjCompanyLocation = document.getElementById('sjCompanyLocation');
  const sjDescription = document.getElementById('sjDescription');
  const sjRequirements = document.getElementById('sjRequirements');
  const sjSalary = document.getElementById('sjSalary');
  const sjLocation = document.getElementById('sjLocation');
  const sjApplyBtn = document.getElementById('sjApplyBtn');
  const sjShareBtn = document.getElementById('sjShareBtn');

  if (sjSectorBadge) sjSectorBadge.textContent = data.sector;
  if (sjTitle) sjTitle.textContent = data.title;
  if (sjCompanyLocation) sjCompanyLocation.innerHTML = `<i class="fas fa-building me-1"></i> ${data.company} • <i class="fas fa-map-marker-alt me-1"></i> ${data.location}`;
  if (sjDescription) sjDescription.textContent = data.description;
  if (sjSalary) sjSalary.textContent = data.salary;
  if (sjLocation) sjLocation.textContent = data.location;

  if (sjRequirements) {
    sjRequirements.innerHTML = data.requirements.map(req => `<li>${req}</li>`).join('');
  }

  if (sjApplyBtn) {
    sjApplyBtn.onclick = () => {
      const singleModalInstance = bootstrap.Modal.getInstance(modalEl);
      if (singleModalInstance) singleModalInstance.hide();
      openApplyModal(data.title, data.company);
    };
  }

  if (sjShareBtn) {
    sjShareBtn.onclick = () => {
      shareJob(data.title, data.description);
    };
  }

  const modalInstance = new bootstrap.Modal(modalEl);
  modalInstance.show();
}

// ==========================================================================
// Candidate Placements Sliding Carousel Data Model & Controller
// ==========================================================================
window.PLACEMENTS_SLIDER_DATA = [
  { id: 1, name: "Achinta", role: "Mechanic", company: "Hero MotoCorp", image: "assets/images/placements/achinta.svg" },
  { id: 2, name: "Subhojit Dutta", role: "Warehouse Exec", company: "Flipkart Logistics", image: "assets/images/placements/subhojit.svg" },
  { id: 3, name: "Mridul Dey", role: "Banking Assistant", company: "Axis Bank", image: "assets/images/placements/mridul.svg" },
  { id: 4, name: "Rajib Roy", role: "Electrician", company: "Havells India", image: "assets/images/placements/rajib.svg" },
  { id: 5, name: "Sk Samim", role: "Back Office Exec", company: "TCS Partner", image: "assets/images/placements/sk_samim.svg" },
  { id: 6, name: "Sahil Mallick", role: "Delivery Partner", company: "Snapdeal", image: "assets/images/placements/sahil.svg" },
  { id: 7, name: "Hafijur Mondal", role: "Security Guard", company: "SIS Security", image: "assets/images/placements/hafijur.svg" }
];

function initPlacementsCarousel() {
  const track = document.getElementById('placementsCarouselTrack');
  if (!track) return;

  const data = window.PLACEMENTS_SLIDER_DATA || [];
  track.innerHTML = data.map(item => `
    <div class="placement-slide-card">
      <img src="${item.image}" alt="${item.name} - ${item.role}" loading="lazy">
    </div>
  `).join('');

  let currentIndex = 0;
  let autoSlideTimer = null;

  function getCardsPerView() {
    if (window.innerWidth < 576) return 1;
    if (window.innerWidth < 992) return 2;
    return 3;
  }

  function updateSlidePosition() {
    const cardsPerView = getCardsPerView();
    const maxIndex = Math.max(0, data.length - cardsPerView);
    if (currentIndex > maxIndex) currentIndex = 0;
    if (currentIndex < 0) currentIndex = maxIndex;

    const card = track.querySelector('.placement-slide-card');
    if (!card) return;
    const cardWidth = card.offsetWidth + 20;
    track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
  }

  function nextSlide() {
    const cardsPerView = getCardsPerView();
    const maxIndex = Math.max(0, data.length - cardsPerView);
    if (currentIndex >= maxIndex) {
      currentIndex = 0;
    } else {
      currentIndex++;
    }
    updateSlidePosition();
  }

  function prevSlide() {
    const cardsPerView = getCardsPerView();
    const maxIndex = Math.max(0, data.length - cardsPerView);
    if (currentIndex <= 0) {
      currentIndex = maxIndex;
    } else {
      currentIndex--;
    }
    updateSlidePosition();
  }

  const btnNext = document.getElementById('btnPlacementNext');
  const btnPrev = document.getElementById('btnPlacementPrev');

  if (btnNext) btnNext.onclick = () => { nextSlide(); resetAutoSlide(); };
  if (btnPrev) btnPrev.onclick = () => { prevSlide(); resetAutoSlide(); };

  function startAutoSlide() {
    stopAutoSlide();
    autoSlideTimer = setInterval(nextSlide, 3500);
  }

  function stopAutoSlide() {
    if (autoSlideTimer) clearInterval(autoSlideTimer);
  }

  function resetAutoSlide() {
    stopAutoSlide();
    startAutoSlide();
  }

  track.addEventListener('mouseenter', stopAutoSlide);
  track.addEventListener('mouseleave', startAutoSlide);
  window.addEventListener('resize', updateSlidePosition);

  updateSlidePosition();
  startAutoSlide();
}

document.addEventListener('DOMContentLoaded', () => {
  initPlacementsCarousel();
  initScrollReveal();
});

// ==========================================================================
// Scroll Reveal Observer & Micro-Animations Controller
// ==========================================================================
function initScrollReveal() {
  const elementsToReveal = document.querySelectorAll('.section-title, .section-tag, .card, .role-sector-card, .candidate-card, .floating-job-alert, .job-post-card');

  elementsToReveal.forEach(el => {
    el.classList.add('reveal-on-scroll');
  });

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('reveal-visible');
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  });

  elementsToReveal.forEach(el => observer.observe(el));
}

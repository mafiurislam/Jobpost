const fs = require('fs');
const path = require('path');

const singleJobsPath = path.join(__dirname, '..', 'singlejobs.html');
let content = fs.readFileSync(singleJobsPath, 'utf8');

const updatedDatabaseCode = `    const JOBS_DATABASE = {
      'job-1': {
        title: "Job Opening Snapdeal Delivery Partner",
        company: "Snapdeal Logistics Partner • Kolkata, Barddhaman",
        salary: "₹ 22,000 / mo",
        qualification: "5th / 8th Pass",
        image: "assets/images/posters/snapdeal_poster.svg",
        description: \`
          <p>Snapdeal logistics partner is hiring delivery partners and drivers for daily parcel delivery routes in Barddhaman town and surrounding Kolkata areas.</p>
          <ul class="ps-3 mb-2">
            <li><strong>Key Responsibilities:</strong> Pick up delivery parcels from logistics hub, route planning, timely doorstep delivery, and cash-on-delivery handling.</li>
            <li><strong>Eligibility & Qualification:</strong> Candidates with 5th, 8th or 10th pass qualification are welcome. Driving license or Commercial Badge preferred.</li>
            <li><strong>Benefits:</strong> ₹22,000 monthly fixed salary + fuel allowance + performance incentives + ESIC medical coverage.</li>
            <li><strong>Placement Fee:</strong> 100% Free placement with zero registration charge or hidden fee.</li>
          </ul>
        \`
      },
      'job-2': {
        title: "REGISTRATION FORM FOR ALL JOBS",
        company: "Bright Future Consultancy • All Over West Bengal",
        salary: "₹ 12,000 TO 35,000",
        qualification: "10th / 12th / Graduate Pass",
        image: "assets/images/posters/registration_poster.svg",
        description: \`
          <p>One-time candidate registration for multiple job openings across 50+ corporate partner companies in Barddhaman, Kolkata, Durgapur and Howrah.</p>
          <ul class="ps-3 mb-2">
            <li><strong>Available Roles:</strong> Back Office Assistant, Data Entry Operator, Retail Sales Executive, Supermarket Helper, Security Guard & Field Executive.</li>
            <li><strong>Eligibility:</strong> Freshers & experienced 10th, 12th pass & Graduates.</li>
            <li><strong>Process:</strong> Submit your details once to receive direct call-letter updates for verified interview drives.</li>
          </ul>
        \`
      },
      'job-3': {
        title: "STORE ASSISTANT (More Supermarket)",
        company: "More Supermarket Retail • Purba Barddhaman",
        salary: "₹ 15,000 / mo",
        qualification: "Full Time & Part Time",
        image: "assets/images/posters/supermarket_poster.svg",
        description: \`
          <p>More Supermarket retail chain is hiring store assistants, counter cashiers, and inventory helpers for their Barddhaman store branch.</p>
          <ul class="ps-3 mb-2">
            <li><strong>Key Duties:</strong> Customer assistance, billing counter management, grocery stock shelf stacking, barcode scanning.</li>
            <li><strong>Salary & Payroll:</strong> ₹15,000 fixed salary on direct company payroll with overtime allowance.</li>
          </ul>
        \`
      },
      'job-4': {
        title: "ATM Cash Refilling Officer",
        company: "CMS Banking Security • Barddhaman, Kolkata",
        salary: "₹ 18,000 / mo",
        qualification: "10th / 12th Pass",
        image: "assets/images/posters/atm_poster.svg",
        description: \`
          <p>Urgent hiring for ATM Cash Custodians and Refilling Officers across private bank ATM routes in Purba Barddhaman and Bankura.</p>
          <ul class="ps-3 mb-2">
            <li><strong>Job Role:</strong> Vault cash loading into bank ATMs, ATM cassette auditing, and cash logistics management.</li>
            <li><strong>Company Payroll:</strong> Direct joining on company payroll with PF, ESIC & insurance benefits.</li>
          </ul>
        \`
      },
      'job-5': {
        title: "Pharmacy Assistant / Pharmacy Trainee / Retail Pharmacist",
        company: "Apollo Pharmacies Limited • Purba Barddhaman",
        salary: "₹ 15,000 - ₹ 20,000",
        qualification: "D.Pharm / B.Pharm / 10th+",
        image: "assets/images/posters/apollo_poster.svg",
        description: \`
          <p>Apollo Pharmacies Limited is conducting urgent spot interviews for pharmacy assistants, trainees, and registered pharmacists.</p>
          <ul class="ps-3 mb-2">
            <li><strong>Duties:</strong> Prescription medicine dispensing, inventory stock checking, billing counter management.</li>
            <li><strong>Qualifications:</strong> D.Pharm, B.Pharm, or 10th/12th pass with medical store experience.</li>
          </ul>
        \`
      },
      'job-6': {
        title: "Escort Guard / Railway Goods Guard (Company Payroll Job)",
        company: "Escort Security & Logistics • Barddhaman & Asansol",
        salary: "₹ 18,000 / mo",
        qualification: "8th / 10th / 12th Pass",
        image: "assets/images/posters/escort_poster.svg",
        description: \`
          <p>Direct spot hiring for cargo train escort guards and industrial goods transport security guards.</p>
          <ul class="ps-3 mb-2">
            <li><strong>Highlights:</strong> Free fooding & lodging provided by company. Spot joining letter on interview day.</li>
            <li><strong>Salary:</strong> ₹18,000 monthly in-hand salary with annual increments.</li>
          </ul>
        \`
      },

      // Sector Mappings
      'all_new': {
        title: "All New and Update Jobs Section",
        company: "Bright Future Hiring Partners • West Bengal",
        salary: "₹ 12,000 - ₹ 35,000",
        qualification: "10th / 12th / Graduate Pass",
        image: "assets/images/roles/all_new_jobs.svg",
        description: \`<p>Comprehensive listing of fresh job updates across IT, Banking, Retail, Logistics, Healthcare, and Govt. Contractual sectors in Barddhaman.</p>\`
      },
      'overseas': {
        title: "ALL OVERSEAS JOBS (Gulf & Europe Placement)",
        company: "Overseas Recruitment Partners • UAE & Qatar",
        salary: "₹ 45,000 - ₹ 90,000",
        qualification: "ITI / Diploma / Experienced",
        image: "assets/images/roles/overseas_jobs.svg",
        description: \`<p>Overseas job vacancies for technicians, electricians, drivers, and hotel staff in UAE, Qatar, Saudi Arabia & Europe. Free visa processing assistance.</p>\`
      },
      'naps': {
        title: "ALL JOBS VACANCY UNDER NAPS (Govt Apprenticeship)",
        company: "NAPS Govt Scheme • West Bengal Industries",
        salary: "₹ 12,000 - ₹ 18,000",
        qualification: "10th / 12th / ITI Pass",
        image: "assets/images/roles/naps_jobs.svg",
        description: \`<p>Govt. National Apprenticeship Promotion Scheme (NAPS) vacancies with stipend, official NAPS certificate & direct company absorption.</p>\`
      },
      'govt': {
        title: "Govt. Contractual Jobs Section",
        company: "Govt. Departments & Municipalities",
        salary: "₹ 16,000 - ₹ 28,000",
        qualification: "8th / 10th / 12th / Graduate",
        image: "assets/images/roles/govt_contractual.svg",
        description: \`<p>Govt. contractual staff, computer operator, and office helper posts across West Bengal state government offices.</p>\`
      },
      'airlines': {
        title: "AIRLINES SECTOR JOBS (Ground Staff & Cabin Crew)",
        company: "IndiGo & Aviation Partners • Kolkata Airport",
        salary: "₹ 25,000 - ₹ 45,000",
        qualification: "12th Pass / Graduate",
        image: "assets/images/roles/airlines_jobs.svg",
        description: \`<p>Airlines ground staff, customer service agent, and luggage handling positions available at Kolkata International Airport. 100% free placement assistance.</p>\`
      },
      'backoffice': {
        title: "Back Office Sector & Data Entry",
        company: "Corporate IT & Finance Firms",
        salary: "₹ 14,000 - ₹ 24,000",
        qualification: "12th Pass / Graduate",
        image: "assets/images/roles/backoffice_jobs.svg",
        description: \`<p>Back office executive, MS Excel operator, telecaller, and document verifier positions in Barddhaman & Kolkata.</p>\`
      },
      'hospitality': {
        title: "Hospitality & Hotel Jobs Section",
        company: "Luxury Hotels & Resort Partners",
        salary: "₹ 15,000 - ₹ 28,000",
        qualification: "10th / 12th / Hotel Mgmt",
        image: "assets/images/roles/hospitality_hotel.svg",
        description: \`<p>Front desk reception, steward, chef assistant, and housekeeping posts in Barddhaman & Durgapur hotels.</p>\`
      },
      'auto': {
        title: "Automobile Sector (Tata Motors & Suzuki)",
        company: "Tata Motors & Maruti Suzuki Plants",
        salary: "₹ 16,000 - ₹ 26,000",
        qualification: "10th / ITI Fitter / Electrician",
        image: "assets/images/roles/automobile_jobs.svg",
        description: \`<p>Assembly line technician, fitter, auto electrician, and quality checker jobs in automobile manufacturing units.</p>\`
      },
      'medical': {
        title: "Medical Sector & Hospital Staff",
        company: "Private Hospitals & Diagnostics",
        salary: "₹ 15,000 - ₹ 30,000",
        qualification: "Nursing / GNM / Paramedical",
        image: "assets/images/roles/medical_sector.svg",
        description: \`<p>Nursing staff, OT technician, lab assistant, and hospital receptionist vacancies in top healthcare facilities.</p>\`
      },
      'banking': {
        title: "Banking Sector & Financial Services",
        company: "Axis Bank, HDFC & Private Banks",
        salary: "₹ 18,000 - ₹ 32,000",
        qualification: "12th / Graduate Pass",
        image: "assets/images/roles/banking_sector.svg",
        description: \`<p>Banking assistant, loan officer, phone banking specialist, and ATM operations executive in Barddhaman branches.</p>\`
      },
      'ac_mechanic': {
        title: "AC Mechanic & Refrigeration Technician",
        company: "HVAC & Service Partners",
        salary: "₹ 16,000 - ₹ 25,000",
        qualification: "10th / ITI RAC Pass",
        image: "assets/images/roles/ac_mechanic.svg",
        description: \`<p>AC installation, maintenance technician, compressor repair, and chiller operator jobs across commercial projects.</p>\`
      },
      'ac_coach': {
        title: "AC Coach Attender & Railway Staff",
        company: "Indian Railways Contracting Partner",
        salary: "₹ 16,500 - ₹ 24,000",
        qualification: "8th / 10th / 12th Pass",
        image: "assets/images/roles/ac_coach_attender.svg",
        description: \`<p>AC coach bedroll staff, train attendant, and passenger assistance staff on express train routes.</p>\`
      },
      'driver': {
        title: "Driver Jobs (Heavy & Commercial Vehicles)",
        company: "Logistics & Commercial Fleet Partners",
        salary: "₹ 18,000 - ₹ 28,000",
        qualification: "Valid DL / Badge",
        image: "assets/images/roles/driver_jobs.svg",
        description: \`<p>Commercial vehicle driver, delivery truck driver, personal driver, and ambulance driver posts in Barddhaman.</p>\`
      },
      'security': {
        title: "Security Guard & Guarding Forces",
        company: "SIS Security & Private Agencies",
        salary: "₹ 14,000 - ₹ 22,000",
        qualification: "8th / 10th Pass",
        image: "assets/images/roles/security_guard.svg",
        description: \`<p>Bank security guard, ATM supervisor, industrial site guard, and residential security staff positions.</p>\`
      },
      'call_centre': {
        title: "Call Centre & BPO Customer Support",
        company: "TCS Partner & BPO Centers",
        salary: "₹ 14,000 - ₹ 22,000",
        qualification: "10th / 12th Pass",
        image: "assets/images/roles/call_centre.svg",
        description: \`<p>Inbound customer service, tele-calling, voice process, and chat support openings in Bengali, Hindi & English.</p>\`
      },
      'housekeeping': {
        title: "Housekeeping Staff & Facility Helpers",
        company: "Facility Management Agencies",
        salary: "₹ 12,000 - ₹ 18,000",
        qualification: "5th / 8th Pass",
        image: "assets/images/roles/housekeeping_stuff.svg",
        description: \`<p>Corporate office cleaner, mall housekeeping staff, hospital sanitation staff, and pantry helper vacancies.</p>\`
      },
      'warehouse': {
        title: "Warehouse Executive & Logistics Picker",
        company: "Flipkart & E-Commerce Hubs",
        salary: "₹ 15,000 - ₹ 23,000",
        qualification: "10th / 12th Pass",
        image: "assets/images/roles/warehouse_executive.svg",
        description: \`<p>Warehouse picker, package scanner, loader, inventory supervisor, and dispatch officer jobs at logistics hubs.</p>\`
      },
      'it_hardware': {
        title: "IT & Hardware Networking Technician",
        company: "Hardware Support & Tech Firms",
        salary: "₹ 16,000 - ₹ 26,000",
        qualification: "12th / ITI / Diploma Hardware",
        image: "assets/images/roles/it_hardware.svg",
        description: \`<p>Desktop support engineer, CCTV technician, printer repair specialist, and computer hardware technician posts.</p>\`
      },
      'labour': {
        title: "Labour & General Factory Helper",
        company: "Manufacturing Plants & Warehouses",
        salary: "₹ 12,000 - ₹ 17,500",
        qualification: "5th / 8th Pass",
        image: "assets/images/roles/labour_helper.svg",
        description: \`<p>Factory helper, industrial packer, loading assistant, and general labour vacancies with free room lodging.</p>\`
      }
    };`;

content = content.replace(/const JOBS_DATABASE = \{[\s\S]*?\};/gi, updatedDatabaseCode);

fs.writeFileSync(singleJobsPath, content, 'utf8');
console.log('Updated singlejobs.html JOBS_DATABASE with all 19 sectors and job cards!');

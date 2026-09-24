@extends('layouts.app')

@section('title', 'Manpower Sectors & Categories - Bright Future Consultancy')
@section('meta_description', 'Explore all 19 manpower recruitment sectors offered by Bright Future Consultancy. Find verified jobs in Airlines, IT, Overseas, Logistics, and Banking.')

@section('content')

<!-- Page Banner Header -->
<section class="py-5 text-center" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff;">
  <div class="container py-4">
    <span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-30 rounded-pill px-3 py-2 fw-bold mb-2">SECTOR DIRECTORY</span>
    <h1 class="display-5 fw-extrabold text-white mb-3" style="letter-spacing: -0.5px;">We Provide Manpower for those Sectors</h1>
    <p class="lead text-light opacity-90 mx-auto mb-0" style="max-width: 700px; font-size: 1.15rem;">
      Browse open positions across 19 specialized recruitment sectors with 100% free placement support.
    </p>
  </div>
</section>

<!-- 19 Manpower Sectors Grid -->
<section class="py-5 bg-light">
  <div class="container py-4">
    <div class="row g-4">

      @php
        $sectorsList = [
          ['title' => 'All New and Update Jobs Section', 'img' => 'assets/images/roles/all_new_jobs.svg', 'slug' => 'all', 'desc' => 'Fresh vacancies in IT, Retail, Healthcare & Offices.'],
          ['title' => 'ALL OVERSEAS JOBS (Gulf & Europe)', 'img' => 'assets/images/roles/overseas_jobs.svg', 'slug' => 'overseas', 'desc' => 'Technicians, drivers & hotel staff in UAE & Europe.'],
          ['title' => 'ALL JOBS UNDER NAPS (Apprenticeship)', 'img' => 'assets/images/roles/naps_jobs.svg', 'slug' => 'naps', 'desc' => 'Govt. apprenticeship stipend & company certification.'],
          ['title' => 'Govt. Contractual Jobs Section', 'img' => 'assets/images/roles/govt_contractual.svg', 'slug' => 'govt', 'desc' => 'Computer operators & office helpers in govt. offices.'],
          ['title' => 'AIRLINES SECTOR JOBS (Airport Staff)', 'img' => 'assets/images/roles/airlines_jobs.svg', 'slug' => 'airlines', 'desc' => 'Ground staff, passenger handling & terminal luggage.'],
          ['title' => 'Back Office Sector & Data Entry', 'img' => 'assets/images/roles/backoffice_jobs.svg', 'slug' => 'backoffice', 'desc' => 'MS Excel operators, KYC checkers & administrative clerks.'],
          ['title' => 'Hospitality & Hotel Jobs Section', 'img' => 'assets/images/roles/hospitality_hotel.svg', 'slug' => 'hospitality', 'desc' => 'Front desk reception, stewards, chefs & room service.'],
          ['title' => 'Automobile Sector (Tata Motors & Suzuki)', 'img' => 'assets/images/roles/automobile_jobs.svg', 'slug' => 'auto', 'desc' => 'Assembly line fitters, quality checkers & mechanics.'],
          ['title' => 'Medical Sector & Hospital Staff', 'img' => 'assets/images/roles/medical_sector.svg', 'slug' => 'medical', 'desc' => 'Nursing aides, lab technicians, pharmacy assistants.'],
          ['title' => 'Banking Sector & Financial Services', 'img' => 'assets/images/roles/banking_sector.svg', 'slug' => 'banking', 'desc' => 'Loan officers, ATM operations & customer executive.'],
          ['title' => 'AC Mechanic & Refrigeration Technician', 'img' => 'assets/images/roles/ac_mechanic.svg', 'slug' => 'technical', 'desc' => 'HVAC installation, gas charging & compressor repair.'],
          ['title' => 'AC Coach Attender & Railway Staff', 'img' => 'assets/images/roles/ac_coach_attender.svg', 'slug' => 'railway', 'desc' => 'Train coach attendants & passenger service staff.'],
          ['title' => 'Driver Jobs (Heavy & Commercial)', 'img' => 'assets/images/roles/driver_jobs.svg', 'slug' => 'driver', 'desc' => 'Logistics truck drivers, personal & delivery drivers.'],
          ['title' => 'Security Guard & Guarding Forces', 'img' => 'assets/images/roles/security_guard.svg', 'slug' => 'security', 'desc' => 'Bank guards, industrial gate supervisors & patrolling.'],
          ['title' => 'Call Centre & BPO Customer Support', 'img' => 'assets/images/roles/call_centre.svg', 'slug' => 'bpo', 'desc' => 'Inbound customer service, Bengali/Hindi telecallers.'],
          ['title' => 'Housekeeping Staff & Facility Helpers', 'img' => 'assets/images/roles/housekeeping_stuff.svg', 'slug' => 'facility', 'desc' => 'Corporate office cleaners, mall staff & pantry helpers.'],
          ['title' => 'Warehouse Executive & Logistics Picker', 'img' => 'assets/images/roles/warehouse_executive.svg', 'slug' => 'logistics', 'desc' => 'Package scanners, barcode pickers & dispatch loaders.'],
          ['title' => 'IT & Hardware Networking Technician', 'img' => 'assets/images/roles/it_hardware.svg', 'slug' => 'it', 'desc' => 'Desktop support engineers, CCTV & printer technicians.'],
          ['title' => 'Labour & General Factory Helper', 'img' => 'assets/images/roles/labour_helper.svg', 'slug' => 'industrial', 'desc' => 'Industrial packers, factory workers & loading assistants.'],
        ];
      @endphp

      @foreach($sectorsList as $sec)
      <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white">
          <div class="p-0 overflow-hidden bg-dark position-relative text-center" style="min-height: 180px;">
            <img src="{{ asset($sec['img']) }}" alt="{{ $sec['title'] }}" class="w-100 h-100 object-fit-cover" style="min-height: 180px; max-height: 200px;">
          </div>
          <div class="card-body p-4 d-flex flex-column justify-content-between">
            <div>
              <h5 class="fw-bold text-dark mb-2" style="font-size: 1.1rem; line-height: 1.35;">{{ $sec['title'] }}</h5>
              <p class="text-secondary small mb-3">{{ $sec['desc'] }}</p>
            </div>
            <div class="pt-3 border-top border-light">
              <a href="{{ route('jobs.index', ['sector' => $sec['slug']]) }}" class="text-success fw-bold text-decoration-none d-inline-flex align-items-center">
                View Vacancies <i class="fas fa-arrow-right ms-2"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</section>

@endsection

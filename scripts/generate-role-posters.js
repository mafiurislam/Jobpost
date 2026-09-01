const fs = require('fs');
const path = require('path');

const targetDir = path.join(__dirname, '..', 'assets', 'images', 'roles');
if (!fs.existsSync(targetDir)) {
  fs.mkdirSync(targetDir, { recursive: true });
}

function escapeXml(unsafe) {
  return unsafe.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&apos;');
}

function makeSvgBanner(title, badgeText, gradientColors, subText = "JOB VACANCY 2025 • ALL OVER INDIA", btnColor = "#d90429") {
  const safeTitle = escapeXml(title.toUpperCase());
  const safeBadge = escapeXml(badgeText);
  const safeSubText = escapeXml(subText);

  return `<svg xmlns="http://www.w3.org/2000/svg" width="600" height="360" viewBox="0 0 600 360">
  <defs>
    <linearGradient id="bgGrad_${Math.random().toString(36).substr(2, 5)}" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="${gradientColors[0]}" />
      <stop offset="60%" stop-color="${gradientColors[1]}" />
      <stop offset="100%" stop-color="${gradientColors[2] || gradientColors[1]}" />
    </linearGradient>
  </defs>
  <rect width="600" height="360" fill="${gradientColors[0]}"/>
  <rect width="600" height="360" fill-opacity="0.9"/>
  
  <!-- Advine 360 Logo Top Left -->
  <circle cx="60" cy="45" r="28" fill="#ffffff"/>
  <text x="60" y="42" font-family="sans-serif" font-weight="bold" font-size="9" fill="${gradientColors[0]}" text-anchor="middle">ADVINE 360</text>
  <text x="60" y="52" font-family="sans-serif" font-size="7" fill="#1b1827" text-anchor="middle">CAREER</text>
  
  <!-- Title Text -->
  <text x="250" y="55" font-family="sans-serif" font-weight="bold" font-size="22" fill="#ffffff" text-anchor="middle">${safeTitle}</text>
  
  <!-- Highlight Badge -->
  <rect x="100" y="80" width="300" height="36" rx="18" fill="#00b894"/>
  <text x="250" y="104" font-family="sans-serif" font-weight="bold" font-size="16" fill="#ffffff" text-anchor="middle">${safeBadge}</text>
  
  <!-- Sub Details -->
  <text x="250" y="140" font-family="sans-serif" font-weight="bold" font-size="13" fill="#ffcc00" text-anchor="middle">${safeSubText}</text>
  <text x="250" y="165" font-family="sans-serif" font-size="12" fill="#ffffff" text-anchor="middle">10th, 12th, Graduate Pass Can Apply</text>
  <text x="250" y="190" font-family="sans-serif" font-weight="bold" font-size="14" fill="#00d2ff" text-anchor="middle">www.bfconsultancy.in</text>
  <text x="250" y="212" font-family="sans-serif" font-size="11" fill="#ffffff" opacity="0.8" text-anchor="middle">Barrackpore, Kolkata-700121</text>
  
  <!-- Apply Button -->
  <rect x="160" y="235" width="180" height="42" rx="21" fill="${btnColor}"/>
  <text x="250" y="262" font-family="sans-serif" font-weight="bold" font-size="16" fill="#ffffff" text-anchor="middle">APPLY NOW</text>
  
  <!-- Candidate Graphic Right -->
  <g transform="translate(430, 40)">
    <circle cx="75" cy="65" r="38" fill="#f3a97b"/>
    <path d="M 35,55 C 35,25 55,18 75,18 C 95,18 115,25 115,55 Z" fill="#1b1827"/>
    <path d="M 15,280 L 15,140 Q 15,115 75,115 Q 135,115 135,140 L 135,280 Z" fill="#ffffff"/>
    <path d="M 60,115 L 70,170 L 75,170 L 90,115" stroke="#0072ff" stroke-width="7" fill="none"/>
  </g>
</svg>`;
}

const sectorsList = [
  { file: 'all_new_jobs.svg', title: 'All New and Update Jobs Section', badge: '100% FREE JOBS', colors: ['#ff9900', '#ff6600', '#cc5200'] },
  { file: 'overseas_jobs.svg', title: 'ALL OVERSEAS JOBS', badge: 'OVERSEAS VACANCY', colors: ['#0a192f', '#1e3c72', '#2a5298'] },
  { file: 'naps_jobs.svg', title: 'ALL JOBS UNDER NAPS', badge: 'NAPS GOVT SCHEME', colors: ['#2d0b5a', '#6b1178', '#b81665'] },
  { file: 'govt_contractual.svg', title: 'Govt. Contractual Jobs Section', badge: 'GOVT PAYROLL', colors: ['#140628', '#4a0e4e', '#931252'] },
  { file: 'airlines_jobs.svg', title: 'AIRLINES SECTOR JOBS', badge: 'GROUND STAFF AND CREW', colors: ['#051937', '#004d7a', '#008793'] },
  { file: 'backoffice_jobs.svg', title: 'Back Office Sector', badge: 'BACK OFFICE JOB', colors: ['#1b002c', '#4d004d', '#800040'] },
  { file: 'medical_sector.svg', title: 'Medical Sector', badge: 'MEDICAL VACANCY', colors: ['#3d002e', '#800040', '#c0005a'] },
  { file: 'automobile_jobs.svg', title: 'Automobile Sector', badge: 'AUTO TECH AND FITTER', colors: ['#14002b', '#3c005a', '#700070'] },
  { file: 'ac_coach_attender.svg', title: 'Ac Coach Attender Jobs', badge: 'RAILWAY AC COACH', colors: ['#003366', '#004080', '#0066cc'] },
  { file: 'driver_jobs.svg', title: 'Driver Jobs', badge: 'HEAVY AND LIGHT DRIVER', colors: ['#e65100', '#f57c00', '#ff9800'] },
  { file: 'banking_sector.svg', title: 'Banking Sector', badge: 'BANKING PAYROLL', colors: ['#1a237e', '#283593', '#3f51b5'] },
  { file: 'security_guard.svg', title: 'Security Guard', badge: 'SECURITY AND GUARD', colors: ['#263238', '#37474f', '#455a64'] },
  { file: 'housekeeping_stuff.svg', title: 'Housekeeping Stuff', badge: 'HOTEL AND FACILITY', colors: ['#4a148c', '#6a1b9a', '#8e24aa'] },
  { file: 'labour_helper.svg', title: 'Labour-Helper', badge: 'FACTORY AND WAREHOUSE', colors: ['#bf360c', '#d84315', '#f4511e'] },
  { file: 'warehouse_executive.svg', title: 'Warehouse Executive', badge: 'LOGISTICS AND INVENTORY', colors: ['#004d40', '#00695c', '#00897b'] },
  { file: 'ac_mechanic.svg', title: 'Ac Mechanic', badge: 'HVAC AND AC REPAIR', colors: ['#0d47a1', '#1565c0', '#1e88e5'] },
  { file: 'hospitality_hotel.svg', title: 'Hospitality and Hotel Sector', badge: 'HOTEL AND RESORT', colors: ['#880e4f', '#ad1457', '#c2185b'] },
  { file: 'it_hardware.svg', title: 'IT sector-Hardware', badge: 'HARDWARE AND NETWORK', colors: ['#1b5e20', '#2e7d32', '#388e3c'] },
  { file: 'call_centre.svg', title: 'Call Centre', badge: 'BPO AND TELECALLER', colors: ['#311b92', '#4527a0', '#512da8'] }
];

sectorsList.forEach(s => {
  fs.writeFileSync(path.join(targetDir, s.file), makeSvgBanner(s.title, s.badge, s.colors));
});

console.log('All 19 SVG posters generated successfully with 100% valid XML!');

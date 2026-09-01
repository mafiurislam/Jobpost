const fs = require('fs');
const path = require('path');

const targetDir = path.join(__dirname, '..', 'assets', 'images', 'placements');
if (!fs.existsSync(targetDir)) {
  fs.mkdirSync(targetDir, { recursive: true });
}

function makeCandidateCardSvg(name, role, company, photoBg = '#1b1827', accentColor = '#0072ff') {
  const safeName = name.toUpperCase();
  const safeRole = role.toUpperCase();
  const safeCompany = company.toUpperCase();

  return `<svg xmlns="http://www.w3.org/2000/svg" width="300" height="420" viewBox="0 0 300 420">
  <defs>
    <linearGradient id="cardGrad_${Math.random().toString(36).substr(2, 5)}" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#00a8cc" />
      <stop offset="100%" stop-color="#005b96" />
    </linearGradient>
  </defs>

  <!-- Card Background -->
  <rect width="300" height="420" rx="16" fill="#f4f9ff" stroke="#e0ecf8" stroke-width="2"/>
  
  <!-- Decorative Top Graphic -->
  <path d="M 0 0 L 300 0 L 300 100 Q 150 140 0 100 Z" fill="url(#cardGrad_${Math.random().toString(36).substr(2, 5)})" opacity="0.15"/>
  
  <!-- Logo Top Right -->
  <g transform="translate(210, 15)">
    <rect width="75" height="35" rx="6" fill="#0072ff" opacity="0.9"/>
    <text x="37" y="16" font-family="sans-serif" font-weight="bold" font-size="8" fill="#ffffff" text-anchor="middle">ADVINE 360</text>
    <text x="37" y="27" font-family="sans-serif" font-size="7" fill="#ffeb3b" text-anchor="middle">CAREER</text>
  </g>
  
  <!-- Verified Badge Top Left -->
  <g transform="translate(15, 18)">
    <circle cx="15" cy="15" r="14" fill="#0A5900"/>
    <text x="15" y="20" font-family="sans-serif" font-weight="bold" font-size="10" fill="#ffffff" text-anchor="middle">✓</text>
  </g>

  <!-- Candidate Oval Image Container -->
  <g transform="translate(45, 60)">
    <ellipse cx="105" cy="115" rx="90" ry="110" fill="#ffffff" stroke="#0072ff" stroke-width="4"/>
    
    <!-- Candidate Portrait Silhouette -->
    <ellipse cx="105" cy="115" rx="86" ry="106" fill="#e8f0fe"/>
    <circle cx="105" cy="85" r="42" fill="#d0e1fd"/>
    <path d="M 45 190 C 45 140, 165 140, 165 190 Z" fill="${accentColor}"/>
    <!-- Face Silhouette -->
    <circle cx="105" cy="88" r="32" fill="#f5c29b"/>
    <path d="M 75 68 C 75 48, 135 48, 135 68 Z" fill="#2b2b2b"/>
  </g>

  <!-- Watermark Text Overlay -->
  <text x="150" y="240" font-family="sans-serif" font-weight="bold" font-size="11" fill="#4a5568" opacity="0.7" text-anchor="middle">Advine 360 Career Solutions</text>

  <!-- Bottom Details Box -->
  <path d="M 30 310 Q 150 280 270 310 L 270 405 Q 150 405 30 405 Z" fill="#1b2a47"/>
  
  <text x="150" y="348" font-family="sans-serif" font-weight="bold" font-size="16" fill="#ffeb3b" text-anchor="middle">${safeName}</text>
  <text x="150" y="372" font-family="sans-serif" font-weight="bold" font-size="13" fill="#ffffff" text-anchor="middle">${safeRole}</text>
  <text x="150" y="392" font-family="sans-serif" font-size="10" fill="#00d2ff" text-anchor="middle">JOB IN ${safeCompany}</text>
</svg>`;
}

const candidates = [
  { file: 'achinta.svg', name: 'Achinta', role: 'Mechanic', company: 'Hero MotoCorp', color: '#1b3b6f' },
  { file: 'subhojit.svg', name: 'Subhojit Dutta', role: 'Warehouse Exec', company: 'Flipkart Logistics', color: '#0072ff' },
  { file: 'mridul.svg', name: 'Mridul Dey', role: 'Banking Assistant', company: 'Axis Bank', color: '#900c3f' },
  { file: 'rajib.svg', name: 'Rajib Roy', role: 'Electrician', company: 'Havells India', color: '#e65100' },
  { file: 'sk_samim.svg', name: 'Sk Samim', role: 'Back Office Exec', company: 'TCS Partner', color: '#4a148c' },
  { file: 'sahil.svg', name: 'Sahil Mallick', role: 'Delivery Partner', company: 'Snapdeal', color: '#004d40' },
  { file: 'hafijur.svg', name: 'Hafijur Mondal', role: 'Security Guard', company: 'SIS Security', color: '#263238' }
];

candidates.forEach(c => {
  fs.writeFileSync(path.join(targetDir, c.file), makeCandidateCardSvg(c.name, c.role, c.company, '#1b1827', c.color));
});

console.log('Placement candidate SVGs generated successfully!');

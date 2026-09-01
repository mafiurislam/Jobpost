const fs = require('fs');
const path = require('path');

const baseDir = path.join(__dirname, '..', 'assets', 'images');

// Helper to create directory
function ensureDir(dir) {
  if (!fs.existsSync(dir)) {
    fs.mkdirSync(dir, { recursive: true });
  }
}

ensureDir(baseDir);
ensureDir(path.join(baseDir, 'team'));
ensureDir(path.join(baseDir, 'courses'));
ensureDir(path.join(baseDir, 'placements'));
ensureDir(path.join(baseDir, 'sectors'));

function createSvgPoster(title, bgGradient, textSub = "Bright Future Consultancy") {
  return `<svg xmlns="http://www.w3.org/2000/svg" width="600" height="400" viewBox="0 0 600 400">
    <defs>
      <linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%" stop-color="${bgGradient[0]}" />
        <stop offset="100%" stop-color="${bgGradient[1]}" />
      </linearGradient>
    </defs>
    <rect width="600" height="400" fill="url(#bg)"/>
    <circle cx="500" cy="80" r="140" fill="#ffffff" opacity="0.1"/>
    <circle cx="100" cy="320" r="180" fill="#ffffff" opacity="0.08"/>
    <rect x="30" y="30" width="540" height="340" rx="16" fill="none" stroke="#ffffff" stroke-width="2" stroke-dasharray="6,6" opacity="0.3"/>
    
    <text x="300" y="180" font-family="'Outfit', sans-serif" font-weight="bold" font-size="28" fill="#ffffff" text-anchor="middle">${title}</text>
    <text x="300" y="220" font-family="'Plus Jakarta Sans', sans-serif" font-weight="600" font-size="16" fill="#f5a623" text-anchor="middle">${textSub}</text>
    <rect x="210" y="250" width="180" height="40" rx="20" fill="#2cb6a6"/>
    <text x="300" y="275" font-family="'Plus Jakarta Sans', sans-serif" font-weight="bold" font-size="14" fill="#ffffff" text-anchor="middle">100% FREE JOBS</text>
  </svg>`;
}

function createAvatarSvg(name, role, bgColor = "#1b1827") {
  const initials = name.split(' ').map(n => n[0]).join('').substring(0,2);
  return `<svg xmlns="http://www.w3.org/2000/svg" width="300" height="360" viewBox="0 0 300 360">
    <rect width="300" height="360" rx="20" fill="${bgColor}"/>
    <circle cx="150" cy="130" r="70" fill="#2cb6a6" opacity="0.2"/>
    <circle cx="150" cy="130" r="55" fill="#ffffff"/>
    <text x="150" y="142" font-family="'Outfit', sans-serif" font-weight="bold" font-size="42" fill="#1b1827" text-anchor="middle">${initials}</text>
    <path d="M 60 300 C 60 210, 240 210, 240 300 Z" fill="#2cb6a6" opacity="0.9"/>
    <text x="150" y="325" font-family="'Outfit', sans-serif" font-weight="bold" font-size="18" fill="#ffffff" text-anchor="middle">${name}</text>
    <text x="150" y="345" font-family="'Plus Jakarta Sans', sans-serif" font-size="12" fill="#e6f7f5" text-anchor="middle">${role}</text>
  </svg>`;
}

// Generate Sectors
const sectors = [
  { file: 'ac.svg', title: 'AC & Appliance Jobs', colors: ['#11998e', '#38ef7d'] },
  { file: 'it.svg', title: 'IT & Software Jobs', colors: ['#0f2027', '#203a43'] },
  { file: 'medical.svg', title: 'Medical & Lab Tech', colors: ['#11998e', '#2cb6a6'] },
  { file: 'bank.svg', title: 'Bank & Financial Jobs', colors: ['#2b5876', '#4e4376'] },
  { file: 'sales.svg', title: 'Sales & Executive Jobs', colors: ['#ff416c', '#ff4b2b'] },
  { file: 'backoffice.svg', title: 'Back Office Sector', colors: ['#3a7bd5', '#3a6073'] },
  { file: 'pharmacy.svg', title: 'Pharmacist Jobs', colors: ['#00b09b', '#96c93d'] },
  { file: 'auto.svg', title: 'Automobile Sector', colors: ['#4b6cb7', '#182848'] },
  { file: 'supermarket.svg', title: 'Supermarket Store Assistant', colors: ['#f857a6', '#ff5858'] },
  { file: 'atm.svg', title: 'ATM Cash Refilling Officer', colors: ['#00c6ff', '#0072ff'] },
  { file: 'escort.svg', title: 'Goods Guard & Security', colors: ['#373b44', '#4286f4'] }
];

sectors.forEach(s => {
  fs.writeFileSync(path.join(baseDir, 'sectors', s.file), createSvgPoster(s.title, s.colors));
});

// Generate Courses
const courses = [
  { file: 'cpa.svg', title: 'CPA Marketing Course', colors: ['#8e2de2', '#4a00e0'] },
  { file: 'wifi.svg', title: 'WiFi Security & Cyber', colors: ['#000428', '#004e92'] },
  { file: 'excel.svg', title: 'Microsoft Excel Pro', colors: ['#11998e', '#38ef7d'] },
  { file: 'animation.svg', title: 'Cartoon Animation', colors: ['#fc4a1a', '#f7b733'] },
  { file: 'email.svg', title: 'Email Marketing', colors: ['#ff512f', '#dd2476'] },
  { file: 'digital.svg', title: 'Digital Marketing', colors: ['#1d976c', '#93f9b9'] },
  { file: 'dataentry.svg', title: 'Data Entry Master', colors: ['#1a2a6c', '#b21f1f'] },
  { file: 'graphic.svg', title: 'Graphic Design Pro', colors: ['#da22ff', '#9733ee'] },
  { file: 'appdev.svg', title: 'App Development', colors: ['#021b79', '#0575e6'] },
  { file: 'ethical.svg', title: 'Ethical Hacking', colors: ['#000000', '#434343'] },
  { file: 'video.svg', title: 'Video Editing Hero', colors: ['#eb3349', '#f45c43'] },
  { file: 'webdev.svg', title: 'Web Development', colors: ['#614385', '#516391'] },
  { file: 'spoken.svg', title: 'Spoken English Course', colors: ['#0288d1', '#26c6da'] },
  { file: 'nios.svg', title: 'NIOS Schooling Support', colors: ['#1a237e', '#3949ab'] }
];

courses.forEach(c => {
  fs.writeFileSync(path.join(baseDir, 'courses', c.file), createSvgPoster(c.title, c.colors, 'Bright Future Consultancy'));
});

// Generate Team
const team = [
  { file: 'manirul.svg', name: 'Mohammad Manirul', role: 'Founder & CEO' },
  { file: 'hafijur.svg', name: 'Hafijur Rahaman', role: 'HR & Senior Manager' },
  { file: 'samim.svg', name: 'Samim Akhter', role: 'Content Manager & Sr. HR' },
  { file: 'sahil.svg', name: 'Sahil Akter', role: 'Career Executive' },
  { file: 'dhiman.svg', name: 'Dhiman Yadav', role: 'Senior Executive' },
  { file: 'prasanna.svg', name: 'Prasanna Manna', role: 'HR & Student Executive' }
];

team.forEach(t => {
  fs.writeFileSync(path.join(baseDir, 'team', t.file), createAvatarSvg(t.name, t.role));
});

// Generate Placements
const placements = [
  { file: 'mridul.svg', name: 'Mridul Dey', company: 'Placed at Axis Bank' },
  { file: 'subhojit.svg', name: 'Subhojit Dutta', company: 'Placed at Flipkart' },
  { file: 'rajib.svg', name: 'Rajib Roy', company: 'Placed at Havells' }
];

placements.forEach(p => {
  fs.writeFileSync(path.join(baseDir, 'placements', p.file), createAvatarSvg(p.name, p.company, "#2cb6a6"));
});

console.log("All visual asset SVGs generated successfully!");

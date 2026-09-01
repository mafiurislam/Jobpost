const fs = require('fs');
const path = require('path');

const targetDir = path.join(__dirname, '..', 'assets', 'images', 'posters');
if (!fs.existsSync(targetDir)) {
  fs.mkdirSync(targetDir, { recursive: true });
}

// 1. Snapdeal Poster
const snapdealSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="700" height="400" viewBox="0 0 700 400">
  <defs>
    <linearGradient id="bgSnap" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#ff0040" />
      <stop offset="50%" stop-color="#e60039" />
      <stop offset="100%" stop-color="#990026" />
    </linearGradient>
  </defs>
  <rect width="700" height="400" fill="url(#bgSnap)"/>
  
  <!-- Snapdeal Logo Pill Top Left -->
  <rect x="30" y="25" width="160" height="44" rx="22" fill="#ffffff"/>
  <text x="110" y="54" font-family="'Outfit', sans-serif" font-weight="900" font-size="22" fill="#e60039" text-anchor="middle">Snapdeal</text>
  
  <rect x="210" y="25" width="220" height="44" rx="22" fill="#ffcc00"/>
  <text x="320" y="54" font-family="'Hind Siliguri', sans-serif" font-weight="bold" font-size="20" fill="#1b1827" text-anchor="middle">অনেক ড্রাইভার নিয়োগ</text>
  
  <text x="250" y="125" font-family="'Hind Siliguri', sans-serif" font-weight="900" font-size="34" fill="#ffffff" text-anchor="middle">মোট পদসংখ্যা-200</text>
  
  <rect x="80" y="150" width="340" height="50" rx="25" fill="#00b894"/>
  <text x="250" y="184" font-family="'Hind Siliguri', sans-serif" font-weight="bold" font-size="24" fill="#ffffff" text-anchor="middle">5th পাশেই সুযোগ</text>
  
  <text x="250" y="240" font-family="'Outfit', sans-serif" font-weight="900" font-size="32" fill="#ffcc00" text-anchor="middle">বেতন - ₹22,000 /Month</text>
  <text x="250" y="280" font-family="'Hind Siliguri', sans-serif" font-weight="bold" font-size="24" fill="#ffffff" text-anchor="middle">কোন টাকা লাগবে না</text>
  
  <rect x="60" y="305" width="380" height="55" rx="10" fill="#ffffff"/>
  <text x="250" y="342" font-family="'Hind Siliguri', sans-serif" font-weight="900" font-size="28" fill="#e60039" text-anchor="middle">সরাসরি কাজের জন্য জয়েন লিখুন</text>

  <!-- Delivery Van & Executive Right -->
  <g transform="translate(470, 70)">
    <rect x="10" y="80" width="180" height="100" rx="10" fill="#ffffff"/>
    <rect x="130" y="90" width="50" height="50" rx="5" fill="#0072ff"/>
    <circle cx="50" cy="180" r="20" fill="#1b1827"/>
    <circle cx="150" cy="180" r="20" fill="#1b1827"/>
    <circle cx="50" cy="180" r="8" fill="#ffffff"/>
    <circle cx="150" cy="180" r="8" fill="#ffffff"/>
    <text x="70" y="130" font-family="sans-serif" font-size="14" font-weight="bold" fill="#e60039">Snapdeal</text>
  </g>
</svg>`;

// 2. Registration Form Poster
const regSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="700" height="400" viewBox="0 0 700 400">
  <defs>
    <linearGradient id="bgReg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#140628" />
      <stop offset="60%" stop-color="#3b0944" />
      <stop offset="100%" stop-color="#69094e" />
    </linearGradient>
  </defs>
  <rect width="700" height="400" fill="url(#bgReg)"/>
  
  <rect x="120" y="30" width="460" height="55" rx="12" fill="#d90429"/>
  <text x="350" y="68" font-family="'Outfit', sans-serif" font-weight="900" font-size="32" fill="#ffffff" text-anchor="middle" letter-spacing="1">REGISTRATION FORM</text>
  
  <text x="350" y="145" font-family="'Hind Siliguri', sans-serif" font-weight="900" font-size="36" fill="#ffcc00" text-anchor="middle">সমস্ত জব-এর জন্য</text>
  
  <rect x="90" y="175" width="520" height="60" rx="30" fill="#00b894"/>
  <text x="350" y="217" font-family="'Outfit', sans-serif" font-weight="900" font-size="28" fill="#ffffff" text-anchor="middle">ADVINE 360 CAREER SOLUTIONS</text>
  
  <text x="350" y="285" font-family="'Hind Siliguri', sans-serif" font-weight="900" font-size="34" fill="#ffffff" text-anchor="middle">এবার কাজ পাবে সবাই</text>
  
  <rect x="150" y="315" width="400" height="45" rx="8" fill="#0072ff"/>
  <text x="350" y="345" font-family="'Outfit', sans-serif" font-weight="bold" font-size="18" fill="#ffffff" text-anchor="middle">WWW.BFCONSULTANCY.IN | 100% FREE PLACEMENT</text>
</svg>`;

// 3. More Supermarket Poster
const supermarketSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="700" height="400" viewBox="0 0 700 400">
  <defs>
    <linearGradient id="bgMore" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#d35400" />
      <stop offset="60%" stop-color="#e67e22" />
      <stop offset="100%" stop-color="#f39c12" />
    </linearGradient>
  </defs>
  <rect width="700" height="400" fill="url(#bgMore)"/>
  
  <rect x="30" y="25" width="140" height="44" rx="8" fill="#d35400"/>
  <text x="100" y="55" font-family="'Outfit', sans-serif" font-weight="900" font-size="24" fill="#ffffff" text-anchor="middle">more</text>
  
  <text x="240" y="55" font-family="'Outfit', sans-serif" font-weight="900" font-size="24" fill="#ffffff">Hiring Alert!</text>
  <text x="240" y="100" font-family="'Outfit', sans-serif" font-weight="900" font-size="34" fill="#ffffff">MORE SUPERMARKET</text>
  
  <rect x="40" y="120" width="340" height="45" rx="8" fill="#1b1827"/>
  <text x="210" y="150" font-family="'Outfit', sans-serif" font-weight="bold" font-size="18" fill="#ffcc00" text-anchor="middle">Full Time & Part Time Jobs</text>
  
  <rect x="40" y="180" width="340" height="45" rx="8" fill="#00b894"/>
  <text x="210" y="210" font-family="'Outfit', sans-serif" font-weight="bold" font-size="20" fill="#ffffff" text-anchor="middle">On Company Payroll</text>
  
  <text x="210" y="270" font-family="'Outfit', sans-serif" font-weight="bold" font-size="16" fill="#1b1827" text-anchor="middle">Store Assistant | Cashier | Billing</text>
  <text x="210" y="300" font-family="'Outfit', sans-serif" font-weight="bold" font-size="16" fill="#1b1827" text-anchor="middle">Supermarket Helper | Packer</text>
  
  <rect x="80" y="325" width="260" height="45" rx="22" fill="#d90429"/>
  <text x="210" y="354" font-family="'Outfit', sans-serif" font-weight="bold" font-size="18" fill="#ffffff" text-anchor="middle">APPLY NOW</text>
  
  <!-- Male Supermarket Assistant Graphic Right -->
  <g transform="translate(440, 50)">
    <circle cx="110" cy="90" r="45" fill="#f3a97b"/>
    <path d="M 60,70 C 60,35 85,25 110,25 C 135,25 160,35 160,70 Z" fill="#d35400"/>
    <path d="M 40,320 L 40,160 Q 40,130 110,130 Q 180,130 180,160 L 180,320 Z" fill="#e67e22"/>
    <rect x="70" y="200" width="80" height="100" rx="6" fill="#ffffff"/>
    <line x1="80" y1="220" x2="140" y2="220" stroke="#d35400" stroke-width="4"/>
    <line x1="80" y1="240" x2="130" y2="240" stroke="#d35400" stroke-width="4"/>
  </g>
</svg>`;

// 4. ATM Cash Refilling Poster
const atmSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="700" height="400" viewBox="0 0 700 400">
  <defs>
    <linearGradient id="bgAtm" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#0f2027" />
      <stop offset="50%" stop-color="#203a43" />
      <stop offset="100%" stop-color="#2c5364" />
    </linearGradient>
  </defs>
  <rect width="700" height="400" fill="url(#bgAtm)"/>
  
  <text x="230" y="55" font-family="'Outfit', sans-serif" font-weight="bold" font-size="22" fill="#ffcc00" text-anchor="middle">Job Opening -</text>
  <text x="230" y="95" font-family="'Outfit', sans-serif" font-weight="900" font-size="30" fill="#ffffff" text-anchor="middle">ATM Cash Refilling Officer</text>
  
  <rect x="40" y="115" width="380" height="36" rx="6" fill="#00b894"/>
  <text x="230" y="139" font-family="'Outfit', sans-serif" font-weight="bold" font-size="14" fill="#ffffff" text-anchor="middle">✔ On Company Payroll • Direct Joining</text>

  <rect x="40" y="160" width="380" height="36" rx="6" fill="#ffffff" opacity="0.15"/>
  <text x="230" y="184" font-family="'Outfit', sans-serif" font-weight="bold" font-size="14" fill="#ffffff" text-anchor="middle">✔ Location: Barddhaman, Kolkata & All WB</text>
  
  <text x="230" y="240" font-family="'Outfit', sans-serif" font-weight="900" font-size="28" fill="#ffcc00" text-anchor="middle">Salary: ₹15,000 - ₹18,000 / month</text>
  <text x="230" y="275" font-family="'Plus Jakarta Sans', sans-serif" font-weight="bold" font-size="15" fill="#ffffff" text-anchor="middle">Qualification: 10th / 12th Pass</text>
  
  <rect x="130" y="305" width="200" height="45" rx="22" fill="#0072ff"/>
  <text x="230" y="334" font-family="'Outfit', sans-serif" font-weight="bold" font-size="18" fill="#ffffff" text-anchor="middle">APPLY NOW</text>
  
  <!-- ATM Cash Custodian Officer Graphic Right -->
  <g transform="translate(460, 50)">
    <rect x="20" y="40" width="160" height="280" rx="10" fill="#1b1827" stroke="#00b894" stroke-width="4"/>
    <rect x="40" y="60" width="120" height="80" rx="6" fill="#00b894"/>
    <text x="100" y="105" font-family="sans-serif" font-weight="bold" font-size="20" fill="#ffffff" text-anchor="middle">ATM</text>
    <rect x="50" y="160" width="100" height="15" rx="3" fill="#ffffff"/>
    <rect x="50" y="200" width="100" height="80" rx="4" fill="#333333"/>
  </g>
</svg>`;

// 5. Apollo Pharmacy Poster
const apolloSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="700" height="400" viewBox="0 0 700 400">
  <defs>
    <linearGradient id="bgApollo" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#004e92" />
      <stop offset="50%" stop-color="#0066b2" />
      <stop offset="100%" stop-color="#0080ff" />
    </linearGradient>
  </defs>
  <rect width="700" height="400" fill="url(#bgApollo)"/>
  
  <text x="240" y="50" font-family="'Outfit', sans-serif" font-weight="900" font-size="24" fill="#ffffff" text-anchor="middle">APOLLO PHARMACIES LIMITED</text>
  
  <rect x="80" y="65" width="320" height="42" rx="8" fill="#ffcc00"/>
  <text x="240" y="94" font-family="'Outfit', sans-serif" font-weight="900" font-size="22" fill="#d90429" text-anchor="middle">URGENT HIRING!</text>
  
  <text x="240" y="140" font-family="'Outfit', sans-serif" font-weight="900" font-size="26" fill="#ffffff" text-anchor="middle">SALARY: ₹15,000 - ₹20,000 / MO</text>
  
  <text x="240" y="180" font-family="'Plus Jakarta Sans', sans-serif" font-weight="bold" font-size="16" fill="#00d2ff" text-anchor="middle">✔ Pharmacy Assistant / Trainee</text>
  <text x="240" y="210" font-family="'Plus Jakarta Sans', sans-serif" font-weight="bold" font-size="16" fill="#00d2ff" text-anchor="middle">✔ Retail Pharmacist (D.Pharm / B.Pharm)</text>
  <text x="240" y="240" font-family="'Plus Jakarta Sans', sans-serif" font-size="14" fill="#ffffff" text-anchor="middle">Qualifications: 10th / 12th / Diploma / Graduate</text>
  
  <rect x="140" y="275" width="200" height="45" rx="22" fill="#00b894"/>
  <text x="240" y="304" font-family="'Outfit', sans-serif" font-weight="bold" font-size="18" fill="#ffffff" text-anchor="middle">APPLY NOW</text>
  
  <g transform="translate(450, 50)">
    <circle cx="90" cy="75" r="40" fill="#f8c291"/>
    <path d="M 50,60 C 50,30 70,20 90,20 C 110,20 130,30 130,60 Z" fill="#004e92"/>
    <path d="M 30,300 L 30,150 Q 30,120 90,120 Q 150,120 150,150 L 150,300 Z" fill="#ffffff"/>
    <path d="M 75,120 L 75,300 M 105,120 L 105,300" stroke="#00b894" stroke-width="6"/>
  </g>
</svg>`;

// 6. Escort Guard Poster
const escortSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="700" height="400" viewBox="0 0 700 400">
  <defs>
    <linearGradient id="bgEscort" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#0f2027" />
      <stop offset="50%" stop-color="#203a43" />
      <stop offset="100%" stop-color="#2c5364" />
    </linearGradient>
  </defs>
  <rect width="700" height="400" fill="url(#bgEscort)"/>
  
  <text x="240" y="45" font-family="'Outfit', sans-serif" font-weight="900" font-size="24" fill="#ffffff" text-anchor="middle">ESCORT GUARD /</text>
  <text x="240" y="80" font-family="'Outfit', sans-serif" font-weight="900" font-size="24" fill="#ffcc00" text-anchor="middle">RAILWAY GOODS GUARD</text>
  
  <rect x="60" y="95" width="360" height="40" rx="8" fill="#d90429"/>
  <text x="240" y="122" font-family="'Outfit', sans-serif" font-weight="bold" font-size="18" fill="#ffffff" text-anchor="middle">COMPANY PAYROLL JOB</text>
  
  <text x="240" y="175" font-family="'Outfit', sans-serif" font-weight="900" font-size="32" fill="#00b894" text-anchor="middle">SALARY: ₹18,000 / MO</text>
  <text x="240" y="215" font-family="'Plus Jakarta Sans', sans-serif" font-weight="bold" font-size="15" fill="#ffffff" text-anchor="middle">Free Fooding & Lodging Provided</text>
  <text x="240" y="245" font-family="'Plus Jakarta Sans', sans-serif" font-size="14" fill="#ffffff" opacity="0.8" text-anchor="middle">Qualification: 8th / 10th / 12th Pass</text>
  
  <rect x="140" y="275" width="200" height="45" rx="22" fill="#0072ff"/>
  <text x="240" y="304" font-family="'Outfit', sans-serif" font-weight="bold" font-size="18" fill="#ffffff" text-anchor="middle">APPLY NOW</text>
  
  <g transform="translate(460, 50)">
    <circle cx="80" cy="70" r="38" fill="#f3a97b"/>
    <rect x="40" y="20" width="80" height="30" rx="4" fill="#1b1827"/>
    <circle cx="80" cy="35" r="6" fill="#ffcc00"/>
    <path d="M 20,300 L 20,140 Q 20,120 80,120 Q 140,120 140,140 L 140,300 Z" fill="#1b1827"/>
    <path d="M 80,120 L 80,240" stroke="#ffffff" stroke-width="4"/>
  </g>
</svg>`;

fs.writeFileSync(path.join(targetDir, 'snapdeal_poster.svg'), snapdealSvg);
fs.writeFileSync(path.join(targetDir, 'registration_poster.svg'), regSvg);
fs.writeFileSync(path.join(targetDir, 'supermarket_poster.svg'), supermarketSvg);
fs.writeFileSync(path.join(targetDir, 'atm_poster.svg'), atmSvg);
fs.writeFileSync(path.join(targetDir, 'apollo_poster.svg'), apolloSvg);
fs.writeFileSync(path.join(targetDir, 'escort_poster.svg'), escortSvg);

console.log('All 6 job posters generated successfully!');

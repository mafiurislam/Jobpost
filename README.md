# 🌟 Bright Future Consultancy - Job & Career Portal

[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![Bootstrap 5](https://img.shields.io/badge/Bootstrap_5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![Node.js](https://img.shields.io/badge/Node.js-339933?style=for-the-badge&logo=nodedotjs&logoColor=white)](https://nodejs.org/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](LICENSE)

A modern, high-performance, responsive web application for **Bright Future Consultancy** — an ISO 9001:2015 certified job recruitment and placement agency operating in Purba Barddhaman and across West Bengal.

This portal provides **100% Free Job Vacancies & Placement Registration**, candidate verification, instant WhatsApp application routing, and interactive job category browsing.

---

## 📸 Key Features

- **100% Free Placements**: Zero candidate fees, zero registration fees.
- **Real-Time Job Search & Filtering**: Filter job openings dynamically by job title, sector (Banking, Retail, NAPS, IT, Overseas, Medical, etc.), and location.
- **Direct Candidate Application & WhatsApp Routing**: Submit job application forms directly, triggering customized WhatsApp messages pre-filled with candidate details for instant counselor connection.
- **ISO Certificate Verification Simulator**: Input registration ID to verify candidate certificates instantly with visual badges and authentication details.
- **Multi-Platform Share Modal & QR Generator**: Share job vacancies across WhatsApp, Telegram, Facebook, Twitter, LinkedIn, Email, and dynamic QR code generation.
- **Placements Carousel Slider**: Interactive sliding showcase of recently placed candidates across partner companies.
- **Responsive Green & White Theme**: Modern, polished aesthetic optimized for mobile, tablet, and desktop screens with smooth micro-animations.

---

## 📁 Repository Directory Structure

```
Bright-Feature/
├── .github/
│   └── workflows/
│       └── deploy.yml           # GitHub Actions workflow for GitHub Pages auto-deployment
├── assets/
│   ├── css/
│   │   └── style.css            # Custom Green & White theme design system & utilities
│   ├── js/
│   │   └── main.js              # Interactive UI handlers, job filters, share modal, & slider
│   └── images/                  # Clean SVG & raster visual assets
│       ├── companies/           # Company branding & hex collage graphics
│       ├── courses/             # Course & skill sector icons
│       ├── jobs/                # Specific job category SVG icons
│       ├── placements/          # Candidate portrait badges
│       ├── posters/             # Promotional job banners & posters
│       ├── roles/               # Job role vector illustrations
│       ├── sectors/             # Sector icons
│       ├── team/                # Team member portraits
│       ├── hero-banner.png      # Homepage hero visual
│       └── logo.png             # Official company logo
├── scripts/                     # Node.js helper scripts for asset & database management
│   ├── fix-localhost-urls.js
│   ├── generate-assets.js
│   ├── generate-job-posters.js
│   └── ...
├── index.html                   # Homepage & Hero Banner
├── about.html                   # About Us & Company Overview
├── categories.html              # Comprehensive Job Categories
├── certificate.html            # ISO Certificate Verification Portal
├── companies.html               # Partner Hiring Companies
├── contact.html                 # Contact Us & Google Map Location
├── jobs.html                    # Job Openings List & Filtering System
├── join.html                    # Free Placement Registration Form
├── service.html                 # Services & Placement Solutions
├── singlejobs.html              # Individual Job Details View
├── server.js                    # Zero-dependency Node.js HTTP Server for local development
├── package.json                 # Project manifest & npm scripts
├── .gitignore                   # Excluded build artifacts & OS files
├── LICENSE                      # MIT Open Source License
└── README.md                    # Project Documentation
```

---

## 🚀 How to Run Locally

### Prerequisites
- Node.js (v14.0 or higher) installed on your system.

### Running the Project

1. **Clone or Download the Repository:**
   ```bash
   git clone https://github.com/mafiurislam/boubanquate.git
   cd Bright-Feature
   ```

2. **Start the Local Development Server:**
   ```bash
   npm start
   # or
   node server.js
   ```

3. **Open in Browser:**
   Navigate to [http://localhost:8080](http://localhost:8080) to view the portal.

---

## 📤 How to Upload to GitHub

Follow these steps to upload this project to a new or existing repository on GitHub:

### Option A: Using Git CLI (Recommended)

1. **Create a New Repository on GitHub:**
   - Go to [GitHub New Repository](https://github.com/new).
   - Enter your repository name (e.g., `bright-future-consultancy`).
   - Leave "Initialize with README" **unchecked** (since README is already included).
   - Click **Create repository**.

2. **Push Local Repository to GitHub:**
   Open terminal inside the project directory and run:
   ```bash
   # Ensure branch is named main
   git branch -M main

   # Add your GitHub repository remote URL
   git remote add origin https://github.com/YOUR-USERNAME/YOUR-REPOSITORY-NAME.git

   # Add all files, commit, and push
   git add .
   git commit -m "Initial commit: Production-ready Bright Future Consultancy portal"
   git push -u origin main
   ```

### Option B: Using GitHub Desktop

1. Open **GitHub Desktop**.
2. Click `File` > `Add Local Repository...`.
3. Browse and select the `Bright Feature` folder.
4. Click `Publish repository` to upload directly to your GitHub account.

---

## 🌐 Deploying to GitHub Pages (Live Hosting)

This repository includes a pre-configured GitHub Actions workflow (`.github/workflows/deploy.yml`) for **1-click automated deployment**:

1. In your GitHub repository, go to **Settings** > **Pages**.
2. Under **Build and deployment** > **Source**, select **GitHub Actions**.
3. Push any commit to `main` branch. GitHub Actions will automatically build and publish your site live!
4. Your website will be accessible at `https://<YOUR-USERNAME>.github.io/<YOUR-REPOSITORY-NAME>/`.

---

## 💻 Tech Stack & Libraries

- **Markup**: Semantic HTML5 with meta tags for SEO.
- **Styling**: Vanilla CSS3, custom CSS variables, Bootstrap 5.3 framework.
- **Icons**: FontAwesome 6 Pro & SVG graphic vectors.
- **Scripting**: Vanilla JavaScript (ES6+), DOM Manipulation, Web APIs (Clipboard, Web Share).
- **Server**: Native Node.js `http` module.

---

## 📄 License

This project is licensed under the **MIT License**. See the [LICENSE](LICENSE) file for details.

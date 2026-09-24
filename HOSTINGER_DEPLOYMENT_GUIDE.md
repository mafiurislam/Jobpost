# Hostinger Deployment Guide for Bright Future Consultancy (PHP Laravel + SQLite)

This application is built with **PHP Laravel 13** and uses a self-contained **SQLite database** (`database/database.sqlite`). You do **not** need MySQL, database usernames, or remote database host configurations.

---

## 1. Quick Summary of What Has Been Configured

1. **Database:** SQLite (`database/database.sqlite`) is pre-populated with:
   - All 25 authentic job posts across 19 manpower sectors
   - Dynamic Home Page sections (Hero banner, Our story, Sectors, Success stories, FAQs, Testimonials)
   - Site settings (Agency logo, phone, WhatsApp helpline, email, address)
   - Admin credentials pre-seeded
2. **Dynamic Frontend Pages:**
   - Home Page (`/` and `/index.html`)
   - All Jobs Directory & Search (`/jobs` and `/jobs.html`)
   - Single Job Details (`/jobs/{id}` and `/singlejobs.html?id=...`)
   - About Us (`/about` and `/about.html`)
   - Corporate Partnerships (`/companies` and `/companies.html`)
   - Consulting Services (`/service` and `/service.html`)
   - Manpower Categories (`/categories` and `/categories.html`)
   - Certificate Verification Portal (`/certificate` and `/certificate.html`)
   - Free Candidate Job Application (`/join` and `/join.html`)
   - Contact Us (`/contact` and `/contact.html`)
3. **Admin Management Portal (`/admin`):**
   - Dashboard with live vacancy, application, and inquiry statistics
   - Job CRUD (Create, Edit, Delete, Toggle active status)
   - Logo Upload & Brand Customization
   - Home Page Dynamic Sections Editor
   - Candidate Applications Viewer
   - Contact Messages & Inquiries Viewer
   - Website Settings
4. **Hostinger-Specific Files Included:**
   - **Root `.htaccess`**: Automatically routes traffic into `/public` if uploaded directly into `public_html` and prevents public access to `.env` and `database/database.sqlite`.
   - **Root `index.php`**: Fallback routing entry point for shared hosting.
   - **`public/.htaccess`**: Standard Apache/LiteSpeed URL rewrite rules.
   - **`public/index.php`**: Pristine Laravel 13 front controller.
   - **`public/hostinger-setup.php`**: Browser-based 1-click diagnostic and cache management tool.
   - **Dependencies**: All PHP packages pre-installed in `vendor/`.

---

## 2. Default Admin Credentials

- **Admin Login URL:** `https://yourdomain.com/admin/login`
- **Primary Admin:**
  - **Email:** `admin@bfconsultancy.in`
  - **Password:** `password123`
- **Secondary Admin:**
  - **Email:** `admin@brightfuture.com`
  - **Password:** `admin123`

---

## 3. How to Deploy to Hostinger (Step-by-Step)

### Step 1: Create a ZIP Archive of the Project Files
Select all files and folders in this project directory:
- `.env` (or copy `.env.example` to `.env`)
- `.htaccess` (the root file)
- `index.php` (the root file)
- `app/`
- `bootstrap/`
- `config/`
- `database/` (including `database/database.sqlite`)
- `public/`
- `resources/`
- `routes/`
- `storage/`
- `vendor/` (contains all installed dependencies)

> **Tip:** Compress them into a single archive, e.g. `bright_future_website.zip`.

---

### Step 2: Upload and Extract on Hostinger
1. Log in to your **Hostinger hPanel**.
2. Go to **Websites** &rarr; click **Manage** next to your domain.
3. Open **File Manager** (Files &rarr; File Manager &rarr; Access all files).
4. Navigate into your website root directory: `public_html`.
5. Click **Upload** &rarr; select `bright_future_website.zip`.
6. Right-click the uploaded ZIP file &rarr; click **Extract** &rarr; extract into `public_html`.
7. Once extracted, you can delete the `.zip` file to save space.

---

### Step 3: Choose Deployment Method in Hostinger

#### Option A: Direct `public_html` Deployment (Easiest - No DocumentRoot Change Required)
Because this codebase includes a root `.htaccess` and root `index.php`, you do **not** need to change Hostinger's DocumentRoot settings if you do not wish to.
- Traffic arriving at `https://yourdomain.com/` will be handled by the root `.htaccess` and routed directly into `public/`.
- All requests for `/jobs`, `/admin`, `/about.html`, etc. will work out of the box.

#### Option B: Set Document Root to `public` (Recommended for High Security)
1. In Hostinger hPanel, go to **Websites** &rarr; **Manage**.
2. Look for **Document Root** or **Subdomains / Domains**.
3. Set the domain's document root to: `public_html/public`.
4. Click **Save**.

---

### Step 4: Configure File Permissions (Important for SQLite & Storage)
In Hostinger File Manager:
1. Navigate to `database/`:
   - Right-click `database/` folder &rarr; **Permissions** &rarr; set to `0775` (or `0777` if required).
   - Right-click `database/database.sqlite` &rarr; **Permissions** &rarr; set to `0664` (or `0666`).
2. Navigate to `storage/`:
   - Right-click `storage/` folder &rarr; **Permissions** &rarr; set to `0775` (or check "Recurse into subdirectories").
3. Navigate to `bootstrap/cache/`:
   - Right-click `bootstrap/cache/` folder &rarr; **Permissions** &rarr; set to `0775`.

---

### Step 5: Check Hostinger PHP Configuration
1. In Hostinger hPanel &rarr; search for **PHP Configuration**.
2. Select **PHP 8.2** or **PHP 8.3**.
3. Under **PHP Extensions**, ensure the following are enabled (enabled by default on Hostinger):
   - `pdo_sqlite`
   - `sqlite3`
   - `openssl`
   - `mbstring`
   - `fileinfo`
   - `curl`

---

### Step 6: Verify Live Setup with Diagnostic Tool
Open your browser and visit:
```
https://yourdomain.com/hostinger-setup.php
```
This utility tool will inspect your server and display:
- **PHP Version Check:** Green `PASS`
- **SQLite3 & PDO_SQLite Extensions:** Green `ACTIVE`
- **Database Permissions:** Confirms `database/database.sqlite` is writable and shows live counts:
  - **25 Job Posts**
  - **2 Admin Users**
  - **8 Site Settings**
- **Storage & Cache Permissions:** Green `WRITABLE`
- **Quick Action:** Click **Clear Application Cache** to clear and compile routes.

*(Once you have verified the site, you may delete `public/hostinger-setup.php` for extra security.)*

---

## 4. Testing Your Live Website

1. **Homepage:** `https://yourdomain.com/` (or `https://yourdomain.com/index.html`)
2. **Jobs Listing:** `https://yourdomain.com/jobs` (or `/jobs.html`)
3. **Single Job Page:** `https://yourdomain.com/jobs/1` (or `/singlejobs.html?id=1`)
4. **Candidate Application:** `https://yourdomain.com/join.html` (Submit test candidate &rarr; verifies saving to SQLite)
5. **Contact Page:** `https://yourdomain.com/contact.html` (Submit test message &rarr; verifies saving to SQLite)
6. **Admin Login:** `https://yourdomain.com/admin/login`
   - View submitted job applications under **Candidate Applications**
   - View messages under **Contact Inquiries**
   - Create, edit, and delete job openings under **Jobs & Vacancies**
   - Upload custom logo under **Logo Management**

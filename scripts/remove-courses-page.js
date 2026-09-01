const fs = require('fs');
const path = require('path');

const projectDir = path.join(__dirname, '..');

// 1. Delete courses.html if it exists
const coursesFilePath = path.join(projectDir, 'courses.html');
if (fs.existsSync(coursesFilePath)) {
  fs.unlinkSync(coursesFilePath);
  console.log('Deleted courses.html successfully!');
}

// 2. Remove all references in HTML files
const htmlFiles = fs.readdirSync(projectDir).filter(f => f.endsWith('.html'));

htmlFiles.forEach(file => {
  const filePath = path.join(projectDir, file);
  let content = fs.readFileSync(filePath, 'utf8');

  // Remove nav item
  content = content.replace(/<li\s+class="nav-item">\s*<a\s+class="nav-link[^"]*"\s+href="courses\.html">Our Courses<\/a>\s*<\/li>/gi, '');
  
  // Remove footer links
  content = content.replace(/<li>\s*<a\s+href="courses\.html"[^>]*>Our Courses<\/a>\s*<\/li>/gi, '');
  
  // Remove service card explore courses link
  content = content.replace(/<a\s+href="courses\.html"[^>]*>Explore Courses[^<]*<\/a>/gi, '');

  fs.writeFileSync(filePath, content, 'utf8');
  console.log(`Cleaned courses references from ${file}`);
});

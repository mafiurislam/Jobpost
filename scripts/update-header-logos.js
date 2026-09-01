const fs = require('fs');
const path = require('path');

const projectDir = path.join(__dirname, '..');
const htmlFiles = fs.readdirSync(projectDir).filter(f => f.endsWith('.html'));

htmlFiles.forEach(file => {
  const filePath = path.join(projectDir, file);
  let content = fs.readFileSync(filePath, 'utf8');

  // Replace navbar-brand block with image only
  content = content.replace(
    /<a class="navbar-brand"[^>]*>[\s\S]*?<\/a>/gi,
    `<a class="navbar-brand py-0" href="index.html">\n          <img src="assets/images/logo.png" alt="Bright Future Consultancy Logo" class="brand-logo">\n        </a>`
  );

  fs.writeFileSync(filePath, content, 'utf8');
  console.log(`Updated header logo in ${file}`);
});

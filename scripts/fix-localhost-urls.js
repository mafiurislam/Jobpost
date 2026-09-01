const fs = require('fs');
const path = require('path');

const projectDir = path.join(__dirname, '..');

const filesToFix = [
  'about.html',
  'categories.html',
  'certificate.html',
  'companies.html',
  'contact.html',
  'index.html',
  'jobs.html',
  'join.html',
  'service.html',
  'singlejobs.html',
  'scripts/update-share-modals.js'
];

let updatedCount = 0;

filesToFix.forEach(relPath => {
  const fullPath = path.join(projectDir, relPath);
  if (fs.existsSync(fullPath)) {
    let content = fs.readFileSync(fullPath, 'utf8');
    const target = 'value="http://localhost:8080/jobs.html"';
    const replacement = 'value="" placeholder="https://brightfutureconsultancy.com/jobs.html"';
    if (content.includes(target)) {
      content = content.replaceAll(target, replacement);
      fs.writeFileSync(fullPath, content, 'utf8');
      console.log(`Updated ${relPath}`);
      updatedCount++;
    }
  }
});

console.log(`Successfully fixed hardcoded localhost URLs in ${updatedCount} files.`);

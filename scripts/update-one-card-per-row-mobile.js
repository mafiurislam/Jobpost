const fs = require('fs');
const path = require('path');

const indexPath = path.join(__dirname, '..', 'index.html');
let content = fs.readFileSync(indexPath, 'utf8');

// Replace sector card column classes with 1-card per row on mobile (col-12 col-md-6 col-lg-3)
content = content.replace(/class="col-6 col-md-6 col-lg-3"/g, 'class="col-12 col-md-6 col-lg-3"');

fs.writeFileSync(indexPath, content, 'utf8');
console.log('Updated index.html sector card boxes to 1 per row on mobile responsive view!');

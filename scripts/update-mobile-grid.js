const fs = require('fs');
const path = require('path');

const indexPath = path.join(__dirname, '..', 'index.html');
let content = fs.readFileSync(indexPath, 'utf8');

// Replace sector card column classes with 2-column mobile class
content = content.replace(/class="col-md-6 col-lg-3"/g, 'class="col-6 col-md-6 col-lg-3"');

fs.writeFileSync(indexPath, content, 'utf8');
console.log('Updated index.html sector grid to 2-column mobile layout!');

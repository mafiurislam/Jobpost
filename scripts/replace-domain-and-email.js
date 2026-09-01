const fs = require('fs');
const path = require('path');

const projectDir = path.join(__dirname, '..');

function walkDir(dir, callback) {
  fs.readdirSync(dir).forEach(f => {
    const dirPath = path.join(dir, f);
    const isDirectory = fs.statSync(dirPath).isDirectory();
    if (isDirectory) {
      if (f !== 'node_modules' && f !== '.git' && f !== '.system_generated' && f !== '.tempmediaStorage') {
        walkDir(dirPath, callback);
      }
    } else {
      callback(dirPath);
    }
  });
}

let countEmail = 0;
let countDomain = 0;

walkDir(projectDir, (filePath) => {
  const ext = path.extname(filePath).toLowerCase();
  if (['.html', '.css', '.js', '.svg', '.json', '.md'].includes(ext)) {
    let content = fs.readFileSync(filePath, 'utf8');
    let original = content;

    // 1. Replace brightfutureconsultancybwn@gmail.com -> brightfutureconsultancybwn@gmail.com
    if (content.includes('brightfutureconsultancybwn@gmail.com')) {
      content = content.replace(/support@advine360\.in/gi, 'brightfutureconsultancybwn@gmail.com');
      countEmail++;
    }

    // 2. Replace bfconsultancy.in -> bfconsultancy.in
    if (content.includes('bfconsultancy.in') || content.includes('BFCONSULTANCY.IN')) {
      content = content.replace(/advine360\.in/g, 'bfconsultancy.in');
      content = content.replace(/ADVINE360\.IN/g, 'BFCONSULTANCY.IN');
      countDomain++;
    }

    if (content !== original) {
      fs.writeFileSync(filePath, content, 'utf8');
      console.log(`Updated: ${path.relative(projectDir, filePath)}`);
    }
  }
});

console.log(`Replacement complete! Email occurrences fixed in ${countEmail} files, Domain occurrences fixed in ${countDomain} files.`);

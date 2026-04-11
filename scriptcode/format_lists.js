const fs = require('fs');
const path = require('path');
const dir = 'services';
const files = fs.readdirSync(dir).filter(f => f.endsWith('.php'));
files.forEach(file => {
  const filePath = path.join(dir, file);
  let content = fs.readFileSync(filePath, 'utf8');
  
  // Clean up any double spaces, unicode glitches
  content = content.replace(/\uFFFD/g, '-');
  
  // Replace the remaining weird characters
  content = content.replace(/\?\?/g, '-');
  
  // Fix lists: lines starting with '- ' followed by text up to <br/>
  // We will convert them to <li> tags
  content = content.replace(/^-\s*(.+?)(?:<br\/>|<br>|\n)/gm, '<li>$1</li>\n');
  
  // Wrap adjacent <li> tags in <ul>
  content = content.replace(/(<li>[\s\S]*?<\/li>\n)+/g, match => {
    return '<ul class="service-list">\n' + match + '</ul>\n';
  });

  // Remove empty <br/> that are left floating around the ul
  content = content.replace(/<br\/>\s*(<ul)/g, '$1');

  fs.writeFileSync(filePath, content, 'utf8');
});
console.log('Done mapping lists');

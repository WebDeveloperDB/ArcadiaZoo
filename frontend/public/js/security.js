
 // ptection contre les injections XSS

function sanitizeHTML(str) {
  if (str === null || str === undefined) {
    return '';
  }
  
  const text = String(str);
  const map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#x27;',
    '/': '&#x2F;'
  };
  
  return text.replace(/[&<>"'/]/g, (char) => map[char]);
}

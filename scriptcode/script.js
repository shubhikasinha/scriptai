document.addEventListener("DOMContentLoaded", () => {

  const hamburger = document.getElementById("hamburger");
  const navLinks = document.getElementById("navLinks");

  if (hamburger && navLinks) {
    hamburger.addEventListener("click", () => {
      navLinks.classList.toggle("active");
    });
  }

  // Auto-Capsule Active Page Matcher
  const currentPath = window.location.pathname;
  const navItems = document.querySelectorAll('.nav-links a');
  navItems.forEach(link => {
    // Basic exact match or if current path contains the link's href and it's not simply / or index
    const linkPath = new URL(link.href).pathname;
    if (linkPath !== '/' && linkPath !== '/index.php') {
      if (currentPath.includes(linkPath)) {
        link.classList.add('active-nav');
      }
    } else if (currentPath === linkPath || (currentPath === '/' && linkPath === '/index.php')) {
        link.classList.add('active-nav');
    }
  });

  // Hero Auto-Rotating Background Slider
  const slides = document.querySelectorAll('.hero-slider .slide');
  if (slides.length > 0) {
    let currentSlide = 0;
    setInterval(() => {
      slides[currentSlide].classList.remove('active');
      currentSlide = (currentSlide + 1) % slides.length;
      slides[currentSlide].classList.add('active');
    }, 5000); // 5 second smooth rotation
  }

  // Increasing Numbers Animation
  const counters = document.querySelectorAll('.stat-box h2, .reach-item h2');
  const speed = 100;

  counters.forEach(counter => {
    const originalText = counter.innerText;
    const numMatch = originalText.match(/[\d\.]+/);
    if (!numMatch) return;
    
    const target = parseFloat(numMatch[0]);
    const prefix = originalText.split(numMatch[0])[0] || '';
    const suffix = originalText.split(numMatch[0])[1] || '';
    
    let count = 0;
    counter.innerText = prefix + '0' + suffix;

    const updateCount = () => {
      const inc = target / speed;
      if (count < target) {
        if (target % 1 !== 0) {
          count += 0.1;
          if (count > target) count = target;
          counter.innerText = prefix + count.toFixed(1) + suffix;
        } else {
          count += inc;
          if (count > target) count = target;
          counter.innerText = prefix + Math.ceil(count) + suffix;
        }
        setTimeout(updateCount, 15);
      } else {
        counter.innerText = originalText;
      }
    };

    const observer = new IntersectionObserver(entries => {
      if (entries[0].isIntersecting) {
        updateCount();
        observer.disconnect();
      }
    }, { threshold: 0.5 });
    
    observer.observe(counter);
  });

});
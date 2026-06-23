// ---------- Preloader: reveal once the DOM is ready (min display + safety fallback) ----------
(function preloader() {
    const startedAt = performance.now();
    const MIN_SHOW_MS = 650; // keep the intro visible briefly for a smooth feel
    const MAX_WAIT_MS = 3000; // hard safety cap so it can never get stuck
    let revealed = false;

    const reveal = () => {
        if (revealed) return;
        revealed = true;
        const wait = Math.max(0, MIN_SHOW_MS - (performance.now() - startedAt));
        setTimeout(() => document.body.classList.add('preloaded'), wait);
    };

    // app.js is a deferred module, so it runs after the DOM is parsed.
    // Reveal as soon as the document is interactive — never wait for every image.
    if (document.readyState !== 'loading') {
        reveal();
    } else {
        document.addEventListener('DOMContentLoaded', reveal, { once: true });
    }

    setTimeout(reveal, MAX_WAIT_MS);
})();

// ---------- Header: transparent over hero, solid on scroll ----------
const header = document.getElementById('site-header');
if (header) {
    const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 40);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
}

// ---------- Mobile menu toggle ----------
const menuToggle = document.getElementById('menu-toggle');
const mobileMenu = document.getElementById('mobile-menu');
if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    mobileMenu.querySelectorAll('a').forEach((link) =>
        link.addEventListener('click', () => mobileMenu.classList.add('hidden'))
    );
}

// ---------- Hero slider ----------
(function heroSlider() {
    const slides = document.querySelectorAll('[data-hero-slide]');
    const dots = document.querySelectorAll('[data-hero-dot]');
    if (slides.length < 2) return;

    let current = 0;
    let timer;

    const show = (n) => {
        current = (n + slides.length) % slides.length;
        slides.forEach((slide, i) => {
            slide.classList.toggle('opacity-100', i === current);
            slide.classList.toggle('opacity-0', i !== current);
        });
        dots.forEach((dot, i) => {
            const active = i === current;
            dot.classList.toggle('w-8', active);
            dot.classList.toggle('bg-white', active);
            dot.classList.toggle('w-2.5', !active);
            dot.classList.toggle('bg-white/50', !active);
        });
    };

    const start = () => (timer = setInterval(() => show(current + 1), 5000));
    const reset = () => {
        clearInterval(timer);
        start();
    };

    dots.forEach((dot, i) =>
        dot.addEventListener('click', () => {
            show(i);
            reset();
        })
    );

    show(0);
    start();
})();

// ---------- Stats count-up (animates when scrolled into view) ----------
(function statsCounter() {
    const els = document.querySelectorAll('[data-stat]');
    if (!els.length || !('IntersectionObserver' in window)) return;

    const animate = (el) => {
        const raw = el.getAttribute('data-stat');
        const target = parseInt(raw.replace(/[^0-9]/g, ''), 10) || 0;
        const suffix = raw.replace(/[0-9]/g, '');
        const duration = 1500;
        const start = performance.now();

        const step = (now) => {
            const p = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - p, 3); // easeOutCubic
            el.textContent = Math.floor(eased * target) + suffix;
            if (p < 1) requestAnimationFrame(step);
            else el.textContent = target + suffix;
        };
        requestAnimationFrame(step);
    };

    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                animate(entry.target);
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.4 });

    els.forEach((el) => io.observe(el));
})();

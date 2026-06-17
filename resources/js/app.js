// ============================================
// MIRAGE MÉXICO — App JavaScript
// ============================================

document.addEventListener('DOMContentLoaded', function () {

    // ---- Hamburger menu ----
    const hamburger = document.getElementById('hamburger');
    const mainNav   = document.getElementById('mainNav');

    if (hamburger && mainNav) {
        hamburger.addEventListener('click', function () {
            const isOpen = mainNav.classList.toggle('open');
            hamburger.setAttribute('aria-expanded', isOpen);
        });

        // Close on outside click
        document.addEventListener('click', function (e) {
            if (!hamburger.contains(e.target) && !mainNav.contains(e.target)) {
                mainNav.classList.remove('open');
            }
        });
    }

    // ---- Back-to-top button ----
    const btt = document.getElementById('backToTop');
    if (btt) {
        window.addEventListener('scroll', function () {
            btt.classList.toggle('visible', window.scrollY > 400);
        });
        btt.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ---- Scroll reveal ----
    const revealEls = document.querySelectorAll(
        '.category-card, .support-card, .trust-item, .banner-card, .feature-grid'
    );

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        revealEls.forEach(function (el) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(24px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(el);
        });
    }

    // ---- Active nav link on scroll ----
    const sections = document.querySelectorAll('section[id]');
    window.addEventListener('scroll', function () {
        const scrollY = window.scrollY + 100;
        sections.forEach(function (section) {
            const navLink = document.querySelector('.nav-link[href="#' + section.id + '"]');
            if (navLink) {
                const inSection = scrollY >= section.offsetTop && scrollY < section.offsetTop + section.offsetHeight;
                navLink.classList.toggle('active', inSection);
            }
        });
    });

});

document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = 'translateX(0)';
            }
        });
    }, { 
        threshold: 0.1 ,
        rootMargin: '0px 100px 0px 100px'
    });

    // Observe all divs
    document.querySelectorAll(".ContentContainer").forEach(div => {
        observer.observe(div);
    });
});
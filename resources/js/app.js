import './bootstrap';

// Success Message
const flash = document.getElementById('flash-message');
setTimeout(() => {
    if (flash) {
        flash.style.opacity = 0;
        setTimeout(() => {
            flash.remove(); // Delete element
        }, 500); // Time of transition
    }
}, 5000);

// NAV BAR - Initialize Apline component on app start
document.addEventListener('alpine:init', () => {
    Alpine.data('scrollNav', () => ({
        lastY: window.scrollY, // Store the last position
        visible: true, // Control if navbar is visible or not
        ticking: false, // Avoid the problems of animation

        // Event listener for the scroll
        init() {
            window.addEventListener('scroll', this.onScroll.bind(this));
        },

        onScroll() {
            if (!this.ticking) {
                window.requestAnimationFrame(() => {
                    const currentY = window.scrollY;
                    this.visible = currentY < this.lastY || currentY < 10; // Show navbar if scrolling up or on top
                    this.lastY = currentY; // Update last position
                    this.ticking = false; // A new animation can be done
                });
                this.ticking = true; // Block the animation to avoid problems
            }
        }
    }));
});
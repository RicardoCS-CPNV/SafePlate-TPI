import './bootstrap';
const flash = document.getElementById('flash-message');
setTimeout(() => {
    if (flash) {
        flash.style.opacity = 0;
        setTimeout(() => {
            flash.remove(); // Delete element
        }, 500); // Time of transition
    }
}, 5000);
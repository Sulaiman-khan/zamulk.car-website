document.addEventListener("DOMContentLoaded", function() {
    // Simulate delay for demonstration purposes
    setTimeout(function() {
        // Add loaded class to body to show content and hide loader
        document.body.classList.add('loaded');
    }, 4000); // Change delay time as needed (in milliseconds)
});
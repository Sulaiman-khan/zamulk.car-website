document.addEventListener("DOMContentLoaded", function() {
    // Simulate delay for demonstration purposes
    setTimeout(function() {
        // Add loaded class to body to show content and hide loader
        document.body.classList.add('loaded');
    }, 4500); // Change delay time as needed (in milliseconds)

    // Trigger 360-degree rotation animation on loader image
    const loaderImg = document.querySelector('.loader img');
    loaderImg.style.animation = 'rotate 4s linear forwards'; // Adjust duration and timing function as needed
});

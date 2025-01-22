


document.addEventListener("DOMContentLoaded", () => {
    const roomsContainer = document.querySelector('.rooms-container');

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate'); // Add animation class
                    observer.unobserve(entry.target); // Stop observing after animation
                }
            });
        },
        {
            threshold: 0.2, // Trigger when 20% of the section is visible
        }
    );

    observer.observe(roomsContainer);
});

//about script -->


document.addEventListener("DOMContentLoaded", () => {
    const aboutContainer = document.querySelector('.about-container');

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate'); // Trigger animation
                    observer.unobserve(entry.target); // Stop observing after animation
                }
            });
        },
        {
            threshold: 0.2, // Trigger when 20% of the section is visible
        }
    );

    observer.observe(aboutContainer);
});


//for service page
// 
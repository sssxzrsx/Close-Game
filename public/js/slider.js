document.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelectorAll(".slide");
    const prev = document.querySelector(".prev");
    const next = document.querySelector(".next");
    let current = 0;

    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove("active"));
        slides[index].classList.add("active");
    }

    prev.addEventListener("click", () => {
        current = (current > 0) ? current - 1 : slides.length - 1;
        showSlide(current);
    });

    next.addEventListener("click", () => {
        current = (current < slides.length - 1) ? current + 1 : 0;
        showSlide(current);
    });

    setInterval(() => {
        next.click();
    }, 6000);
});

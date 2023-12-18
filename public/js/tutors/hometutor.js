const navbar = document.querySelector(".navbar");

window.addEventListener("scroll", () => {
    const scrollPosition = window.scrollY;
    const maxOpacity = 0.9;
    const opacity = 1 - scrollPosition / 200;

    navbar.style.opacity = opacity > maxOpacity ? maxOpacity : opacity;
});

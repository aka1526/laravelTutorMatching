function togglePages() {
    var mainPage = document.getElementById("main-page");
    var subPage = document.getElementById("sub-page");

    if (mainPage.style.display === "none") {
        mainPage.style.display = "block";
        subPage.style.display = "none";
    } else {
        mainPage.style.display = "none";
        subPage.style.display = "block";
    }
}


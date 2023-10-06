const loader = document.getElementById("preloader");
const body = document.body;
const minLoadingTime = 500; // temps minimum en millisecondes que le preloader doit durer
const startTime = Date.now(); // temps de départ

window.addEventListener("load", () => {
    const elapsedTime = Date.now() - startTime; // temps écoulé depuis le départ
    if (elapsedTime < minLoadingTime) { // si le temps écoulé est inférieur au temps minimum
        setTimeout(() => {
            body.style.overflowY = "auto"; // on rétablit l'affichage de l'overflow Y
            body.style.overflowX = "hidden"; // on masque l'overflow X
            loader.classList.remove("show"); // on enlève la classe "show" pour cacher le preloader avec une animation de fondue
        }, minLoadingTime - elapsedTime); // on attend le temps restant avant de cacher le preloader
    } else {
        body.style.overflowY = "auto"; // on rétablit l'affichage de l'overflow Y
        body.style.overflowX = "hidden"; // on masque l'overflow X
        loader.classList.remove("show"); // sinon on enlève la classe "show" pour cacher le preloader avec une animation de fondue
    }
});

// Ajouter la classe "show" pour afficher le preloader avec une animation de fondue
loader.classList.add("show");
body.style.overflowY = "hidden";
body.style.overflowX = "hidden";
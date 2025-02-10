// Al caricamento della pagina vengano nascoste tutte le immagini, eccetto le prime due.
// Alla prima immagine deve essere inoltre aggiunta la classe "current".
document.addEventListener("DOMContentLoaded", () => {
    const slider = document.getElementsByClassName('slider-image')[0];
    const images = slider.getElementsByTagName("img");

    for (let i = 0; i < images.length; i++) {
        if (i > 1) {
            images[i].style.visibility = "hidden";
        }

        // set event listener
        images[i].addEventListener('click', handleImageClick)
    }

    if (images.length > 0) {
        images[0].classList.add("current");
    }
})

/**
 * @type {EventListener}
 */
const handleImageClick = (ev) => {
    const el = ev.target;
    // Al click su un'immagine, si dovrà controllare se l’immagine ha la classe current e nel caso non fare nulla.
    if (!el.classList.contains("current")) {
        // In caso contrario, invece, bisognerà aggiungere la classe current, rimuovendola da altre immagini.
        el.classList.add("current");

        const slider = document.getElementsByClassName('slider-image')[0];
        const images = slider.getElementsByTagName("img");

        let idx = -1;
        for (let i = 0; i < images.length; i++) {
            if (images[i] != el) {
                images[i].classList.remove("current");
                images[i].style.visibility = "hidden";
            } else {
                idx = i;
            }
        }

        // Successivamente, andranno opportunamente nascoste e visualizzate le immagini in modo che siano visibili: l’immagine con classe current, l’eventuale immagine prima e l’eventuale immagine dopo.

        if(idx > 0) {
            images[idx-1].style.visibility = "visible";
        }
        if(idx < images.length-1) {
            images[idx+1].style.visibility = "visible";
        }
    }

}



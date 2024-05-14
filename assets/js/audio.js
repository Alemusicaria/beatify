// Selecció de l'element d'àudio a la pàgina web
const audio1 = document.querySelector('audio');

// Selecció de l'element del control deslitzant de volum a la pàgina web
const volumeSlider = document.getElementById('volumeSlider');

// Selecció de l'element de l'icona de volum a la pàgina web
const volumeIcon = document.getElementById('volumeIcon');

// Estableix el valor inicial del volum i l'ícona
audio1.volume = volumeSlider.value;

// Afegeix un esdeveniment d'escolta al canvi de valor del control deslitzant de volum
volumeSlider.addEventListener('change', () => {
    // Actualitza el volum de l'element d'àudio amb el valor del control deslitzant
    audio1.volume = volumeSlider.value;

    // Actualitza l'icona de volum
    updateVolumeIcon();
});

// Funció per actualitzar l'icona de volum
function updateVolumeIcon() {
    // Canvia l'icona de volum basant-se en el nivell de volum
    if (audio1.volume === 0) {
        volumeIcon.src = '../img/simbols/mute.svg';
    } else if (audio1.volume < 0.5) {
        volumeIcon.src = '../img/simbols/volume-low.svg';
    } else if (audio1.volume >= 0.5 && audio1.volume < 0.9) {
        volumeIcon.src = '../img/simbols/volume-high.svg';
    } else {
        volumeIcon.src = '../img/simbols/volume.svg';
    }
}

// Crida a la funció updateVolumeIcon inicialment per establir l'icona de volum correcta
updateVolumeIcon();

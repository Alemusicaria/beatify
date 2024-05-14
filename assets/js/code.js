const audio = document.querySelector('audio');
const songLength = document.getElementById('SongLength');
const currentTime = document.getElementById('CurrentSongTime');
const playPause = document.getElementById('PlayPause');
const plus10 = document.getElementById('Plus10');
const back10 = document.getElementById('Back10');
const progress = document.querySelector('.progress');
const progressContainer = document.querySelector('.progress-bar');
const progressBall = document.querySelector('.progress-ball');

// Funció per calcular el temps en format "minuts:segons"
const calculateTime = (secs) => {
    const minutes = Math.floor(secs / 60);
    const seconds = Math.floor(secs % 60);
    const returnedSeconds = seconds < 10 ? `0${seconds}` : `${seconds}`;
    return `${minutes}:${returnedSeconds}`;
};

// Funció per mostrar la durada total de la cançó
const displayDuration = () => {
    songLength.innerHTML = calculateTime(audio.duration);
};

// Funció per establir el progrés de la barra de progrés
const setProgress = (percentage) => {
    progress.style.width = percentage + '%';
    progressBall.style.left = percentage + '%'; // Ajustament per moure la bola juntament amb la barra de progrés
};

// Funció per actualitzar el progrés de la reproducció quan es fa clic a la barra de progrés
const updateProgress = (e) => {
    const clickX = e.offsetX;
    const width = progressContainer.clientWidth;
    const duration = audio.duration;
    audio.currentTime = (clickX / width) * duration;
};

// Funció per canviar entre reproducció i pausa de la cançó
const togglePlayPause = () => {
    if (audio.paused) {
        playPause.src = '../img/simbols/pause.svg';
        audio.play();
    } else {
        playPause.src = '../img/simbols/Play.svg';
        audio.pause();
    }
};

// Afegir un esdeveniment de clic per a la reproducció o pausa de la cançó
playPause.addEventListener('click', togglePlayPause);

// Afegir esdeveniments per canviar la icona de reproducció quan es comença o es pausa la reproducció
audio.addEventListener('play', () => {
    playPause.src = '../img/simbols/pause.svg';
});
audio.addEventListener('pause', () => {
    playPause.src = '../img/simbols/Play.svg';
});

// Afegir funcionalitat per avançar 10 segons
plus10.addEventListener('click', () => {
    audio.currentTime += 10;
});

// Afegir funcionalitat per retrocedir 10 segons
back10.addEventListener('click', () => {
    audio.currentTime -= 10;
});

// Afegir esdeveniment per mostrar la durada total quan el metadades de l'àudio estan carregades
audio.addEventListener('loadedmetadata', () => {
    displayDuration();
});

// Afegir esdeveniment per actualitzar el progrés de la reproducció i el temps transcorregut
audio.addEventListener('timeupdate', () => {
    currentTime.innerHTML = calculateTime(audio.currentTime);
    const percentage = (audio.currentTime / audio.duration) * 100;
    setProgress(percentage);
});

// Afegir esdeveniments per actualitzar la reproducció quan es fa clic o es mou el ratolí sobre la barra de progrés
progressContainer.addEventListener('click', updateProgress);
progressContainer.addEventListener('mousemove', (e) => {
    if (e.buttons === 1) {
        updateProgress(e);
    }
});

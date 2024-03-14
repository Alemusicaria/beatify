const audio = document.querySelector('audio');
const songLength = document.getElementById('SongLength');
const currentTime = document.getElementById('CurrentSongTime');
const playPause = document.getElementById('PlayPause');
const plus10 = document.getElementById('Plus10');
const back10 = document.getElementById('Back10');
const progress = document.querySelector('.progress');

const calculateTime = (secs) => {
    const minutes = Math.floor(secs / 60);
    const seconds = Math.floor(secs % 60);
    const returnedSeconds = seconds < 10 ? `0${seconds}` : `${seconds}`;
    return `${minutes}:${returnedSeconds}`;
};

const displayDuration = () => {
    songLength.innerHTML = calculateTime(audio.duration);
};

const setProgress = () => {
    let percentage = (audio.currentTime / audio.duration) * 100;
    progress.style.width = percentage + '%';
};

const togglePlayPause = () => {
    if (audio.paused) {
        playPause.src = '../img/simbols/pause.svg';
        audio.play();
    } else {
        playPause.src = '../img/simbols/Play.svg';
        audio.pause();
    }
};

playPause.addEventListener('click', togglePlayPause);

audio.addEventListener('play', () => {
    playPause.src = '../img/simbols/pause.svg';
});

plus10.addEventListener('click', () => {
    audio.currentTime += 10;
});

back10.addEventListener('click', () => {
    audio.currentTime -= 10;
});

audio.addEventListener('loadedmetadata', () => {
    displayDuration();
});

audio.addEventListener('timeupdate', () => {
    currentTime.innerHTML = calculateTime(audio.currentTime);
    setProgress();
});

// Inicialización
if (audio.readyState > 0) {
    displayDuration();
    currentTime.innerHTML = calculateTime(audio.currentTime);
}

const audio = document.querySelector('audio');
const songLength = document.getElementById('SongLength');
const currentTime = document.getElementById('CurrentSongTime');
const playPause = document.getElementById('PlayPause');
const plus10 = document.getElementById('Plus10');
const back10 = document.getElementById('Back10');
const progress = document.querySelector('.progress');
const progressContainer = document.querySelector('.progress-bar');
const progressBall = document.querySelector('.progress-ball');

const calculateTime = (secs) => {
    const minutes = Math.floor(secs / 60);
    const seconds = Math.floor(secs % 60);
    const returnedSeconds = seconds < 10 ? `0${seconds}` : `${seconds}`;
    return `${minutes}:${returnedSeconds}`;
};

const displayDuration = () => {
    songLength.innerHTML = calculateTime(audio.duration);
};

const setProgress = (percentage) => {
    progress.style.width = percentage + '%';
    progressBall.style.left = percentage + '%'; // Ajuste para mover la bola junto con la barra de progreso
};

const updateProgress = (e) => {
    const clickX = e.offsetX;
    const width = progressContainer.clientWidth;
    const duration = audio.duration;
    audio.currentTime = (clickX / width) * duration;
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
audio.addEventListener('pause', () => {
    playPause.src = '../img/simbols/Play.svg';
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
    const percentage = (audio.currentTime / audio.duration) * 100;
    setProgress(percentage);
});

progressContainer.addEventListener('click', updateProgress);
progressContainer.addEventListener('mousemove', (e) => {
    if (e.buttons === 1) {
        updateProgress(e);
    }
});

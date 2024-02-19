const audio = document.querySelector('audio'),
    songLength = document.getElementById('SongLength'),
    currentTime = document.getElementById('CurrentSongTime');

const calculateTime = (secs) =>{
    const minutes = Math.floor(secs / 60),
        seconds = Math.floor(secs % 60),
        returnedSeconds = seconds < 10 ? `0${seconds}` : `${seconds}`;
        return `${minutes}:${returnedSeconds}`;
}

const displayDuration = () =>{
    songLength.innerHTML = calculateTime(audio.duration);
}

if(audio.readyState > 0){
    displayDuration();
    currentTime.innerHTML = calculateTime(audio.currentTime);
}else{
    audio.addEventListener('loadedmetadata', () =>{
        displayDuration();
    })
}

audio.ontimeupdate = function(){
    currentTime.innerHTML = calculateTime(audio.currentTime);
    setProgress();
}

function setProgress(){
    let percentage = (audio.currentTime / audio.duration) * 100;
    document.querySelector('.progress').style.width = percentage + '%'; 
}

//Audio Controls
const playPause = document.getElementById('PlayPause'),
    plus10 = document.getElementById('Plus10'),
    back10 = document.getElementById('Back10');

playPause.addEventListener('click', ()=>{
    if(audio.paused){
        playPause.src = './img/simbols/pause.svg';
        audio.play();
    }else{
        playPause.src = './img/simbols/Play.svg';
        audio.pause();
    }
})

plus10.addEventListener('click', ()=>{
    audio.currentTime +=10;
})

back10.addEventListener('click', ()=>{
    audio.currentTime -=10;
})
/*
const volumeSlider = document.getElementById('volumeSlider');
const volumeIcon = document.getElementById('volumeIcon');

// Set initial volume value and icon
audio.volume = volumeSlider.value;

volumeSlider.addEventListener('input', () => {
    audio.volume = volumeSlider.value;
    updateVolumeIcon();
});

function updateVolumeIcon() {
    // Change volume icon based on the volume level
    if (audio.volume === 0) {
        volumeIcon.src = './img/simbols/mute.svg';
    } else if (audio.volume < 0.5) {
        volumeIcon.src = './img/simbols/volume-low.svg';
    } else {
        volumeIcon.src = './img/simbols/volume.svg';
    }
}
// Call updateVolumeIcon initially to set the correct volume icon
updateVolumeIcon();
*/
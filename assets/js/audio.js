const audio1 = document.querySelector('audio');
const volumeSlider = document.getElementById('volumeSlider');
const volumeIcon = document.getElementById('volumeIcon');

// Set initial volume value and icon
audio1.volume = volumeSlider.value;

volumeSlider.addEventListener('input', () => {
    audio1.volume = volumeSlider.value;
    updateVolumeIcon();
});

function updateVolumeIcon() {
    // Change volume icon based on the volume level
    if (audio1.volume === 0) {
        volumeIcon.src = '../img/simbols/mute.svg';
    } else if (audio1.volume < 0.5) {
        volumeIcon.src = '../img/simbols/volume-low.svg';
    } else if (audio1.volume > 0.5 < 0.9) {
        volumeIcon.src = '../img/simbols/volume-high.svg';
    } else {
        volumeIcon.src = '../img/simbols/volume.svg';
    }
}
// Call updateVolumeIcon initially to set the correct volume icon
updateVolumeIcon();

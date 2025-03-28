const audio = document.getElementById('audio');
const trackTitle = document.getElementById('trackTitle');
const prevBtn = document.getElementById('prevBtn');
const stopBtn = document.getElementById('stopBtn');
const nextBtn = document.getElementById('nextBtn');
const seekBar = document.getElementById("seekBar");
const trackPhoto = document.querySelector('.track-photo');

const tracks = [
    {title: "BREATHING", src: "audio/Sxtreen_-_BREATHING_77714506.mp3", bgSrc: "url(images/imagesoftracks/BREATHING.jpg)"},
    {title: "Loneliness", src: "audio/LXRY_PXNK_CHMCL_SUP_-_Loneliness_76266909.mp3", bgSrc: "url(images/imagesoftracks/loneliness.jpg)"},
    {title: "Time", src: "audio/LXRY_PXNK_XTOM_-_Time_77580176.mp3", bgSrc: "url(images/imagesoftracks/Time.jpg)"},
    {title: "STEREO WAVE", src: "audio/XCELLA_maaayheem_-_STEREO_WAVE_(musmore.org).mp3", bgSrc: "url(images/imagesoftracks/xcells.jpg)"},
    {title: "Frozen", src: "audio/LXRY_PXNK_KHXXMU_-_Frozen_(musmore.org).mp3", bgSrc: "url(images/imagesoftracks/Frozen.jpg)"},
    {title: "Rain", src: "audio/LXRY_PXNK_CHMCL_SUP_-_Rain_77802480.mp3", bgSrc: "url(images/imagesoftracks/Rain.jpg)"},
    {title: "ASPIRE", src: "audio/FLONEX, Autxmn Love - ASPIRE.mp3", bgSrc: "url(images/imagesoftracks/ASPIRE.jpg)"}
];

var trackIndex = 0;

function loadTrack(index) {
    audio.src = tracks[index].src;
    trackTitle.textContent = tracks[index].title;
    trackPhoto.style.backgroundImage = tracks[index].bgSrc;
    seekBar.value = 0;
    audio.pause();
}

function clickTrack(index) {
    audio.src = tracks[index].src;
    trackTitle.textContent = tracks[index].title;
    trackPhoto.style.backgroundImage = tracks[index].bgSrc;
    audio.play();
    stopBtn.classList.add('playAnimated');
}

function playPouseTrack() {
    stopBtn.classList.toggle('playAnimated');
    if (audio.paused) {
        audio.play();
    }
    else {
        audio.pause();
    }
}

function loadNext() {
    trackIndex = (trackIndex + 1) % tracks.length;
    loadTrack(trackIndex);
    audio.play();
    stopBtn.classList.add('playAnimated');
}

function loadPrev() {
    trackIndex = (trackIndex - 1 + tracks.length) % tracks.length;
    loadTrack(trackIndex);
    audio.play();
    stopBtn.classList.add('playAnimated');
}

audio.addEventListener('timeupdate', function() {
    seekBar.value = (audio.currentTime / audio.duration) * 100;
});

seekBar.addEventListener('input', function() {
    audio.currentTime = (seekBar.value / 100) * audio.duration;
});

audio.addEventListener("ended", loadNext);

stopBtn.addEventListener('click', playPouseTrack);
nextBtn.addEventListener('click', loadNext);
prevBtn.addEventListener('click', loadPrev);


loadTrack(trackIndex);
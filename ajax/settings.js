function PlayMusic(){
    document.getElementById('back-music').play(); 
    document.getElementById('music_pause').style.display = 'block';
    document.getElementById('music_play').style.display = 'none';
}

function StopMusic(){
    document.getElementById('back-music').pause()
    document.getElementById('music_pause').style.display = 'none';
    document.getElementById('music_play').style.display = 'block';
}
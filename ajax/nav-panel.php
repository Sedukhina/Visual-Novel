<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script src="/ajax/forms.js"></script>
        <script src="/ajax/settings.js"></script>
        <script src="/../forum/forum.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        
        <!--Settings form-->
        <div id = "Settings" class="userForm">
            <button type="button" id = "music_pause" onclick="StopMusic('back-music')"> <img class ="ico" src="\..\content\icons\turn-off-music.png" alt="Turn Off Music"/></button>
            <button type="button" id = "music_play" onclick="PlayMusic('back-music')" class = "displayNone"><img class ="ico" src="\..\content\icons\turn-on-music.png" alt="Turn On Music"/></button>
            <div>
                <h1>Attribution</h1>
                <a href="https://www.freepik.com/author/upklyak">Character Outfits by upklyak</a>
                <a href="https://www.flaticon.com/free-icons/adjust">Icons created by Freepik - Flaticon</a>
                <a href="https://freetouse.com/music">Music track: Sweet Talks by Limujii</a>
            </div>
            <button type="button" class="closeButton" onclick="closeForm('Settings')">x</button>
        </div>

    </head>
	<body>
        <div id = "nav-panel">
            <audio src="\..\content\music\Limujii _SweetTalks.mp3" autoplay loop id = "back-music"></audio>
            <button class="navbutton" onclick="openForm('Settings')"> <img class ="ico" src="\..\content\icons\settings.png" alt="Settings"/> </button>
            <button class="navbutton" onclick='change_topic(-1);'> <img class ="ico" src="\..\content\icons\forum.png" alt="Forum"/> </button>
            <button class="navbutton" onclick="$('#page').load('/../qian.php')"> <img class ="ico" src="\..\content\icons\coins.png" alt="Shop"/> </button>
        </div>

    </body>
</html>
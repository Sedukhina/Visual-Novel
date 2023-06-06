<?php
	require_once __DIR__.'../boot.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!--Linking external files-->
        <link rel="stylesheet" href="/../style.css">
        <script src="game.js"></script>
        <script src="/ajax/forms.js"></script>
    </head>
    
    <body>
        <div id = "Game" class = "game">
            <canvas class = "GameCanvas" id="GameCanvas"></canvas>
            <div id = "CharactersCues" class = "charactersCues"></div>
            <img id = "MoveForward" class ="gameNavigation forward" src="..//content//details//move_forward.png" alt="Move Forward" onclick = "Move('Forward')"/>
            <img id = "MoveBack" class ="gameNavigation back" src="..//content//details//move_back.png" alt="Move Back" onclick = "Move('Back')"/>
            <img id = "MoveRight" class ="gameNavigation right" src="..//content//details//move_right.png" alt="Move Right" onclick = "Move('Right')"/>
            <img id = "MoveLeft" class ="gameNavigation left" src="..//content//details//move_left.png" alt="Move Left" onclick = "Move('Left')"/>
            <div id = "PlayersCues" class = "playerCues"></div>
        </div>
        <script>
            LoadGame();
        </script>
    </body>
</html>
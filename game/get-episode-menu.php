<?php
    require_once __DIR__.'\..\boot.php';

    $stmt = pdo_users()->prepare("SELECT * FROM `CompletedEpisodes` WHERE Username = :Username ORDER BY `Episode_ID`");
    $stmt->execute(['Username' => $_SESSION['Username']]);

    foreach ($stmt as $row) 
    {
        $stmt_episodes = pdo_game()->prepare("SELECT * FROM `Episodes` WHERE Episode_ID = :E_ID");
        $stmt_episodes->execute(['E_ID' => $row['Episode_ID']]);
        foreach ($stmt_episodes as $episode) {
            echo("<div class = 'leftmargin'><h1>".$episode['EpisodName']."</h1><p>".$episode['Synopsis']."</p></div>");
        }
    }
    
    $stmt = null;
?>
<?php
    require_once __DIR__.'\..\boot.php';
    if (isset($_SESSION['Username'])){
        $stmt = pdo_users()->prepare("SELECT * FROM `GameProgress` WHERE Username = :Username");
        $stmt->execute(['Username' => $_SESSION['Username']]);
        $EpisodeID;
        foreach ($stmt as $row) 
        {  
            $EpisodeID = $row['CurrentEpisode'];
        }

        $stmt = pdo_users()->prepare("INSERT INTO `CompletedEpisodes`(`Episode_ID`, `username`) VALUES (:E_ID, :Username)");
        $stmt->execute(['E_ID' => $EpisodeID, 'Username' => $_SESSION['Username']]);

        $stmt = pdo_users()->prepare("UPDATE `GameProgress` SET `CurrentEpisode` = null, `CurrentCue` = null, `CurrentDialogue` = null, `NextDialogue` = null WHERE Username = :Username");
        $stmt->execute(['Username' => $_SESSION['Username']]);

        $stmt = NULL;
    }   
    else{
        echo(NULL);
    }
?>

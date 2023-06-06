<?php
    require_once __DIR__.'\..\boot.php';
    if (isset($_SESSION['Username'])){

        $stmt = pdo_users()->prepare("UPDATE `GameProgress` SET `CurrentCue` = 1, `CurrentDialogue` = :NextDialogue, `NextDialogue` = null WHERE Username = :Username");
        $stmt->execute(['NextDialogue' => $_POST['dialogue_id'], 'Username' => $_SESSION['Username']]);
        
        $stmt = NULL;
    }   
    else{
        echo(NULL);
    }
?>
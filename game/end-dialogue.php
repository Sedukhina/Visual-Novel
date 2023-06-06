<?php
    require_once __DIR__.'\..\boot.php';
    if (isset($_SESSION['Username'])){

        $stmt = pdo_users()->prepare("UPDATE `GameProgress` SET `CurrentCue` = null, `CurrentDialogue` = null, `NextDialogue` = :NextDialogue WHERE Username = :Username");
        $stmt->execute(['NextDialogue' => $_POST['Next_Dialogue'], 'Username' => $_SESSION['Username']]);

        $stmt = NULL;
    }   
    else{
        echo(NULL);
    }
?>
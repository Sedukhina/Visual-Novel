<?php
    require_once __DIR__.'\..\boot.php';
    if (isset($_SESSION['Username'])){
        $stmt = pdo_users()->prepare("UPDATE `GameProgress` SET `CurrentCue` = :next_cue WHERE Username = :Username");
        $stmt->execute(['next_cue' => $_POST['Next_Cue'], 'Username' => $_SESSION['Username']]);
        
        $stmt = NULL;
    }   
    else{
        echo(NULL);
    }
?>

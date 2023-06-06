<?php
    require_once __DIR__.'\..\boot.php';
    if (isset($_SESSION['Username'])){

        $stmt = pdo_users()->prepare("SELECT * from `GameProgress` WHERE Username = :Username");
        $stmt->execute(['Username' => $_SESSION['Username']]);

        foreach ($stmt as $row) 
        {  
            echo($row['NextDialogue']);
        }

        $stmt = NULL;
    }   
    else{
        echo(NULL);
    }
?>
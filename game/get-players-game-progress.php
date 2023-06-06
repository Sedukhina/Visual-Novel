<?php
    require_once __DIR__.'\..\boot.php';
    if (isset($_SESSION['Username'])){
        $stmt = pdo_users()->prepare("SELECT * FROM `GameProgress` WHERE Username = :Username");
        $stmt->execute(['Username' => $_SESSION['Username']]);
        foreach ($stmt as $row) 
        {  
            echo(json_encode($row));
        }
        $stmt = NULL;
    }   
    else{
        echo(NULL);
    }
?>
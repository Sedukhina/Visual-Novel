<?php
    require_once __DIR__.'\..\boot.php';

    $stmt = pdo_users()->prepare("SELECT * FROM `Characters` WHERE Username = :Username");
    $stmt->execute(['Username' => $_SESSION['Username']]);
    foreach ($stmt as $row) 
    {  
        echo(json_encode($row));
    }
    $stmt = NULL;
?>
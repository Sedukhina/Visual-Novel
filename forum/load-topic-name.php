<?php
    require_once __DIR__.'\..\boot.php';
    $stmt = pdo_forum()->prepare("SELECT Topic_Name FROM `Topics` WHERE Topic_ID = :tid");
    $stmt->execute(['tid' => $_SESSION["topic_id"]]);
    $stmt->execute();
    foreach ($stmt as $row) 
    {  
        echo($row["Topic_Name"]);
    }
?>
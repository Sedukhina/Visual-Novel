<?php
    require_once __DIR__.'\..\boot.php';
    $stmt = pdo_forum()->prepare("SELECT * FROM `Topics` ORDER BY `Topic_Id`");
    $stmt->execute();
    foreach ($stmt as $row) 
    {  
        echo("<button class = 'textLink' onClick = 'change_topic(".$row["Topic_ID"].")'>".$row["Topic_Name"]."</button>");
    }
    
    $stmt = null;
?>
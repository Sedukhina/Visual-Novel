<?php
    require_once __DIR__.'\..\boot.php';

    $stmt = pdo_users()->prepare("SELECT * FROM `users` WHERE `user_id` = :user_id");
    $stmt->execute([
        'user_id' =>  $_SESSION['user_id']
    ]);
    foreach ($stmt as $row) 
    {  
        if($row["IsAdmin"] == 1){
            echo(1);
        }
    }
?>
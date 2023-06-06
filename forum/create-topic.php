<?php
    require_once __DIR__.'\..\boot.php';
    
    if($_POST['TopicName'] != NULL){
        $stmt = pdo_forum()->prepare("INSERT INTO Topics (Closed, Topic_Name) VALUES (false, :TopicName)");
        $stmt->execute([
            'TopicName' => $_POST['TopicName']
        ]);
    }
?>
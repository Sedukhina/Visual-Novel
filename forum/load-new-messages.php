<?php
    require_once __DIR__.'\..\boot.php';
    $stmt = pdo_forum()->prepare("SELECT * FROM Messages WHERE Topic_ID = :tid AND CreationTime = :ct ORDER BY Message_Id ");
    $stmt->execute(['tid' => $_SESSION["topic_id"], 'ct' => date("Y-m-d h:i:s", strtotime('-1 seconds'))]);
    $stmt_img = pdo_forum()->prepare("SELECT * FROM ForumImages WHERE MessageID = :mid");
    foreach ($stmt as $row) 
    {  
        echo ("<b><font color='orange'>".$row["Username"].": </font></b>".$row["Message"]."<br>");
    }
?>
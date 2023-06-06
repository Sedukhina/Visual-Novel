<?php
    require_once __DIR__.'\..\boot.php';
    $stmt = pdo_forum()->prepare("SELECT * FROM Messages WHERE Topic_ID = :tid ORDER BY Message_Id ");
    $stmt->execute(['tid' => $_SESSION["topic_id"]]);
    foreach ($stmt as $row) 
    {  
        echo ("<b><font color='orange'>".$row["Username"].": </font></b>".$row["Message"]."<br>");
        $stmt_img = pdo_forum()->prepare("SELECT * FROM ForumImages WHERE MessageID = :mid");
        $stmt_img->execute(['mid' => $row["Message_ID"]]);
        foreach ($stmt_img as $row_img){
            echo ("<b><font color='orange'>".$row["Username"].": </font></b><img src='"."\\forum\\forum-images\\".$row_img['PathToImage']."'><br>");
        } 
    }
?>
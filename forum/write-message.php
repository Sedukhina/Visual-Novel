<?php
    require_once __DIR__.'\..\boot.php';

    $CreationTime = date("Y-m-d h:i:s");
    $FileCreationTime = date("Y-m-d-h-i-s");
 
    $stmt = pdo_forum()->prepare("INSERT INTO Messages (Topic_ID, Message, Username, CreationTime) VALUES (:tid, :MessageText, :Username, :CreationTime)");
    $stmt->execute([
        'tid' => $_SESSION['topic_id'],
        'MessageText' => $_POST['message'],
        'Username' => $_SESSION["Username"],
        'CreationTime' => $CreationTime,
    ]);
   
    $stmt = pdo_forum()->prepare("SELECT * from Messages where CreationTime = :CreationTime AND Username = :Username;");
    $stmt->execute([
        'Username' => $_SESSION["Username"],
        'CreationTime' => $CreationTime,
    ]);

    $m_id;
    foreach($stmt as $row){
        $m_id = $row['Message_ID'];
    }

    if(!empty($_FILES["image"]["name"])){
        $stmt = pdo_forum()->prepare("INSERT INTO ForumImages (MessageID, PathToImage) VALUES (:mid, :img)");
        $stmt->execute([
            'mid' => $m_id,
            'img' => $FileCreationTime.$_FILES["image"]["name"],
        ]);
        $targetFilePath = __DIR__.'\forum-images\\'.$FileCreationTime.$_FILES["image"]["name"];
        echo($targetFilePath);
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
        echo("csvS");
    }
    else{
        echo("asdcas");
    }

    $stmt = NULL;
?>
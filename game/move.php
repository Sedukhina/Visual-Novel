<?php
    require_once __DIR__.'\..\boot.php';


    $stmt = pdo_users()->prepare("SELECT * FROM `Users` WHERE Username = :Username");
    $stmt->execute(['Username' => $_SESSION['Username']]);
    $Energy;

    foreach ($stmt as $row){
        $Energy = $row['Energy'];
    }

    $Energy = $Energy - 2;

    $stmt = pdo_users()->prepare("UPDATE `Users` SET `Energy`= :Energy  WHERE Username = :Username");
    $stmt->execute(['Energy' => $Energy, 'Username' => $_SESSION['Username']]);

    $stmt = pdo_users()->prepare("SELECT * FROM `GameProgress` WHERE Username = :Username");
    $stmt->execute(['Username' => $_SESSION['Username']]);

    foreach ($stmt as $row) 
    {  
        $stmt_game = pdo_game()->prepare("SELECT * FROM Locations WHERE CurrentLocation = :CR");
        $stmt_game->execute(['CR' => $row['CurrentLocation']]);
        $DemandLocation = $_POST['Direction']."Location";
        foreach ($stmt_game as $row_game){
            $stmt_update = pdo_users()->prepare("UPDATE `GameProgress` SET CurrentLocation = :DemLocation WHERE Username = :Username");
            $stmt_update->execute(['Username' => $_SESSION['Username'], 'DemLocation' => $row_game[$DemandLocation]]);
            echo($row_game[$DemandLocation]);
        }
    }
    $stmt = null;
    $stmt_game = null;
?>
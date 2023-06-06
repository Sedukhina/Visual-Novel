<?php
    require_once __DIR__.'\..\boot.php';

    $stmt = pdo_users()->prepare("SELECT * FROM `GameProgress` WHERE Username = :Username");
    $stmt->execute(['Username' => $_SESSION['Username']]);
    $Episode_num;
    foreach ($stmt as $row) 
    {  
        $Episode_num = $row['CurrentEpisode'];
    }

    echo(json_encode((json_decode(file_get_contents(__DIR__.'\..\content\episodes\Episode_'.$Episode_num.'.json'), true))["dialogue_".$_POST['dialogue_id']]['Location']));
?>

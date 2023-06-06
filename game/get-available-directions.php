<?php
    require_once __DIR__.'\..\boot.php';

    $stmt = pdo_game()->prepare("SELECT * FROM Locations WHERE CurrentLocation = :CR");
    $stmt->execute(['CR' => $_POST['CurrentLocation']]);
    foreach ($stmt as $row) {
        echo(json_encode($row));
    }

    $stmt = null;
?>
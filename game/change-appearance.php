<?php
require_once __DIR__.'/../boot.php';

$stmt = pdo_users()->prepare("UPDATE `Characters` SET `Hair_Type` = :hair_type, `Eyes_Type` = :eyes_type, `Brows_Type` = :brows_type, `Nose_Type` = :nose_type, `Mouth_Type` = :mouth_type, `Gender` = :gender WHERE Username = :username");
$stmt->execute([
    'username' => $_SESSION['Username'],
    'hair_type' => $_POST['hair_type'],
    'eyes_type' => $_POST['eyes_type'],
    'brows_type' => $_POST['brows_type'],
    'nose_type' => $_POST['nose_type'],
    'mouth_type' => $_POST['mouth_type'],
    'gender' => $_POST['gender']
]);
?>
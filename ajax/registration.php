<?php
    require_once __DIR__.'\..\boot.php';
    $stmt = pdo_users()->prepare("SELECT * FROM `Users` WHERE `email` = :email");
    $stmt->execute(['email' => $_POST['email']]);
    if ($stmt->rowCount() > 0) 
    {
        flash('You are already registered');
        header('Location: /');
        die; 
    }   
    $stmt = pdo_users()->prepare("SELECT * FROM `Users` WHERE `username` = :username");
    $stmt->execute(['username' => $_POST['username']]);
    if ($stmt->rowCount() > 0) 
    {
        flash('This username is already taken');
        header('Location: /');
        die; 
    }   
    $stmt = pdo_users()->prepare("INSERT INTO `Users` (`email`, `username`, `registration_date`, `birthday`, `hashed_password`, `money`, `energy`, `IsAdmin`) VALUES (:email, :username, :rg, :birthday, :password, :money, :energy, false)");
    $stmt->execute([
        'email' => $_POST['email'],
        'username' => $_POST['username'],
        'rg' => date('y-m-d'),
        'birthday' => $_POST['birthday'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'money' => 300,
        'energy' => 300
    ]);

    $stmt = pdo_users()->prepare("INSERT INTO `Characters` (`Username`, `Hair_Type`, `Eyes_Type`, `Brows_Type`, `Nose_Type`, `Mouth_Type`, `Gender`) VALUES (:username, 1, 1, 1, 1, 1, :gender)");
    $stmt->execute([
        'username' => $_POST['username'],
        'gender' => $_POST['gender']
    ]);
    
    $stmt = pdo_users()->prepare("INSERT INTO `GameProgress` (`Username`, `CurrentEpisode`, `CurrentDialogue`, `CurrentCue`, `CurrentLocation`) VALUES (:username, 0, 1, 1, 'Main')");
    $stmt->execute([
        'username' => $_POST['username']
    ]);

    $stmt = NULL;
    header('Location: ../main.php');
?>
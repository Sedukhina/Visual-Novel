<?php
    require_once __DIR__.'\..\boot.php';
    $stmt = pdo_users()->prepare("SELECT * FROM `Users` WHERE `email` = :email");
    $stmt->execute(['email' => $_POST['email']]);
    if ($stmt->rowCount() == 0) 
    {
        flash("You aren't registered");
        header('Location: /');
        die; 
    }   
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (password_verify($_POST['password'], $user['Hashed_Password'])) 
    {
        if (password_needs_rehash($user['Hashed_Password'], PASSWORD_DEFAULT)) {
            $newHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = pdo_users()->prepare('UPDATE `users` SET `Hashed_Password` = :password WHERE `email` = :email');
            $stmt->execute([
                'email' => $_POST['email'],
                'Hashed_Password' => $newHash,
            ]);
        }
        $_SESSION['user_id'] = $user['User_ID'];
        $_SESSION['Username'] = $user['Username'];
        header('Location: /');
        die;
    }
    else 
    {
        flash('Wrong Password');
    }

    header('Location: ../main.php');
?>
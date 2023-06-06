<?php
    require_once __DIR__.'../boot.php';
    $_SESSION['user_id'] = null;
    $_SESSION['Username'] = null;
    $_SESSION['page'] = 'main';
    header('Location: /');
    die;
    header('Location: ../main.php');
?>
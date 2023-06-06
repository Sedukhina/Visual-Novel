<?php
    require_once __DIR__.'\..\boot.php';
    echo(json_encode(json_decode(file_get_contents(__DIR__.'\..\content\episodes\Episode_'.$_POST['Episode_num'].'.json'), true)));
?>

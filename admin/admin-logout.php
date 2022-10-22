<?php
    session_start();
    if(!isset($_SESSION['czy_zalogowany']))
    {
        header('Location: index.php');
        exit();
    }
    else
    {
        session_destroy();
        header('Location: index.php');
    }
?>

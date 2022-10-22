<?php
        session_start();
        if($_SESSION['czy_zalogowany']!=1)
        {
            header('Location: index.php');
            exit();
        }


        if(!isset($_GET['id']))
        {
            header('Location: admin-index.php');
            $_SESSION['blad'] = "<b>Błąd:</b> Nie usunięto tokenu!";
            exit();
        }
        
        $id = $_GET['id'];
        $id = htmlentities($id,ENT_QUOTES,"UTF-8");

        require_once('connect.php');
        $polaczenie=new mysqli($db_host,$db_user,$db_password,$db_name);
        if($polaczenie->connect_errno!=0)
        {
            $_SESSION['blad'] = "<b>Błąd połączenia z bazą danych!</b> Nie usunięto tokenu! ";
        }
        else
        {   
            $query="DELETE FROM tokens WHERE id_token = $id;";
            $final=$polaczenie->query($query);

            if($final)
            {
                $_SESSION['sukcest'] = "Sukces! Usunięto token.";
            }
            else
            {
                $_SESSION['blad'] = "<b>Błąd połączenia z bazą danych!</b> Nie usunięto tokenu! ";
            }
        }

        $polaczenie -> close();
        header('Location: admin-index.php');

?>


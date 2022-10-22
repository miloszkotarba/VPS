<?php
    session_start();
    
    //czy pusty formularz
    if(empty($_POST['login']) || empty($_POST['password']))
    {
        $_SESSION['error-login']="Nie podano loginu lub hasła!";
        header('Location: index.php');
        exit();
    }

    if((!isset($_POST['login'])) || (!isset($_POST['password'])))
    {
        $_SESSION['error-login']="Nie podano loginu lub hasła!";
        header('Location: index.php');
        exit();
    }

    $login=$_POST['login'];
    $password=$_POST['password'];
    $login=htmlentities($login,ENT_QUOTES,"UTF-8");
    $password=htmlentities($password,ENT_QUOTES,"UTF-8");
    

    //walidacja loginu i polaczenie z baza
    require_once('connect.php');
    $polaczenie=new mysqli($db_host,$db_user,$db_password,$db_name);
        if($polaczenie->connect_errno!=0)
        {
            echo "<b>Błąd połączenia z bazą.</b> Informacja deweloperska: ".$polaczenie->connect_errno;
        }
        else
        {   
            $query="SELECT * FROM admin WHERE login='$login' AND PASSWORD='$password'";
            $final=$polaczenie->query($query);
            $ilewierszy=$final->num_rows;
            if($ilewierszy!=1)
            {
                $_SESSION['error-login']="Nieprawidłowy login lub hasło!";
                header('Location: index.php');
            }
            else
            {
                $_SESSION['czy_zalogowany']=1;
                $wiersz=$final->fetch_assoc();
                $_SESSION['admin-name']=$wiersz['name'];
                $_SESSION['admin-surname']=$wiersz['surname'];
                $final->free_result();
            }
            $polaczenie->close();
        }

    if(isset($_SESSION['czy_zalogowany']))
    {
        header('Location: admin-index.php');
        exit();
    }
?>

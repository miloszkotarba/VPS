<?php
        session_start();
        if($_SESSION['czy_zalogowany']!=1)
        {
            header('Location: index.php');
            exit();
        }

        if(!isset($_POST['ilosc']))
        {
            $_SESSION['error-ilosc']="Należy podać ilość tokenów!";
            header('Location: generate.php');
            exit();
        }

        if(empty($_POST['ilosc']))
        {
            $_SESSION['error-ilosc']="Należy podać ilość tokenów!";
            header('Location: generate.php');
            exit();
        }
        
        $ilosc=$_POST['ilosc'];
        $ilosc=htmlentities($ilosc,ENT_QUOTES,"UTF-8");
        
        if(!is_numeric($ilosc))
        {
            $_SESSION['error-ilosc']="Należy podać wartość liczbową!";
            header('Location: generate.php');
            exit();
        }

        

        require_once('connect.php');
        $polaczenie=new mysqli($db_host,$db_user,$db_password,$db_name);
        if($polaczenie->connect_errno!=0)
        {
            $_SESSION['error-ilosc']="<b>Błąd połączenia z bazą.</b> Informacja deweloperska: ".$polaczenie->connect_errno;
            header('Location: generate.php');
        }
        else
        {  
            for($i=0; $i<$ilosc; $i++)
            {
                $liczba_losowa=rand(1000000000,10000000000);
                $query="INSERT INTO tokens VALUES(NULL,'$liczba_losowa')";
                $final=$polaczenie->query($query);
            }
            if($final)
            {
                $_SESSION['token-info']=$ilosc;
            }
            header('Location: generate.php');
            $polaczenie->close();
        }
?>
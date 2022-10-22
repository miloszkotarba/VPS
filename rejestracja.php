<?php

session_start();
ob_start();

    $walidacja=true;

    //walidacja tokenu

    if(!isset($_POST['token']))
    {
        header('Location: index.php');
        $walidacja=false;
    }
    
    if(empty($_POST['token']))
    {
       $_SESSION['e.token']='To pole nie może być puste.';
       $walidacja=false;
    }

    else
    {
        $_SESSION['token']=$_POST['token'];
    }

    //walidacja nazwy uzytkownika

    if(!ctype_alnum($_POST['username']))
    {
        $_SESSION['e.username']='Nazwa użytkownika nie może mieć znaków specjalnych.';
       $walidacja=false;
    }

    if(empty($_POST['username']))
    {
       $_SESSION['e.username']='To pole nie może być puste.';
       $walidacja=false;
    }

    else
    {
        $_SESSION['username']=$_POST['username'];
    }
    //walidacja imienia

    $sprawdz = '/(*UTF8)^[A-ZŁŚ]{1}+[a-ząęółśżźćń]+$/';
    if(!preg_match($sprawdz,$_POST['name']))
    {
        $_SESSION['e.name']='Podaj poprawne imię.';
        $walidacja=false;
    }

    if(empty($_POST['name']))
    {
       $_SESSION['e.name']='To pole nie może być puste.';
       $walidacja=false;
    }

    else
    {
        $_SESSION['name']=$_POST['name'];
    }

    //walidacja nazwiska

    $sprawdz = '/(*UTF8)^[A-ZŁŚ]{1}+[a-ząęółśżźćń]+$/';
    if(!preg_match($sprawdz,$_POST['surname']))
    {
        $_SESSION['e.surname']='Podaj poprawne nazwisko.';
        $walidacja=false;
    }

    if(empty($_POST['surname']))
    {
       $_SESSION['e.surname']='To pole nie może być puste.';
       $walidacja=false;
    }

    else
    {
        $_SESSION['surname']=$_POST['surname'];
    }

    //walidacja indeksu

    if(empty($_POST['index_number']))
    {
        $_SESSION['e.index_number']='To pole nie może być puste.';
        $walidacja=false;
    }

    else
    {
        $_SESSION['index_number']=$_POST['index_number'];
    }

    //sprawdzenie czy login istnieje
    if($walidacja==true)
    {
	   $login_usera=$_POST['username'];
	    $czy_login="sudo bash /home/mkotarba/skrypt-login.sh $login_usera";
	    $warunek=shell_exec("$czy_login");
	    if($warunek == 1)
	    {
		    $_SESSION['e.username']="Ta nazwa użytkownika jest już zajęta.";
		    $walidacja=false;
	    }
    }
    //final

    if($walidacja==false)
    {
        header("Location: index.php");
        exit();
    }

    if($walidacja==true)
    {
        require_once('connect.php');
        $polaczenie=new mysqli($db_host,$db_user,$db_password,$db_name);
        if($polaczenie->connect_errno!=0)
        {
            echo "<b>Błąd połączenia z bazą.</b> Informacja deweloperska: ".$polaczenie->connect_errno;
        }
        else
        {
            $token=$_POST['token'];
            $token=htmlentities($token,ENT_QUOTES,"UTF-8");
            $username=$_POST['username'];
            $name=$_POST['name'];
            $surname=$_POST['surname'];
            $index=$_POST['index_number'];
            
            unset($_POST['token']);
            unset($_POST['username']);
            unset($_POST['name']);
            unset($_POST['surname']);
            unset($_POST['index_number']);

            $query="SELECT * FROM `tokens` WHERE value='$token';";
            $zapytanie=$polaczenie->query($query);
            $ilewierszy=$zapytanie->num_rows;

            if($ilewierszy!=1)
            {
                $_SESSION['critic-error']='Podano niepoprawny token aktywacyjny!';
		header('Location: index.php');
		ob_end_flush();
            }
            else
            {
                $haslo=rand(1000000000,10000000000);
                $komenda="sudo bash /home/mkotarba/skrypt.sh '221526042022' '$name $surname' $username $haslo";
		echo "<br />";
		echo "Odpowiedz serwera: <pre>".shell_exec("$komenda")."</pre>";
               if($komenda)
               {

                $polaczenie2=new mysqli($db_host,$db_user,$db_password,$db_name);
                $query="DELETE FROM tokens where tokens.value=$token";
                $polaczenie2->query($query);
                $polaczenie2->close();

                $polaczenie2=new mysqli($db_host,$db_user,$db_password,$db_name);
                $query2="INSERT INTO users VALUES(null,'$username','$name','$surname','$index','$token',NOW())";
                $polaczenie2->query($query2);
		$polaczenie2->close();
		
		$data_aktywnosci=shell_exec("sudo bash /home/mkotarba/skrypt-data.sh $username");
		$link='https://vps.kotika.pl/~'.$username.'"';

		///eksport zmiennych
		$_SESSION['k.haslo']=$haslo;
		$_SESSION['k.user']=$username;
		$_SESSION['k.data']=$data_aktywnosci;
		$_SESSION['k.link']=$link;
		
		header('Location: komunikat.php');
               }

            }
            $polaczenie->close();
        }



    }


/*

$url = "https://api2.smsplanet.pl/sms";
$params = [
		'key' => 'b297f3f4-eed5-4f50-9af9-6ba0ea89def7',
			'password' => 'Feliks110',
				'from' => 'TEST',
					'to' => '796260415',
						'msg' => 'Informacja: Dodano nowego uzytkownika na serwerze VPS-KOTIKA!'
					];

$response=send_get($url, $params);
var_dump($response);

function send_get($url,$params) {
		$params_string = http_build_query($params);
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url . '?'.$params_string);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$response = curl_exec($ch);
					curl_close ($ch); 
				return $response;*/
?>

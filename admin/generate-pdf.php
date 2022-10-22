<?php
    session_start();
    if($_SESSION['czy_zalogowany']!=1)
        {
            header('Location: index.php');
            exit();
        }

require_once __DIR__ . '/vendor/autoload.php';

//pobranie zmiennych
$dzisiaj = date("Y-m-d H:i:s");

$mpdf = new \Mpdf\Mpdf();

$data = '<style>body{font-family: sans-serif;} table{font-size: 16px; text-align: center; line-height: 35px;}.test{background-color: white; text-align: center; margin-left: auto; margin-right: auto;} #lp{width: 30px;} td{width: 150px;}</style>';
$data .= "<h1 style='text-align:center;'>Tokeny Aktywacyjne VPS-KOTIKA</h1>";
$data .= "<p><i>Wygenerowano przez:</i> <b>".$_SESSION['admin-name']." ".$_SESSION['admin-surname']."</b><br>";
$data .= "<i>Data:</i> $dzisiaj</p>";

    require_once('connect.php');
    $polaczenie=new mysqli($db_host,$db_user,$db_password,$db_name);
        if($polaczenie->connect_errno!=0)
        {
            echo "<b>Błąd połączenia z bazą.</b> Informacja deweloperska: ".$polaczenie->connect_errno;
        }
        else
        {   
            $query="SELECT * FROM tokens";
            $final=$polaczenie->query($query);
            $ilewierszy=$final->num_rows;

            if($ilewierszy == 0)
            {
                $data .= "<b>BRAK TOKENÓW!</b>";
                $mpdf->writeHTML("$data");
                $mpdf->Output();

            }
            else
            {
                    $data .= "<div class='test'><table border='1' style='border-collapse: collapse; collapse;'><tbody><tr><th>#</th><th>Token</th>";
                
                
                    $lp=0;

                    while($wiersz=$final->fetch_array())
                    {
                        $lp++;
                        $data .= "<tr><td id='lp'>";
                        $data .= "$lp.</td>";
                        $data .="<td>".$wiersz['value']."</td></tr>";
                    }
            }
            
            $polaczenie->close();
        }

$data .= "</tbody></table></div>";

$mpdf->writeHTML("$data");
$mpdf->Output();

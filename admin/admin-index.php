<?php
    session_start();
    if($_SESSION['czy_zalogowany']!=1)
        {
            header('Location: index.php');
            exit();
        }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admina</title>
    <link href="style-index.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="korekta.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
        <div class="logo">
            <span class="material-symbols-outlined logoi">lan</span>VPS-KOTIKA</div>
        <nav>
            <div class="user"><b><span class="material-symbols-outlined ikonki">admin_panel_settings</span>Administrator:</b> <?php echo $_SESSION['admin-name']." ".$_SESSION['admin-surname']; ?></div>
            <ul>
                <li><a href="generate.php"><span class="material-symbols-outlined ikonki">add_circle</span>Generowanie nowych tokenów</a></li>
                <li><a href="list.php"><span class="material-symbols-outlined ikonki">group</span>Utworzeni użytkownicy</a></li>
                <li><a href="admin-logout.php"><span class="material-symbols-outlined ikonki">Logout</span>Wyloguj się</a></li>
            </ul>
        </nav>

        <?php
                if(isset($_SESSION['blad']))
                {
                
                   echo '<div class="alert">';
                   echo '<span class="fa fa-exclamation-circle"></span>';
                    echo '<span class="msg">'.$_SESSION['blad'].'</span>';
                   echo '<span class="material-symbols-outlined close">close</span>
                </div>';

                unset($_SESSION['blad']);

                echo <<< END
                <script>
                    let alert = document.querySelector(".alert");
                    alert.style.display = "block";
                </script>
                END;
                }
                
                if(isset($_SESSION['sukcest']))
                {
                
                   echo '<div class="alerts" id="alert-s">';
                   echo '<span class="fa fa-exclamation-circle"></span>';
                    echo '<span class="msg">'.$_SESSION['sukcest'].'</span>';
                   echo '<span class="material-symbols-outlined close2" id="close-s">close</span>
                </div>';

                unset($_SESSION['sukcest']);

                echo <<< END
                <script>
                    let alert-s = document.querySelector(".alert-s");
                    alerts-s.style.display = "block";
                </script>
                END;
                }
                ?>

    <?php 
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
            if($ilewierszy == 0) echo "<h1 class=\"info\">Nie utworzono jeszcze żadnych tokenów.</h1>";
            else
            {
                ECHO <<< END
                <main>
                <div style="margin-top: 50px;"></div>
                <div class="tokeny">
                <div class="headline">Tokeny aktywacyjne</div>
                <hr>
                <br>
                <br>
                <br>
                END;
                ?>
                <?php
                ECHO <<< END
                <table>
                <tr>
                <th>#</th>
                <th>Token</th>
                <th>Status</th>
                <th>Wygenerowano przez</th>
                <th>Zarządzanie</th>
                </tr>
                END;

                $licznik = 1;

                while($wiersz=$final->fetch_array())
                {
                    echo "<tr>";
                    echo "<td>".$licznik.".</td>";
                    echo "<td>".$wiersz['value']."</td>";
                    echo '<td><span class="material-symbols-outlined">done</span></td>
                        <td>Miłosz Kotarba</td>';
                    echo '<td class="list-item"><a href="token-delete.php?id='.$wiersz['id_token'].'"><span class="material-symbols-outlined" style="color: white; vertical-align: middle;">delete</span>Usuń</a></td>';
                    echo "</tr>";
                    $licznik++;
                }
                echo <<< END
                <tr>
                        <td colspan="4"><a href="generate-pdf.php" target="_blank">Wygeneruj PDF</a></td>
                        <td><a href="generate-pdf.php" title="Plik PDF zostanie otwarty w nowej karcie!" target="_blank"><span class="material-symbols-outlined" style="font-size: 2.5rem !important;">Download</span></a></td>
                    </tr>
                        </table>
                    </div>
                </main>
                END;
            }     
            $polaczenie->close();
        }
	?>
    <script>
        let sukcesowyprzycisk = document.getElementById("close-s");
        let sukcesowyalert = document.getElementById("alert-s");

        sukcesowyprzycisk.onclick = function () {
            sukcesowyalert.style.display = "none";
        }

    </script>
</body>
</html>

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
    <title>Lista użytkowników</title>
    <link href="style-index.css" type="text/css" rel="stylesheet" />
    <style type="text/css">
        table, table *
        {
            min-width: 0;
            padding: 10px 100px;
        }
        a
        {
            color: black;
            font-size: 19px;
        }
        #linkxd
        {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">Lista zarejestrowanych użytkowników</div>
    <hr style="width: 95%;"/>
    <br /><br /><br />
    <table>
        <thead>
            <th>Lp.</th>
            <th>Nazwisko i imię</th>
            <th>Login</th>
            <th>Token</th>
            <th>Data wygenerowania konta</th>
        </thead>
        <tbody>

        <?php
        require_once('connect.php');
        $polaczenie=new mysqli($db_host,$db_user,$db_password,$db_name);
            if($polaczenie->connect_errno!=0)
            {
                echo "<b>Błąd połączenia z bazą.</b> Informacja deweloperska: ".$polaczenie->connect_errno;
            }
            else
            {
                $query="SELECT * FROM users";
                $final=$polaczenie->query($query);
                $lp=0;
                while($wiersz=$final->fetch_assoc())
                {
                    $lp++;
                    echo "<tr>";
                    echo "<td>$lp.</td>";
                    echo "<td>".$wiersz['surname'].' '.$wiersz['name']."</td>";
                    echo "<td>".$wiersz['username']."</td>";
                    echo "<td>".$wiersz['token']."</td>";
                    echo "<td>".$wiersz['date']."</td>";
                    echo "</tr>";
                }
                $final->free_result();
                $polaczenie->close();
            }

        ?>
    </tbody>
    </table>
    <br />    
    <div id="linkxd"><a href="admin-index.php"><---- Powrót do strony głównej</a></div>
</body>
</html>
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
    <title>Generowanie tokenów</title>
    <meta charset="utf-8" />
    <link href="style-index.css" type="text/css" rel="stylesheet" />
    <style type="text/css">
    a
    {
        color: black;
    }
    </style>
</head>
<body>
    <h1>Generowanie tokenów</h1>
    <form action="generate2.php" method="post">
        <input type="number" placeholder="Liczba tokenów" autocomplete="off"  name="ilosc"/>
        <input type="submit" value="Wygeneruj"/>
    </form>

    <div style="color: red; margin-top: 20px; font-size: 20px;">
    <?php
        if(isset($_SESSION['error-ilosc']))
        {
            echo $_SESSION['error-ilosc'];
            unset($_SESSION['error-ilosc']);
        }
    ?>
    </div>
    
    <div style="color: green; margin-top: 20px; font-size: 20px;">
    <?php
        if(isset($_SESSION['token-info']))
        {
            echo "Sukces! Ilość wygenerowanych tokenów: <b>".$_SESSION['token-info']."</b>";
            unset($_SESSION['token-info']);
        }
    ?>
    </div>
    
    <div style="margin-top: 30px;">
    <a id="linkxd" href="admin-index.php"><---- Powrót do strony głównej</a>
    </div>
</body>
</html>
<?php
    session_start();
    if(isset($_SESSION['czy_zalogowany']))
    {
        header('Location: admin-index.php');
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
    <link href="style-login.css" type="text/css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    
    <div id="container">
        <form action="login-admin.php" method="post">
            <h2>Panel Administracyjny</h2>
            <div class="pozycja1">
            <input type="text" placeholder="Login" onfocus="this.placeholder=''" onblur="this.placeholder='Login'" name="login" autocomplete="off">
            <i class="fa fa-user"></i></div>

            <div class="pozycja2"><input type="password" placeholder="Hasło" onfocus="this.placeholder=''" onblur="this.placeholder='Hasło'" name="password">
            <i class="fa fa-key"></i>
            </div>

            <input type="submit" value="Zaloguj się" />
            <?php
                if(isset($_SESSION['error-login']))
                {
                    echo '<p>'.$_SESSION['error-login'].'</p>';
                    unset($_SESSION['error-login']);
                }
            ?>
            
        </form>
    </div>

</body>
</html>
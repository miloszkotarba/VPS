<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja Linux VPS-Kotika</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

    
    <div class="logo"><h1>Rejestracja konta na serwerze kotika</h1></div>
    <div class="content">
        <div class="form-box">
            <form action="rejestracja.php" method="post">
                <h1>Rejestracja Konta</h1>
                <hr />
                <input type="token" placeholder="Token" name="token" value="<?php if(isset($_SESSION['token'])) {echo $_SESSION['token']; unset($_SESSION['token']);} ?>" /></br>
                <div class="error">
                    <?php 
                        if(isset($_SESSION['e.token']))
                        {
                            echo $_SESSION['e.token'];
                            unset($_SESSION['e.token']);
                        }
                    ?>
                </div>

                <input type="text" placeholder="Nazwa użytkownika" name="username" value="<?php if(isset($_SESSION['username'])) {echo $_SESSION['username']; unset($_SESSION['username']);} ?>" /><br />
                <div class="error">
                    <?php 
                        if(isset($_SESSION['e.username']))
                        {
                            echo $_SESSION['e.username'];
                            unset($_SESSION['e.username']);
                        }
                    ?>
                </div>

                <input type="text" placeholder="Imię" name="name" value="<?php if(isset($_SESSION['name'])) {echo $_SESSION['name']; unset($_SESSION['name']);} ?>" /><br />
                <div class="error">
                    <?php 
                        if(isset($_SESSION['e.name']))
                        {
                            echo $_SESSION['e.name'];
                            unset($_SESSION['e.name']);
                        }
                    ?>
                </div>

                <input type="text" placeholder="Nazwisko" name="surname" value="<?php if(isset($_SESSION['surname'])) {echo $_SESSION['surname']; unset($_SESSION['surname']);} ?>" /><br />
                <div class="error">
                    <?php 
                        if(isset($_SESSION['e.surname']))
                        {
                            echo $_SESSION['e.surname'];
                            unset($_SESSION['e.surname']);
                        }
                    ?>
                </div>

                <input type="number" placeholder="Numer indeksu" name="index_number" value="<?php if(isset($_SESSION['index_number'])) {echo $_SESSION['index_number']; unset($_SESSION['index_number']);} ?>" /><br />
                <div class="error">
                    <?php 
                        if(isset($_SESSION['e.index_number']))
                        {
                            echo $_SESSION['e.index_number'];
                            unset($_SESSION['e.index_number']);
                        }
                    ?>
                </div>

                <input type="submit" value="Załóż konto" />
            </form>
            <?php
                if(isset($_SESSION['critic-error']))
                {
                    echo '<p style="margin-top: 35px; color: crimson; font-weight: bold; font-size: 22px;">'.$_SESSION['critic-error'].'</p>';
                    unset($_SESSION['critic-error']);
                }
            ?>

        </div>
    </div>

</body>
</html>
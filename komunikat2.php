<?php
session_start();
if(!isset($_SESSION['k.link']))
{
	header('Location: index.php');
	exit;
}
else
unset($_SESSION['k.link']);
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finał</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <style type="text/css">
        .footer
        {
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        #pass
        {
            position: absolute;
        }
        #haslo
        {
            position: relative;
            top: 40%;
            left: 13%;
            transform: translate(-50%,-50%);
            border-radius: 50%;
            width: 45px;
            height: 45px;
        }

        @media screen and (max-width: 1199px)
        {
            #haslo
            {
                display: none;
            }
            #pass
            {
                position: relative;
            }
        }
    </style>
</head>
<body class="p-3 m-0 border-0 bd-example">
    <div class="container">
        <div class="mt-3"></div>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Sukces!</h4>
            Pomyślnie utworzyliśmy Twoje konto.
        </div>
        <hr>
    <h2>Twoje dane dostępowe</h2>
        <div class="mt-3"></div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Nazwa użytkownika</label>
            <div class="col-sm-10">
	    <input type="text"  class="form-control-plaintext"  value="<?php echo $_SESSION['k.user']; ?>" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Hasło</label>
            <div class="col-sm-10">
	    <input type="text" id="pass" readonly class="form-control-plaintext"  value="<?php echo $_SESSION['k.haslo']; ?>">
	<button id="haslo" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">?</button>

                <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Zmiana hasła</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <p>Po zalogowaniu się na serwer zmień hasło komendą <b>passwd</b>.</p>
                        <p>Użycie: passwd nowe_hasło nowe_hasło</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Hostname</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext"  value="vps.kotika.pl">
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Port</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext"  value="96">
            </div>
        </div>
	<br>
	<p class="lead">Twoje konto jest aktywne do: <b><?php echo $_SESSION['k.data']; ?></b></p>

	<p><a class="lead" href=<?php echo '"https://vps.kotika.pl/~'.$_SESSION['k.user'].'"'?> target="_blank">Link do twojej strony.</a></p>
    </div>

    <!-- Footer -->
    <footer class="text-center text-lg-start bg-white text-muted footer">

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
            © 2022 Technologię dostarcza:
            <div class="text-reset fw-bold" style="display: inline-block;">Kotika</div>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>
</html>

use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    //Load Composer's autoloader
    //    require 'vendor/autoload.php';
    //        $mail = new PHPMailer(true);
    //            try {
    //                    //Server settings
    //                            $mail->SMTPDebug = 1;                      
    //                                    $mail->isSMTP();                                           
    //                                            $mail->Host       = 'mail.kotika.pl';                     
    //                                                    $mail->SMTPAuth   = true;                                   
    //                                                            $mail->Username   = 'robot@kotika.pl';                     
    //                                                                    $mail->Password   = 'Demodemo38';                               
    //                                                                            $mail->SMTPSecure = 'tls';            
    //                                                                                    $mail->Port       = 587;                              
    //
    //                                                                                            //Recipients
    //                                                                                                    $mail->setFrom('robot@kotika.pl', 'Portal Kotika');
    //                                                                                                            $mail->addAddress("$email", "$nazwa_do_wyslania");
    //                                                                                                                // $mail->addReplyTo('info@example.com', 'Information');
    //
    //                                                                                                                        //Attachments
    //                                                                                                                            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //                                                                                                                                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    //
    //                                                                                                                                        //Content
    //                                                                                                                                                $mail->isHTML(true);                                
    //                                                                                                                                                        $mail->CharSet  = 'UTF-8';
    //                                                                                                                                                                $mail->Subject = 'Reset hasła';
    //                                                                                                                                                                        $mail->Body    ='<!DOCTYPE html>
    //                                                                                                                                                                                <html lang="pl">
    //                                                                                                                                                                                          <head>
    //                                                                                                                                                                                                      <meta charset="UTF-8">
    //                                                                                                                                                                                                                  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    //                                                                                                                                                                                                                              <meta name="viewport" content="width=device-width, initial-scale=1.0">
    //                                                                                                                                                                                                                                          <title>Reset hasła</title>
    //                                                                                                                                                                                                                                                      
    //                                                                                                                                                                                                                                                                </head>
    //                                                                                                                                                                                                                                                                          <body style="margin:8%;font-family:sans-serif;text-align:justify;font-size:1.2rem;">
    //                                                                                                                                                                                                                                                                                      <div class="container">
    //                                                                                                                                                                                                                                                                                                    <div class="header" style="text-align:center;">
    //                                                                                                                                                                                                                                                                                                                    <h1 style="margin-top:0px;">Reset hasła!</h1>
    //                                                                                                                                                                                                                                                                                                                                  </div>
    //                                                                                                                                                                                                                                                                                                                                                <div class="content">Witaj<b> '.$nazwa_do_wyslania.'</b>, <br><br>
    //                                                                                                                                                                                                                                                                                                                                                                Aby ustawić nowe hasło do konta, kliknij w ten <a href="https://panel.kotika.pl/new-password.php?id='.$token.'">Link</a>.
    //                                                                                                                                                                                                                                                                                                                                                                            </div>
    //                                                                                                                                                                                                                                                                                                                                                                                            <br>
    //                                                                                                                                                                                                                                                                                                                                                                                                            Pozdrawiamy,<br>
    //                                                                                                                                                                                                                                                                                                                                                                                                                            <b>Zespół Helpdesk - Kotika</b>
    //                                                                                                                                                                                                                                                                                                                                                                                                                                          </div>
    //                                                                                                                                                                                                                                                                                                                                                                                                                                                      </div>
    //                                                                                                                                                                                                                                                                                                                                                                                                                                                                </body>
    //                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </html>';
    //                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $mail->send();
    //                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        $_SESSION['informacja']="Sukces! Wysłano kod aktywacyjny do zmiany hasła na e-mail.";
    //
    //                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } catch (Exception $e) {
    //                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "Nie wyslano maila. Blad: {$mail->ErrorInfo}";
    //                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            $_SESSION['blad']="<b>Błąd!</b> Nie udało się zresetować hasła.";
    //                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }

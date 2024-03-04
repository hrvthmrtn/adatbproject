<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
if($_SESSION['registerCode'] == 1){
    echo '<script>        
           function delayedFunction() {
			alert("Sikertelen regisztráció");
		}
		setTimeout(delayedFunction, 100);
        </script>';
    $_SESSION['registerCode']=10;
}
?>

    <!DOCTYPE html>
    <html lang="hu">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../assets/style.css">
        <title>Navbar példa</title>
    </head>
    <body>

<?php
switch ($_SESSION['userLevel']) {
    case 0:
        include_once ("../../view/common/navbars/user.php");
        break;
    case 1:
        include_once ("../../view/common/navbars/operator.php");
        break;
    default:
        include_once ("../../view/common/navbars/guest.php");
        break;
}
?>
        <form onsubmit="return checkPassword();" action="../../../frontend/controller/registrationController.php" method="post" class="form">
            <h2>Regisztráció</h2>
            <input type="text" placeholder="felhasználónév" name="username" class="textinput" required></br>
            <input type="password" placeholder="jelszó" name="password1" id="password1" class="textinput" required></br>
            <input type="password" placeholder="jelszó mégegyszer" name="password2" id="password2" class="textinput" required></br>
            <input type="text" placeholder="név" name="name" class="textinput" required></br>
            </br>
            <input type="submit" value="Regisztráció" name="registration" class="submit"></br>
        </form>
        <script>
            function checkPassword() {
                var psw1 = document.getElementById("password1").value;
                var psw2 = document.getElementById("password2").value;
                if (psw1 != psw2) {
                    alert("A két jelszó nem egyezik meg!");
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>
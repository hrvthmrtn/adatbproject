<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
if($_SESSION['logincode'] == 1){
    echo '<script>        
           function delayedFunction() {
			alert("Sikertelen bejelentkezés");
		}
		setTimeout(delayedFunction, 100);
        </script>';
    $_SESSION['logincode']=10;
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
    <form action="../../../frontend/controller/loginController.php" method="post" class="form">
            <h2>Bejelentkezés</h2>
            <input type="text" placeholder="Felhasználónév" name="username" class="textinput" required></br>
            <input type="password" placeholder="jelszó" name="password" class="textinput" required></br></br>
            <input type="submit" value="Bejelentkezés" name="login" class="submit">
        </form>
    </body>
</html>
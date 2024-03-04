<?php
include_once('../../../backend/functions/getData.php');
error_reporting(E_ERROR | E_PARSE);
session_start();
if ($_SESSION['userLevel'] != 1){
    header("Location: ../../../frontend/view/pages/login.php");
}
if($_SESSION['userAddError'] == 1){
    echo '<script>        
           function delayedFunction() {
			alert("Ilyen felhasználó már létezik");
		}
		setTimeout(delayedFunction, 100);
        </script>';
    $_SESSION['userAddError']=10;
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
        <form onsubmit="return checkPassword();" action="../../../frontend/controller/userController.php" method="post" class="form">
            <h2>Felhasználó létrehozása</h2>
            <input type="text" placeholder="felhasználónév" name="username" class="textinput" required></br>
            <input type="password" placeholder="jelszó" name="password1" id="password1" class="textinput" required></br>
            <input type="password" placeholder="jelszó mégegyszer" name="password2" id="password2" class="textinput" required></br>
            <input type="text" placeholder="név" name="name" class="textinput" required></br>
            </br>
            <input type="submit" value="Mentés" name="saveUser" class="submit"></br>
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
    <table cellspacing="0" cellpadding="1" >
        <tr>
            <th colspan="5">
                <h1>felhasználók</h1>
            </th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Felhasználónév</th>
            <th>Név</th>
        </tr>
        <tr>
            <?php
            $user = getUsers();
            while ($row = mysqli_fetch_assoc($user)) {
                echo '<tr class="whitehover">';
                echo '<td>' . $row['dolgozo_azonosito'] . '</td>';
                echo '<td>' . $row['elotag'] . '</td>';
                echo '<td>' . $row['nev'] . '</td>';
                echo '<td><form action="../../../frontend/controller/userController.php" method="post">
                                    <input type="text" name="userId" value="'.$row['dolgozo_azonosito'].'" class="hidden">
                                    <input type="submit" value="Törlés" name="delete">
                                       </form></td>';
                echo '</tr>';
            }
            mysqli_free_result($user);
            ?>
        </tr>
    </table>

    </body>
</html>

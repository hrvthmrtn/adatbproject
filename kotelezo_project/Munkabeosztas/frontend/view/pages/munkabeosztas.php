<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include_once('../../../backend/functions/getData.php');
if($_SESSION['logincode'] == 0){
    echo '<script>        
           function delayedFunction() {
			alert("Sikeres bejelentkezés");
		}
		setTimeout(delayedFunction, 100);
        </script>';
    $_SESSION['logincode']=10;
}
if($_SESSION['registerCode'] == 2){
    echo '<script>        
           function delayedFunction() {
			alert("Sikeres regisztráció");
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
<table cellspacing="0" cellpadding="1" >
    <tr>
        <th colspan="7">
            <h1>Műszakbeosztás</h1>
        </th>
    </tr>
    <tr>
        <th>Munkás</th>
        <th>Részleg</th>
        <th>Munkaóra</th>
        <th>Dátum</th>
        <th>Műszakbeosztás</th>
        <th>Feladatkör</th>
    </tr>
    <tr>
        <?php
        $muszakok = getMuszakAdmin();
        $previousUserId = null;

        while ($row = mysqli_fetch_assoc($muszakok)) {
            echo '<tr class="whitehover">';
            echo '<td>' . $row['nev'] . '</td>';
            echo '<td>' . $row['reszleg'] . '</td>';
            echo '<td>' . $row['munkaoraszam'] . '</td>';
            echo '<td>' . $row['datum'] . '</td>';

            // Műszakbeosztás beállítása az előző sor alapján
            if ($row['muszakbeosztas'] != $previousUserId) {
                switch ($row['muszakbeosztas']) {
                    case 1:
                        $muszakbeosztas = 'nappalos';
                        break;
                    case 2:
                        $muszakbeosztas = 'éjszakás';
                        break;
                    case 3:
                        $muszakbeosztas = 'pihenőnap';
                        break;
                    case 4:
                        $muszakbeosztas = 'szabadnap';
                        break;
                }

                $previousUserId = $row['muszakbeosztas'];
            }

            echo '<td>' . $muszakbeosztas . '</td>';
            echo '<td>' . $row['feladatkor'] . '</td>';
            echo '</tr>';
        }
        mysqli_free_result($muszakok);
        ?>
    </tr>
</table>
    </body>
</html>

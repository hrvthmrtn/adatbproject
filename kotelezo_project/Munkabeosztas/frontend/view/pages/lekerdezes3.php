
<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include_once ("../../../backend/functions/getData.php");
if ($_SESSION['userLevel'] != 1){
    header("Location: ../../../frontend/view/pages/login.php");
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
<table cellspacing="0" cellpadding="1">
    <tr>
        <th colspan="4">
            <h1>Dolgozószám részlegenként (3. lekérdezés)</h1>
        </th>
    </tr>
    <tr>
        <th>Dátum</th>
        <th>Részleg</th>
        <th>Beosztás</th>
        <th>Dolgozószám</th>
    </tr>
    <?php
    $lekeredezes3 = lekerdezes3();
    while ($row = mysqli_fetch_assoc($lekeredezes3)) {
        echo '<tr class="whitehover">';
        echo '<td>' . $row['datum'] . '</td>';
        echo '<td>' . $row['reszleg'] . '</td>';
        if ($row['beosztas'] == 0){
            echo '<td>munkás</td>';
        }else{
            echo '<td>operátor</td>';
        }
        echo '<td>' . $row['dolgozo'] . '</td>';
        echo '</tr>';
    }
    mysqli_free_result($lekeredezes3);
    ?>
</table>
    </body>
</html>

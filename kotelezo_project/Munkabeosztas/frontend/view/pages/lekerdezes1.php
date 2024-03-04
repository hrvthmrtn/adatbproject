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
        <th colspan="7">
            <h1>Munkaórák és Pihenőnapok (1. lekérdezés)</h1>
        </th>
    </tr>
    <tr>
        <th>Év</th>
        <th>Hónap</th>
        <th>Dolgozo azonosító</th>
        <th>Dolgozo név</th>
        <th>munkaköri beosztás</th>
        <th>munkaórák száma</th>
        <th>pihenőnapok száma</th>
    </tr>
    <?php
    $lekeredezes1 = lekerdezes1();
    while ($row = mysqli_fetch_assoc($lekeredezes1)) {
        echo '<tr class="whitehover">';
        echo '<td>' . $row['ev'] . '</td>';
        echo '<td>' . $row['honap'] . '</td>';
        echo '<td>' . $row['azonosito'] . '</td>';
        echo '<td>' . $row['dolgozo_neve'] . '</td>';
        if ($row['beosztas'] == 0){
            echo '<td>munkás</td>';
        }else{
            echo '<td>operátor</td>';
        }
        echo '<td>' . $row['munkaorak_szama'] . '</td>';
        echo '<td>' . $row['pihenonapok_szama'] . '</td>';
        echo '</tr>';
    }
    mysqli_free_result($lekeredezes1);
    ?>
</table>
    </body>
</html>

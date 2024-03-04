<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include_once ('../../../backend/functions/getData.php');
if($_SESSION['dolgozhatError'] == 2){
    echo '<script>        
           function delayedFunction() {
			alert("Ez a munkás erre a napra foglalt");
		}
		setTimeout(delayedFunction, 100);
        </script>';
    $_SESSION['dolgozhatError']=10;
}
if ($_SESSION['userLevel'] != 1){
    header("Location: ../../../frontend/view/pages/login.php");
}
$beosztasobj = getMuszakUpdate($_SESSION['updatingBeosztas']);
$beosztas = mysqli_fetch_assoc($beosztasobj);
$elso = null;
$masodik = null;
$harmadik = null;
$negyedik = null;
switch ($beosztas['muszakbeosztas']){
    case 1:
        $elso = 'selected';
        break;
    case 2:
        $masodik='selected';
        break;
    case 3:
        $harmadik='selected';
        break;
    case 4:
        $negyedik='selected';
        break;
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
        <th colspan="3">
            <h1>Készítette tábla tartalma (logolás)</h1>
        </th>
    </tr>
    <tr>
        <th>MűszakbeosztásID</th>
        <th>Felelős operátor</th>
        <th>Pontos időpont</th>
    </tr>
    <?php
    $keszitette = keszitette();
    while ($row = mysqli_fetch_assoc($keszitette)) {
        echo '<tr class="whitehover">';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nev'] . '</td>';
        echo '<td>' . $row['datum'] . '</td>';
        echo '</tr>';
    }
    mysqli_free_result($keszitette);
    ?>
</table>
    </body>
</html>

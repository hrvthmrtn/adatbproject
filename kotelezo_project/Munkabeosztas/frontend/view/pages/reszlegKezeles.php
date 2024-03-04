<?php
error_reporting(E_ERROR | E_PARSE);
include_once ("../../../backend/functions/getData.php");
session_start();
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
<form action="../../../frontend/controller/reszlegController.php" method="post" class="form">
    <h2>Részleg felvétel</h2>
    <input type="text" placeholder="Részleg neve" name="name" class="textinput" required></br>
    <input type="text" placeholder="Részleg helye" name="address" class="textinput" required></br>
    <div class="flexdiv">
        <label for="select">Részlegvezető:</label>
        <select class="textinput" name="leader" id="select">
            <?php
            $users = getUsers();
            while ($row = mysqli_fetch_assoc($users)) {
                echo '<option value='.$row['dolgozo_azonosito'].'>'.$row['nev'].'</option>';
            }
            mysqli_free_result($users);
            ?>
        </select>
    </div>
    </br>
    <input type="submit" value="felvétel" name="save" class="submit"></br>
</form>

<table cellspacing="0" cellpadding="1">
    <tr>
        <th colspan="5">
            <h1>Részlegek</h1>
        </th>
    </tr>
    <tr>
        <th>ID</th>
        <th>Részleg neve</th>
        <th>Részleg helye</th>
        <th>Részleg vezető</th>
    </tr>
    <?php
    $reszleg = getReszleg();
    while ($row = mysqli_fetch_assoc($reszleg)) {
        echo '<tr class="whitehover">';
        echo '<td>' . $row['reszleg_azonosito'] . '</td>';
        echo '<td>' . $row['reszleg_neve'] . '</td>';
        echo '<td>' . $row['reszleg_helye'] . '</td>';
        echo '<td>';
        if ($row['vezeto'] == null) {
            echo '<form action="../../../frontend/controller/reszlegController.php" method="post">
                        <div class="centered">
                        <input type="text" value="' . $row['reszleg_azonosito'] . '" class="hidden" name="reszlegAddAzonosito">
                        <select class="textinput reszleg" name="leaderAdd" id="select">
                            ';
            $users = getUsers();
            while ($userRow = mysqli_fetch_assoc($users)) {
                echo '<option value=' . $userRow['dolgozo_azonosito'] . '>' . $userRow['nev'] . '</option>';
            }
            mysqli_free_result($users);
            echo '</select>
            <input type="submit" value="Hozzáad" name="reszlegAdd">
            </div>
                      </form>';
        } else {
            echo $row['vezeto'];
        }
        echo '</td>';
        echo '<td>
                <form action="../../../frontend/controller/reszlegController.php" method="post">
                    <input type="text" name="reszlegId" value="' . $row['reszleg_azonosito'] . '" class="hidden">
                    <input type="submit" value="Törlés" name="delete">
                </form>
              </td>';
        echo '</tr>';
    }
    mysqli_free_result($reszleg);
    ?>
</table>

    </body>
</html>

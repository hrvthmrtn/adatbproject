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
<form action="../../../frontend/controller/munkabeosztasController.php" method="post" class="form">
    <h2>Műszakbeosztás felvétel</h2>
    <div class="flexdiv">
        <label for="select">Munkás:</label>
        <select class="textinput" name="userid" id="select">
            <?php
            $users = getUsers();
            while ($row = mysqli_fetch_assoc($users)) {
                echo '<option value='.$row['dolgozo_azonosito'].'>'.$row['nev'].'</option>';
            }
            mysqli_free_result($users);
            ?>
        </select>
    </div>
    <div class="flexdiv">
        <label for="select1">Részleg:</label>
        <select class="textinput" name="reszleg" id="select1">
            <?php
            $reszleg = getReszleg();
            while ($row = mysqli_fetch_assoc($reszleg)) {
                echo '<option value='.$row['reszleg_azonosito'].'>'.$row['reszleg_neve'].'</option>';
            }
            mysqli_free_result($reszleg);
            ?>
        </select>
    </div>
    <input type="number" placeholder="Munkaóraszám" min="1" max="12" name="munkaora" id="munkaora" class="textinput" required></br>
    <input type="date" placeholder="Dátum" name="date" class="textinput" min="<?php echo date('Y-m-d', strtotime('+1 week')); ?>" required></br>
    <div class="flexdiv">
        <label for="select2">Munkabeosztás:</label>
        <select class="textinput" name="munkatipus" id="select2" onchange="checkMunkatipus()">
            <option value="1">nappalos</option>
            <option value="2">éjszakás</option>
            <option value="3">pihenőnap</option>
            <option value="4">szabadság</option>
        </select>
    </div>

    <input type="text" placeholder="Feladatkör" id="feladatkor" name="feladatkor" class="textinput" required></br>
    <input type="submit" value="felvétel" name="save" class="submit"></br>
</form>
<table cellspacing="0" cellpadding="1" >
    <tr>
        <th colspan="8">
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
        <th colspan="2">Műveletek</th>
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
            echo '<td><form action="../../../frontend/controller/munkabeosztasController.php" method="post">
                        <input type="text" name="muszakId1" value="'.$row['id'].'" class="hidden">
                        <input type="submit" value="Módosít" name="update">
                            </form></td>';
            echo '<td><form action="../../../frontend/controller/munkabeosztasController.php" method="post">
                        <input type="text" name="muszakId" value="'.$row['id'].'" class="hidden">
                        <input type="submit" value="Törlés" name="delete">
                            </form></td>';
            echo '</tr>';
        }
        mysqli_free_result($muszakok);
        ?>
    </tr>
</table>
<script>
    function checkMunkatipus() {
        var munkatipus = document.getElementById('select2').value;
        var munkaora = document.getElementById('munkaora');
        var feladatkor = document.getElementById('feladatkor');
        var reszleg = document.getElementById('select1')

        if (munkatipus == '3' || munkatipus == '4') {
            munkaora.value = "";
            feladatkor.value = "";
            reszleg.value="";
            munkaora.disabled = true;
            feladatkor.disabled = true;
            reszleg.disabled = true;

        } else {
            munkaora.disabled = false;
            feladatkor.disabled = false;
            reszleg.disabled = false;
        }
    }

</script>
    </body>
</html>

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
<form action="../../../frontend/controller/updatemunkabeosztasController.php" method="post" class="form"">
    <h2>Munkabeosztás módosítás</h2>
    <div class="flexdiv">
        <label for="select">Munkás:</label>
        <select class="textinput" name="userid" id="select">
            <?php echo '<option value="'.$beosztas['dolgozoid'].'">' .$beosztas['nev'] . '</option>'?>
            <?php
            $users = getUsers();
            while ($row = mysqli_fetch_assoc($users)) {
                if ($row['dolgozo_azonosito'] != $beosztas['dolgozoid']) {
                    echo '<option value=' . $row['dolgozo_azonosito'] . '>' . $row['nev'] . '</option>';
                }
            }
            mysqli_free_result($users);
            ?>
        </select>
    </div>
    <div class="flexdiv">
        <label for="select1">Részleg:</label>
        <select class="textinput" name="reszleg" id="select1">
            <?php echo '<option value="'.$beosztas['reszleg_azonosito'].'">' .$beosztas['reszlegnev'] . '</option>'?>
            <?php
            $reszleg = getReszleg();
            while ($row = mysqli_fetch_assoc($reszleg)) {
            if ($row['reszleg_azonosito'] != $beosztas['reszlegid']) {
                echo '<option value=' . $row['reszleg_azonosito'] . '>' . $row['reszleg_neve'] . '</option>';
            }
            }
            mysqli_free_result($reszleg);
            ?>
        </select>
    </div>
    <input type="number" placeholder="Munkaóraszám" min="1" value="<?php echo $beosztas['munkaoraszam']?>" max="12" name="munkaora" id="munkaora" class="textinput" required></br>
    <input type="date" placeholder="Dátum" name="date" value="<?php echo $beosztas['datum']?>" class="textinput" min="<?php echo date('Y-m-d', strtotime('+1 week')); ?>" required></br>
    <div class="flexdiv">
        <label for="select2">Munkabeosztás:</label>
        <select class="textinput" name="munkatipus" id="select2" onchange="checkMunkatipus()">
            <option value="1" <?php echo $elso?> >nappalos</option>
            <option value="2" <?php echo $masodik?> >éjszakás</option>
            <option value="3" <?php echo $harmadik?> >pihenőnap</option>
            <option value="4" <?php echo $negyedik?> >szabadság</option>
        </select>

        <script>
            window.onload = function() {
                checkMunkatipus();
            };
            function setDefaultOption(selectElement, defaultValue) {
                for (var i = 0; i < selectElement.options.length; i++) {
                    if (selectElement.options[i].value === defaultValue) {
                        selectElement.selectedIndex = i;
                        break;
                    }
                }
            }
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
        </select>
    </div>

    <input type="text" placeholder="Feladatkör" value="<?php echo $beosztas['feladatkor']?>" id="feladatkor" name="feladatkor" class="textinput" required></br>
    <input type="submit" value="Módosít" name="update" class="submit"></br>
</form>

</body>
</html>

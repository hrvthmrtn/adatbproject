<?php
include_once("db.php");
include_once("../../backend/functions/getData.php");
function registration($username, $password1, $name){
    $connect = connectToDatabase();
    $usedname = getUsername($username);
    if ($usedname!=null){
        $_SESSION['registerror'] = 2;
        return false;
    }
    $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($connect, "INSERT INTO munkasok (elotag, jelszo, nev) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $name);
    $success = mysqli_stmt_execute($stmt);
    if (!$success) {
        die(mysqli_error($connect));
    }

    $_SESSION['username'] = $username;
    $_SESSION['userLevel'] = 0;
    $_SESSION['registrationCode'] = 0;
    mysqli_close($connect);
    return true;
}

function saveReszleg($name, $address, $leader){
    $connect = connectToDatabase();
    $usedname = getReszlegName($name);
    if ($usedname!=null){
        $_SESSION['reszlegError'] = 1;
        return false;
    }

    $stmt = mysqli_prepare($connect, "INSERT INTO reszlegek (reszleg_neve, reszleg_helye, reszleg_vezetoje) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $name, $address, $leader);
    $success = mysqli_stmt_execute($stmt);
    if (!$success) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return true;
}

function saveUser($username, $password1, $name){
    $connect = connectToDatabase();
    $usedname = getUsername($username);
    if ($usedname!=null){
        $_SESSION['userAddError'] = 1;
        return false;
    }
    $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($connect, "INSERT INTO munkasok (elotag, jelszo, nev) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $name);
    $success = mysqli_stmt_execute($stmt);
    if (!$success) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return true;
}

function saveMunkabeosztas($munkas,$reszleg,$munkaora,$date,$beosztas,$feladat){
    $connect = connectToDatabase();
    $dolgozhat = getDolgozhat($munkas);
    $dolgozhate = mysqli_fetch_assoc($dolgozhat);
    if ($dolgozhate['datum'] == $date){
        $_SESSION['dolgozhatError'] = 2;
        return false;
    }
    $stmt = mysqli_prepare($connect, "INSERT INTO muszakbeosztasok (dolgozo_azonosito, reszleg_azonosito, munkaoraszam, datum, muszakbeosztas, feladatkor) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iiisis",$munkas,$reszleg, $munkaora, $date, $beosztas, $feladat);
    $success = mysqli_stmt_execute($stmt);
    if (!$success) {
        die(mysqli_error($connect));
    }
    $idresult = getBeosztasMaxId();
    $id = mysqli_fetch_assoc($idresult);
    $userresult = getUserIdByName($_SESSION['username']);
    $userid = mysqli_fetch_assoc($userresult);
    saveKeszit($id['id'],$userid['azonosito']);
    mysqli_close($connect);
    return true;
}

function saveKeszit($id,$operator){
    $connect = connectToDatabase();
    $datum = (new DateTime("now"))->format('Y-m-d H:i:s');
    date_default_timezone_set('Europe/Berlin');
    $stmt = mysqli_prepare($connect, "INSERT INTO keszit (muszakbeszotas_id,felelos_operator,datum) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $id, $operator, $datum);
    $success = mysqli_stmt_execute($stmt);
    if (!$success) {
        die(mysqli_error($connect));
    }

    mysqli_close($connect);
    return true;
}
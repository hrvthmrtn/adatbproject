<?php
include_once("db.php");
include_once ('getData.php');
session_start();
function addLeader($reszleg_id, $munkas_id){
    if ( !($connect = connectToDatabase()) ) {
        return false;
    }
    $stmt = mysqli_prepare($connect, "UPDATE reszlegek SET reszleg_vezetoje = ? WHERE reszleg_azonosito=?");
    mysqli_stmt_bind_param($stmt, "ii", $munkas_id, $reszleg_id);
    $success = mysqli_stmt_execute($stmt);
    if ($success == false) {
        die(mysqli_error($connect));
    }
    mysqli_close($connect);
    return true;
}

function updateMuszakbeosztas($userid, $reszleg, $munkaora, $date, $munkatipus, $feladatkor,$changedsession){
    if ( !($connect = connectToDatabase()) ) {
        return false;
    }
    if (!isset($reszleg) || $reszleg == null){
        $reszlegchange = getreszlegchange($changedsession);
        $reszlegid = mysqli_fetch_assoc($reszlegchange);
    }

    if ($reszleg==null){
        $stmt = mysqli_prepare($connect, "UPDATE muszakbeosztasok SET dolgozo_azonosito = ?, reszleg_azonosito = ?, munkaoraszam = ?, datum = ?, muszakbeosztas = ?, feladatkor = ? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "iiisisi", $userid, $reszlegid['reszleg_azonosito'],$munkaora,$date,$munkatipus,$feladatkor,$_SESSION['updatingBeosztas']);
    }else {
        $stmt = mysqli_prepare($connect, "UPDATE muszakbeosztasok SET dolgozo_azonosito = ?, reszleg_azonosito = ?, munkaoraszam = ?, datum = ?, muszakbeosztas = ?, feladatkor = ? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "iiisisi", $userid, $reszleg,$munkaora,$date,$munkatipus,$feladatkor,$_SESSION['updatingBeosztas']);
    }


    $success = mysqli_stmt_execute($stmt);
    if ($success == false) {
        die(mysqli_error($connect));
    }
    mysqli_close($connect);
    $_SESSION['updatingBeosztas'] = 0;

    return true;
}


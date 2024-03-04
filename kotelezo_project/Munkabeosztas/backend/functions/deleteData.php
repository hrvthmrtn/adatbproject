<?php
include_once("db.php");
function deleteUser($id){
    if (!($connect = connectToDatabase())) {
        return false;
    }
    $result = mysqli_query( $connect,"DELETE FROM munkasok WHERE dolgozo_azonosito = '$id'");
    if ($result == false) {
        die(mysqli_error($connect));
    }
    mysqli_close($connect);
    return true;
}

function deleteReszleg($id){
    if (!($connect = connectToDatabase())) {
        return false;
    }
    $result = mysqli_query( $connect,"DELETE FROM reszlegek WHERE reszleg_azonosito = '$id'");
    if ($result == false) {
        die(mysqli_error($connect));
    }
    mysqli_close($connect);
    return true;
}

function deletemuszak($id){
    if (!($connect = connectToDatabase())) {
        return false;
    }
    $result = mysqli_query( $connect,"DELETE FROM muszakbeosztasok WHERE id = '$id'");
    if ($result == false) {
        die(mysqli_error($connect));
    }
    mysqli_close($connect);
    return true;
}
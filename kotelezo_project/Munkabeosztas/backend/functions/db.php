<?php
function connectToDatabase() {

    $conn = mysqli_connect("localhost", "root", "") or die("Nem sikerült csatlakozni!");
    if (false == mysqli_select_db($conn, "muszakbeosztas")) {
        return null;
    }

    mysqli_query($conn, 'SET character_set_results=utf8');
    mysqli_set_charset($conn, 'utf8');

    return $conn;
}
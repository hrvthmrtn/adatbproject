<?php
session_start();
include_once ('../../backend/functions/insertData.php');
include_once ('../../backend/functions/deleteData.php');
if (isset($_POST['save'])){
    $save = saveMunkabeosztas($_POST['userid'],$_POST['reszleg'],$_POST['munkaora'],$_POST['date'],$_POST['munkatipus'],$_POST['feladatkor']);
    header("Location: ../../frontend/view/pages/munkabeosztasKezeles.php");
}

if (isset($_POST['delete'])){
    $delete = deletemuszak($_POST['muszakId']);
    header("Location: ../../frontend/view/pages/munkabeosztasKezeles.php");
}

if (isset($_POST['update'])){
    $_SESSION['updatingBeosztas'] = $_POST['muszakId1'];
    header("Location: ../../frontend/view/pages/updatemunkabeosztas.php");
}
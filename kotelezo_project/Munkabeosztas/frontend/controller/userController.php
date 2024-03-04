<?php
include_once('../../backend/functions/deleteData.php');
include_once ('../../backend/functions/insertData.php');
if(isset($_POST['delete'])){
    $deleted = deleteUser($_POST['userId']);
    header("Location: ../../frontend/view/pages/felhasznaloKezeles.php");
}

if (isset($_POST['saveUser'])){
    $saved = saveUser($_POST['username'],$_POST['password1'],$_POST['name']);
    header("Location: ../../frontend/view/pages/felhasznaloKezeles.php");
}
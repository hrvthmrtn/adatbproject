<?php
include_once('../../backend/functions/insertData.php');
include_once ('../../backend/functions/deleteData.php');
include_once ('../../backend/functions/updateData.php');
if(isset($_POST['save'])){
    $save = saveReszleg($_POST['name'], $_POST['address'], $_POST['leader']);
    if ($save == true) {
        header("Location: ../../frontend/view/pages/reszlegKezeles.php");
    }
}

if(isset($_POST['delete'])){
    $deleted = deleteReszleg($_POST['reszlegId']);
    header("Location: ../../frontend/view/pages/reszlegKezeles.php");
}

if (isset($_POST['reszlegAdd'])){
    $addLeader = addLeader($_POST['reszlegAddAzonosito'],$_POST['leaderAdd']);
    header("Location: ../../frontend/view/pages/reszlegKezeles.php");
}
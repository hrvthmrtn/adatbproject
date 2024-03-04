<?php
include_once ('../../backend/functions/updateData.php');
session_start();
if(isset($_POST['update'])){
    $update = updateMuszakbeosztas($_POST['userid'],$_POST['reszleg'],$_POST['munkaora'],$_POST['date'],$_POST['munkatipus'],$_POST['feladatkor'],$_SESSION['updatingBeosztas']);
    if ($update == true){
        header("Location: ../../frontend/view/pages/munkabeosztasKezeles.php");
    }

}
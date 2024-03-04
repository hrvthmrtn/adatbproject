<?php
include_once('../../backend/functions/insertData.php');
include_once('../../backend/functions/getData.php');
if(isset($_POST['registration'])){
    if(!empty($_POST['username']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['name'])){
        $registration = registration($_POST['username'],$_POST['password1'],$_POST['name']);
        if ($registration == true){
            header("Location: ../../frontend/view/pages/munkabeosztas.php");
        }
    }
}
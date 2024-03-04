<?php
include_once("../../backend/functions/getData.php");
if(isset($_POST['login'])){
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        $login = login($_POST['username'],$_POST['password']);
        if ($login == true) {
            var_dump($_SESSION['userLevel']);
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['logincode'] = 0;
            header("Location: ../../frontend/view/pages/munkabeosztas.php");
        }else{
            $_SESSION['logincode'] = 1;
            header("Location: ../../frontend/view/pages/login.php");

        }

    }
}
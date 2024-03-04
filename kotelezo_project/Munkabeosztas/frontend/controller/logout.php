<?php
session_start();
$_SESSION['userLevel'] = 3;
header('Location: ../../frontend/view/pages/login.php');
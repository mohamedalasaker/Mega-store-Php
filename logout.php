
<?php 
session_start();
require_once 'classes/User.php';
$user = new User;
if($user->isLogged()){
    $_SESSION = [];
    $_SESSION['login_message'] = 'You have loged out';
    header("location:index.php");
    die();
}elseif(!$user->isLogged()){
    header("location:index.php");
    die();
}

    
    



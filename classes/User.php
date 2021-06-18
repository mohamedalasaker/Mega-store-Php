<?php 
class User {

    public function isLogged(){
        return isset($_SESSION['is_logged']) == true;
    }
    public function isAdmin(){
        return isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
    }


}
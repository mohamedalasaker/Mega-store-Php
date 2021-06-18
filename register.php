<?php 



$title = 'register';
require_once 'templates/header.php';
require_once 'templates/nav-bar.php';
require_once 'config/connection.php';
require_once 'config/app.php';
if(isset($_SESSION["is_logged"])){
    header("location:index.php");
    die();
}


$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $password_confirm = mysqli_real_escape_string($conn,$_POST['password_confirm']);

    if(empty($email)) array_push($errors,'Email is required');
    if(empty($name)) array_push($errors,'Name is required');
    if(empty($password)) array_push($errors,'Password is required');
    if(empty($password_confirm)) array_push($errors,'Password confirmation is required');
    if($password != $password_confirm) array_push($errors,'Passwords doea not match');

    if(!count($errors)){
        $user = $conn->query("select id ,email from users where email='$email' limit 1");

        if($user->num_rows){
            array_push($errors,'User alredy exists');
        }
    }

    if(!count($errors)){
        $password = password_hash($password,PASSWORD_DEFAULT);
        $conn->query(" INSERT INTO `users` (`email`, `name`,`password`) VALUES ('$email', '$name', '$password');");

        $_SESSION['is_logged'] = true;
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['user_name'] = $name;
        $_SESSION['login_message'] = "$name You are welcome to our website";
        header("location:index.php");
        die();
    
    }
}


?>

<div id="register" class="container pt-5">

    <h4 class="text-center">welcome to our website</h4>
    <h5 class="text-center text-success">please fill the form to register a new user^_^</h5>
    <hr>
    <?php require_once 'templates/errors.php' ?>
    <form action="" method="POST" class="pt-3" style="padding-bottom: 300px;">
        <div class="row">
            
            <div class="form-group col-8 offset-2">
                <label for="email" >Email :</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" value="<?php if(count($errors))echo $email ?>">
            </div>
            
            <div class="form-group col-8 offset-2">
                <label for="email" >Name :</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" value="<?php if(count($errors))echo $name ?>">
            </div>
            
            <div class="form-group col-8 offset-2">
                <label for="password" >Password :</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password">
            </div>
            
            <div class="form-group col-8 offset-2">
                <label for="password_confirm" >Confirm password :</label>
                <input type="password" name="password_confirm" class="form-control" placeholder="Confirm assword">
            </div>
            <a href="login.php" class="col-6 offset-2">you have an account?</a>

            <div class="col-8 offset-2">
                <button class="btn btn-success send-register-form">send</button>
            </div>

        </div>
    </form>
</div>







<?php require_once 'templates/footer.php'?>
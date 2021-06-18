<?php 

$title = 'Change reset';
require_once 'templates/header.php';
require_once 'templates/nav-bar.php';
require_once 'config/connection.php';
require_once 'config/app.php';
require_once 'classes/User.php';
$user = new User;
if($user->isLogged()){
    header("location:index.php"); 
    die();

}

if(!isset($_GET['token']) || !$_GET['token'] ){
    die('You dont have a token to take change password');
}


$now = date("Y-m-d H:i:s");

$sql = $conn->prepare(" select * from password_reset where token=? and expires > '$now'");
$sql->bind_param('s',$token);
$token = $_GET['token'];
$sql->execute();
$result = $sql->get_result();

if(!$result->num_rows){
    die("token is not valid");
}

$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $passwordConfirm = mysqli_real_escape_string($conn,$_POST['password_confirmation']);
    if(!$password) array_push($errors,'Passowrd is requeird');
    if(!$passwordConfirm) array_push($errors,'Passowrd confirmation is requeird');
    if($password != $passwordConfirm && $passwordConfirm){
        array_push($errors,'passwords does not match');
    }
    
    if(!count($errors)){        
        $hashedPassord = password_hash($password,PASSWORD_DEFAULT);
        $userId = $result->fetch_assoc()['user_id'];
        $conn->query(" update users set password ='$hashedPassord' where id='$userId'");
        $conn->query(" delete from password_reset where user_id='$userId'");
        $_SESSION['login_message'] = 'your password have been changed now login';


        header('location:login.php');
        die();
    }




    
}

?>

<div id="password_change" class="container pt-5">

    <h4 class="text-center">Change password!</h4>
    <h5 class="text-center text-success">please fill the form to change your password</h5>
    <hr>
    <?php  require_once 'templates/errors.php'?>
    <?php  require_once 'templates/message.php'?>

    <form action="" method="POST" class="pt-3" style="padding-bottom: 300px;">
        <div class="row">
            
            <div class="form-group col-8 offset-2">
                <label for="password" >Enter your new password :</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your new password">
            </div>
            <div class="form-group col-8 offset-2">
                <label for="password_confiramtion" >Confirm password :</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
            </div>
            
            <div class="col-8 offset-2">
                <button class="btn btn-success reset-password-form">Change password!</button>
            </div>

        </div>
    </form>
</div>

<?php 
require_once 'templates/footer.php';
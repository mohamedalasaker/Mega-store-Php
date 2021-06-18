<?php 

$title = 'login';
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

$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    if(empty($email)) array_push($errors,'Email is required');
    if(empty($password)) array_push($errors,'Password is required');
    
    if(!count($errors)){
        $user = $conn->query("select role,id,name ,email,password from users where email='$email' limit 1");
        
        if(!$user->num_rows){
            array_push($errors,"Your email $email does not exists");
        }else{

            $result = $user->fetch_array(MYSQLI_ASSOC);
            
            if(password_verify($password,$result['password'])){

                $_SESSION['is_logged'] = true;
                $_SESSION['role'] = $result['role'];
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['user_name'] = $result['name'];
                if($result['role'] == 'admin'){
                    header("location:admin");
                    die();
                }else{
                    $_SESSION['login_message'] =  "welcome back $result[name]";
                    header("location:index.php?login=success");
                    die();
                }

            }else{
                array_push($errors,'Password is wrong');
            }
        }
    }




    
}

?>

<div id="login" class="container pt-5">

    <h4 class="text-center">Login</h4>
    <h5 class="text-center text-success">please fill the form to login</h5>
    <hr>
    <?php  require_once 'templates/errors.php'?>
    <?php  require_once 'templates/message.php'?>

    <form action="" method="POST" class="pt-3" style="padding-bottom: 300px;">
        <div class="row">
            
            <div class="form-group col-8 offset-2">
                <label for="email" >Enter your email :</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" value="<?php if(count($errors)) echo $email ?>">
            </div>
            
            <div class="form-group col-8 offset-2">
                <label for="password" >Enter your password :</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password">
            </div>
            <a href="password_reset.php" class="col-6 offset-2">Forgot password</a>
            <a href="register.php" class="col-6 offset-2">create a new account</a>
            
            <div class="col-8 offset-2">
                <button class="btn btn-success send-register-form">send</button>
            </div>

        </div>
    </form>
</div>

<?php 
require_once 'templates/footer.php';
<?php 

$title = 'passwoed reset';
require_once 'templates/header.php';
require_once 'templates/nav-bar.php';
require_once 'config/connection.php';
require_once 'config/app.php';
if(isset($_SESSION['is_logged'])){
    header("location:index.php"); 
     die();
 }
$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = mysqli_real_escape_string($conn,$_POST['email']);

    if(empty($email)) array_push($errors,'Email is required');
    
    if(!count($errors)){
        $user = $conn->query("select id,email from users where email='$email' limit 1");
        
        if($user->num_rows){
            $userId = $user->fetch_assoc()['id'];
            // if there is a token in db it will be removed and it will be one token for each user only
            $tokenExists = $conn->query("delete from password_reset where user_id='$userId'");
            // random bytes create a random bytes and bin2hex make it a readable string
            $token = bin2hex(random_bytes(16));
            $expiers_at = date(' y-m-d H:i:s',strtotime('+10 minute'));
            $conn->query(" insert into password_reset (user_id,token,expires) values ('$userId','$token','$expiers_at') ");
            $conn->close();


            $changePasswordUrl = $config['app_url'] . 'change_password.php?token='.$token;
            $headers  = 'MIME-Version: 1.0' . "\r\n";

            $headers = 'Content-type: text/html; charset=UFT-8';

            $headers .= 'From: '.$config['admin_mail']."\r\n".

                'Reply-To: '.$config['admin_mail']."\r\n" .

                'X-Mailer: PHP/' . phpversion();

            $htmlMessage = '<html><body>';

            $htmlMessage .= '<h1 style="color:red; background-color:blue">this is h1</h1>';
            $htmlMessage .= '<p style="color:#ff000000;">' .$changePasswordUrl. '</p>';

            $htmlMessage .= '</body></html>';



            $subject = 'رسالة جديدة';

            if(mail($email,$subject,$htmlMessage,$headers)) $_SESSION['login_message'] = 'Reset password have been sent to your email';
            ;
            


        }
        $email = '';
    }




    
}

?>

<div id="password_reset" class="container pt-5">

    <h4 class="text-center">Reset password!</h4>
    <h5 class="text-center text-success">please fill the form to  reset your password</h5>
    <hr>
    <?php  require_once 'templates/errors.php'?>
    <?php  require_once 'templates/message.php'?>

    <form action="" method="POST" class="pt-3" style="padding-bottom: 300px;">
        <div class="row">
            
            <div class="form-group col-8 offset-2">
                <label for="email" >Enter your email :</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" value="<?php if(isset($email)) echo $email ?>">
            </div>
            
            <div class="col-8 offset-2">
                <button class="btn btn-success reset-password-form">Reset password!</button>
            </div>

        </div>
    </form>
</div>

<?php 
require_once 'templates/footer.php';
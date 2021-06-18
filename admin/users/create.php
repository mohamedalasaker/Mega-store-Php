
<?php 
ob_start();
$title = 'Create users';
$icon = 'fa fa-plus';
include __DIR__.'/../templates/header.php';

$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $role = mysqli_real_escape_string($conn,$_POST['role']);

    if(!$email) array_push($errors,'Email is reqiured');
    if(!$name) array_push($errors,'Name is reqiured');
    if(!$password) array_push($errors,'Password is reqiured');

    // you can use this way to check if user exists or mysqli error for the query

    // if(!count($errors)){
    //     $user = $conn->query("select email from users where email='$email' limit 1");

    //     if($user->num_rows){
    //         array_push($errors,'User alredy exists');
    //     }
    // }

    if(!count($errors)){
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);

        $conn->query(" insert into users (email,name,password,role) values ('$email','$name','$hashed_password','$role') ");
        if($conn->error){
            array_push($errors,$conn->error);
        }else{
            $_SESSION['success_message'] = 'User have been added';
            header("location:index.php");
            die();
        }
        
    }


}

?>




    <div class="container pt-5" id="createUser" style="padding-bottom: 100px;">
        
        <?php include __DIR__.'/../templates/admin_errors.php'?>
        <?php require_once '../templates/admin_message.php'; ?>


        <form action="" method="POST" class="" style="padding-bottom: 100px;">
            <div class="row">
                <div class="form-group col-7 offset-1 mx-auto" >
                    <label for="email" >Email :</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" value="<?php echo isset($email) ? $email : ''; ?>">
                </div>
                
                <div class="form-group col-7 mx-auto">
                    <label for="email" >Name :</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your name" value="<?php echo isset($name) ? $name : ''; ?>">
                </div>
                
                <div class="form-group col-7 mx-auto" >
                    <label for="password" >Password :</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password">
                </div>
                <div class="form-group col-7 mx-auto" >
                    <label for="password" >Role :</label>
                    <select name="role" id="" class="form-control" style="color:#a9a9a9;">
                        <option value="user" <?php if(isset($role) && $role == 'user') echo 'selected' ?> >User</option>
                        <option value="admin" <?php if(isset($role) && $role == 'admin') echo 'selected' ?>>Admin</option>
                    </select>
                </div>
                
                <div class="col-7 mx-auto">
                    <button name="create" class="btn btn-primary">Create</button>
                </div>
                
    
    
            </div>
        </form>
    </div>
    
</div>

</div>    



<?php
include __DIR__.'/../templates/footer.php';
ob_end_flush();


?>




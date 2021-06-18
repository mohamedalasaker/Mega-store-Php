
<?php 
$title = 'Edit user';
$icon = 'fa fa-edit';
include __DIR__.'/../templates/header.php';

$errors = [];
if(isset($_GET['id'])){
    // $sql = $conn->query(" select * from users where id='$_GET[id]' ");
    $stmt = $conn->prepare(" select * from users where id=? limit 1");
    $stmt->bind_param('i',$userId);
    $userId = $_GET['id'];
    $stmt->execute();
    $user = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
    // $conn->close();

    $email = $user['email'];
    $name = $user['name'];
    $role = $user['role'];

}else{
    echo '<script> location.href="index.php"</script>';
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $sql = $conn->prepare("update users set email=?,name=?,role=?, password=? where id=?");
        $sql->bind_param('ssssi',$userEmail,$userName,$userRole,$userPass,$userId);
        
        empty($_POST['email']) ? $userEmail =  $email : $userEmail = $_POST['email'];
        empty($_POST['name']) ? $userName =  $name : $userName = $_POST['name'];
        empty($_POST['role']) ? $userRole =  $role : $userRole = $_POST['role'];
        $_POST['password'] ? $userPass = password_hash($_POST['password'],PASSWORD_DEFAULT) : $userPass = $user['password'];
        $userId = $userId;
        $sql->execute();
    
        if($conn->error){
            array_push($errors,$conn->error);
        }else{
            $sql->close();
            $_SESSION['success_message'] = 'User have been edited';
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
                    <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?php echo $email?>">
                </div>
                
                <div class="form-group col-7 mx-auto">
                    <label for="email" >Name :</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name" value="<?php echo $name ?>">
                </div>
                
                <div class="form-group col-7 mx-auto" >
                    <label for="password" >Password :</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter  password" >
                </div>
                <div class="form-group col-7 mx-auto" >
                    <label for="password" >Role :</label>
                    <select name="role" id="" class="form-control" style="color:#a9a9a9;">
                        <option value="user" <?php if($role == 'user') echo 'selected' ?> >User</option>
                        <option value="admin" <?php if($role  == 'admin') echo 'selected' ?>>Admin</option>
                    </select>
                </div>
                
                <div class="col-7 mx-auto">
                    <button name="create" class="btn btn-primary">Update</button>
                </div>
                
    
    
            </div>
        </form>
    </div>
    
</div>

</div>    



<?php
include __DIR__.'/../templates/footer.php';


?>




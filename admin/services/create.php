
<?php 
ob_start();
$title = 'Create service';
$icon = 'fa fa-plus';
include __DIR__.'/../templates/header.php';

$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $describtion = mysqli_real_escape_string($conn,$_POST['dec']);
    $price = mysqli_real_escape_string($conn,$_POST['price']);

    if(!$name) array_push($errors,'Name is reqiured');
    if(!$describtion) array_push($errors,'Describtion reqiured');
    if(!$price) array_push($errors,'Price is reqiured');
    
    

    if(!count($errors)){
        

        $conn->query(" insert into services (name,describtion,price) values ('$name','$describtion','$price') ");
        if($conn->error){
            array_push($errors,$conn->error);
        }else{
            $_SESSION['success_message'] = 'Service have been added';
        }
        
    }


}

?>




    <div class="container pt-5" id="createService" style="padding-bottom: 100px;">
        
        <?php include __DIR__.'/../templates/admin_errors.php'?>
        <?php include '../templates/admin_message.php'; ?>

        <form action="" method="POST" class="" style="padding-bottom: 100px;">
            
            <div class="row">
   
                
                <div class="form-group col-7 mx-auto">
                    <label for="name" >Name :</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter service name" value="<?php echo isset($name) ? $name : ''; ?>">
                </div>
                
                <div class="form-group col-7 mx-auto" >
                    <label for="describtion" >Describtion :</label>
                    <textarea   type="textarea" name="dec" class="form-control" rows="5" colmns="5"><?php echo isset($describtion) ? $describtion :''; ?></textarea>
                </div>
                <div class="form-group col-7 mx-auto" >
                    <label for="price" >Price :</label>
                    <input type="text" name="price" class="form-control" placeholder="Enter service price" value="<?php echo isset($price) ? $price : ''; ?>">
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




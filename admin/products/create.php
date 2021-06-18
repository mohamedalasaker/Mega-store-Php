
<?php 

ob_start();
$title = 'Create product';
$icon = 'fa fa-plus';
include __DIR__.'/../templates/header.php';
include __DIR__.'/../../classes/Uplouder.php';


$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $Ptitle = mysqli_real_escape_string($conn,$_POST['title']);
    $describtion = mysqli_real_escape_string($conn,$_POST['dec']);
    $price = mysqli_real_escape_string($conn,$_POST['price']);
    $img = $_FILES['document']['name'];
    
    
    
    if(!$Ptitle) array_push($errors,'Title is reqiured');
    if(!$describtion) array_push($errors,'Describtion reqiured');
    if(!$price) array_push($errors,'Price is reqiured');
    if(!$img) array_push($errors,'Image is required');

    
    
    if(!count($errors)){
        $uploud = new Uplouder('uplouds/products');
        $uploud->file = $_FILES['document'];
        $errors = $uploud->uploud();
        if(empty($errors)) $errors = [];
        if(!count($errors)){
            $conn->query("insert into products (title,describtion,price,product_img) values ('$Ptitle','$describtion','$price','$uploud->filepath') ");
            if($conn->error){
                array_push($errors,$conn->error);
            }else{
                $_SESSION['success_message'] = 'Product have been added';
            }
        }

        }
        


        
      
    }

    
    





?>




    <div class="container pt-5" id="createProduct" style="padding-bottom: 100px;">
        
        <?php include __DIR__.'/../templates/admin_errors.php'?>
        <?php include '../templates/admin_message.php'; ?>

        <form action="" method="POST" class="" style="padding-bottom: 100px;" enctype="multipart/form-data">
            
            <div class="row">
   
                
                <div class="form-group col-7 mx-auto">
                    <label for="name" >Ttile :</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter service title" value="<?php echo isset($Ptitle) ? $Ptitle : ''; ?>">
                </div>
                
                <div class="form-group col-7 mx-auto" >
                    <label for="describtion" >Describtion :</label>
                    <textarea   type="textarea" name="dec" class="form-control" rows="5" colmns="5"><?php echo isset($describtion) ? $describtion :''; ?></textarea>
                </div>
                <div class="form-group col-7 mx-auto" >
                    <label for="describtion" >Price :</label>
                    <input type="text" name="price" class="form-control" placeholder="Enter service price" value="<?php echo isset($price) ? $price : ''; ?>">
                </div>
                
                <div class="col-7 mx-auto">
                    <div class="custom-file form-group">
                        <input type="file" name="document" class="custom-file-input form-control" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose image of product</label>
                        <p class="text-danger"> <?php echo isset($errors['file']) ? htmlspecialchars($errors['file']): '' ?> </p>
                        
                    </div>
                </div>
                
               
                
                <div class="col-7 mx-auto mt-2">
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





<?php 
$title = 'Edit service';
$icon = 'fa fa-edit';
include __DIR__.'/../templates/header.php';

$errors = [];
if(isset($_GET['id'])){
    $stmt = $conn->prepare(" select * from services where id=? limit 1");
    $stmt->bind_param('i',$serviceId);
    $serviceId = $_GET['id'];
    $stmt->execute();
    $service = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);

    $name = $service['name'];
    $describtion = $service['describtion'];
    $price = explode('.',$service['price'])[0];

}else{
    echo '<script> location.href="index.php"</script>';
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(empty(trim($_POST['name'])))array_push($errors,'Name is required');
    if(empty(trim($_POST['dec'])))array_push($errors,'Describtion is required');
    if(empty(trim($_POST['price'])))array_push($errors,'Price is required');
    

    if(!count($errors)){

        $sql = $conn->prepare("update services set name=?,describtion=?,price=? where id=?");
        $sql->bind_param('ssii',$serviceName,$serviceDec,$servicePrice,$serviceId);
        $serviceName  =  $_POST['name'];
        $serviceDec   =  $_POST['dec'];
        $servicePrice =  $_POST['price'];
        $serviceId = $serviceId;
        $sql->execute();
    
        if($conn->error){
            array_push($errors,$conn->error);
        }else{
            $sql->close();
            $_SESSION['success_message'] = 'Service have been edited';
    
        }
    }
   
}

?>



<div class="container pt-5" id="editService" style="padding-bottom: 100px;">
        
        <?php include __DIR__.'/../templates/admin_errors.php'?>
        <?php require_once '../templates/admin_message.php'; ?>


        <form action="" method="POST" class="" style="padding-bottom: 100px;">
            <div class="row">
               
                
                <div class="form-group col-7 mx-auto">
                    <label for="name" >Name :</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter service name" value="<?php echo $name?>">
                </div>
                
                <div class="form-group col-7 mx-auto" >
                    <label for="describtion" >Describtion :</label>
                    <textarea   type="textarea" name="dec" class="form-control" rows="5" colmns="5"><?php echo isset($describtion) ? $describtion :''; ?></textarea>
                </div>
                <div class="form-group col-7 mx-auto" >
                    <label for="price" >Price :</label>
                    <input type="text" name="price" class="form-control" placeholder="Enter service price" value="<?php echo $price ?>">
                </div>
               
                
                <div class="col-7 mx-auto">
                    <button name="create" class="btn btn-primary">Edit</button>
                </div>
                
    
    
            </div>
            </form>
        </div>
    
    </div>

    </div>    


<?php
include __DIR__.'/../templates/footer.php';


?>




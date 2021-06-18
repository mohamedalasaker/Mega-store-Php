<?php 
$title = 'Edit product';
$icon = 'fa fa-edit';
include __DIR__.'/../../classes/Uplouder.php';
include __DIR__.'/../templates/header.php';
$uploud_dir = __DIR__.'/../../uplouds/products/';
$img_dir = 'uplouds/products/';


$errors = [];
if(isset($_GET['id'])){
    $stmt = $conn->prepare(" select * from products where id=? limit 1");
    $stmt->bind_param('i',$productId);
    $productId = $_GET['id'];
    $stmt->execute();
    $product = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);

    $title = $product['title'];
    $describtion = $product['describtion'];
    $price = $product['price'];
    $img = $product['product_img'];
}else{
    echo '<script> location.href="index.php"</script>';
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(empty(trim($_POST['title'])))array_push($errors,'Ttile is required');
    if(empty(trim($_POST['dec'])))array_push($errors,'Describtion is required');
    if(empty(trim($_POST['price'])))array_push($errors,'Price is required');

    if(isset($_FILES['document']) && $_FILES['document']['error'] == 0 ){
        $uploud = new Uplouder('uplouds/products');
        $uploud->file = $_FILES['document'];
        $errors = $uploud->uploud();

        if(empty($errors)){

            unlink($uploud->rootDir.'/'.$img);

            $img = $uploud->filepath;
        }

    }

    if(empty($errors)){
        if($_POST['title'] == $title && $_POST['dec'] == $describtion && $_POST['price'] == $price && empty($_FILES['document']['name'])){
            echo '<script>location.href = "index.php"</script>';
        }
        $sql = $conn->prepare("update products set title=?,describtion=?,price=?,product_img=? where id=?");
        $sql->bind_param('ssisi',$productTitle,$productDec,$productPrice,$productImg,$productId);
        $productTitle = $_POST['title'];
        $productDec = $_POST['dec'];
        $productPrice = $_POST['price'];
        $productImg = $img;
        $productId = $productId;
        $sql->execute();
    
        if($conn->error){
            die($conn->error);
            array_push($errors,$conn->error);
        }else{
            $sql->close();
            $_SESSION['success_message'] = 'Product have been edited';
            
        }

    }
   
}

?>


<div class="container-fluid pt-1">
        <h1 class="text-center " style="color:#343a40!important">Edit product</h1>
        <div class="row">
            <div class="col-12">
                <?php require_once '../templates/admin_errors.php'; ?>
                <?php require_once '../templates/admin_message.php'; ?>
                    

                <form style="padding-bottom: 300px;" action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-7 mx-auto">
                            <div class="form-group">
                                <label for="title">Title of product :</label>
                                <input value="<?php echo $title ?>" type="text" name="title" class="form-control">
                                <p class="text-danger"> <?php echo isset($errors['title']) ? htmlspecialchars($errors['title']): '' ?> </p>
                            </div>
                        </div>
                        
                        <div class="col-7 mx-auto">
                            <div class="form-group">
                                <label for="dec">Decreption of product :</label>
                                <textarea   type="textarea" name="dec" class="form-control" rows="5" colmns="5"><?php echo isset($describtion) ? $describtion :''; ?></textarea>
                                <p class="text-danger"> <?php echo isset($errors['dec']) ? htmlspecialchars($errors['dec']): '' ?> </p>

                            </div>
                        </div>
                        <div class="col-7 mx-auto">
                            <div class="form-group">
                                <label for="dec">Price of product :</label>
                                <input value="<?php echo $price ?>" type="textarea" name="price" class="form-control">
                                <p class="text-danger"> <?php echo isset($errors['price']) ? htmlspecialchars($errors['price']): '' ?> </p>

                            </div>
                        </div>
                        <div class="col-7 mx-auto">
                            <img src="<?php echo $config['app_url'].'/'.$img ?>" width="100px" height="100px" alt="">
                            this is the Saved image
                            <div class="custom-file form-group ">
                                <input type="file" name="document" class="custom-file-input form-control " id="customFile">
                                <label class="custom-file-label" for="customFile">Choose image of product</label>
                                <p class="text-danger"> <?php echo isset($errors['file']) ? htmlspecialchars($errors['file']): '' ?> </p>
                                
                            </div>
                        </div>
                        
                        <div class="col-7 mx-auto mt-3">
                            <button class="btn btn-primary" style="width: 100%;">send</button>
                        </div>
                        
                    </div>    
                </form>
            </div>
        </div>
    </div>
<?php require_once('../templates/footer.php')?>
    
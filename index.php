<?php
$title = 'home page';

require_once('templates/header.php');
require_once('templates/nav-bar.php');
require_once('includes/uplouder.php');

require 'classes/Services.php';
require 'classes/Products.php';
require 'config/connection.php';

$service = new Service();
$productObj = new Product(0.5);



?>
    <div class="container my-5" style="max-height: 300px;">


<!-- Each carousel needs a unique ID -->
<div id="carousel-id" class="carousel slide"  data-ride="carousel" style="max-height: 300px;">

  <div class="carousel-inner" role="listbox" style="max-height: 300px;">
    <div class="carousel-item active">
      <img src="imgs/test1.jpeg" width="100%" height="50px"  alt="First slide" class="img-fluid">
    </div>
    <div class="carousel-item">
      <img src="imgs/test.jpeg" width="100%" height="50px"  alt="First slide" class="img-fluid">
    </div>
    <div class="carousel-item">
      <img src="imgs/test2.jpeg" width="100%" height="50px" alt="First slide" class="img-fluid">
    </div>
  </div>

  <ol class="carousel-indicators">
    <li data-target="#carousel-" data-slide-to="0" class="active"></li>
    <li data-target="#carousel" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>
  <p class="text-xs-center">
    <a class="" href="#carousel-id" role="button" data-slide="prev">
      <span class="icon-prev" aria-hidden="true"></span> Previous
    </a>&emsp;
    <a class="l" href="#carousel-id" role="button" data-slide="next">
      <span class="icon-next" aria-hidden="true"></span> Next
    </a>
  </p>
  <!-- /.text-center -->
</div>
<!-- /.carousel -->

</div>
<!-- /.container -->
<?php if($service->avaliblity){  ?>
    <div class="container pt-5">
        <h1 class="text-center">Start shooping</h1>
        
        <?php if(isset($_SESSION['login_message'])): ?>

            <div class="alert alert-success" id="logged_in">
                <?php echo $_SESSION['login_message'];?>
                <?php unset($_SESSION['login_message']); ?>
            </div>
        <?php endif; ?>

        <div class="row" style="padding-bottom: 300px; margin-bottom:300px">
            
            
            <?php $products = $conn->query('select product_img ,title ,price,describtion from products')->fetch_all(MYSQLI_ASSOC) ?>
            <?php foreach($products as $product){ ?>
                <div class="col-md-6 col-lg-4 offset-md-0 offset-lg-0  col-sm-10 offset-sm-1 mt-5" style=""  >
                    <div class="card" style="min-height: 500px;">
                    
                    <div class="card-body">
                        <?php 
                        $img_name_jpeg = explode('/',$product['product_img']); 
                        $img_name = explode('.',$img_name_jpeg[count($img_name_jpeg) -1 ]);
                        ?>
                        <img  class="card-img img-fluid" width="200px" height="200px" src="<?php echo $config['app_url'] . $product['product_img'] ?>" alt="<?php echo $img_name[0] ?>">
                        <hr>
                        <div class='card-text mb-2 text-truncate '><?php echo $product['title'] ?> </div>
                        <div class='card-text mb-2 text-truncate  '><?php echo $product['describtion'] ?> </div>
                        <hr>
                        <div class='card-text  text-success'>price : $<?php echo $productObj->getPrices($product['price']) ?> </div>
                        <div class="btn btn-lg btn-danger" style="min-width: 100%; min-height:40px; margin-top:0px">Add To Cart</div>
                    </div>
                    </div>
                </div>
                <?php } ?>  

            <?php $conn->close() ?>

        </div>
    </div>
    
<?php }?>

<?php require_once('templates/footer.php') ?>
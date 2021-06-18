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
   <div class="container mb-5" style="padding-bottom: 200px;">
    <h1 class="text-center">about us</h1>
    <!-- <h2 class="text-center">we serve you as much as we can</h2> -->
    <div class="row text-center">
        <div class="col-4 text-black text-center">
            <img src="imgs/prices.jpeg" width="70%" height="250px" alt="">
            <h3>We have the best prices and we have disconts in holdays and vications</h3>

        </div>
        <div class="col-4">
            <img src="imgs/quality.png" width="70%" height="250px" alt="">
            <h3>We made our products with the best tools and materials</h3>
        </div>
        <div class="col-4">
        <img src="imgs/guarntee.png" width="70%" height="250px" alt="">
            <h3>if anything happen to the product by us we will pay you back 100% of the price</h3>
        </div>
    </div>
   </div>
<?php require_once('templates/footer.php') ?>
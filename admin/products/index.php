<?php 
$title = 'Products';
$icon = 'fa fa-dropbox';
include __DIR__.'/../templates/header.php';
include __DIR__.'/../../classes/Services.php';
include __DIR__.'/../../classes/Products.php';

$productObj = new Product(0.5);

$products = $conn->query(" select * from products order by id")->fetch_all(MYSQLI_ASSOC);

if(isset($_POST['delete_button'])){

    $sql = $conn->prepare("DELETE from products where id = ?");
        
    $sql->bind_param('i',$productId);
    
    $productId = $_POST['delete_product'];
    
    $sql->execute();
    $sql->close();
    if(isset($_POST['image'])){
        unlink($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '/study/flex-courses-1/'.$_POST['image']);
    }
    echo '<script>location.href="index.php" </script>';

}

?>

<?php if(!count($products)): ?>
        <h1 class="text-center" style="color:#a9a9a9;">there is no products</h1>
<?php  else : ?>   

<div class="card table-responsive" style="margin-bottom: 100px;">
    <h4 class="text-center">There is  <?php echo count($products) ?>    products</h4>
    <table class="table table-hover table-" >
        <thead>
            <tr>
                <th width="0">#</th>
                <th>Title</th>
                <th >Describtion</th>
                <th >Price</th>
                <th width="50px">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product){ ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['id']) ?></td>
                    <td><?php echo htmlspecialchars($product['title']) ?></td>
                    <td><?php echo htmlspecialchars($product['describtion']) ?></td>
                    <td><?php echo '$'.$productObj->getPrices(htmlspecialchars($product['price'])) ?></td>
                    <td>
                        <img width="50" height="50" src="<?php echo $config['app_url'].htmlspecialchars($product['product_img']) ?>">
                    </td>
                    <td style="position: relative;">
                        <div class="test">
                            <a href="edit.php?id=<?php echo $product['id'] ?>" class="btn btn-warning btn-sm" style="margin-right: 10px;">Edit</a>
                            <form  action="" method="POST" style="display: inline-block;">
                                <input type="hidden" name='delete_product' value="<?php echo $product['id'] ?>" >
                                <input type="hidden" name='image' value="<?php echo $product['product_img'] ?>" >
                                <button onclick="return confirm('Are u sure ?')" class="btn btn-sm btn-danger" name="delete_button">Delete</button>
                            </form>
                            
                        </div>
                    </td>
                    
                </tr>
    
            <?php }?>    
        </tbody>

    </table>
</div>


<?php
endif;
include __DIR__.'/../templates/footer.php';

?>
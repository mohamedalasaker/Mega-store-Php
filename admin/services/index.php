<?php 
$title = 'Services';
$icon = 'fa fa-cubes';
include __DIR__.'/../templates/header.php';
include __DIR__.'/../../classes/Services.php';
include __DIR__.'/../../classes/Products.php';

$serviceObj = new Service(0.3);


$services = $conn->query(" select * from services order by id")->fetch_all(MYSQLI_ASSOC);

if(isset($_POST['delete_button'])){

    $sql = $conn->prepare("DELETE from services where id = ?");
        
    $sql->bind_param('i',$serviceId);
    
    $serviceId = $_POST['delete_service'];
    
    $sql->execute();

    $sql->close();
    echo '<script>location.href="index.php" </script>';

}

?>

<?php if(!count($services)): ?>
        <h1 class="text-center" style="color:#a9a9a9;">there is no services</h1>
<?php  else : ?>   

    

<div class="card table-responsive" style="margin-bottom: 100px;">
    <h4 class="text-center">There is  <?php echo count($services) ?> service<?php if(count($services) > 1) echo 's'?></h4>
    <table class="table table-hover table-striped" >
        <thead>
            <tr>
                <th width="0">#</th>
                <th>Name</th>
                <th>Describtion</th>
                <th width="0px">Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($services as $service){ ?>
                <tr>
                    <td><?php echo htmlspecialchars($service['id']) ?></td>
                    <td><?php echo htmlspecialchars($service['name']) ?></td>
                    <td><?php echo htmlspecialchars($service['describtion']) ?></td>
                    <td><?php echo $serviceObj->getPrices(htmlspecialchars($service['price'])) ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $service['id'] ?>" class="btn btn-warning btn-sm" style="margin-right: 10px;">Edit</a>
                        <form  action="" method="POST" style="display: inline-block;">
                            <input type="hidden" name='delete_service' value="<?php echo $service['id'] ?>" >
                            <button onclick="return confirm('Are u sure ?')" class="btn btn-sm btn-danger" name="delete_button">Delete</button>
                        </form>
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
<?php
$title = 'settings';
$icon = 'fa fa-cogs';
include_once __DIR__.'/../templates/header.php';
include_once __DIR__.'/../templates/sidebar.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = $conn->prepare(" update settings set app_name=? , admin_email=? where id = 2 ");
    $sql->bind_param('ss',$appName,$adminEmail);
    $appName = $_POST['app_name'] ? $_POST['app_name'] : $config['app_name'];
    $adminEmail = $_POST['admin_email'] ? $_POST['admin_email'] : $config['admin_mail'];
    $sql->execute();
    echo '<script>location.href="index.php" </script>';
}


?>

<div class="card " style="min-height: 80%;">
    <div class="content mx-auto" style="width: 50%;">
        <h3 class="text-center">settings</h3>
        <form action="" method="POST">
            <div class="form-gruop">
                <label for="app_name">Application name : </label>
                <input type="text" name="app_name" value="<?php echo $config['app_name'] ?>" class="form-control">
            </div>
            <div class="form-gruop">
                <label for="app_name">Admin email : </label>
                <input type="email" name="admin_email" value="<?php echo $config['admin_mail']?>" class="form-control">
            </div>
            <div class="form-gruop">
                <button class="btn btn-primary mt-2">Update</button>
            </div>

        </form>
    </div>
</div>

<?php 
include_once __DIR__.'/../templates/footer.php';
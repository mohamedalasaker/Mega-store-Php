<?php 

$title = 'dashboard';
$icon ='fa fa-dashboard';
include 'templates/header.php';
?>
<h1 class="text-center">welcome <?php echo $_SESSION['user_name'] ?> to the admin control panel</h1>

<?php 
include 'templates/footer.php';


?>
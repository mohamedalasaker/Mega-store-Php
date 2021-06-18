<?php 
require_once 'header.php';
$user = new User();


?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <a class="navbar-brand" href="#" style="color: #28a745;"><?php echo $config['app_name']?></a>
  <?php if(isset($_SESSION['is_logged'])): ?>
      <ul class="navbar-nav ml-auto d-lg-none flex-row" >
        <li class="nav-item mr-4">
          <a style="color: orange;" class="nav-link" href="#"><?php echo $_SESSION['user_name'] ?></a>
        </li>
        <li class="nav-item mr-4">
          <a class="nav-link active" href="<?php echo $config['app_url'] ?>logout.php">Logout</a>
        </li>
        

      </ul>
  <?php endif ?>  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $config['app_url'] ?>index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $config['app_url'] ?>contact.php">Contact</a>
      </li>
      <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo $config['app_url'] . '/admin'  ?>">admin panel</a>
        </li>
      <?php endif; ?>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $config['app_url'] . '/about.php'  ?>">about us</a>
      </li>
      
      
      
      
    </ul>
    <hr style="background-color: white;">
    <ul class="navbar-nav ml-auto">
    <?php if(!isset($_SESSION['is_logged'])): ?>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $config['app_url'] ?>register.php">Register</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $config['app_url'] ?>login.php">Login</a>
      </li>
    <?php elseif(isset($_SESSION['is_logged'])): ?>
      <li class="nav-item active d-md-none d-lg-block d-sm-none">
        <a style="color: orange;" class="nav-link" href="#"><?php echo $_SESSION['user_name']?></a>
      </li>
      <li class="nav-item active d-md-none d-lg-block d-sm-none">
        <a class="nav-link" href="<?php echo $config['app_url'] ?>logout.php">Logout</a>
      </li>
    
    <?php endif ?>  
      
    </ul>
  </div>
</nav>

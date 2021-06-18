<?php
$title = 'contact';
require_once('templates/header.php');
require_once('templates/nav-bar.php');
require_once('includes/uplouder.php');
require 'classes/Services.php';
require 'config/connection.php';
require 'test.php';

$service2 = new Service(0.15);

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center" style="color:#343a40!important">contact us</h1>
                <form style="padding-bottom: 300px;" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6 offset-3">
                            <div class="form-group">
                                <label for="name">name :</label>
                                <input value="<?php if(!empty($_SESSION['contact_form']['name'])) echo $_SESSION['contact_form']['name']?>" type="text" name="name" class="form-control">
                                <p class="text-danger"> <?php echo isset($errors['name']) ? htmlspecialchars($errors['name']): '' ?> </p>
                            </div>
                        </div>
                        <div class="col-6 offset-3">
                            <div class="form-group">
                                <label for="email">email :</label>
                                <input value="<?php if(!empty($_SESSION['contact_form']['email'])) echo $_SESSION['contact_form']['email'] ?>" type="text" name="email" class="form-control">
                                <p class="text-danger"> <?php echo isset($errors['email']) ? htmlspecialchars($errors['email']): '' ?> </p>

                            </div>
                        </div>
                        <div class="col-6 offset-3">
                            <div class="form-group">
                                <label for="dec">decreption :</label>
                                <input value="<?php if(!empty($_SESSION['contact_form']['dec'])) echo $_SESSION['contact_form']['dec'] ?>" type="textarea" name="dec" class="form-control">
                                <p class="text-danger"> <?php echo isset($errors['dec']) ? htmlspecialchars($errors['dec']): '' ?> </p>

                            </div>
                        </div>
                        <div class="col-6 offset-3">
                            <div class="form-group">
                                <label for="services">services :</label>
                                <select name="services_id" id=""  class="form-control">
                                   
                                    
                                        <option value="" selected hidden>Choose here</option>                                    
                                        
                                        <?php $services = $conn->query('select id,name,price from services')->fetch_all(MYSQLI_ASSOC) ?>
                                            <?php foreach($services as $service){ ?>
                                            
                                            <option value="<?php echo $service['id'] ?>" <?php if(!empty($_SESSION['contact_form']['service']) && $_SESSION['contact_form']['service'] == $service['id']) echo 'selected'; ?>> 
                                            <?php
                                            echo $service['name']
                                            .'($'
                                            .$service2->getPrices($service['price']) 
                                            .')'
                                            ?>
                                            </option>
                                            
                                            <?php } ?>  
                                            <?php $conn->close()  ?>;
                                </select>
                                <p class="text-danger"> <?php echo isset($errors['service']) ? htmlspecialchars($errors['service']): '' ?> </p>

                            </div>
                        </div>
                        
                        <div class="col-6 offset-3">
                            <div class="custom-file">
                                <input type="file" name="doc" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <p class="text-danger"> <?php echo isset($errors['file']) ? htmlspecialchars($errors['file']): '' ?> </p>
                                
                            </div>
                        </div>
                        
                        <div class="col-6 offset-3">
                            <button class="btn btn-danger send-contact-form">send</button>
                        </div>
                        
                    </div>    
                </form>
            </div>
        </div>
    </div>
<?php require_once('templates/footer.php')?>
    
    

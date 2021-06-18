<?php if(isset($_SESSION['login_message'])): ?>

    <div class="alert alert-success col-8 offset-2" id="logged_in">
        <?php echo $_SESSION['login_message'];?>
        
        <?php unset($_SESSION['login_message']); ?>
        
    </div>


<?php endif; ?>

<?php if(isset($_SESSION['product_added'])): ?>

    <div class="alert alert-success col-6 offset-3" id="logged_in">
        <?php echo $_SESSION['product_added'];?>
        <?php unset($_SESSION['product_added']); ?>
    </div>


<?php endif;
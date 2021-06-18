<?php if(isset($_SESSION['success_message'])): ?>

<div class="alert alert-success col-7 mx-auto" id="logged_in">
    <?php echo $_SESSION['success_message'];?>
    <?php unset($_SESSION['success_message']); ?>
</div>


<?php endif;
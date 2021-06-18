<?php if(!empty($errors)): ?>
    <div class="alert alert-danger col-7 mx-auto ">
        <?php foreach($errors as $error): ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>

<?php endif ?>

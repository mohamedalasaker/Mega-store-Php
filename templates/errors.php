<?php if(count($errors)): ?>
    <div class="alert alert-danger col-8 offset-2 ">
        <?php foreach($errors as $error): ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>


<?php endif ?>

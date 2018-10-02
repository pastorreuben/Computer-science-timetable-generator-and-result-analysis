<?php if(count($errors) > 0):?>
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php foreach($errors as $error):?>
            
            <strong><?php echo $error; ?></strong>
        <?php endforeach?>
    </div>
<?php endif ?>
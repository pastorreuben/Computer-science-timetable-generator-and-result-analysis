<?php if(count($success) > 0):?>
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php foreach($success as $suc):?>
            
            <strong><?php echo $suc; ?></strong>
        <?php endforeach?>
    </div>
<?php endif ?>
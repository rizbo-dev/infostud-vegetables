<?php require ROOT . '/views/includes/header.php';?>

<form method="post" class="formSearch">
    <label>Pretrazi
        <input class="input" type="text" name="key">
    </label>
    <button type="submit">Search</button>

</form>



<div class="products">
    <?php if (isset($data)):
        foreach ($data['vegetables'] as $vegetable):?>
            <div class="product-item">
                <h4 class="product-name"><?php echo $vegetable->name;?></h4>
                <a href="<?php echo URLROOT;?>/products/product/<?php echo $vegetable->id;?>"> <div class="image-card">
                        <img src="<?php echo URLROOT;?>/public/img/<?php echo $vegetable->image;?>.jpg" alt="<?php echo $vegetable->name;?>">
                    </div></a>
                <h5 class="product-price"><?php echo $vegetable->price;?> RSD</h5>
            </div>


        <?php endforeach;
    endif;?>


</div>





<?php require ROOT . '/views/includes/footer.php'; ?>

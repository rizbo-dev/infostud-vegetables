<?php require ROOT . '/views/includes/header.php';?>


<div class="product-item">
    <h4 class="product-name"><?php echo $data['vegetable']->name;?></h4>
    <div class="image-card">
        <img src="<?php echo URLROOT;?>/public/img/<?php echo $data['vegetable']->image;?>.jpg">
    </div>
    <h5 class="product-price"><?php echo $data['vegetable']->price;?> RSD</h5>




    <?php require ROOT . '/views/includes/footer.php';?>


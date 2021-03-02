
<?php require ROOT . '/views/includes/header.php';?>

<?php if(isset($data)):?>

    <div class="intro-text">
        <h1><?php echo $data['title'];?></h1>
        <h2><?php echo $data['text'];?></h2>
    </div>

<?php else:?>
    Something went wrong
<?php endif;?>

<?php require ROOT . '/views/includes/footer.php';?>
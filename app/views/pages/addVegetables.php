<?php require ROOT . '/views/includes/header.php';?>

    <form method="post" class="formAdd" action="<?php echo URLROOT;?>/products/add" enctype="multipart/form-data">

        <label>Name:
            <input type="text" name="name" required>
        </label>
        <label>
            Price:
            <input type="text" name="price" required>
        </label>
        <label for="image">
            <div class="select-image">Select Image</div>
        </label>
        <input type="file" id="image" name="picture" accept="image/jpeg" required>
        <button type="submit">Submit</button>
    </form>
<?php if(isset($data['inserted'])):?>

    <h1 class="error-text"><?php echo $data['inserted'];?></h1>

<?php endif;?>


<?php require ROOT . '/views/includes/footer.php';?>
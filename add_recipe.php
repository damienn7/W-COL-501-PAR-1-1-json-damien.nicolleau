<body>

    <?php echo $_POST['id_recipe'];?>

    <form action="" method="post">
        <input type="hidden" name="id_recipe" value="<?php echo $_POST['id_recipe'];?>">
        <input type="email" name="email" id="email" placeholder="your email" required>
        <button name="send" type="submit">Save your order</button>
    </form>
</body>
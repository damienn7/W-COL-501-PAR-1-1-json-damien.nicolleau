<?php

$url = $_SERVER['REQUEST_URI'];

if ($url == '/') {
    require('./header.php');
    require('./home.php');
    require('./footer.php');
} else {

    if (isAjax() === true) {
        require('./header.php');
        require('./home.php');
        require('./footer.php');
    } else {
        require('./header.php');
        require('./not_found.php');
        require('./footer.php');
    }
}


if (isset($_GET['format'])) {
    if ($_GET['format'] === 'json') {
        $json_content = json_decode(file_get_contents('./recipes.json'));
        print_r($json_content);
    }
}

if (isset($_POST['id_recipe']) && !isset($_POST['id_ingredient'])) {
    if (!empty($_POST['id_recipe'])) {

        if (!isset($_POST['send'])) {
            require('./header.php');
            require('add_recipe.php');
            require('./footer.php');
        } else {
            require('./header.php');
            require('save_recipe.php');
            require('./footer.php');

            $file = './logs.txt';

            $current = file_get_contents($file);

            $current .= "------ADD_RECIPE------\n";
            $current .= $_POST['email']."\n";
            $current .= $_POST['id_recipe']."\n";

            file_put_contents($file, $current);

        }




    }
}


if (isset($_POST['id_recipe']) && isset($_POST['id_ingredient'])) {
    if (!empty($_POST['id_recipe']) && !empty($_POST['id_ingredient'])) {

        if (!isset($_POST['send'])) {
            require('./header.php');
            require('add_ingredient.php');
            require('./footer.php');
        } else {
            require('./header.php');
            require('save_ingredient.php');
            require('./footer.php');

            $file = './logs.txt';

            $current = file_get_contents($file);
            
            $current .= "------ADD_INGREDIENT------\n";
            $current .= $_POST['email']."\n";
            $current .= $_POST['id_recipe']."\n";
            $current .= $_POST['id_ingredient']."\n";
            

            file_put_contents($file, $current);
        }

    }
}

function isAjax()
{
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    }

    return false;
}

?>
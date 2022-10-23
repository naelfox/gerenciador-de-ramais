<?php
header("Content-type: application/json; charset=utf-8");

require './ramais.php';
require './database.php';
require './environment.php';
require './informacoes.php';


if (isset($_GET)) {

    switch ($_GET['action']) {
        case 'obterDados':
            echo json_encode((new Informacoes())->obterDados());
            break;
        default:
            echo '404';
            die();
            break;
    }
}
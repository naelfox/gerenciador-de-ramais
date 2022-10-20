<?php


require './ramais.php';
require './database.php';
require './environment.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    switch ($_GET['action']) {
        case 'obterInformacoes':
            echo json_encode((new Ramais())->obterInformacoes());
            break;
        default:
            echo '404';
            die();
            break;
    }
}
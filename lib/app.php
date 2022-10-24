<?php
header("Content-type: application/json; charset=utf-8");

require "../vendor/autoload.php";

use Lib\Informacoes;


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
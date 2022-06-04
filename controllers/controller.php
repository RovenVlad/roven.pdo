<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once(ROOT.'/models/model.php');

$model = new Model();
$_POST = json_decode(file_get_contents('php://input'), true);
$res = '';

switch ($_POST['event']) {
    case 'vendor': 
        foreach ($model->getItemsByVendor($_POST['id']) as $value) {
            $res .= "<li>" . $value['it_name'] . "; Цена: " . $value['price'] . "; Кол-во: " . $value['quantity'] . "; Категория: " . $value['cat_name'] . "</li>";
        }
        echo json_encode($res);
        break;
    case 'category': 
        foreach ($model->getItemsByCategory($_POST['id']) as $value) {
            $res .= "<li>" . $value['it_name'] . "; Цена: " . $value['price'] . "; Кол-во: " . $value['quantity'] . "; Производитель: " . $value['ven_name'] . "</li>";
        }
        $res = '<?xml version="1.0" encoding="UTF-8" ?>
        <document>' .
            $res
        . '</document>';
        echo $res;
        break;
    case 'range': 
        foreach ($model->getRange($_POST['from'], $_POST['to']) as $value) {
            $res .= "<li>" . $value['it_name'] . "; Цена: " . $value['price'] . "; Кол-во: " . $value['quantity'] . "; Производитель: " . $value['ven_name'] . "; Категория: " . $value['cat_name'] . "</li>";
        }
        echo $res;
        break;
}

?>
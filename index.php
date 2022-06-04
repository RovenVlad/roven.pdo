<?php

define('ROOT', dirname(__FILE__));
require_once(ROOT.'/models/model.php');

$model = new Model();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
</head>
<body>
    <div>
        <label for="vendors-select">Производитель: </label>
        <select name="vendors" id="vendors-select">
            <option value="" selected disabled>Не выбрано</option>
            <? foreach($model->getVendors() as $vend) { ?>
            <option value="<?= $vend['id'] ?>"><?= $vend['name'] ?></option>
            <? } ?>
        </select>
        <ul id="list-vendor"></ul>
    </div>
    <div>
        <label for="category-select">Категория: </label>
        <select name="category" id="category-select">
            <option value="" selected disabled>Не выбрано</option>
            <? foreach($model->getCategory() as $cat) { ?>
            <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
            <? } ?>
        </select>
        <ul id="list-category"></ul>
    </div>
    <div>
        <label for="range">Диапазон цен: </label>
        <input type="text" placeholder="От" id="range-from">
        <input type="text" placeholder="До" id="range-to">
        <button>Найти</button>
        <ul id="list-range"></ul>
    </div>

    <script src="script.js" defer></script>
</body>
</html>
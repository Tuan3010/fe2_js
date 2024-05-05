<?php
require_once '../../config/database.php';
spl_autoload_register(function ($className)
{
   require_once "../../app/models/$className.php";
});
$input = json_decode(file_get_contents('php://input'),true);
$querry = $input['q'];
$productModel = new ProductModel();
$nameProduct = $productModel->searchProduct($querry);
echo json_encode($nameProduct);

<?php
include "bootstrap/init.php";

use Classes\Product;
use Classes\Storage;
use Classes\Utility;


if (!$session->isUserLoggedIn()) {
    Utility::redirect('index.php');
}

$page = $_GET['page'] ?? 'products';

if ($page == 'products') {
    $products = Product::findAll();
    include Utility::view('product.products');

} else if ($page == 'add-product') {    
    include Utility::view('product.add-product');

} else if ($page == 'storages') {
    $storages = Storage::findAll();
    include Utility::view('storage.storages');

}
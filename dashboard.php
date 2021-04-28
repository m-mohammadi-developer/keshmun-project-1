<?php
include "bootstrap/init.php";

use Classes\Product;
use Classes\Storage;
use Classes\Utility;


if (!$session->isUserLoggedIn()) {
    Utility::redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $action = $_GET['action'] ?? '';

    if($action == 'add-product') {
        // validation here
        $product = new Product;
        $product->name = $_POST['product_name'];
        $product->description = $_POST['product_description'];
        if ($product->save()) {
            Utility::redirect('dashboard.php?page=products');
        }
    }

    if($action == 'add-storage') {
        // validation here
        $product = new Storage;
        $product->name = $_POST['storage_name'];
        $product->address = $_POST['storage_address'];
        if ($product->save()) {
            Utility::redirect('dashboard.php?page=storages');
        }
    }

    


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

}  else if ($page == 'add-storage') {    
    include Utility::view('storage.add-storage');

} else if ($page == 'storage-products') {
    
    if (isset($_GET['storage-id'])) {
        $products = Storage::findStorageProducts($_GET['storage-id'] ?? 1);
        $storage = Storage::findById($_GET['storage-id'] ?? 1);
        include Utility::view('storage.storage-products');
    }
    
    
    
}

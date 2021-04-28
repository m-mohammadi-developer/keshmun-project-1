<?php
include "bootstrap/init.php";

use Classes\Product;
use Classes\Storage;
use Classes\Utility;


if (!$session->isUserLoggedIn()) {
    Utility::redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET['action'] ?? '';

    if ($action == 'add-product') {
        // validation here
        $product = new Product;
        $product->name = $_POST['product_name'];
        $product->description = $_POST['product_description'];
        if ($product->save()) {
            Utility::redirect('dashboard.php?page=products');
        }
    }

    if ($action == 'add-storage') {
        // validation here
        $product = new Storage;
        $product->name = $_POST['storage_name'];
        $product->address = $_POST['storage_address'];
        if ($product->save()) {
            Utility::redirect('dashboard.php?page=storages');
        }
    }
}






























if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = '';
}

switch ($page) {
    case 'products':
        $products = Product::findAll();
        include Utility::view('product.products');
        break;

    case 'add-product':
        include Utility::view('product.add-product');
        break;

    case 'storages':
        $storages = Storage::findAll();
        include Utility::view('storage.storages');
        break;

    case 'add-storage':
        include Utility::view('storage.add-storage');
        break;

    case 'storage-products':
        if (isset($_GET['storage-id'])) {
            $products = Storage::findStorageProducts($_GET['storage-id'] ?? 1);
            $storage = Storage::findById($_GET['storage-id'] ?? 1);
            include Utility::view('storage.storage-products');
        }
        break;

    case 'product-storages':
        if (isset($_GET['product-id'])) {
            $storages = Product::findProductStorages($_GET['product-id'] ?? 1);
            $product = Product::findById($_GET['product-id'] ?? 1);
            include Utility::view('product.product-storages');
        }
        break;
    case 'pivot-storage-product':
        $storages = Storage::findAll();
        $products = Product::findAll();
        include Utility::view('storage.pivot-storage-product');
        break;

    case '':
    case 'dashboard':
        include Utility::view('dashboard');
        break;

    default:
        include Utility::view('404');
        
}


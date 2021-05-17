<?php
include "bootstrap/init.php";

use Classes\Product;
use Classes\Storage;
use Classes\StorageProduct;
use Classes\Utility;

// to displauy form errors for Post methods
$errors = [];

// check for login and if not then exit from page
if (!$session->isUserLoggedIn()) {
    Utility::redirect('index.php');
    exit();
}



// check and handle post methods
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $session->isUserLoggedIn()) {
    $action = $_GET['action'] ?? '';

    if ($action == 'add-product') {
        // validation here
        if (empty($_POST['product_name'])) {
            $errors['add-product'][] = 'نام محصول نباید خالی باشد';
        }
        if (empty($_POST['product_description'])) {
            $errors['add-product'][] = 'توضیحات محصول نباید خالی باشد';
        }

        if (!isset($errors['add-product'])) {
            $product = new Product;
            $product->name = $_POST['product_name'];
            $product->description = $_POST['product_description'];
            if ($product->save()) {
                Utility::redirect('dashboard.php?page=products');
            }
        }
    }

    if ($action == 'add-storage') {
        // validation here
        if (empty($_POST['storage_name'])) {
            $errors['add-storage'][] = 'نام انبار نباید خالی باشد';
        }
        if (empty($_POST['storage_address'])) {
            $errors['add-storage'][] = 'آدرس انبار نباید خالی باشد';
        }

        if (!isset($errors['add-storage'])) {
            $product = new Storage;
            $product->name = $_POST['storage_name'];
            $product->address = $_POST['storage_address'];
            if ($product->save()) {
                Utility::redirect('dashboard.php?page=storages');
            }
        }
    }

    if ($action == 'edit-product') {
        if (empty($_POST['product_name'])) {
            $errors['edit-product'][] = 'نام محصول نباید خالی باشد';
        }
        if (empty($_POST['product_description'])) {
            $errors['edit-product'][] = 'توضیحات محصول نباید خالی باشد';
        }
        if (empty($_POST['product_id'])) {
            $errors['edit-product'][] = 'آیدی محصول دستکاری شده است';
        }

        if (!isset($errors['edit-product'])) {
            $product = Product::findById($_POST['product_id']);
            $product->name = $_POST['product_name'];
            $product->description = $_POST['product_description'];
            if ($product->save()) {
                Utility::redirect('dashboard.php?page=products');
            }
        }
    }

    if ($action == 'edit-storage') {
        if (empty($_POST['storage_name'])) {
            $errors['edit-storage'][] = 'نام انبار نباید خالی باشد';
        }
        if (empty($_POST['storage_address'])) {
            $errors['edit-storage'][] = 'آدرس انبار نباید خالی باشد';
        }
        if (empty($_POST['storage_id'])) {
            $errors['edit-storage'][] = 'آیدی محصول دستکاری شده است';
        }

        if (!isset($errors['edit-storage'])) {
            $storage = Storage::findById($_POST['storage_id']);
            $storage->name = $_POST['storage_name'];
            $storage->address = $_POST['storage_address'];

            if ($storage->save()) {
                Utility::redirect('dashboard.php?page=storages');
            }
        }
    }
}

// check and handle get actions
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['method']) && $session->isUserLoggedIn()) {

    // check for method to be GET
    if (strtolower($_GET['method']) == 'get') {
        $action = $_GET['action'] ?? '';

        // remove storage from database
        if ($action == 'remove-storage') {
            $storage_id = $_GET['storage-id'] ?? '';

            if (!empty($storage_id) && is_numeric($storage_id)) {
                if ($storage = Storage::findById($storage_id)) {
                    $storage->deleteWithDependencies();
                    Utility::redirect('dashboard.php?page=storages');
                }
            }
        }

        // remove product from database
        if ($action == 'remove-product') {
            $product_id = $_GET['product-id'] ?? '';

            if (!empty($product_id) && is_numeric($product_id)) {
                if ($product = Product::findById($product_id)) {
                    $product->deleteWithDependencies();
                    Utility::redirect('dashboard.php?page=products');
                }
            }
        }

        // romve product from storage
        if ($action == 'remove-product-storage') {
            $product_id = $_GET['product-id'] ?? '';
            $storage_id = $_GET['storage-id'] ?? '';

            if (
                (!empty($product_id) && is_numeric($product_id))
                &&
                (!empty($storage_id) && is_numeric($storage_id))
            ) {
                if ($storage_product = StorageProduct::findWhere([
                    ['storage_id', '=', $storage_id],
                    ['product_id', '=', $product_id]
                ])) {
                    $storage_product->delete();
                    Utility::redirect("dashboard.php?page=product-storages&product-id={$product_id}");
                }
            }
        }

        // remove product from storage :: in storage-part
        if ($action == 'remove-storage-product') {
            $product_id = $_GET['product-id'] ?? '';
            $storage_id = $_GET['storage-id'] ?? '';

            if (
                (!empty($product_id) && is_numeric($product_id))
                &&
                (!empty($storage_id) && is_numeric($storage_id))
            ) {
                if ($storage_product = StorageProduct::findWhere([
                    ['storage_id', '=', $storage_id],
                    ['product_id', '=', $product_id]
                ])) {
                    $storage_product->delete();
                    Utility::redirect("dashboard.php?page=storage-products&storage-id={$storage_id}");
                }
            }
        }

    }
}




// get page and include the view for that page
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = '';
}

// include view
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
            // Utility::dd($_GET);
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

    // return 404 page as default
    default:
        include Utility::view('404');

}

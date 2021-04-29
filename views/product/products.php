<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محصولات</title>
    <link rel="stylesheet" href="<?= Classes\Utility::assets('css/styles.css'); ?>" />

</head>

<style>
    /* Modal Overlay Styles */

    .modal-overlay {
        position: absolute;
        z-index: 999;
        background: rgba(0, 0, 0, 0.7);
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
    }

    .modal-overlay .modal {
        width: 50%;
        background: #fff;
        padding: 20px;
        border-radius: 7px;
        margin: 0 auto;
        margin-top: 0 !important;
        position: relative;
    }

    .modal-overlay .modal .close {
        position: absolute;
        top: 7px;
        left: 15px;
        color: #a90909;
        font-size: 20px;
        cursor: pointer;
    }

    .modal-overlay .modal h3.modal-title {
        padding: 0;
        margin: 0 0 30px 0;
    }

    .modal-overlay .modal h3.modal-content {}

    .field-row {
        margin: 10px 0;
    }

    .field-row::after {
        content: ' ';
        display: block;
        clear: both;
        width: 100%;
    }

    .field-row div.field-title {
        width: 20%;
        float: right;
    }

    .field-row div.field-content {
        width: 80%;
        float: right;
    }

    .field-row textarea,
    .field-row select,
    .field-row input {
        line-height: 36px;
        padding: 0 10px;
        border-radius: 5px;
        border: 1px solid #e7e7e7;
        font-size: 16px;
        font-weight: 400;
        width: 97%;
    }

    input[type="submit"] {
        background: #007bec;
        color: #fff;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        opacity: 0.7;
    }
</style>

<body>


    <?php
    include Classes\Utility::view('partials.header');
    ?>

    <?php if (!empty($errors['edit-product'])) : ?>
        <div class="container">
            <div class="col-12 error">
                <?php foreach ($errors['edit-product'] as $error) : ?>
                    <h6 style="color: #cd3232e8; margin-right: 10px; font-size: 18px;"><?= $error ?></h6>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="container">
        <h3 class="center-text">لیست محصولات</h3>
        <table width="100%">
            <thead>
                <tr>
                    <th>آیدی</th>
                    <th>نام</th>
                    <th>توضیحات</th>
                    <th>تاریخ ثبت</th>
                    <th style="width: 20%;">عملیات</th>

                </tr>
            </thead>
            <tbody>
                <?php if ($products) : ?>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td style="width: 6%;text-align: center;"><?= $product->id ?></td>
                            <td style="width: 160px;"><?= $product->name ?></td>
                            <td class="table-td-overflow"><?= $product->description ?></td>
                            <td style="width: 160px;"><?= $product->created_at ?></td>

                            <td>
                                <button data-prid="<?= $product->id ?>" class="btn btn-danger">حذف</button>
                                <button data-prid="<?= $product->id ?>" class="btn btn-info edit-button">ویرایش</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>


            </tbody>
        </table>
    </div>


    <div class="container">
        <div class="modal-overlay" id="editModal" style="display: none;">
            <div class="modal">
                <span class="close">x</span>
                <h3 class="modal-title">ویرایش محصول</h3>
                <div class="modal-content">
                    <form id='editProduct' action="<?= Classes\Utility::site_url('dashboard.php?action=edit-product&page=products') ?>" method="post">
                        <input type="hidden" id="p-id" name="product_id" value="">
                        <div class="field-row">
                            <div class="field-title">نام محصول</div>
                            <div class="field-content">
                                <input type="text" name="product_name" id="p-name" placeholder="نام محصول را وارد کنید">
                            </div>
                        </div>
                        <div class="field-row">
                            <div class="field-title">توضیحات محصول</div>
                            <div class="field-content">
                                <textarea name="product_description" id='p-description' cols="25" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="field-row">
                            <div class="field-title"><a style="text-decoration: none;" href="<?= '#' ?>">ثبت نام کنید!</a></div>
                            <div class="field-content">
                                <input type="submit" name="edit-product" value=" ویرایش ">
                            </div>
                        </div>
                        <div class="ajax-result"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $('#editModal .close').click(function() {
            $("#editModal").fadeOut(500);
        });

        $(".edit-button").click(function() {


            const btn = $(this);
            const form = $("#editProduct");

            // ajax request to get product by its id
            $.ajax({
                url: '<?= Classes\Utility::site_url('/actions/ajax-handler.php') ?>',
                method: 'POST',
                data: {
                    product_id: btn.attr('data-prid'),
                    action: 'edit-product'
                },
                success: function(response) {
                    const resp = JSON.parse(response);
                    if (resp['type'] === 'success') {
                        // show modal for edit
                        $("#editModal").fadeIn(500);
                        // fill form with data from server
                        const product = JSON.parse(resp['data']);
                        $("#p-id").val(product['id']);
                        $("#p-name").val(product['name']);
                        $("#p-description").html(product['description']);

                    } else {
                        alert('مشکلی پیش آمد صحفحه را رفرش کرده و دوباره تلاش کنید')
                    }
                }
            });

        });
    </script>


</body>

</html>
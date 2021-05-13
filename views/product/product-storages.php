<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'مدیریت محصول' ?></title>
    <link rel="stylesheet" href="<?= Classes\Utility::assets('css/styles.css'); ?>" />

</head>
<style>
    th {
        text-align: center !important;
    }
</style>

<body>


    <?php include Classes\Utility::view('partials.header'); ?>

    <div class="container">
        <table cellpadding="0" cellspacing="0" width="100%">
            <h3 style="text-align: center;">مشخصات کالا</h3>

            <thead>
                <tr>
                    <th>آیدی</th>
                    <th>نام</th>
                    <th>آدرس</th>
                    <th>تاریخ ثبت(در سامانه)</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($product) : ?>
                    <tr>
                        <td class="first"><?= $product->id ?></td>
                        <td><?= $product->name ?></td>
                        <td class="table-td-overflow"><?= $product->description ?></td>
                        <td><?= $product->created_at ?></td>
                        
                    </tr>
                <?php endif; ?>


            </tbody>
        </table>

        <br />

        <table cellpadding="0" cellspacing="0" width="100%">
            <h3 style="text-align: center;">انبار های شامل محصول</h3>
            <thead>
                <tr>
                    <th>آیدی</th>
                    <th>نام</th>
                    <th>آدرس</th>
                    <th>تعداد در انبار</th>
                    <th>تاریخ افزودن این محصول در انبار</th>
                    <th>عملیات</th>

                </tr>
            </thead>
            <tbody>
                <?php if ($storages) : ?>
                    <?php foreach ($storages as $storage) : ?>
                        <tr>
                            <td class="first"><?= $storage->id ?></td>
                            <td><?= $storage->name ?></td>
                            <td class="table-td-overflow"><?= $storage->address ?></td>
                            <td style="border-left: 1px solid white;"><?= $storage->count_in_storage ?></td>
                            <td><?= $storage->date_addition_to_pivot ?></td>
                            
                            <td class="center">
                            <a 
                            href="<?= Classes\Utility::site_url("dashboard.php?method=get&action=remove-product-storage&storage-id={$storage->id}&product-id={$_GET['product-id']}") ?>" class="btn btn-danger" 
                            onclick="return confirm('با حذف محصول از انبار موافقید؟')">
                            حذف از انبار
                            </a>
                            
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>


            </tbody>
        </table>
    </div>




</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>انبار ها</title>
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
                    <th>تاریخ ثبت</th>
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
                    <th>تاریخ ثبت</th>
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
                            <td><?= $storage->created_at ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>


            </tbody>
        </table>
    </div>




</body>

</html>
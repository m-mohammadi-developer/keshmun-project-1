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


    <?php
    include Classes\Utility::view('partials.header');
    ?>

    <div class="container">
    <table cellpadding="0" cellspacing="0" width="100%">
        <h3 style="text-align: center;">مشخصات انبار</h3>

            <thead>
                <tr>
                    <th>آیدی</th>
                    <th>نام</th>
                    <th>آدرس</th>
                    <th>تاریخ ثبت</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($storage): ?>
                <tr>
                    <td class="first"><?= $storage->id ?></td>
                    <td><?= $storage->name ?></td>
                    <td class="table-td-overflow"><?= $storage->address ?></td>
                    <td><?= $storage->created_at ?></td>
                </tr>
                <?php endif; ?>


            </tbody>
        </table>

        <br />

        <table cellpadding="0" cellspacing="0" width="100%">
            <h3 style="text-align: center;">محصولات موجود در انبار</h3>
            <thead>
                <tr>
                    <th>آیدی</th>
                    <th>نام</th>
                    <th>توضیحات</th>
                    <th>تعداد</th>
                    <th>تاریخ ثبت</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($products): ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="first"><?= $product->id ?></td>
                    <td><?= $product->name ?></td>
                    <td class="table-td-overflow"><?= $product->description ?></td>
                    <td style="border-left: 1px solid white;"><?= $product->count_in_storage ?></td>
                    <td><?= $product->created_at ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>


            </tbody>
        </table>
    </div>

    


</body>

</html>
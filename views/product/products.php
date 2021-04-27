<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محصولات</title>
    <link rel="stylesheet" href="<?= Classes\Utility::assets('css/styles.css'); ?>" />

</head>

<body>


    <?php
    include Classes\Utility::view('partials.header');
    ?>

    <div class="container">
        <table cellpadding="0" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>آیدی</th>
                    <th>نام</th>
                    <th>توضیحات</th>
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
                    <td><?= $product->created_at ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>


            </tbody>
        </table>
    </div>

    


</body>

</html>
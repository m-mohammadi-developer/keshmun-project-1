<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= (isset($page_title) && !empty($page_title)) ? $page_title : 'ورود'; ?>
    </title>
    <link rel="stylesheet" href="<?= Classes\Utility::assets('css/styles.css'); ?>" />
    <link rel="stylesheet" href="<?= Classes\Utility::assets('css/login.css'); ?>" />



</head>

<body>
    <?php include Classes\Utility::view('partials.header'); ?>

    <div class="login-page">
        <div style="text-align: center;color: red;">
            <?php
            if (isset($errors['login_error'])) {
                echo $errors['login_error'];
            }
            ?>

        </div>

        <div class="container center">
            <div class="form">
                <form class="login-form" method="POST" action="<?php Classes\Utility::site_url('index.php?action=login') ?>">
                    <!-- <img src="https://fakeimg.pl/100x100/?text=Logo" /> -->
                    <input type="hidden" name="action" value="login" />

                    <input type="text" placeholder="نام کاربری" name="username" />
                    <input type="password" placeholder="پسورد" name="password" />
                    <button class="btn" type="submit">ورود</button>
                </form>
            </div>
        </div>

    </div>
</body>

</html>
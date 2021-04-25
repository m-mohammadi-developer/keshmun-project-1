<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= (isset($page_title) && !empty($page_title)) ? $page_title : 'ورود'; ?>
    </title>
    <link rel="stylesheet" href="<?= Utility::assets('css/styles.css'); ?>" />
    <link rel="stylesheet" href="<?= Utility::assets('css/login.css'); ?>" />



</head>

<body>
    <?php include Utility::view('partials.header'); ?>
    
    <div class="login-page">
        <div class="form">
            <form class="login-form">
                <!-- <img src="https://fakeimg.pl/100x100/?text=Logo" /> -->
                <input type="text" placeholder="نام کاربری" />
                <input type="password" placeholder="پسورد" />
                <button class="btn">ورود</button>
                <p class="message">اکانت دارید ندارید؟<a href="#">ثبت نام</a></p>
            </form>
        </div>
    </div>
</body>

</html>
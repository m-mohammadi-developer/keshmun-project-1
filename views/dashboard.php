<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php echo isset($page_title) ? $page_title : 'داشبورد مدیریت' ?></title>

    <link rel="stylesheet" href="<?= Classes\Utility::assets('css/styles.css'); ?>" />

 
</head>

<body>


    <?php
    include Classes\Utility::view('partials.header');
    ?>
    <div class="container">
        <div id="form-main-container">
            <div id="form-area">
                
                <div id="form-title">
                    داشبورد مدیریت
                </div>
                <div id="form-body">
                    <p style="margin-left: 10px;font-size: 16px;">
                        به سایت انبار داری کشمون خوش آمدید شما میتوانید به خدمات ما از طریق منو بالایی سایت دسترسی داشته باشید
                        در صورت بروز هرگونه مشکل با پشتیبانی تماس بگیرید
                    </p>
                    با تشکر
                    <span style="color:#8120a1;font-weight: 700;">
                    محمد محمدی
                    </span>
                </div>
            </div>
        </div>
   
    </div>
    





</body>

</html>
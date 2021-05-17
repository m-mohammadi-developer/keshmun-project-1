<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'افزودن محصول' ?></title>
    <link rel="stylesheet" href="<?= assets('css/styles.css'); ?>" />

 
</head>

<body>


    <?php
    include view('partials.header');
    ?>
    <div class="container">
    <form method="POST" action="<?= site_url('dashboard.php?action=add-product&page=add-product') ?>">
        <div id="form-main-container">
            <div id="form-area">
                <div id="form-title">
                    ثبت محصول جدید
                </div>
                <div id="form-body">
                    <div>
                        
                        <?php if(!empty($errors['add-product'])): ?>
                        <div class="col-12 error">
                            <?php foreach ($errors['add-product'] as $error): ?>
                                <h6 style="color: #cd3232e8; margin-right: 10px;"><?= $error ?></h6>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label class="form-label" for="input4">نام</label>
                                <input type="text" name="product_name" class="form-control" id="input4" placeholder="نام یا عنوان محصول را وارد کنید" required>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label class="form-label" for="input5">توضیحات</label>
                                <textarea name="product_description" id="" cols="30" rows="10" class="form-control" placeholder="لطفا توضیحات محصول را وارد کنید"></textarea>
                            </fieldset>
                        </div>
                    </div>
                    <div>
                        <div class="center-text button-area">
                            <button type="submit" class="btn btn-cancel">افزودن محصول جدید</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    





</body>

</html>
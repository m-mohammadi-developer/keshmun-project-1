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
    <form method="POST" action="<?= Classes\Utility::site_url('dashboard.php?action=add-storage') ?>">
        <div id="form-main-container">
            <div id="form-area">
                <div id="form-title">
                    ثبت انبار جدید
                </div>
                <div id="form-body">
                    <div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label class="form-label" for="input4">نام</label>
                                <input type="text" name="storage_name" class="form-control" id="input4" placeholder="نام یا عنوان محصول را وارد کنید" required>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label class="form-label" for="input5">آدرس</label>
                                <input type="text" name="storage_address" class="form-control" id="input4" placeholder="نام یا عنوان محصول را وارد کنید" required>
                            </fieldset>
                        </div>
                    </div>
                    <div>
                        <div class="center-text button-area">
                            <button type="submit" class="btn btn-cancel">افزودن</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    





</body>

</html>
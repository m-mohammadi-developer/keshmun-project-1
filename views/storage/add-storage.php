<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'افزودن انبار' ?></title>
    <link rel="stylesheet" href="<?= assets('css/styles.css'); ?>" />


</head>

<body>


    <?php
    include view('partials.header');
    ?>
    <div class="container">
        <form method="POST" action="<?= site_url('dashboard.php?action=add-storage&page=add-storage') ?>">
            <div id="form-main-container">
                <div id="form-area">
                    <div id="form-title">
                        ثبت انبار جدید
                    </div>
                    <div id="form-body">
                        <div>
                            <?php if (!empty($errors['add-storage'])) : ?>
                                <div class="col-12 error">
                                    <?php foreach ($errors['add-storage'] as $error) : ?>
                                        <h6 style="color: #cd3232e8; margin-right: 10px;"><?= $error ?></h6>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <div class="col-12">
                                <fieldset class="form-group">
                                    <label class="form-label" for="input4">نام</label>
                                    <input type="text" name="storage_name" class="form-control" id="input4" placeholder="نام انبار را وارد کنید" required>
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <fieldset class="form-group">
                                    <label class="form-label" for="input5">آدرس</label>
                                    <input type="text" name="storage_address" class="form-control" id="input4" placeholder="آدرس انبار را وارد کنید" required>
                                </fieldset>
                            </div>
                        </div>
                        <div>
                            <div class="center-text button-area">
                                <button type="submit" class="btn btn-cancel">افزودن انبار</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>






</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محصولات</title>
    <link rel="stylesheet" href="<?= Classes\Utility::assets('css/styles.css'); ?>" />


</head>
<style>
    
</style>

<body>


    <?php

    use Classes\Utility;

    include Classes\Utility::view('partials.header');
    ?>
    <div class="container">
        <form id="form-relate" method="POST" action="<?= Classes\Utility::site_url('/actions/ajax-handler.php') ?>">
            <div id="form-main-container">
                <div id="form-area">
                    <div id="form-title">
                        ثبت اطلاعات محصول در انبار
                    </div>
                    <div id="form-body">
                        <div>
                            <input type="hidden" name="action" value="relate_product_storage">
                            <h6 class="form-group">
                                توجه : در صورتی که کالای مورد نظر در انبار ثبت شده باشد تعداد آن آپدیت می شود
                            </h6>
                            

                            <div class="col-12">
                                <fieldset class="form-group">
                                    <label class="form-label" for="input4">انتخاب محصول</label>
                                    <?php if ($products) : ?>
                                        <select name="product_id" class="form-control">
                                            <?php foreach ($products as $product) : ?>
                                                <option value="<?= $product->id ?>"><?= $product->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php else : ?>
                                        هیچ محصولی پیدا نشد
                                    <?php endif; ?>
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <fieldset class="form-group">
                                    <label class="form-label" for="input5">انتخاب انبار</label>
                                    <?php if ($products) : ?>
                                        <select name="storage_id" class="form-control">
                                            <?php foreach ($storages as $storage) : ?>
                                                <option value="<?= $storage->id ?>"><?= $storage->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php else : ?>
                                        هیچ انباری پیدا نشد
                                    <?php endif; ?>
                                </fieldset>
                            </div>

                            <div class="col-12">
                                <fieldset class="form-group">
                                    <label class="form-label" for="input5">تعداد موجود</label>
                                    <input type="number" name="product_count" class="form-control" placeholder="تعداد محصول موجود در انبار را وارد کنید" required>
                                </fieldset>
                            </div>
                        </div>
                        <div>
                            <div class="center-text button-area">
                                <button type="submit" id="btn-ralate" class="btn btn-cancel">ثبت در انبار</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        $('#form-relate').submit(function(e) {
            e.preventDefault();
            var form = $(this);

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
                    alert(response);
                }
            });
        });
    </script>




</body>

</html>
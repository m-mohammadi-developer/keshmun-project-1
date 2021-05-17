<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'انبار ها' ?></title>
    <link rel="stylesheet" href="<?= assets('css/styles.css'); ?>" />

</head>

<body>


    <?php
    use Classes\Utility;
    include view('partials.header');
    ?>

    <?php if (!empty($errors['edit-storage'])) : ?>
        <div class="container">
            <div class="col-12 error">
                <?php foreach ($errors['edit-storage'] as $error) : ?>
                    <h6 style="color: #cd3232e8; margin-right: 10px; font-size: 18px;"><?= $error ?></h6>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>


    <div class="container">
        <h3 class="center-text">لیست انبار ها</h3>
        <table width="100%">
            <thead>
                <tr>
                    <th>آیدی</th>
                    <th>نام</th>
                    <th>آدرس</th>
                    <th>تاریخ ثبت(در سامانه)</th>
                    <th style="width: 20%;">عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($storages) : ?>
                    <?php foreach ($storages as $storage) : ?>
                        <tr>
                            <td class="first"><?= $storage->id ?></td>
                            <td><?= $storage->name ?></td>
                            <td class="table-td-overflow"><?= $storage->address ?></td>
                            <td style="width: 18%;"><?= $storage->created_at ?></td>
                            <td style="width: 30%;">
                                <a
                                href="<?= site_url("dashboard.php?method=get&action=remove-storage&storage-id=$storage->id") ?>" 
                                class="btn btn-danger" 
                                onclick="return confirm('با حذف انبار تمامی اطلاعات ثبت شده محصولات در انبار مورد نظر حذف می شود آیا موافقید؟')"
                                >حذف</a>
                 
                                <button data-sid="<?= $storage->id ?>" class="btn btn-info edit-button">ویرایش</button>
                                <a href="<?= site_url("dashboard.php?page=storage-products&storage-id={$storage->id}") ?>" class="btn btn-secandry" style="width: auto;">محصولات</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>


            </tbody>
        </table>
    </div>

    <div class="container">
        <div class="modal-overlay" id="editModal" style="display: none;">
            <div class="modal">
                <span class="close">x</span>
                <h3 class="modal-title">ویرایش انبار</h3>
                <div class="modal-content">
                    <form id='editStorage' action="<?= site_url('dashboard.php?action=edit-storage&page=storages') ?>" method="post">
                        <input type="hidden" id="s-id" name="storage_id" value="">
                        <div class="field-row">
                            <div class="field-title">نام انبار</div>
                            <div class="field-content">
                                <input type="text" name="storage_name" id="s-name" placeholder="نام انبار را وارد کنید">
                            </div>
                        </div>
                        <div class="field-row">
                            <div class="field-title">آدرس محصول</div>
                            <div class="field-content">
                                <input type="text" name="storage_address" id="s-address" placeholder="آدرس انبار را وارد کنید">
                            </div>
                        </div>
                        <div class="field-row">
                            <div class="field-title"><a style="text-decoration: none;" href="<?= '#' ?>">ذخیره و بستن</a></div>
                            <div class="field-content">
                                <input type="submit" name="edit-str" value=" ویرایش ">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $('#editModal .close').click(function() {
            $("#editModal").fadeOut(500);
        });

        $(".edit-button").click(function() {

            const btn = $(this);
            const form = $("#editStorage");

            // ajax request to get product by its id
            $.ajax({
                url: '<?= site_url('/actions/ajax-handler.php') ?>',
                method: 'POST',
                data: {
                    storage_id: btn.attr('data-sid'),
                    action: 'edit-storage'
                },
                success: function(response) {
                    const resp = JSON.parse(response);
                    if (resp['type'] === 'success') {
                        // show modal for edit
                        $("#editModal").fadeIn(200);
                        // fill form with data from server
                        const storage = JSON.parse(resp['data']);
                        $("#s-id").val(storage['id']);
                        $("#s-name").val(storage['name']);
                        $("#s-address").val(storage['address']);

                    } else if (resp['type'] === 'error') {
                        alert(resp['data']);
                    } else {
                        alert('مشکلی پیش آمد صحفحه را رفرش کرده و دوباره تلاش کنید')
                    }
                }
            });

        });
    </script>

</body>

</html>
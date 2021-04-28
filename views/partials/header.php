<header class="header">
    <a href="" class="logo">
        <img src="assets/images/logo.png" alt="keshmun" height="22px;">
    </a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu" style="text-align: right;">

        <?php  if ($session->isUserLoggedIn()): ?>
        <li><a href="<?= Classes\Utility::site_url('?action=logout') ?>">خروج</a></li>
        
        <li><a href="<?= Classes\Utility::site_url('dashboard.php?page=pivot-storage-product') ?>">انبار داری</a></li>
        <li><a href="<?= Classes\Utility::site_url('dashboard.php?page=add-storage') ?>">افزودن انبار</a></li>
        <li><a href="<?= Classes\Utility::site_url('dashboard.php?page=add-product') ?>">افزودن محصول</a></li>
        <li><a href="<?= Classes\Utility::site_url('dashboard.php?page=products') ?>">محصولات</a></li>
        <li><a href="<?= Classes\Utility::site_url('dashboard.php?page=storages') ?>">انبار ها</a></li>

    

        <?php endif; ?>
        <li><a href="<?= Classes\Utility::site_url() ?>">خانه</a></li>
    </ul>
</header>
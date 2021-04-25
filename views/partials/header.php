<header class="header">
    <a href="" class="logo">
        <img src="assets/images/logo.png" alt="keshmun" height="22px;">
    </a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu" style="text-align: right;">
        <li><a href="#about">درباره ما</a></li>

        <?php 
        if ($session->isUserLoggedIn()):
        ?>
        <li><a href="<?= Classes\Utility::site_url('?action=logout') ?>">خروج</a></li>
        <?php endif; ?>
        <li><a href="<?= Classes\Utility::site_url() ?>">خانه</a></li>
    </ul>
</header>
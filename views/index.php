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
   
</head>

<body>
    <?php include SITE_ROOT . DS . 'views/partials/header.php'; ?>
    
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?> :: Smile & Sunshine Toy Co. Ltd.</title>
    <link rel="stylesheet" href="/assets/bulma.min.css">
    <link rel="stylesheet" href="/assets/bulma-list.css">
    <script src="/assets/navbar.js" defer async></script>
    <script defer src="/assets/fontawesome/js/solid.min.js"></script>
    <script defer src="/assets/fontawesome/js/duotone.min.js"></script>
    <script defer src="/assets/fontawesome/js/fontawesome.min.js"></script>
</head>
<body>
<nav class="navbar is-primary is-spaced">
        <div class="navbar-brand">
            <a class="navbar-item" href="/admin">
                <span class="icon-text">
                    <span class="icon">
                        <i class="fa-duotone fa-solid fa-teddy-bear"></i>
                    </span>
                    <span>Smile & Sunshine Toy Co. Ltd.</span>
                </span>
            </a>
            <a class="navbar-burger" data-target="main-menu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="main-menu" class="navbar-menu">
            <? ((isset($navbar_menu_tpl)) ? require($navbar_menu_tpl) : ""); ?>
        </div>
    </nav>
    <? require($tpl); ?>
</body>
</html>

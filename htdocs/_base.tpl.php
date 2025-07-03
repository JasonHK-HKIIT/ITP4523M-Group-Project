<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?> :: Smile & Sunshine Toy Co. Ltd.</title>
    <link rel="stylesheet" href="/assets/bulma.min.css">
    <link rel="stylesheet" href="/assets/bulma-list.css">
    <link rel="stylesheet" href="/assets/common.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/duotone.min.css">
    <script src="/assets/common.js" defer async></script>
    <? foreach ($extra_head as $entry): ?>
        <?= $entry ?>
    <? endforeach ?>
</head>
<body>
    <nav class="navbar is-<?= $navbar_theme ?? "primary" ?> is-spaced">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
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
            <div class="navbar-start">
                <? if (is_client()): ?>
                    <a class="navbar-item" href="/">Home</a>
                    <a class="navbar-item" href="/products.php">Products</a>
                    <? if (is_logged_in()): ?>
                        <a class="navbar-item" href="/orders.php">Orders</a>
                    <? endif ?>
                <? else: ?>
                    <a class="navbar-item" href="/admin/">Home</a>
                    <a class="navbar-item" href="/admin/orders.php">Orders</a>
                    <a class="navbar-item" href="/admin/products.php">Products</a>
                    <a class="navbar-item" href="/admin/materials.php">Materials</a>
                    <a class="navbar-item" href="/admin/reports.php">Reports</a>
                <? endif ?>
            </div>

            <div class="navbar-end">
                <? if (is_client()): ?>
                    <div class="navbar-item">
                        <div class="select is-small">
                            <select id="currency">
                                <option value="USD">USD ($)</option>
                                <option value="EUR">EUR (€)</option>
                                <option value="HKD">HKD (HK$)</option>
                                <option value="JPY">JPY (¥)</option>
                            </select>
                        </div>
                    </div>
                    <? if (is_logged_in()): ?>
                        <a class="navbar-item" href="/profile.php">Profile</a>
                    <? endif ?>
                <? endif ?>
                <? if (is_logged_in()): ?>
                    <a class="navbar-item" href="/logout.php">Log Out</a>
                <? else: ?>
                    <a class="navbar-item" href="/login.php">Log In</a>
                    <a class="navbar-item" href="/register.php">Register</a>
                <? endif ?>
            </div>
        </div>
    </nav>
    <? require($tpl); ?>
</body>
</html>

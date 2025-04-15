<div class="navbar-start">
    <a class="navbar-item" href="/">Home</a>
    <a class="navbar-item" href="/products.php">Products</a>
    <a class="navbar-item" href="/orders.php">Orders</a>
</div>

<div class="navbar-end">
    <a class="navbar-item" href="/cart.php">Cart</a>
    <a class="navbar-item" href="/profile.php">Profile</a>
    <? if (is_logged_in()): ?>
        <a class="navbar-item" href="/logout.php">Log Out</a>
    <? else: ?>
        <a class="navbar-item" href="/login.php">Log In</a>
        <a class="navbar-item" href="/register.php">Register</a>
    <? endif ?>
</div>

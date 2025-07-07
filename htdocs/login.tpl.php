<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            Login
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" enctype="application/x-www-form-urlencoded">

        <div class="field is-horizontal">
            <div class="field-label">
                <label for="username" class="label">User Type</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <div class="control">
                        <div class="radios">
                            <label class="radio">
                                <input type="radio" name="user_type" value="0"<?php echo (@$user["user_type"] !== USER_STAFF) ? " checked" : "" ?> />
                                Client
                            </label>
                            <label class="radio">
                                <input type="radio" name="user_type" value="1"<?php echo (@$user["user_type"] === USER_STAFF) ? " checked" : "" ?> />
                                Staff
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="uid" class="label">User ID</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="uid" class="input<?php echo (isset($error_messages["uid"]) || isset($error_messages["password"])) ? " is-danger" : "" ?>" name="uid" value="<?php echo htmlspecialchars(@$user["uid"]) ?>" type="text" autocomplete="username" placeholder="User ID" required />
                    </p>
                    <?php if (isset($error_messages["uid"])): ?>
                        <p class="help is-danger"><?php echo $error_messages["uid"] ?></p>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="password" class="label">Password</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="password" class="input<?php echo (isset($error_messages["uid"]) || isset($error_messages["password"])) ? " is-danger" : "" ?>" name="password" type="password" autocomplete="current-password" placeholder="Password" required />
                    </p>
                    <?php if (isset($error_messages["password"])): ?>
                        <p class="help is-danger"><?php echo $error_messages["password"] ?></p>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label"></div>
            <div class="field-body">
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" type="submit">
                            <span class="icon is-small">
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </span>
                            <span>Login</span>
                        </button>
                    </div>
                    <div class="control">
                        <a class="button is-text" href="/register.php<?php echo !empty($_SERVER["QUERY_STRING"]) ? sprintf("?%s", $_SERVER["QUERY_STRING"]) : "" ?>">
                            Register a new account
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </form>
</main>

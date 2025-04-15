<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            Login
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" enctype="application/x-www-form-urlencoded">

        <div class="field is-horizontal">
            <div class="field-label">
                <label for="username" class="label">User Type</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <div class="control">
                        <div class="radios">
                            <label class="radio">
                                <input type="radio" name="user_type" value="0"<?= (!isset($field_values["user_type"]) || ($field_values["user_type"] !== USER_STAFF)) ? " checked" : "" ?> />
                                Client
                            </label>
                            <label class="radio">
                                <input type="radio" name="user_type" value="1"<?= (isset($field_values["user_type"]) && ($field_values["user_type"] === USER_STAFF)) ? " checked" : "" ?> />
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
                        <input id="uid" class="input<?= isset($error_messages["uid"]) ? " is-danger" : "" ?>" name="uid" value="<?= $field_values["uid"] ?? "" ?>" type="text" autocomplete="username" placeholder="Username" required />
                    </p>
                    <? if (isset($error_messages["uid"])): ?>
                        <p class="help is-danger"><?= $error_messages["uid"] ?></p>
                    <? endif ?>
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
                        <input id="password" class="input<?= isset($error_messages["password"]) ? " is-danger" : "" ?>" name="password" type="password" autocomplete="current-password" placeholder="Password" required />
                    </p>
                    <? if (isset($error_messages["password"])): ?>
                        <p class="help is-danger"><?= $error_messages["password"] ?></p>
                    <? endif ?>
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
                        <a class="button is-text" href="/register.php<?= !empty($_SERVER["QUERY_STRING"]) ? sprintf("?%s", $_SERVER["QUERY_STRING"]) : "" ?>">
                            Register a new account
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </form>
</main>

<script src="/assets/forms.js" defer async></script>

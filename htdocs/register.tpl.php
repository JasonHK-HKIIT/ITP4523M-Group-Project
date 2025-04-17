<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            Register
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="/register.php" method="post" enctype="application/x-www-form-urlencoded">

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="username" class="label">Name</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="username" class="input<?= isset($error_messages["cname"]) ? " is-danger" : "" ?>" name="cname" value="<?= @$client["cname"] ?>" type="text" autocomplete="name" placeholder="Name" required />
                    </p>
                    <? if (isset($error_messages["cname"])): ?>
                        <p class="help is-danger"><?= $error_messages["cname"] ?></p>
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
                        <input id="password" class="input<?= isset($error_messages["cpassword"]) ? " is-danger" : "" ?>" name="cpassword" type="password" autocomplete="new-password" placeholder="Password" required />
                    </p>
                    <? if (isset($error_messages["cpassword"])): ?>
                        <p class="help is-danger"><?= $error_messages["cpassword"] ?></p>
                    <? endif ?>
                </div>
                <div class="field is-narrow">
                    <p class="control">
                        <input id="confirm-password" class="input<?= isset($error_messages["cpassword_confirm"]) ? " is-danger" : "" ?>" name="cpassword_confirm" type="password" autocomplete="new-password" placeholder="Confirm Password" required />
                    </p>
                    <? if (isset($error_messages["cpassword_confirm"])): ?>
                        <p class="help is-danger"><?= $error_messages["cpassword_confirm"] ?></p>
                    <? endif ?>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="telephone" class="label">Telephone</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="telephone" class="input<?= isset($error_messages["ctel"]) ? " is-danger" : "" ?>" name="ctel" value="<?= @$client["ctel"] ?>" type="tel" size="8" maxlength="8" placeholder="Telephone" />
                    </p>
                    <? if (isset($error_messages["ctel"])): ?>
                        <p class="help is-danger"><?= $error_messages["ctel"] ?></p>
                    <? endif ?>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="address" class="label">Address</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control is-expanded">
                        <textarea id="address" name="caddr" class="textarea" rows="3"><?= @$client["caddr"] ?></textarea>
                    </p>
                    <? if (isset($error_messages["caddr"])): ?>
                        <p class="help is-danger"><?= $error_messages["caddr"] ?></p>
                    <? endif ?>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="company-name" class="label">Company Name</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="company-name" class="input" name="company" value="<?= @$client["company"] ?>" type="text" placeholder="Company Name" />
                    </p>
                    <? if (isset($error_messages["company"])): ?>
                        <p class="help is-danger"><?= $error_messages["company"] ?></p>
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
                                <i class="fa-solid fa-sparkles"></i>
                            </span>
                            <span>Register</span>
                        </button>
                    </div>
                    <div class="control">
                        <a class="button is-text" href="/login.php<?= !empty($_SERVER["QUERY_STRING"]) ? sprintf("?%s", $_SERVER["QUERY_STRING"]) : "" ?>">
                            Login to a existing account
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </form>
</main>

<script src="/assets/forms.js" defer async></script>

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
                <label for="password" class="label">Password</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="password" class="input<?php echo (isset($error_messages["cpassword"]) || isset($error_messages["cpassword_confirm"])) ? " is-danger" : "" ?>" name="cpassword" placeholder="Password" type="password" autocomplete="new-password" maxlength="255" required />
                    </p>
                    <?php if (isset($error_messages["cpassword"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["cpassword"]) ?></p>
                    <?php endif ?>
                </div>
                <div class="field is-narrow">
                    <p class="control">
                        <input id="confirm-password" class="input<?php echo (isset($error_messages["cpassword"]) || isset($error_messages["cpassword_confirm"])) ? " is-danger" : "" ?>" name="cpassword_confirm" placeholder="Confirm Password" type="password" autocomplete="new-password" maxlength="255" required />
                    </p>
                    <?php if (isset($error_messages["cpassword_confirm"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["cpassword_confirm"]) ?></p>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="name" class="label">Name</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="name" class="input<?php echo isset($error_messages["cname"]) ? " is-danger" : "" ?>" name="cname" placeholder="Name" value="<?php echo htmlspecialchars(@$client["cname"]) ?>" type="text" autocomplete="name" maxlength="255" required />
                    </p>
                    <?php if (isset($error_messages["cname"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["cname"]) ?></p>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="company" class="label">Company</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="company" class="input<?php echo isset($error_messages["company"]) ? " is-danger" : "" ?>" name="company" placeholder="Company Name" value="<?php echo htmlspecialchars(@$client["company"]) ?>" type="text" maxlength="255" />
                    </p>
                    <?php if (isset($error_messages["company"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["company"]) ?></p>
                    <?php endif ?>
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
                        <input id="telephone" class="input<?php echo isset($error_messages["ctel"]) ? " is-danger" : "" ?>" name="ctel" placeholder="Telephone" value="<?php echo htmlspecialchars(@$client["ctel"]) ?>" type="tel" size="8" maxlength="8" />
                    </p>
                    <?php if (isset($error_messages["ctel"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["ctel"]) ?></p>
                    <?php endif ?>
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
                        <textarea id="address" class="textarea<?php echo isset($error_messages["caddr"]) ? " is-danger" : "" ?>" name="caddr" rows="3" maxlength="25565"><?php echo htmlspecialchars(@$client["caddr"]) ?></textarea>
                    </p>
                    <?php if (isset($error_messages["caddr"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["caddr"]) ?></p>
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
                                <i class="fa-solid fa-sparkles"></i>
                            </span>
                            <span>Register</span>
                        </button>
                    </div>
                    <div class="control">
                        <a class="button is-text" href="/login.php<?php echo !empty($_SERVER["QUERY_STRING"]) ? sprintf("?%s", $_SERVER["QUERY_STRING"]) : "" ?>">
                            Login to an existing account
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </form>
</main>

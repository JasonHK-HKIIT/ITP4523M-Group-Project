<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            Profile
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="/profile.php" method="post" enctype="application/x-www-form-urlencoded">

        <div class="field is-horizontal">
            <div class="field-label">
                <label for="uid" class="label">User ID</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <?php echo $client["cid"] ?>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="current-password" class="label">Current Password</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="current-password" class="input<?php echo isset($error_messages["cpassword"]) ? " is-danger" : "" ?>" name="cpassword" placeholder="Current Password" type="password" autocomplete="current-password" />
                    </p>
                    <?php if (isset($error_messages["cpassword"])): ?>
                        <p class="help is-danger"><?php echo $error_messages["cpassword"] ?></p>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="new-password" class="label">New Password</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="new-password" class="input<?php echo (isset($error_messages["cpassword_new"]) || isset($error_messages["cpassword_confirm"])) ? " is-danger" : "" ?>" name="cpassword_new" placeholder="New Password" type="password" autocomplete="new-password" />
                    </p>
                    <?php if (isset($error_messages["cpassword_new"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["cpassword"]) ?></p>
                    <?php endif ?>
                </div>
                <div class="field is-narrow">
                    <p class="control">
                        <input id="confirm-password" class="input<?php echo (isset($error_messages["cpassword_new"]) || isset($error_messages["cpassword_confirm"])) ? " is-danger" : "" ?>" name="cpassword_confirm" placeholder="Confirm New Password" type="password" autocomplete="new-password" />
                    </p>
                    <?php if (isset($error_messages["cpassword_confirm"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["cpassword_confirm"]) ?></p>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label">
                <label for="name" class="label">Name</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p>
                        <?php echo htmlspecialchars($client["cname"]) ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label">
                <label for="company" class="label">Company</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p>
                        <?php echo htmlspecialchars($client["company"]) ?>
                    </p>
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
                                <i class="fa-solid fa-floppy-disk"></i>
                            </span>
                            <span>Save</span>
                        </button>
                    </div>
                    <div class="control">
                        <a class="button is-light is-cancel" href="/">
                            <span class="icon is-small">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                            <span>Cancel</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </form>
</main>

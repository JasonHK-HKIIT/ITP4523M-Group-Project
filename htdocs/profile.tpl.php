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
            <div class="field-label is-normal">
                <label for="current-password" class="label">Current Password</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="current-password" class="input" name="current_password" type="password" autocomplete="current-password" placeholder="Current Password" required />
                    </p>
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
                        <input id="new-password" class="input" name="new_password" type="password" autocomplete="new-password" placeholder="New Password" />
                    </p>
                </div>
                <div class="field is-narrow">
                    <p class="control">
                        <input id="confirm-password" class="input" name="confirm_password" type="password" autocomplete="new-password" placeholder="Confirm New Password" />
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
                        <input id="telephone" class="input" name="telephone" type="tel" size="8" placeholder="Telephone" required />
                    </p>
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
                        <textarea id="address" name="address" class="textarea" rows="3" required></textarea>
                    </p>
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
                        <button class="button is-light is-cancel">
                            <span class="icon is-small">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                            <span>Cancel</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</main>

<script src="/assets/forms.js" defer async></script>

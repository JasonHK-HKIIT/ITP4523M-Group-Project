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
                <label for="username" class="label">Username</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="username" class="input" name="username" type="text" autocomplete="username" placeholder="Username" required />
                    </p>
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
                        <input id="password" class="input" name="password" type="password" autocomplete="new-password" placeholder="Password" required />
                    </p>
                </div>
                <div class="field is-narrow">
                    <p class="control">
                        <input id="confirm-password" class="input" name="confirm_password" type="password" autocomplete="new-password" placeholder="Confirm Password" required />
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
                <label for="company-name" class="label">Company Name</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="company-name" class="input" name="company_name" type="text" placeholder="Company Name" required />
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

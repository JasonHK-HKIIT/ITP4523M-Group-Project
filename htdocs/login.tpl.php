<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            Login
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="/login.php" method="post" enctype="application/x-www-form-urlencoded">

        <div class="field is-horizontal">
            <div class="field-label">
                <label for="username" class="label">User Type</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <div class="control">
                        <div class="radios">
                            <label class="radio">
                                <input type="radio" name="user_type" value="0" checked />
                                Client
                            </label>
                            <label class="radio">
                                <input type="radio" name="user_type" value="1" />
                                Staff
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="username" class="label">User ID</label>
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
                        <input id="password" class="input" name="password" type="password" autocomplete="current-password" placeholder="Password" required />
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

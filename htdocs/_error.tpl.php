<main class="hero is-danger is-fullheight-with-navbar">
    <div class="hero-body">
        <div class="container is-max-desktop has-text-centered">
            <h1 class="title">
                <?= $error_title ?? "Error" ?>
            </h1>
            <p class="subtitle">
                <?= $error_message ?? "An error has occurred." ?>
                <div class="buttons is-centered">
                    <a class="button is-primary" href="/">
                        <span class="icon">
                            <i class="fa-solid fa-house"></i>
                        </span>
                        <span>Return to Home</span>
                    </a>
                </div>
            </p>
        </div>
    </div>
</main>

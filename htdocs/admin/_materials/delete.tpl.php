<main class="hero is-warning is-fullheight-with-navbar">
    <div class="hero-body">
        <form class="container is-max-desktop has-text-centered" action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" type="application/x-www-form-urlencoded">
            
            <input name="mid" value="<?= $material["mid"] ?>" type="hidden" />

            <h1 class="title">
                Delete Material
            </h1>
            <p class="subtitle">
                Are you sure to delete the material “<?= htmlspecialchars($material["mname"]) ?>” (ID: <?= $material["mid"] ?>)?
                <div class="buttons is-centered">
                    <button class="button is-danger is-dark" type="submit">
                        <span class="icon">
                            <i class="fa-solid fa-trash"></i>
                        </span>
                        <span>Delete</span>
                    </button>
                    <button class="button is-dark is-cancel">
                        <span class="icon is-small">
                            <i class="fa-solid fa-xmark"></i>
                        </span>
                        <span>Cancel</span>
                    </button>
                </div>
            </p>
            
        </form>
    </div>
</main>

<script src="/assets/forms.js" defer async></script>

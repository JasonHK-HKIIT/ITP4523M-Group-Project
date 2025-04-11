<header class="hero is-primary is-medium">
    <div class="hero-body">
        <div class="container is-max-desktop">
            <h1 class="title">
                Materials
            </h1>
        </div>
    </div>
</header>

<main class="m-4 mt-5">
    <div class="container is-max-desktop">
        <div class="list has-visible-pointer-controls">
            <? foreach ($materials as $material): ?>
                <div class="list-item">
                    <div class="list-item-image">
                        <figure class="image is-96x96">
                            <img src="/assets/materials/<?= $material["mid"] ?>.jpg" alt="<?= $material["mname"] ?>">
                        </figure>
                    </div>
                    <div class="list-item-content">
                        <div class="list-item-title"><?= $material["mname"] ?></div>
                    </div>
                    <div class="list-item-controls">
                        <div class="is-flex is-align-items-center">
                            <div class="buttons ml-3">
                                <a class="button is-hidden-mobile" href="/admin/materials.php?action=edit&id=<?= $material["mid"] ?>">
                                    <span class="icon">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                                <a class="button is-hidden-tablet" title="Edit" aria-label="Edit" href="/admin/materials.php?action=edit&id=<?= $material["mid"] ?>">
                                    <span class="icon">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </span>
                                </a>
                                <a class="button" title="Delete" aria-label="Delete" href="/admin/materials.php?action=delete&id=<?= $material["mid"] ?>">
                                    <span class="icon">
                                        <i class="fa-solid fa-trash"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <? endforeach ?>
        </div>
    </div>
</main>

<header class="hero is-primary is-medium">
    <div class="hero-body">
        <div class="container is-max-desktop">
            <h1 class="title">
                Products
            </h1>
        </div>
    </div>
</header>

<main class="m-4 mt-5">
    <div class="container is-max-desktop">
        <div class="list has-visible-pointer-controls">
            <? foreach ($products as $product): ?>
                <div class="list-item">
                    <div class="list-item-image">
                        <figure class="image is-96x96">
                            <img src="/assets/products/<?= $product["id"] ?>.jpg" alt="<?= $product["name"] ?>">
                        </figure>
                    </div>
                    <div class="list-item-content">
                        <div class="list-item-title"><?= $product["name"] ?></div>
                    </div>
                    <div class="list-item-controls">
                        <div class="is-flex is-align-items-center">
                            <div class="buttons ml-3">
                                <a class="button is-hidden-mobile" href="/admin/products.php?action=edit&id=<?= $product["id"] ?>">
                                    <span class="icon">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                                <a class="button is-hidden-tablet" title="Edit" aria-label="Edit" href="/admin/products.php?action=edit&id=<?= $product["id"] ?>">
                                    <span class="icon">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </span>
                                </a>
                                <a class="button" title="Delete" aria-label="Delete" href="/admin/products.php?action=delete&id=<?= $product["id"] ?>">
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

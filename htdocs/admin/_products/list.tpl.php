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
        <div class="buttons">
            <a class="button is-primary" href="/admin/products.php?action=new">
                <span class="icon">
                    <i class="fa-solid fa-plus"></i>
                </span>
                <span>New Product</span>
            </a>
        </div>
        <div class="list has-visible-pointer-controls">
            <? foreach ($products as $product): ?>
                <div class="list-item box is-align-items-flex-start">
                    <div class="list-item-image">
                        <figure class="image is-96x96">
                            <img src="/assets/products/<?= $product["pid"] ?>.jpg" alt="<?= $product["pname"] ?>">
                        </figure>
                    </div>
                    <div class="list-item-content">
                        <div class="list-item-title"><?= $product["pname"] ?></div>
                        <div class="list-item-description"><?= $product["pdesc"] ?></div>
                    </div>
                    <div class="list-item-controls">
                        <div class="is-flex is-align-items-center">
                            <div class="buttons ml-3">
                                <a class="button is-hidden-mobile" href="/admin/products.php?action=edit&id=<?= $product["pid"] ?>">
                                    <span class="icon">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                                <a class="button is-hidden-tablet" title="Edit" aria-label="Edit" href="/admin/products.php?action=edit&id=<?= $product["pid"] ?>">
                                    <span class="icon">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </span>
                                </a>
                                <a class="button" title="Delete" aria-label="Delete" href="/admin/products.php?action=delete&id=<?= $product["pid"] ?>">
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

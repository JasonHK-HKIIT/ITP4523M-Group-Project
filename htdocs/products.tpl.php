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
                            <div class="field has-addons mb-0">
                                <p class="control">
                                    <input class="input" type="number" size="5" value="1" min="1">
                                </p>
                                <p class="control">
                                    <a class="button is-static">
                                        $0.00
                                    </a>
                                </p>
                            </div>
                            <div class="buttons ml-3">
                                <button class="button" title="Add to Cart" aria-label="Add to Cart">
                                    <span class="icon">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <? endforeach ?>
        </div>
    </div>
</main>

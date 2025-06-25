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
                            <div class="field has-addons mb-0">
                                <p class="control">
                                    <a class="button is-static" data-price="<?= doubleval($product["pcost"]) ?>">
                                        $<?= sprintf("%.2f", doubleval($product["pcost"])) ?>
                                    </a>
                                </p>
                                <p class="control">
                                    <input class="input" type="number" size="2" value="1" min="1" max="<?= $product["pqty"] ?>">
                                </p>
                            </div>
                            <div class="buttons ml-3">
                                <button class="button is-primary is-outlined" title="Add to Cart" aria-label="Add to Cart">
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

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

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="company" class="label">Ordered By</label>
            </div>
            <div class="field-body" style="flex-basis: initial;">
                <div class="field is-narrow">
                    <div class="select">
                        <select id="sort">
                            <option value="magic"
                                <? if ($sort == "magic"): ?>selected<? endif ?>
                            >Magic</option>
                            <option value="price_asc"
                                <? if ($sort == "price_asc"): ?>selected<? endif ?>
                            >Price (Low to High)</option>
                            <option value="price_desc"
                                <? if ($sort == "price_desc"): ?>selected<? endif ?>
                            >Price (High to Low)</option>
                            <option value="name_asc"
                                <? if ($sort == "name_asc"): ?>selected<? endif ?>
                            >Name (A to Z)</option>
                            <option value="name_desc"
                                <? if ($sort == "name_desc"): ?>selected<? endif ?>
                            >Name (Z to A)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="list has-visible-pointer-controls">
            <? foreach ($products as $product): ?>
                <div class="list-item box is-align-items-flex-start">
                    <div class="list-item-image">
                        <figure class="image is-product is-96x96">
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
                                    <a class="button is-static" data-pcost="<?= doubleval($product["pcost"]) ?>">
                                        $<?= sprintf("%.2f", doubleval($product["pcost"])) ?>
                                    </a>
                                </p>
                                <p class="control">
                                    <a class="button is-primary" href="/orders.php?action=new&pid=<?= $product["pid"] ?>" title="Add to Cart" aria-label="Add to Cart">
                                        <span class="icon">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <? endforeach ?>
        </div>

    </div>
</main>

<script>
    document.getElementById("sort").addEventListener("change", function()
    {
        const query = new URLSearchParams(location.search);
        query.set("sort", this.value);

        location.search = `?${query}`;
    });
</script>

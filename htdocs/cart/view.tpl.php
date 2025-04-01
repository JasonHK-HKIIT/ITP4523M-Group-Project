<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            Cart
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="/admin/materials/new" method="post" enctype="application/x-www-form-urlencoded">
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Products</label>
            </div>
            <div class="field-body">
                <div class="is-flex is-flex-direction-column is-flex-grow-1">
                    <div id="products" class="list has-visible-pointer-controls">
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
                                                <input class="input" type="number" size="4" min="1" value="<?= $product["quantity"] ?>">
                                            </p>
                                            <p class="control">
                                                <a class="button is-static"><?= sprintf("\$%.2F", $product["unit_proce"] * $product["quantity"]) ?></a>
                                            </p>
                                        </div>
                                        <div class="buttons ml-3">
                                            <button class="button" title="Add to Cart" aria-label="Add to Cart">
                                                <span class="icon">
                                                    <i class="fa-solid fa-cart-minus"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <? endforeach ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="total-price" class="label">Total Price</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow has-addons">
                    <p class="control">
                        <a class="button is-static">US$</a>
                    </p>
                    <p class="control">
                        <input id="total-price" class="input is-static" name="unit_cost" type="number" readonly />
                    </p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="client-telephone" class="label">Client Telephone</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="client-telephone" name="client_telephone" class="input" type="tel" />
                    </p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="delivery-address" class="label">Delivery Address</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control is-expanded">
                        <textarea id="delivery-address" name="delivery_address" class="textarea" rows="3" required></textarea>
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
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</main>

<script src="/assets/forms.js" defer async></script>

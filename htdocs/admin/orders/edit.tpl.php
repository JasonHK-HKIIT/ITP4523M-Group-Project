<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            Update Order
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="/admin/materials/new" method="post" enctype="application/x-www-form-urlencoded">

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="order-date" class="label">Date</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="order-date" class="input is-static" type="date" value="2025-05-05" readonly />
                    </p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="order-status" class="label">Order Status</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="select">
                        <select id="order-status" name="order_status">
                            <option value="0">Rejected</option>
                            <option value="1" selected>Open</option>
                            <option value="2">Processing</option>
                            <option value="3">Approved</option>
                            <option value="4">Pending Delivery</option>
                            <option value="5">Completed</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="client-name" class="label">Client Name</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="client-name" class="input is-static" type="text" value="Client Name" readonly />
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
                        <input id="client-telephone" name="client_telephone" class="input is-static" type="tel" />
                    </p>
                </div>
            </div>
        </div>
        
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
                <label for="delivery-date" class="label">Delivery Date</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="delivery-date" class="input" name="delivery_date" type="date" value="2025-05-05" />
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
                            <span class="icon is-small">
                                <i class="fa-solid fa-floppy-disk"></i>
                            </span>
                            <span>Save</span>
                        </button>
                    </div>
                    <div class="control">
                        <button class="button is-light is-cancel">
                            <span class="icon is-small">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                            <span>Cancel</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</main>

<script src="/assets/forms.js" defer async></script>

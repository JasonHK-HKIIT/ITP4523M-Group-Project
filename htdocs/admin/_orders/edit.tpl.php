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
            <div class="field-label">
                <label for="order-date" class="label">Date</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control"><?= $order["odate"] ?></p>
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
                            <option value="0"<?= $order["ostatus"] == 0 ? " selected" : "" ?>>Rejected</option>
                            <option value="1"<?= $order["ostatus"] == 1 ? " selected" : "" ?>>Open</option>
                            <option value="2"<?= $order["ostatus"] == 2 ? " selected" : "" ?>>Accepted</option>
                            <option value="3"<?= $order["ostatus"] == 3 ? " selected" : "" ?>>Processing</option>
                            <option value="4"<?= $order["ostatus"] == 4 ? " selected" : "" ?>>Pending Delivery</option>
                            <option value="5"<?= $order["ostatus"] == 5 ? " selected" : "" ?>>Completed</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label">
                <label for="client-name" class="label">Client Name</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control"><?= htmlspecialchars($order["cname"]) ?></p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label">
                <label for="client-telephone" class="label">Client Telephone</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control"><?= $order["ctel"] ?></p>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Product</label>
            </div>
            <div class="field-body">
                <div class="is-flex is-flex-direction-row is-flex-grow-1 is-align-items-center">
                    <figure class="image is-96x96">
                        <img src="/assets/products/<?= $order["pid"] ?>.jpg" alt="<?= htmlspecialchars($order["pname"]) ?>">
                    </figure>
                    <p style="margin-inline-start: 1em;"><?= htmlspecialchars($order["pname"]) ?></p>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="quantity" class="label">Quantity</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow has-addons">
                    <p class="control">
                        <input id="quantity" class="input"  name="oqty" value="<?= $order["oqty"] ?>" type="number" size="4" onchange="updatePrice(<?= $order["pcost"] ?>, this.valueAsNumber, 'price');" />
                    </p>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label">
                <label class="label">Price</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow has-addons">
                    <p id="price" class="control" data-unit-price="<?= $order["pcost"] ?>">
                        <?= sprintf("\$%.2f", $order["ocost"]) ?>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Materials</label>
            </div>
            <div class="field-body">
                <div class="is-flex is-flex-direction-column is-flex-grow-1">
                    <div id="materials" class="list has-visible-pointer-controls">
                        <? foreach ($materials as $material): ?>
                            <div class="list-item">
                                <div class="list-item-content">
                                    <p><?= htmlspecialchars($material["mname"]) ?></p>
                                </div>
                                <div class="list-item-controls">
                                    <div class="is-flex is-align-items-center">
                                        <div class="field has-addons mb-0">
                                            <p class="control">
                                                <input class="input" value="<?= $material["pmqty"] ?? 1 ?>" size="2" readonly>
                                            </p>
                                            <p class="control">
                                                <a class="material-unit button is-static"><?= $material["munit"] ?></a>
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
                        <textarea id="delivery-address" class="textarea" rows="3" readonly><?= htmlspecialchars($order["caddr"]) ?></textarea>
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

<script>
    function updatePrice(unitPrice, quantity, target)
    {
        document.getElementById(target).innerText = `\$${(unitPrice * quantity).toFixed(2)}`;
    }
</script>

<script src="/assets/forms.js" defer async></script>

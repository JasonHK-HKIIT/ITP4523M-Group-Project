<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            Update Order
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" enctype="application/x-www-form-urlencoded">

        <input name="oid" type="hidden" value="<?= $order["oid"] ?>" />

        <div class="field is-horizontal">
            <div class="field-label">
                <label class="label">Date</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p><?= $order["odate"] ?></p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="status" class="label">Status</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="select<?= isset($error_messages["ostatus"]) ? " is-danger" : "" ?>">
                        <select id="status" name="ostatus">
                            <option value="0"
                                <? if ($order["ostatus"] == ORDER_STATUS_REJECTED): ?>selected<? endif ?>
                                <? if ($order["ostatus"] > ORDER_STATUS_OPEN): ?>disabled<? endif ?>
                            >Rejected</option>
                            <option value="1"
                                <? if ($order["ostatus"] == ORDER_STATUS_OPEN): ?>selected<? endif ?>
                                <? if ($order["ostatus"] > ORDER_STATUS_OPEN): ?>disabled<? endif ?>
                            >Open</option>
                            <option value="2"
                                <? if ($order["ostatus"] == ORDER_STATUS_ACCEPTED): ?>selected<? endif ?>
                                <? if ($order["ostatus"] > ORDER_STATUS_ACCEPTED): ?>disabled<? endif ?>
                            >Accepted</option>
                            <option value="3"
                                <? if ($order["ostatus"] == ORDER_STATUS_PROCESSING): ?>selected<? endif ?>
                                <? if ($order["ostatus"] > ORDER_STATUS_PROCESSING): ?>disabled<? endif ?>
                            >Processing</option>
                            <option value="4"
                                <? if ($order["ostatus"] == ORDER_STATUS_PENDING_DELIVERY): ?>selected<? endif ?>
                                <? if ($order["ostatus"] > ORDER_STATUS_PENDING_DELIVERY): ?>disabled<? endif ?>
                            >Pending Delivery</option>
                            <option value="5"
                                <? if ($order["ostatus"] == ORDER_STATUS_COMPLETED): ?>selected<? endif ?>
                                <? if ($order["ostatus"] > ORDER_STATUS_COMPLETED): ?>disabled<? endif ?>
                            >Completed</option>
                        </select>
                    </div>
                    <? if (isset($error_messages["ostatus"])): ?>
                        <p class="help is-danger"><?= htmlspecialchars($error_messages["ostatus"]) ?></p>
                    <? endif ?>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label">
                <label class="label">Client Name</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p><?= htmlspecialchars($order["cname"]) ?></p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label">
                <label class="label">Client Telephone</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p><?= $order["ctel"] ?></p>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-flex is-flex-direction-column is-justify-content-center">
                <label class="label">Product</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="is-flex is-flex-direction-row is-flex-grow-1 is-align-items-center">
                        <figure class="image is-product is-96x96">
                            <img src="/assets/products/<?= $order["pid"] ?>.jpg" alt="<?= htmlspecialchars($order["pname"]) ?>">
                        </figure>
                        <p class="ml-4"><?= htmlspecialchars($order["pname"]) ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="quantity" class="label">Quantity</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="quantity" class="input<?= ($order["ostatus"] >= ORDER_STATUS_ACCEPTED) ? " is-static" : "" ?><?= isset($error_messages["oqty"]) ? " is-danger" : "" ?>" name="oqty" value="<?= $order["oqty"] ?>"<?= ($order["ostatus"] >= ORDER_STATUS_ACCEPTED) ? " readonly" : "" ?> type="number" size="4" min="<?= $min_quantity ?>" max="<?= $max_quantity ?>" />
                    </p>
                    <? if (isset($error_messages["oqty"])): ?>
                        <p class="help is-danger"><?= htmlspecialchars($error_messages["oqty"]) ?></p>
                    <? endif ?>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label">
                <label class="label">Total Amount</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p id="total-amount" data-pcost="<?= $order["pcost"] ?>" data-auto-exchange="false">
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
                <div class="field">
                    <div class="is-flex is-flex-direction-column is-flex-grow-1">
                        <div class="table-container">
                            <table class="table is-striped is-hoverable is-fullwidth">
                                <thead>
                                    <tr>
                                        <th>Material</th>
                                        <th>Quantity Used</th>
                                        <th>Physical Quantity</th>
                                        <th>Available Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? foreach ($materials as $material): ?>
                                        <tr>
                                            <td>
                                                <?= htmlspecialchars($material["mname"]) ?>
                                                <? if ($material["mqty"] < $material["mreorderqty"]): ?>
                                                    <div class="notification is-warning mt-1 px-3 py-2">
                                                        Warning: Low on Stock
                                                    </div>
                                                <? endif ?>
                                            </td>
                                            <td class="material-quantity" data-pmqty="<?= $material["pmqty"] ?>" data-munit="<?= htmlspecialchars($material["munit"]) ?>">
                                                <?= $material["omqty"] ?>
                                                <?= htmlspecialchars($material["munit"]) ?>
                                            </td>
                                            <td>
                                                <?= $material["mqty"] ?>
                                                <?= htmlspecialchars($material["munit"]) ?>
                                            </td>
                                            <td>
                                                <?= $material["mqty"] - $material["mrqty"] ?>
                                                <?= htmlspecialchars($material["munit"]) ?>
                                            </td>
                                        </tr>
                                    <? endforeach ?>
                                </tbody>
                            </table>
                        </div>
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
                        <input id="delivery-date" class="input<?= isset($error_messages["odeliverdate"]) ? " is-danger" : "" ?>" name="odeliverdate" type="datetime-local" value="<?= $order["odeliverdate"] ?>" />
                    </p>
                    <? if (isset($error_messages["odeliverdate"])): ?>
                        <p class="help is-danger"><?= htmlspecialchars($error_messages["odeliverdate"]) ?></p>
                    <? endif ?>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label">
                <label class="label">Delivery Address</label>
            </div>
            <div class="field-body">
                <div class="field is-expended">
                    <p class="control">
                        <textarea class="textarea is-static p-0" rows="3" readonly style="min-height: 3lh; border: none; outline: none;"><?= htmlspecialchars($order["caddr"]) ?></textarea>
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
                        <a class="button is-light" href="<?= $_SERVER["SCRIPT_NAME"] ?>">
                            <span class="icon is-small">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                            <span>Cancel</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </form>
</main>

<script>
    document.getElementById("quantity").addEventListener("change", function(event)
    {
        const quantity = this.valueAsNumber;

        const totalAmountField = document.getElementById("total-amount");
        renderPrice(Number.parseFloat(totalAmountField.dataset.pcost) * quantity, "USD")
            .then((price) => (totalAmountField.innerText = price));

        const materialFields = document.getElementsByClassName("material-quantity");
        for (const field of materialFields)
        {
            field.innerText = `${Number.parseFloat(field.dataset.pmqty) * quantity} ${field.dataset.munit}`;
        }
    });
</script>

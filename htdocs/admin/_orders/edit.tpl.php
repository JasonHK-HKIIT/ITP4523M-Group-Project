<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            Update Order
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="post" enctype="application/x-www-form-urlencoded">

        <input name="oid" type="hidden" value="<?php echo $order["oid"] ?>" />

        <div class="field is-horizontal">
            <div class="field-label">
                <label class="label">Date</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p><?php echo $order["odate"] ?></p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="status" class="label">Status</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="select<?php echo isset($error_messages["ostatus"]) ? " is-danger" : "" ?>">
                        <select id="status" name="ostatus">
                            <option value="0"
                                <?php if ($order["ostatus"] == ORDER_STATUS_REJECTED): ?>selected<?php endif ?>
                                <?php if ($order["ostatus"] > ORDER_STATUS_OPEN): ?>disabled<?php endif ?>
                            >Rejected</option>
                            <option value="1"
                                <?php if ($order["ostatus"] == ORDER_STATUS_OPEN): ?>selected<?php endif ?>
                                <?php if ($order["ostatus"] > ORDER_STATUS_OPEN): ?>disabled<?php endif ?>
                            >Open</option>
                            <option value="2"
                                <?php if ($order["ostatus"] == ORDER_STATUS_ACCEPTED): ?>selected<?php endif ?>
                                <?php if ($order["ostatus"] > ORDER_STATUS_ACCEPTED): ?>disabled<?php endif ?>
                            >Accepted</option>
                            <option value="3"
                                <?php if ($order["ostatus"] == ORDER_STATUS_PROCESSING): ?>selected<?php endif ?>
                                <?php if ($order["ostatus"] > ORDER_STATUS_PROCESSING): ?>disabled<?php endif ?>
                            >Processing</option>
                            <option value="4"
                                <?php if ($order["ostatus"] == ORDER_STATUS_PENDING_DELIVERY): ?>selected<?php endif ?>
                                <?php if ($order["ostatus"] > ORDER_STATUS_PENDING_DELIVERY): ?>disabled<?php endif ?>
                            >Pending Delivery</option>
                            <option value="5"
                                <?php if ($order["ostatus"] == ORDER_STATUS_COMPLETED): ?>selected<?php endif ?>
                                <?php if ($order["ostatus"] > ORDER_STATUS_COMPLETED): ?>disabled<?php endif ?>
                            >Completed</option>
                        </select>
                    </div>
                    <?php if (isset($error_messages["ostatus"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["ostatus"]) ?></p>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label">
                <label class="label">Client Name</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p><?php echo htmlspecialchars($order["cname"]) ?></p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label">
                <label class="label">Client Telephone</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p><?php echo $order["ctel"] ?></p>
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
                            <img src="/assets/products/<?php echo $order["pid"] ?>.jpg" alt="<?php echo htmlspecialchars($order["pname"]) ?>">
                        </figure>
                        <p class="ml-4"><?php echo htmlspecialchars($order["pname"]) ?></p>
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
                        <input id="quantity" class="input<?php echo ($order["ostatus"] >= ORDER_STATUS_ACCEPTED) ? " is-static" : "" ?><?php echo isset($error_messages["oqty"]) ? " is-danger" : "" ?>" name="oqty" value="<?php echo $order["oqty"] ?>"<?php echo ($order["ostatus"] >= ORDER_STATUS_ACCEPTED) ? " readonly" : "" ?> type="number" size="4" min="<?php echo $min_quantity ?>" max="<?php echo $max_quantity ?>" />
                    </p>
                    <?php if (isset($error_messages["oqty"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["oqty"]) ?></p>
                    <?php endif ?>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label">
                <label class="label">Total Amount</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p id="total-amount" data-pcost="<?php echo $order["pcost"] ?>" data-auto-exchange="false">
                        <?php echo sprintf("\$%.2f", $order["ocost"]) ?>
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
                                    <?php foreach ($materials as $material): ?>
                                        <tr>
                                            <td>
                                                <?php echo htmlspecialchars($material["mname"]) ?>
                                                <?php if ($material["mqty"] < $material["mreorderqty"]): ?>
                                                    <div class="notification is-warning mt-1 px-3 py-2">
                                                        Warning: Low on Stock
                                                    </div>
                                                <?php endif ?>
                                            </td>
                                            <td class="material-quantity" data-pmqty="<?php echo $material["pmqty"] ?>" data-munit="<?php echo htmlspecialchars($material["munit"]) ?>">
                                                <?php echo $material["omqty"] ?>
                                                <?php echo htmlspecialchars($material["munit"]) ?>
                                            </td>
                                            <td>
                                                <?php echo $material["mqty"] ?>
                                                <?php echo htmlspecialchars($material["munit"]) ?>
                                            </td>
                                            <td>
                                                <?php echo $material["mqty"] - $material["mrqty"] ?>
                                                <?php echo htmlspecialchars($material["munit"]) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
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
                        <input id="delivery-date" class="input<?php echo isset($error_messages["odeliverdate"]) ? " is-danger" : "" ?>" name="odeliverdate" type="datetime-local" value="<?php echo $order["odeliverdate"] ?>" />
                    </p>
                    <?php if (isset($error_messages["odeliverdate"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["odeliverdate"]) ?></p>
                    <?php endif ?>
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
                        <textarea class="textarea is-static p-0" rows="3" readonly style="min-height: 3lh; border: none; outline: none;"><?php echo htmlspecialchars($order["caddr"]) ?></textarea>
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
                        <a class="button is-light" href="<?php echo $_SERVER["SCRIPT_NAME"] ?>">
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

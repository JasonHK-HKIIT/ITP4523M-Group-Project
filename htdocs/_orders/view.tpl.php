<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            View Order
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <div class="container is-max-desktop">

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
            <div class="field-label">
                <label for="status" class="label">Status</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p><?php echo render_order_status($order["ostatus"]) ?></p>
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
            <div class="field-label">
                <label for="quantity" class="label">Quantity</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p><?php echo $order["oqty"] ?></p>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label">
                <label class="label">Total Amount</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p id="total-amount" data-ocost="<?php echo $order["ocost"] ?>">
                        <?php echo sprintf("\$%.2f", $order["ocost"]) ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label">
                <label for="delivery-date" class="label">Delivery Date</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p><?php echo !empty($order["odeliverdate"]) ? render_date($order["odeliverdate"]) : "" ?></p>
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
                        <textarea class="textarea is-static p-0" rows="3" readonly style="border: none; outline: none;"><?php echo htmlspecialchars($order["caddr"]) ?></textarea>
                    </p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label"></div>
            <div class="field-body">
                <div class="field is-grouped">
                    <div class="control">
                        <a class="button is-info" href="<?php echo $_SERVER["SCRIPT_NAME"] ?>">
                            <span class="icon is-small">
                                <i class="fa-solid fa-arrow-left"></i>
                            </span>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

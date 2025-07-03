<style>
    .textarea.is-static[readonly]
    {

    }
</style>

<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            New Order
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" enctype="application/x-www-form-urlencoded">

        <div class="field is-horizontal">
            <div class="field-label is-flex is-flex-direction-column is-justify-content-center">
                <label class="label">Product</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="is-flex is-flex-direction-row is-flex-grow-1 is-align-items-center">
                        <figure class="image is-96x96">
                            <img src="/assets/products/<?= $product["pid"] ?>.jpg" alt="<?= htmlspecialchars($product["pname"]) ?>">
                        </figure>
                        <p class="ml-4"><?= htmlspecialchars($product["pname"]) ?></p>
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
                        <input id="quantity" class="input" name="oqty" value="<?= $order["oqty"] ?? 1 ?>" type="number" size="4" min="1" max="<?= $product["pqty"] ?>" />
                    </p>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label">
                <label class="label">Total Amount</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p id="total-amount" data-pcost="<?= $product["pcost"] ?>">
                        <?= sprintf("\$%.2f", $product["pcost"]) ?>
                    </p>
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
                        <textarea class="textarea is-static p-0" rows="3" readonly style="border: none; outline: none;"><?= htmlspecialchars($client["caddr"]) ?></textarea>
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
                                <i class="fa-solid fa-cart-shopping"></i>
                            </span>
                            <span>Place Order</span>
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
    document.getElementById("quantity").addEventListener("change", function(event)
    {
        const quantity = this.valueAsNumber;

        const totalAmountField = document.getElementById("total-amount");
        totalAmountField.innerText = `\$${(Number.parseFloat(totalAmountField.dataset.pcost) * quantity).toFixed(2)}`;
    });
</script>

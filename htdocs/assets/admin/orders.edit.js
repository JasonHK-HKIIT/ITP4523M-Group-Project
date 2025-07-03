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

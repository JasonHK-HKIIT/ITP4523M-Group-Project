window.addEventListener("load", () =>
{
    document.getElementById("currency").addEventListener("change", renderTotalAmount);
    document.getElementById("quantity").addEventListener("change", renderTotalAmount);
    renderTotalAmount();

    function renderTotalAmount()
    {
        const quantity = document.getElementById("quantity").valueAsNumber;

        const totalAmountField = document.getElementById("total-amount");
        renderPrice(Number.parseFloat(totalAmountField.dataset.pcost) * quantity)
            .then((price) => (totalAmountField.innerText = price));
    }
});

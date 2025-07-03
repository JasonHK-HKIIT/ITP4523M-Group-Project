// Handle navigation bar.
for (const burger of document.querySelectorAll(".navbar-burger"))
{
    if (burger instanceof HTMLElement)
    {
        burger.addEventListener("click", () =>
        {
            if (burger.dataset.target)
            {
                burger.classList.toggle("is-active", document.getElementById(burger.dataset.target)?.classList.toggle("is-active"));
            }
        });
    }
}

// Handle sortable tables.
for (const table of document.querySelectorAll("table[data-sortable]"))
{
    table.addEventListener("Sortable.sorted", () =>
    {
        const headers = table.querySelectorAll("thead th:not([data-sortable=false])");
        for (const header of headers)
        {
            header.querySelector(".icon i").className = `fa-solid fa-sort${(header.dataset.sorted === "true") ? ((header.dataset.sortedDirection === "ascending") ? "-down" : "-up") : ""}`;
        }
    });
}

// Handle cancel buttons.
for (const button of document.querySelectorAll(".is-cancel"))
{
    button.addEventListener("click", () => { history.back(); });
}

// Handle file inputs.
for (const input of document.querySelectorAll(".file-input"))
{
    if (input instanceof HTMLInputElement)
    {
        input.addEventListener("change", () =>
        {
            if (input.dataset.display)
            {
                document.getElementById(input.dataset.display).innerText = input.files[0]?.name ?? "";
            }
        });
    }
}

// Handle adding materials to products.
for (const button of document.querySelectorAll("[data-action=new-item]"))
{
    if (button instanceof HTMLElement)
    {
        const template = document.getElementById(button.dataset.template);
        if (!(template instanceof HTMLTemplateElement)) { throw new Error(`#${button.dataset.template} was not a <template /> element.`); }

        const target = document.getElementById(button.dataset.target);
        if (!target) { throw new Error("No target was set."); }

        button.addEventListener("click", () =>
        {
            const node = template.content.cloneNode(true);
            target.appendChild(node);
        });
    }
}

// Handle currency exchange.
{
    window.renderPrice = renderPrice;

    const currencySelect = document.getElementById("currency");
    if (currencySelect)
    {
        currencySelect.value = localStorage.getItem("currency") ?? "USD";
        currencySelect.addEventListener("change", () =>
        {
            localStorage.setItem("currency", currencySelect.value);
            renderPrices();
        });
    }

    renderPrices();

    function renderPrices()
    {
        const priceFields = document.querySelectorAll(":is([data-pcost], [data-ocost]):not([data-auto-exchange=false])");
        for (const priceField of priceFields)
        {
            renderPrice(Number.parseFloat(priceField.dataset.pcost ?? priceField.dataset.ocost))
                .then((price) => (priceField.innerText = price));
        }
    }

    async function renderPrice(price, currency)
    {
        currency = currency ?? localStorage.getItem("currency") ?? "USD";
        
        let convertedPrice = price;
        if (currency !== "USD")
        {
            const response = await fetch(`/exchange.php?amount=${price}&currency=${currency}`);
            if (!response.ok)
            {
                const error = await response.json();
                throw new Error(error.reason);
            }

            const data = await response.json();
            convertedPrice = data.converted_amount;
        }

        switch (currency)
        {
            case "USD":
                return `\$${convertedPrice.toFixed(2)}`;
            case "EUR":
                return `€${convertedPrice.toFixed(2)}`;
            case "HKD":
                return `HK\$${convertedPrice.toFixed(1)}0`;
            case "JPY":
                return `¥${convertedPrice.toFixed()}`;
            default:
                throw new TypeError(`Currency ${currency} missing.`);
        }
    }
}

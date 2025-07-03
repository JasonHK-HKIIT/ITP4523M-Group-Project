window.addEventListener("load", () =>
{
    /** @type {HTMLElement} */
    const list = document.getElementById("materials");

    list.addEventListener("click", (event) =>
    {
        if (!(event.target instanceof Element)) { return; }

        const element = event.target.closest("[data-action]");
        if (!(element instanceof HTMLElement)) { return; }

        if (element.dataset.action === "delete")
        {
            element.closest(".list-item")?.remove();
        }
    });

    list.addEventListener("change", (event) =>
    {
        if (!(event.target instanceof HTMLSelectElement)) { return; }
        const select = event.target;

        const item = select.closest(".list-item");
        if (!item) { return; }

        const image = item.querySelector(".material-image");
        if (!(image instanceof HTMLImageElement)) { return; }
        image.src = select.selectedOptions[0].dataset.image;

        const unit = item.querySelector(".material-unit");
        if (!(unit instanceof HTMLElement)) { return; }
        unit.innerText = select.selectedOptions[0].dataset.unit;
    });
});

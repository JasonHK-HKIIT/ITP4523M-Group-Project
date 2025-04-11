{
    const buttons = document.querySelectorAll(".is-cancel");
    for (const button of buttons)
    {
        button.addEventListener("click", () => { history.back(); });
    }
}

{
    const inputs = document.querySelectorAll(".file-input");
    for (const input of inputs)
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
}

{
    const buttons = document.querySelectorAll("[data-action=new-item]");
    for (const button of buttons)
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
}

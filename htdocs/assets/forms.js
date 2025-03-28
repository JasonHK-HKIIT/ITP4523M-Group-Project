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

{
    const buttons = document.querySelectorAll(".is-cancel");
    for (const button of buttons)
    {
        button.addEventListener("click", () => { history.back(); });
    }
}

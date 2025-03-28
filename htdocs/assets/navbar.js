{
    const burgers = document.querySelectorAll(".navbar-burger");
    for (const burger of burgers)
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
}

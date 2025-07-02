{
    const tables = document.querySelectorAll("table[data-sortable]");
    for (const table of tables)
    {
        table.addEventListener("Sortable.sorted", (event) =>
        {
            const headers = table.querySelectorAll("thead th:not([data-sortable=false])");
            for (const header of headers)
            {
                header.querySelector(".icon i").className = `fa-solid fa-sort${(header.dataset.sorted === "true") ? ((header.dataset.sortedDirection === "ascending") ? "-down" : "-up") : ""}`;
            }
        });
    }
}

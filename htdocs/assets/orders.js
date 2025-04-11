{
    /** @type {HTMLTableElement[]} */
    const tables = document.querySelectorAll("table[data-sortable]");
    for (const table of tables)
    {
        table.addEventListener("Sortable.sorted", (event) =>
        {
            table.querySelectorAll(":is(thaed, tfoot")
        });
    }
}

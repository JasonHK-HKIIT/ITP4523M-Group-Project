<style>
    table[data-sortable] :is(thead, tfoot) th:not([data-sortable=false])
    {
        cursor: pointer;
    }
</style>

<header class="hero is-primary is-medium">
    <div class="hero-body">
        <div class="container is-max-desktop">
            <h1 class="title">
                Orders
            </h1>
        </div>
    </div>
</header>

<main class="m-4 mt-5">
    <div class="container is-max-desktop">
        <div class="table-container">
            <table class="table is-striped is-hoverable is-fullwidth" style="text-wrap-mode: nowrap;" data-sortable>
                <thead>
                    <tr>
                        <th data-sortable="false">#</th>
                        <th>
                            <div class="is-flex is-flex-direction-row is-align-items-center">
                                <span class="is-flex-grow-1">Date</span>
                                <span class="icon is-small">
                                    <i class="fa-solid fa-sort"></i>
                                </span>
                            </div>
                        </th>
                        <th>
                            <div class="is-flex is-flex-direction-row is-align-items-center">
                                <span class="is-flex-grow-1">Product</span>
                                <span class="icon is-small">
                                    <i class="fa-solid fa-sort"></i>
                                </span>
                            </div>
                        </th>
                        <th data-sortable="false">Quantity</th>
                        <th data-sortable="false">Total</th>
                        <th>
                            <div class="is-flex is-flex-direction-row is-align-items-center">
                                <span class="is-flex-grow-1">Status</span>
                                <span class="icon is-small">
                                    <i class="fa-solid fa-sort"></i>
                                </span>
                            </div>
                        </th>
                        <th style="min-width: 16ch;">
                            <div class="is-flex is-flex-direction-row is-align-items-center">
                                <span class="is-flex-grow-1">Delivery Date</span>
                                <span class="icon is-small">
                                    <i class="fa-solid fa-sort"></i>
                                </span>
                            </div>
                        </th>
                        <th data-sortable="false" style="min-width: 6.75rem;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($orders as $order): ?>
                        <tr>
                            <th><?= $order["oid"] ?></th>
                            <td data-value="<?= strtotime($order["odate"]) ?>"><?= render_date($order["odate"]) ?></td>
                            <td><?= htmlspecialchars($order["pname"]) ?></td>
                            <td><?= $order["oqty"] ?></td>
                            <td data-ocost="<?= $order["ocost"] ?>"><?= sprintf("\$%.2f", $order["ocost"]) ?></td>
                            <td data-value="<?= $order["ostatus"] ?>"><?= render_order_status($order["ostatus"]) ?></td>
                            <? if (!empty($order["odeliverdate"])) : ?>
                                <td data-value="<?= strtotime($order["odeliverdate"]) ?>"><?= render_date($order["odeliverdate"]) ?></td>
                            <? else: ?>
                                <td data-value=""></td>
                            <? endif ?>
                            <td>
                                <div class="buttons are-small">
                                    <a class="button is-primary" href="/orders.php?action=view&id=<?= $order["oid"] ?>">
                                        <span class="icon is-small">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </a>
                                    <a class="button is-danger" href="/orders.php?action=delete&id=<?= $order["oid"] ?>">
                                        <span class="icon is-small">
                                            <i class="fa-solid fa-trash"></i>
                                        </span>
                                    </a>
                                </div>  
                            </td>
                        </tr>
                    <? endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

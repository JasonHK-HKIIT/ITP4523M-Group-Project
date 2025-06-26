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
                            Date
                            <span class="icon is-small is-pulled-right">
                                <i class="fa-solid fa-sort"></i>
                            </span>
                        </th>
                        <th>
                            Product
                        </th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Delivery Date</th>
                        <th data-sortable="false" style="min-width: 6.75rem;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($orders as $order): ?>
                        <tr>
                            <th><?= $order["oid"] ?></th>
                            <td data-value="<?= strtotime($order["odate"]) ?>"><?= render_date($order["odate"]) ?></td>
                            <td><?= $order["pname"] ?></td>
                            <td data-value="<?= doubleval($order["ocost"]) ?>"><?= sprintf("\$%.2f", doubleval($order["ocost"])) ?></td>
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

<script src="/assets/sortable.min.js" async defer></script>
<script src="/assets/orders.js" async defer></script>

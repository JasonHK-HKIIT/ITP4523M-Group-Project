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
                            <div>
                                <span>Date</span>
                                <span class="icon is-small">
                                    <i class="fa-solid fa-sort"></i>
                                </span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Product</span>
                                <span class="icon is-small">
                                    <i class="fa-solid fa-sort"></i>
                                </span>
                            </div>
                        </th>
                        <th data-sortable="false">Quantity</th>
                        <th data-sortable="false">Total</th>
                        <th>
                            <div>
                                <span>Status</span>
                                <span class="icon is-small">
                                    <i class="fa-solid fa-sort"></i>
                                </span>
                            </div>
                        </th>
                        <th style="min-width: 16ch;">
                            <div>
                                <span>Delivery Date</span>
                                <span class="icon is-small">
                                    <i class="fa-solid fa-sort"></i>
                                </span>
                            </div>
                        </th>
                        <th data-sortable="false" style="min-width: 6.75rem;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <th><?php echo $order["oid"] ?></th>
                            <td data-value="<?php echo strtotime($order["odate"]) ?>"><?php echo render_date($order["odate"]) ?></td>
                            <td><?php echo htmlspecialchars($order["pname"]) ?></td>
                            <td><?php echo $order["oqty"] ?></td>
                            <td data-ocost="<?php echo $order["ocost"] ?>"><?php echo sprintf("\$%.2f", $order["ocost"]) ?></td>
                            <td data-value="<?php echo $order["ostatus"] ?>"><?php echo render_order_status($order["ostatus"]) ?></td>
                            <?php if (!empty($order["odeliverdate"])) : ?>
                                <td data-value="<?php echo strtotime($order["odeliverdate"]) ?>"><?php echo render_date($order["odeliverdate"]) ?></td>
                            <?php else: ?>
                                <td data-value=""></td>
                            <?php endif ?>
                            <td>
                                <div class="buttons are-small">
                                    <a class="button" href="/orders.php?action=view&id=<?php echo $order["oid"] ?>">
                                        <span class="icon is-small">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </a>
                                    <a class="button is-danger is-outlined" href="/orders.php?action=delete&id=<?php echo $order["oid"] ?>">
                                        <span class="icon is-small">
                                            <i class="fa-solid fa-trash"></i>
                                        </span>
                                    </a>
                                </div>  
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

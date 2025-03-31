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
            <table class="table is-striped is-hoverable is-fullwidth" style="text-wrap-mode: nowrap;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Delivery Date</th>
                        <th style="min-width: 6.75rem;">Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Delivery Date</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    <? foreach ($orders as $order): ?>
                        <tr>
                            <th><?= $order["id"] ?></th>
                            <td><?= $order["date"] ?></td>
                            <td><?= sprintf("\$%.2F", $order["total"]) ?></td>
                            <td><?= $order["status"] ?></td>
                            <td><?= $order["delivery_date"] ?></td>
                            <td>
                                <div class="buttons are-small">
                                    <a class="button is-primary" href="/orders.php?action=view&id=<?= $order["id"] ?>">
                                        <span class="icon is-small">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </a>
                                    <a class="button is-danger" href="/orders.php?action=delete&id=<?= $order["id"] ?>">
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

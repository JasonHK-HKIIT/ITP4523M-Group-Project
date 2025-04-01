<header class="hero is-primary is-medium">
    <div class="hero-body">
        <div class="container is-max-desktop">
            <h1 class="title">
                Reports
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
                        <th>Product</th>
                        <th>Total Orders</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Product</th>
                        <th>Total Orders</th>
                        <th>Total Sales</th>
                    </tr>
                </tfoot>
                <tbody>
                    <? foreach ($products as $product): ?>
                        <tr>
                            <th><?= $product["name"] ?></th>
                            <td><?= $product["total_orders"] ?></td>
                            <td><?= $product["total_sales"] ?></td>
                        </tr>
                    <? endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

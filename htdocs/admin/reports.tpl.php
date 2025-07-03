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

        <h2 class="title is-3">Sales By Product</h2>
        <div class="table-container">
            <table class="table is-striped is-hoverable is-fullwidth" style="text-wrap-mode: nowrap;" data-sortable>
                <thead>
                    <tr>
                        <th data-sortable="false">#</th>
                        <th>
                            <div>
                                <span>Product</span>
                                <span class="icon is-small">
                                    <i class="fa-solid fa-sort"></i>
                                </span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Total Orders</span>
                                <span class="icon is-small">
                                    <i class="fa-solid fa-sort"></i>
                                </span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Total Sales</span>
                                <span class="icon is-small">
                                    <i class="fa-solid fa-sort"></i>
                                </span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($products as $product): ?>
                        <tr>
                            <th><?= $product["pid"] ?></th>
                            <td data-value="<?= $product["pid"] ?>"><?= $product["pname"] ?></td>
                            <td><?= $product["ocount"] ?></td>
                            <td data-value="<?= $product["ocost"] ?>">$<?= sprintf("%.2f", $product["ocost"]) ?></td>
                        </tr>
                    <? endforeach ?>
                </tbody>
            </table>
        </div>

        <h2 class="title is-3">Sales By Client</h2>
        <div class="table-container">
            <table class="table is-striped is-hoverable is-fullwidth" style="text-wrap-mode: nowrap;" data-sortable>
                <thead>
                    <tr>
                        <th data-sortable="false">#</th>
                        <th>
                            <div>
                                <span>Client Name</span>
                                <span class="icon is-small">
                                    <i class="fa-solid fa-sort"></i>
                                </span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Total Orders</span>
                                <span class="icon is-small">
                                    <i class="fa-solid fa-sort"></i>
                                </span>
                            </div>
                        </th>
                        <th>
                            <div>
                                <span>Total Sales</span>
                                <span class="icon is-small">
                                    <i class="fa-solid fa-sort"></i>
                                </span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($clients as $client): ?>
                        <tr>
                            <th><?= $client["cid"] ?></th>
                            <td data-value="<?= $client["cid"] ?>"><?= $client["cname"] ?></td>
                            <td><?= $client["ocount"] ?></td>
                            <td data-value="<?= $client["ocost"] ?>">$<?= sprintf("%.2f", $client["ocost"]) ?></td>
                        </tr>
                    <? endforeach ?>
                </tbody>
            </table>
        </div>

    </div>
</main>

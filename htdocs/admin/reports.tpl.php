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
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <th><?php echo $product["pid"] ?></th>
                            <td data-value="<?php echo $product["pid"] ?>"><?php echo $product["pname"] ?></td>
                            <td><?php echo $product["ocount"] ?></td>
                            <td data-value="<?php echo $product["ocost"] ?>">$<?php echo sprintf("%.2f", $product["ocost"]) ?></td>
                        </tr>
                    <?php endforeach ?>
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
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <th><?php echo $client["cid"] ?></th>
                            <td data-value="<?php echo $client["cid"] ?>"><?php echo $client["cname"] ?></td>
                            <td><?php echo $client["ocount"] ?></td>
                            <td data-value="<?php echo $client["ocost"] ?>">$<?php echo sprintf("%.2f", $client["ocost"]) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>
</main>

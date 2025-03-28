<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            <?= ($action === "edit") ? "Edit" : "New" ?> Material
        </h1>
    </div>
</header>
<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="/admin/materials.php?action=<?= $action ?>" method="post" enctype="multipart/form-data">
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="name" class="label">Name</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control is-expanded">
                        <input id="name" class="input" name="name" type="text" placeholder="Name" required />
                    </p>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="unit" class="label">Unit</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="unit" class="input" name="unit" type="text" placeholder="Unit" required />
                    </p>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="reserved-quantity" class="label">Physical Quantity</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="reserved-quantity" class="input" name="reserved_quantity" type="number" inputmode="numeric" value="0" min="0" required />
                    </p>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="physical-quantity" class="label">Reserved Quantity</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="physical-quantity" class="input" name="physical_quantity" type="number" inputmode="numeric" value="0" min="0" required />
                    </p>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="reorder-level" class="label">Re-order Level</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="reorder-level" class="input" name="reorder_level" type="number" inputmode="numeric" value="0" min="0" required />
                    </p>
                </div>
            </div>
        </div>

        <div class="field is-horizontal">
            <div class="field-label"></div>
            <div class="field-body">
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" type="submit">
                            <span class="icon is-small">
                                <i class="fa-solid fa-<?= ($action === "edit") ? "floppy-disk" : "plus" ?>"></i>
                            </span>
                            <span><?= ($action === "edit") ? "Save" : "Create" ?></span>
                        </button>
                    </div>
                    <div class="control">
                        <button class="button is-light is-cancel" type="submit">
                            <span class="icon is-small">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                            <span>Cancel</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

<script src="/assets/forms.js" defer async></script>

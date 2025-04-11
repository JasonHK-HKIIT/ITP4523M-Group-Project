<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            <?= ($action === "edit") ? "Edit" : "New" ?> Material
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data">

        <? if ($action === "edit"): ?>
            <input name="mid" value="<?= $material["mid"] ?>" type="hidden" />
        <? endif ?>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="name" class="label">Name</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control is-expanded">
                        <input id="name" class="input" name="name" placeholder="Name" value="<?= $material["mname"] ?? "" ?>" type="text" required />
                    </p>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="image" class="label">Image</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <div class="file has-name">
                            <label class="file-label">
                                <input id="image" name="image" class="file-input" data-display="image-name" type="file" accept="image/jpeg,.jpg,.jpeg"<?= ($action === "edit") ? "" : " required" ?> />
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fa-solid fa-upload"></i>
                                    </span>
                                    <span class="file-label">Choose a file…</span>
                                </span>
                                <span id="image-name" class="file-name" style="width: var(--bulma-file-name-max-width);"></span>
                            </label>
                        </div>
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
                        <input id="unit" class="input" name="unit" placeholder="Unit" value="<?= $material["munit"] ?? "" ?>" type="text" required />
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
                        <input id="reserved-quantity" class="input" name="reserved_quantity" value="<?= $material["mqty"] ?? 0 ?>" type="number" inputmode="numeric" min="0" required />
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
                        <input id="physical-quantity" class="input" name="physical_quantity" value="<?= $material["mrqty"] ?? 0 ?>" type="number" inputmode="numeric" min="0" required />
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
                        <input id="reorder-level" class="input" name="reorder_level" value="<?= $material["mreorderqty"] ?? 0 ?>" type="number" inputmode="numeric" min="0" required />
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
                        <button class="button is-light is-cancel">
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

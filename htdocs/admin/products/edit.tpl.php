<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            <?= ($action === "edit") ? "Edit" : "New" ?> Product
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="/admin/products.php?action=<?= $action ?>" method="post" enctype="multipart/form-data">

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
                <label for="name" class="label">Description</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control is-expanded">
                        <textarea id="description" name="description" class="textarea" placeholder="Description" rows="5" required></textarea>
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
                                <input id="image" name="image" class="file-input" data-display="image-name" type="file" accept="image/jpeg,image/png,.jpg,.jpeg,.png" required />
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
                <label for="unit-cost" class="label">Unit Cost</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow has-addons">
                    <p class="control">
                        <a class="button is-static">US$</a>
                    </p>
                    <p class="control">
                        <input id="unit-cost" class="input" name="unit_cost" type="number" inputmode="numeric" value="0" min="0"
                            step="0.01" required />
                    </p>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Materials</label>
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

<template id="material">
    
</template>

<script src="/assets/forms.js" defer async></script>

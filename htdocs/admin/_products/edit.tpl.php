<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            <?= ($action === "edit") ? "Edit" : "New" ?> Product
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="<?= $_SERVER["REQUEST_URI"] ?>" method="post" enctype="multipart/form-data">

        <? if ($action === "edit"): ?>
            <input name="pid" value="<?= $product["pid"] ?>" type="hidden" />
        <? endif ?>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="name" class="label">Name</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control is-expanded">
                        <input id="name" class="input<?= isset($error_messages["pname"]) ? " is-danger" : "" ?>" name="pname" placeholder="Name" value="<?= htmlspecialchars(@$product["pname"]) ?>" type="text" required maxlength="<?= PNAME_LEN ?>" />
                    </p>
                    <? if (isset($error_messages["pname"])): ?>
                        <p class="help is-danger"><?= htmlspecialchars($error_messages["pname"]) ?></p>
                    <? endif ?>
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
                        <textarea id="description" class="textarea<?= isset($error_messages["pdesc"]) ? " is-danger" : "" ?>" name="pdesc" maxlength="<?= PDESC_LEN ?>" placeholder="Description" rows="5"><?= htmlspecialchars(@$product["pdesc"]) ?></textarea>
                    </p>
                    <? if (isset($error_messages["pdesc"])): ?>
                        <p class="help is-danger"><?= htmlspecialchars($error_messages["pdesc"]) ?></p>
                    <? endif ?>
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
                        <div class="file<?= isset($error_messages["image"]) ? " is-danger" : "" ?> has-name mb-0">
                            <label class="file-label">
                                <input id="image" class="file-input" name="image" data-display="image-name" type="file" accept="image/jpeg,.jpg,.jpeg"<?= ($action === "edit") ? "" : " required" ?> />
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
                    <? if (isset($error_messages["image"])): ?>
                        <p class="help is-danger"><?= htmlspecialchars($error_messages["image"]) ?></p>
                    <? endif ?>
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
                        <input id="unit-cost" class="input<?= isset($error_messages["pcost"]) ? " is-danger" : "" ?>" name="pcost" value="<?= doubleval($product["pcost"] ?? 0.01) ?>" type="number" inputmode="numeric" min="0.01" step="0.01" required />
                    </p>
                    <? if (isset($error_messages["pcost"])): ?>
                        <p class="help is-danger"><?= htmlspecialchars($error_messages["pcost"]) ?></p>
                    <? endif ?>
                </div>
            </div>
        </div>
        
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label">Materials</label>
            </div>
            <div class="field-body">
                <div class="is-flex is-flex-direction-column is-flex-grow-1">
                    <p class="buttons mb-0">
                        <button class="button" type="button" data-action="new-item" data-target="materials" data-template="material">
                            <span class="icon">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                            <span>Add Material</span>
                        </button>
                    </p>
                    <div id="materials" class="list has-visible-pointer-controls">
                        <? foreach ($materials as $material): ?>
                            <? require "_material_select.tpl.php" ?>
                        <? endforeach ?>
                        <? unset($material) ?>
                    </div>
                    <? if (isset($error_messages["materials"])): ?>
                        <p class="help is-danger"><?= htmlspecialchars($error_messages["materials"]) ?></p>
                    <? endif ?>
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
    <? require "_material_select.tpl.php" ?>
</template>

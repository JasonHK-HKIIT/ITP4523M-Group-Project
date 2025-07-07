<header class="hero is-primary is-medium">
    <div class="hero-body container is-max-desktop">
        <h1 class="title">
            <?php echo ($action === "edit") ? "Edit" : "New" ?> Product
        </h1>
    </div>
</header>

<main class="m-4 mt-5">
    <form class="container is-max-desktop" action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="post" enctype="multipart/form-data">

        <?php if ($action === "edit"): ?>
            <input name="pid" value="<?php echo $product["pid"] ?>" type="hidden" />
        <?php endif ?>

        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label for="name" class="label">Name</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <p class="control is-expanded">
                        <input id="name" class="input<?php echo isset($error_messages["pname"]) ? " is-danger" : "" ?>" name="pname" placeholder="Name" value="<?php echo htmlspecialchars(@$product["pname"]) ?>" type="text" required maxlength="<?php echo PNAME_LEN ?>" />
                    </p>
                    <?php if (isset($error_messages["pname"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["pname"]) ?></p>
                    <?php endif ?>
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
                        <textarea id="description" class="textarea<?php echo isset($error_messages["pdesc"]) ? " is-danger" : "" ?>" name="pdesc" maxlength="<?php echo PDESC_LEN ?>" placeholder="Description" rows="5"><?php echo htmlspecialchars(@$product["pdesc"]) ?></textarea>
                    </p>
                    <?php if (isset($error_messages["pdesc"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["pdesc"]) ?></p>
                    <?php endif ?>
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
                        <div class="file<?php echo isset($error_messages["image"]) ? " is-danger" : "" ?> has-name mb-0">
                            <label class="file-label">
                                <input id="image" class="file-input" name="image" data-display="image-name" type="file" accept="image/jpeg,.jpg,.jpeg"<?php echo ($action === "edit") ? "" : " required" ?> />
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
                    <?php if (isset($error_messages["image"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["image"]) ?></p>
                    <?php endif ?>
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
                        <input id="unit-cost" class="input<?php echo isset($error_messages["pcost"]) ? " is-danger" : "" ?>" name="pcost" value="<?php echo doubleval($product["pcost"] ?? 0.01) ?>" type="number" inputmode="numeric" min="0.01" step="0.01" required />
                    </p>
                    <?php if (isset($error_messages["pcost"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["pcost"]) ?></p>
                    <?php endif ?>
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
                        <?php foreach ($materials as $material): ?>
                            <?php require "_material_select.tpl.php" ?>
                        <?php endforeach ?>
                        <?php unset($material) ?>
                    </div>
                    <?php if (isset($error_messages["materials"])): ?>
                        <p class="help is-danger"><?php echo htmlspecialchars($error_messages["materials"]) ?></p>
                    <?php endif ?>
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
                                <i class="fa-solid fa-<?php echo ($action === "edit") ? "floppy-disk" : "plus" ?>"></i>
                            </span>
                            <span><?php echo ($action === "edit") ? "Save" : "Create" ?></span>
                        </button>
                    </div>
                    <div class="control">
                        <a class="button is-light" href="<?php echo $_SERVER["SCRIPT_NAME"] ?>">
                            <span class="icon is-small">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                            <span>Cancel</span>
                    </a>
                    </div>
                </div>
            </div>
        </div>

    </form>
</main>

<template id="material">
    <?php require "_material_select.tpl.php" ?>
</template>

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
                        <input id="name" class="input<?= isset($error_messages["mname"]) ? " is-danger" : "" ?>" name="mname" placeholder="Name" value="<?= isset($material["mname"]) ? htmlspecialchars($material["mname"]) : "" ?>" type="text" maxlength="255" required />
                    </p>
                    <? if (isset($error_messages["mname"])): ?>
                        <p class="help is-danger"><?= htmlspecialchars($error_messages["mname"]) ?></p>
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
                                <input id="image" class="file-input" data-display="image-name" name="image" type="file" accept="image/jpeg,.jpg,.jpeg"<?= ($action === "edit") ? "" : " required" ?> />
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
                <label for="unit" class="label">Unit</label>
            </div>
            <div class="field-body">
                <div class="field is-narrow">
                    <p class="control">
                        <input id="unit" class="input<?= isset($error_messages["munit"]) ? " is-danger" : "" ?>" name="munit" placeholder="Unit" value="<?= @$material["munit"] ?>" type="text" maxlength="20" required />
                    </p>
                    <? if (isset($error_messages["munit"])): ?>
                        <p class="help is-danger"><?= htmlspecialchars($error_messages["munit"]) ?></p>
                    <? endif ?>
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
                        <input id="reserved-quantity" class="input<?= isset($error_messages["mqty"]) ? " is-danger" : "" ?>" name="mqty" value="<?= @$material["mqty"] ?: 0 ?>" type="number" inputmode="numeric" min="0" required />
                    </p>
                    <? if (isset($error_messages["mqty"])): ?>
                        <p class="help is-danger"><?= htmlspecialchars($error_messages["mqty"]) ?></p>
                    <? endif ?>
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
                        <input id="physical-quantity" class="input<?= isset($error_messages["mrqty"]) ? " is-danger" : "" ?>" name="mrqty" value="<?= @$material["mrqty"] ?: 0 ?>" type="number" inputmode="numeric" min="0" required />
                    </p>
                    <? if (isset($error_messages["mrqty"])): ?>
                        <p class="help is-danger"><?= htmlspecialchars($error_messages["mrqty"]) ?></p>
                    <? endif ?>
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
                        <input id="reorder-level" class="input<?= isset($error_messages["mreorderqty"]) ? " is-danger" : "" ?>" name="mreorderqty" value="<?= @$material["mreorderqty"] ?: 0 ?>" type="number" inputmode="numeric" min="0" required />
                    </p>
                    <? if (isset($error_messages["mreorderqty"])): ?>
                        <p class="help is-danger"><?= htmlspecialchars($error_messages["mreorderqty"]) ?></p>
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

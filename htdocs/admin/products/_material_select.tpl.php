<div class="list-item">
    <div class="list-item-image">
        <figure class="image is-96x96">
            <? if (!empty($material)): ?>
                <img class="material-image" src="/assets/materials/<?= $material["mid"] ?>.jpg" alt="<?= $material["mname"] ?>" />
            <? else: ?>
                <img class="material-image" src="/assets/placeholder.jpg" alt="Select Material" />
            <? endif ?>
        </figure>
    </div>
    <div class="list-item-content">
        <div class="field">
            <div class="select">
                <select name="mid[]" required>
                    <option data-image="/assets/placeholder.jpg" data-unit="&ZeroWidthSpace;">Select Material</option>
                    <? foreach ($select_materials as $select_material): ?>
                        <option value="<?= $select_material["mid"] ?>"<?= (!empty($material) && ($select_material["mid"] === $material["mid"])) ? " selected" : "" ?> data-image="/assets/materials/<?= $select_material["mid"] ?>.jpg" data-unit="<?= $select_material["munit"] ?>"><?= $select_material["mname"] ?></option>
                    <? endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <div class="list-item-controls">
        <div class="is-flex is-align-items-center">
            <div class="field has-addons mb-0">
                <p class="control">
                    <input class="input" name="pmqty[]" value="<?= $material["pmqty"] ?? 1 ?>" type="number" size="2" min="1">
                </p>
                <p class="control">
                    <a class="material-unit button is-static">
                        <? if (!empty($material)): ?>
                            <?= $material["munit"] ?>
                        <? else: ?>
                            &ZeroWidthSpace;
                        <? endif ?>
                    </a>
                </p>
            </div>
            <div class="buttons ml-3">
                <button class="button" title="Delete" aria-label="Delete" type="button" data-action="delete">
                    <span class="icon">
                        <i class="fa-solid fa-trash"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="list-item">
    <div class="list-item-image">
        <figure class="image is-material is-64x64">
            <?php if (!empty($material)): ?>
                <img class="material-image" src="/assets/materials/<?php echo $material["mid"] ?>.jpg" alt="<?php echo htmlspecialchars($material["mname"]) ?>" />
            <?php else: ?>
                <img class="material-image" src="/assets/placeholder.jpg" alt="Select Material" />
            <?php endif ?>
        </figure>
    </div>
    <div class="list-item-content">
        <div class="field">
            <div class="select">
                <select name="mid[]" required>
                    <option data-image="/assets/placeholder.jpg" data-unit="&ZeroWidthSpace;">Select Material</option>
                    <?php foreach ($select_materials as $select_material): ?>
                        <option value="<?php echo $select_material["mid"] ?>"<?php echo (!empty($material) && ($select_material["mid"] == $material["mid"])) ? " selected" : "" ?> data-image="/assets/materials/<?php echo $select_material["mid"] ?>.jpg" data-unit="<?php echo htmlspecialchars($select_material["munit"]) ?>"><?php echo htmlspecialchars($select_material["mname"]) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <div class="list-item-controls">
        <div class="is-flex is-align-items-center">
            <div class="field has-addons mb-0">
                <p class="control">
                    <input class="input" name="pmqty[]" value="<?php echo $material["pmqty"] ?? 1 ?>" type="number" size="2" min="1">
                </p>
                <p class="control">
                    <a class="material-unit button is-static">
                        <?php if (!empty($material)): ?>
                            <?php echo htmlspecialchars($material["munit"]) ?>
                        <?php else: ?>
                            &ZeroWidthSpace;
                        <?php endif ?>
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

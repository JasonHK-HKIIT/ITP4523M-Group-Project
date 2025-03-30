<div class="list-item">
    <div class="list-item-image">
        <figure class="image is-96x96">
            <img src="/assets/materials/<?= $material["id"] ?>.jpg" alt="<?= $material["name"] ?>">
        </figure>
    </div>
    <div class="list-item-content">
        <div class="field">
            <div class="select">
                <select>
                    <option value="" data-image="" data-unit="&ZeroWidthSpace;">Select Material</option>
                    <? foreach ($materials as $material): ?>
                        <option value="<?= $material["id"] ?>" data-image="/assets/materials/<?= $material["id"] ?>.jpg" data-unit="<?= $material["unit"] ?>"><?= $material["name"] ?></option>
                    <? endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <div class="list-item-controls">
        <div class="is-flex is-align-items-center">
            <div class="field has-addons mb-0">
                <p class="control">
                    <input class="input" type="number" size="4" min="0" value="0">
                </p>
                <p class="control">
                    <a class="button is-static">&ZeroWidthSpace;</a>
                </p>
            </div>
            <div class="buttons ml-3">
                <a class="button" title="Delete" aria-label="Delete">
                    <span class="icon">
                        <i class="fa-solid fa-trash"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>

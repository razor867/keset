<?= $this->extend('form/form') ?>

<?= $this->section('form_css') ?>
<link rel="stylesheet" href="<?= base_url('vendor/select2/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('vendor/select2/select2-bootstrap4.min.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('form_plugins') ?>
<script src="<?= base_url('vendor/select2/select2.min.js') ?>"></script>
<?= $this->endSection() ?>

<?= $this->section('form_js') ?>
<script>
    $(document).ready(function() {
        const select2TypeAsset = $('#type_asset');
        select2TypeAsset.select2(configSelect2);
    })
</script>
<?= $this->endSection() ?>

<?= $this->section('form_content') ?>
<input type="hidden" name="main_assets_id" value="<?= $id ?>">
<div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label">Nama Aset</label>
    <div class="col-sm-9">
        <input type="text" class="form-control <?= ($validation->hasError('name') ? 'is-invalid' : '') ?>" id="name" name="name" value="<?= ($is_edit) ? $name : old('name') ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('name') ?>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="type_asset" class="col-sm-3 col-form-label">Tipe Aset</label>
    <div class="col-sm-6">
        <select name="type_asset" id="type_asset" class="form-control <?= ($validation->hasError('type_asset') ? 'is-invalid' : '') ?>">
            <?php if ($is_edit) : ?>
                <option value="<?= $asset_type_id_edit ?>"><?= $asset_type_name_edit ?></option>
            <?php else : ?>
                <option value=""></option>
            <?php endif ?>
            <?php foreach ($asset_types as $row) : ?>
                <option value="<?= $row->id ?>"><?= $row->name ?></option>
            <?php endforeach ?>
        </select>
        <div class="invalid-feedback">
            <?= $validation->getError('type_asset') ?>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="detail" class="col-sm-3 col-form-label">Detail Aset</label>
    <div class="col-sm-7">
        <textarea name="detail" id="detail" cols="30" rows="5" class="form-control <?= ($validation->hasError('detail') ? 'is-invalid' : '') ?>"><?= ($is_edit) ? $detail : old('detail') ?></textarea>
        <div class="invalid-feedback">
            <?= $validation->getError('detail') ?>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="total" class="col-sm-3 col-form-label">Jumlah Aset</label>
    <div class="col-sm-4">
        <input type="number" class="form-control <?= ($validation->hasError('total') ? 'is-invalid' : '') ?>" id="total" name="total" min="0" value="<?= ($is_edit) ? $total : old('total') ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('total') ?>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="price" class="col-sm-3 col-form-label">Harga Aset (Satuan)</label>
    <div class="col-sm-4 flex-nowrap">
        <div class="input-group ">
            <div class="input-group-prepend">
                <span class="input-group-text" id="addon-wrapping">Rp</span>
            </div>
            <input type="number" class="form-control <?= ($validation->hasError('price') ? 'is-invalid' : '') ?>" aria-label="proce" aria-describedby="addon-wrapping" id="price" name="price" value="<?= ($is_edit) ? $price : old('price') ?>">
            <div class="invalid-feedback">
                <span><?= $validation->getError('price') ?></span>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
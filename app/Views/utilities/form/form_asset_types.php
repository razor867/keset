<?= $this->extend('form/form') ?>

<?= $this->section('form_css') ?>
<?= $this->endSection() ?>

<?= $this->section('form_plugins') ?>
<?= $this->endSection() ?>

<?= $this->section('form_js') ?>
<?= $this->endSection() ?>

<?= $this->section('form_content') ?>
<input type="hidden" name="asset_types_id" value="<?= $id ?>">
<div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label">Nama Tipe Aset</label>
    <div class="col-sm-9">
        <input type="text" class="form-control <?= ($validation->hasError('name') ? 'is-invalid' : '') ?>" id="name" name="name" value="<?= ($is_edit) ? $name : old('name') ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('name') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
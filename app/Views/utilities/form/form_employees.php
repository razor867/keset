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
        const select2Position = $('#position_id');
        const select2Department = $('#department_id');
        select2Position.select2(configSelect2);
        select2Department.select2(configSelect2);
    })
</script>
<?= $this->endSection() ?>

<?= $this->section('form_content') ?>
<input type="hidden" name="employees_id" value="<?= $id ?>">
<div class="form-group row">
    <label for="name" class="col-sm-3 col-form-label">Nama Karyawan</label>
    <div class="col-sm-9">
        <input type="text" class="form-control <?= ($validation->hasError('name') ? 'is-invalid' : '') ?>" id="name" name="name" value="<?= ($is_edit) ? $name : old('name') ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('name') ?>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="nip" class="col-sm-3 col-form-label">NIP (Nomor Induk Pegawai)</label>
    <div class="col-sm-4">
        <input type="number" min="1" class="form-control <?= ($validation->hasError('nip') ? 'is-invalid' : '') ?>" id="nip" name="nip" min="0" value="<?= ($is_edit) ? $nip : old('nip') ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('nip') ?>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="position_id" class="col-sm-3 col-form-label">Jabatan</label>
    <div class="col-sm-6">
        <select name="position_id" id="position_id" class="form-control <?= ($validation->hasError('position_id') ? 'is-invalid' : '') ?>">
            <?php if ($is_edit) : ?>
                <option value="<?= $position_id_edit ?>"><?= $position_name_edit ?></option>
            <?php else : ?>
                <option value=""></option>
            <?php endif ?>
            <?php foreach ($positions as $row) : ?>
                <option value="<?= $row->id ?>"><?= $row->name ?></option>
            <?php endforeach ?>
        </select>
        <div class="invalid-feedback">
            <?= $validation->getError('position_id') ?>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="department_id" class="col-sm-3 col-form-label">Departemen</label>
    <div class="col-sm-6">
        <select name="department_id" id="department_id" class="form-control <?= ($validation->hasError('department_id') ? 'is-invalid' : '') ?>">
            <?php if ($is_edit) : ?>
                <option value="<?= $department_id_edit ?>"><?= $department_name_edit ?></option>
            <?php else : ?>
                <option value=""></option>
            <?php endif ?>
            <?php foreach ($departments as $row) : ?>
                <option value="<?= $row->id ?>"><?= $row->name ?></option>
            <?php endforeach ?>
        </select>
        <div class="invalid-feedback">
            <?= $validation->getError('department_id') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
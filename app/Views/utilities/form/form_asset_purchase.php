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
        $("select").select2({
            theme: "bootstrap4",
            minimumInputLength: 3,
            allowClear: true,
            placeholder: 'Cari nama Asset',
            ajax: {
                url: base_url + '/utilities/get_ajax_asset',
                type: "post",
                dataType: "json",
                delay: 250,
                cache: false,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page || 1,
                    };
                },
                processResults: function(data, params) {
                    return data;
                },
            },
            language: {
                searching: function() {
                    return '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
                },
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            tags: false,
        });
    })
</script>
<?= $this->endSection() ?>

<?= $this->section('form_content') ?>
<input type="hidden" name="asset_purchase_id" value="<?= $id ?>">
<div class="form-group row">
    <label for="asset_id" class="col-sm-3 col-form-label">Aset</label>
    <div class="col-sm-6">
        <select name="asset_id" id="asset_id" class="form-control <?= ($validation->hasError('asset_id') ? 'is-invalid' : '') ?>">
            <?php if ($is_edit) : ?>
                <option value="<?= $asset_id_edit ?>"><?= $asset_name_edit ?></option>
            <?php else : ?>
                <option value=""></option>
            <?php endif ?>
        </select>
        <div class="invalid-feedback">
            <?= $validation->getError('asset_id') ?>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="total" class="col-sm-3 col-form-label">Total Beli</label>
    <div class="col-sm-4">
        <input type="number" min="1" class="form-control <?= ($validation->hasError('total') ? 'is-invalid' : '') ?>" id="total" name="total" min="0" value="<?= ($is_edit) ? $total : old('total') ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('total') ?>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="price" class="col-sm-3 col-form-label">Harga Per (Unit/Pack/Dus)</label>
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
<div class="form-group row">
    <label for="total_price" class="col-sm-3 col-form-label">Total Harga</label>
    <div class="col-sm-4 flex-nowrap">
        <div class="input-group ">
            <div class="input-group-prepend">
                <span class="input-group-text" id="addon-wrapping">Rp</span>
            </div>
            <input type="number" class="form-control <?= ($validation->hasError('total_price') ? 'is-invalid' : '') ?>" aria-label="proce" aria-describedby="addon-wrapping" id="total_price" name="total_price" value="<?= ($is_edit) ? $total_price : old('total_price') ?>">
            <div class="invalid-feedback">
                <span><?= $validation->getError('total_price') ?></span>
            </div>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="seller" class="col-sm-3 col-form-label">Seller</label>
    <div class="col-sm-9">
        <input type="text" class="form-control <?= ($validation->hasError('seller') ? 'is-invalid' : '') ?>" id="seller" name="seller" value="<?= ($is_edit) ? $seller : old('seller') ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('seller') ?>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="date" class="col-sm-3 col-form-label">Tanggal Beli</label>
    <div class="col-sm-3">
        <input type="date" class="form-control <?= ($validation->hasError('date') ? 'is-invalid' : '') ?>" id="date" name="date" value="<?= ($is_edit) ? $date : old('date') ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('date') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->extend('template/template') ?>

<?= $this->section('css_custom') ?>
<link rel="stylesheet" href="<?= base_url('vendor/sweetalert/sweetalert2.min.css') ?>">
<?= $this->renderSection('form_css') ?>
<?= $this->endSection() ?>

<?= $this->section('plugins') ?>
<script src="<?= base_url('vendor/sweetalert/sweetalert2.min.js') ?>"></script>
<?= $this->renderSection('form_plugins') ?>
<?= $this->endSection() ?>

<?= $this->section('js_custom') ?>
<script src="<?= base_url('js/extensions/sweetalert.js') ?>"></script>
<?= $this->renderSection('form_js') ?>
<script>
    $(document).ready(function() {
        $('.swal2-container .select2-container').css('display', 'none');
    })
    let configSelect2Ajax = {
        theme: "bootstrap4",
        minimumInputLength: 2,
        allowClear: true,
        placeholder: "",
        ajax: {
            url: "",
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
    }
    let configSelect2 = {
        theme: "bootstrap4",
        // minimumInputLength: 2,
        // allowClear: true,
        // placeholder: "",
    }
</script>
<?= $this->endSection() ?>

<?= $this->section('modal_custom') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-4">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title_card ?></h6>
            </div>
            <div class="col-md-8 mt-3">
                <a class="btn btn-sm btn-secondary float-right" href="<?= $back_url ?>"><i class="fas fa-fw fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="<?= $action_url ?>" method="post">
            <?= csrf_field() ?>
            <?= $this->renderSection('form_content') ?>
            <button type="reset" class="btn btn-light btn-sm float-right mt-3"><i class="fas fa-fw fa-undo"></i> Reset</button>
            <button type="submit" class="btn btn-primary btn-sm float-right mt-3 mr-2"><i class="fas fa-fw fa-save"></i> Save</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
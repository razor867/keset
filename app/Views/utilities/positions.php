<?= $this->extend('template/template') ?>

<?= $this->section('css_custom') ?>
<link href="<?= base_url('vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('vendor/sweetalert/sweetalert2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('css/datatable.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('plugins') ?>
<script src="<?= base_url('vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('vendor/sweetalert/sweetalert2.min.js') ?>"></script>
<?= $this->endSection() ?>

<?= $this->section('js_custom') ?>
<script src="<?= base_url('js/pages/listdata_positions.js') ?>"></script>
<script src="<?= base_url('js/extensions/sweetalert.js') ?>"></script>
<script src="<?= base_url('js/action_table.js') ?>"></script>
<?= $this->endSection() ?>

<?= $this->section('modal_custom') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-4">
                <h6 class="m-0 font-weight-bold text-primary">Positions data in office</h6>
            </div>
            <div class="col-md-8 mt-3">
                <a class="btn btn-sm btn-primary float-right" href="<?= base_url('utilities/form_positions') ?>"><i class="fas fa-fw fa-plus"></i> Add</a>
                <div class="dropdown float-right mr-2">
                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Export
                    </button>
                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-file-csv"></i> CSV</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-file-excel"></i> Excel</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-fw fa-file-pdf"></i> PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="wrap-max-80">Nama Jabatan</th>
                        <th class="wrap-max-20 dt-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
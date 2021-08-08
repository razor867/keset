<?= $this->extend('template/auth') ?>

<?= $this->section('css_custom') ?>
<!-- <style>
    .bg-login-image {
        background: url(<?= base_url('img/undraw_secure_login_pdn4.png') ?>);
        background-position: center;
        background-size: cover;
    }
</style> -->
<?= $this->endSection() ?>

<?= $this->section('plugins') ?>
<?= $this->endSection() ?>

<?= $this->section('js_custom') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="text-center mb-3">
    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
</div>

<?= view('Myth\Auth\Views\_message_block') ?>

<form class="user mt-3" action="<?= route_to('login') ?>" method="post">
    <?= csrf_field() ?>

    <?php if ($config->validFields === ['email']) : ?>
        <div class="form-group">
            <input type="email" class="form-control form-control-user <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" id="email" name="login" aria-describedby="emailHelp" placeholder="Enter Email Address...">
            <div class="invalid-feedback">
                <?= session('errors.login') ?>
            </div>
        </div>
    <?php else : ?>
        <div class="form-group">
            <input type="text" class="form-control form-control-user <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" id="username_and_email" name="login" aria-describedby="emailHelp" placeholder="Enter Email or Username">
            <div class="invalid-feedback">
                <?= session('errors.login') ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <input type="password" class="form-control form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="password" name="password" placeholder="Password">
        <div class="invalid-feedback">
            <?= session('errors.password') ?>
        </div>
    </div>

    <?php if ($config->allowRemembering) : ?>
        <div class="form-group">
            <div class="custom-control custom-checkbox small">
                <input type="checkbox" class="custom-control-input" id="customCheck" name="remember" <?php if (old('remember')) : ?> checked <?php endif ?>>
                <label class="custom-control-label" for="customCheck">Remember Me</label>
            </div>
        </div>
    <?php endif; ?>

    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>

    <!-- <hr>
    <a href="index.html" class="btn btn-google btn-user btn-block">
        <i class="fab fa-google fa-fw"></i> Login with Google
    </a>
    <a href="index.html" class="btn btn-facebook btn-user btn-block">
        <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
    </a> -->
</form>
<hr>
<div class="text-center">
    <!-- <a class="small" href="forgot-password.html">Forgot Password?</a> -->
    <small>Forgot Password?</small><br>
    <small>Call Administration (087879643123)</small>
</div>
<!-- <div class="text-center">
    <a class="small" href="register.html">Create an Account!</a>
</div> -->
<?= $this->endSection() ?>
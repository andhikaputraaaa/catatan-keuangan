<?php $this->load->view('layout/header'); ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h3 class="text-center mb-4">Login</h3>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('auth/login') ?>">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-hijau w-100">Login</button>
        </form>

        <p class="mt-3 text-center">Belum punya akun? <a href="<?= site_url('auth/register') ?>">Daftar di sini</a></p>
    </div>
</div>

<?php $this->load->view('layout/footer'); ?>

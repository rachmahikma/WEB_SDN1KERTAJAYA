<div class="d-flex justify-content-center align-items-center min-vh-100" style="background: linear-gradient(135deg, #f5f7fa 0%, #e2e8f0 100%); padding: 40px 0;">
    <div class="card shadow-lg" style="max-width: 420px; width: 100%; border-radius: 24px; background: #fff8e1;">
        <div class="card-body p-5">
            <h3 class="fw-bold text-center mb-4">Silakan masuk terlebih dahulu</h3>

            <?php if (!empty($message)): ?>
                <div class="alert alert-<?php echo isset($message_type) ? $message_type : 'info'; ?> alert-dismissible fade show" role="alert">
                    <?php echo $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= site_url('login') ?>">
                <div class="mb-3">
                    <label for="username" class="form-label fw-bold">Nama pengguna:</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan nama pengguna" required style="border-radius: 12px; padding: 14px;" value="<?= isset($username) ? htmlspecialchars($username) : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Kata sandi:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required style="border-radius: 12px; padding: 14px;">
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" value="1" id="remember_me" name="remember_me">
                    <label class="form-check-label" for="remember_me">Ingat saya</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold" style="padding: 12px; border-radius: 12px;">Masuk</button>
            </form>

            <div class="text-center mt-4">
                <a href="#" class="text-decoration-none">Lupa kata sandi Anda?</a>
            </div>
            <div class="text-center mt-3">
                <span class="text-muted">Belum punya akun? </span>
                <a href="<?= site_url('login/register') ?>" class="text-decoration-none">Daftar sekarang.</a>
            </div>
        </div>
    </div>
</div>

<style>
body {
    background: linear-gradient(135deg, #edf2f7 0%, #e2e8f0 100%);
}
</style>

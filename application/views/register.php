<div class="d-flex justify-content-center align-items-center min-vh-100" style="background: linear-gradient(135deg, #f5f7fa 0%, #e2e8f0 100%); padding: 40px 0;">
    <div class="card shadow-lg" style="max-width: 520px; width: 100%; border-radius: 24px; background: #fff8e1;">
        <div class="card-body p-5">
            <h3 class="fw-bold text-center mb-4">Daftar Akun Siswa</h3>

            <?php if (!empty($message)): ?>
                <div class="alert alert-<?php echo isset($message_type) ? $message_type : 'info'; ?> alert-dismissible fade show" role="alert">
                    <?php echo $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

            <form method="post" action="<?= site_url('login/register') ?>">
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" required style="border-radius: 12px; padding: 14px;" value="<?= htmlspecialchars($name ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label for="nisn" class="form-label fw-bold">NISN</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukkan NISN" required style="border-radius: 12px; padding: 14px;" value="<?= htmlspecialchars($nisn ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label for="class" class="form-label fw-bold">Kelas</label>
                    <select class="form-select" id="class" name="class" required style="border-radius: 12px; padding: 14px;">
                        <option value="">Pilih kelas</option>
                        <?php foreach ($class_options as $key => $label): ?>
                            <option value="<?= htmlspecialchars($key) ?>" <?= isset($class) && $class == $key ? 'selected' : '' ?>><?= htmlspecialchars($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Buat kata sandi" required style="border-radius: 12px; padding: 14px;">
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label fw-bold">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Ketik ulang kata sandi" required style="border-radius: 12px; padding: 14px;">
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold" style="padding: 12px; border-radius: 12px;">Daftar Akun</button>
            </form>

            <div class="text-center mt-4">
                <span class="text-muted">Sudah punya akun? </span>
                <a href="<?= site_url('login') ?>" class="text-decoration-none">Masuk di sini.</a>
            </div>
        </div>
    </div>
</div>

<style>
body {
    background: linear-gradient(135deg, #edf2f7 0%, #e2e8f0 100%);
}
</style>

<main class="main-content">
    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Add Volume</h2>
            <a href="<?= base_url('admin/volumes') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <!-- Flash message (optional) -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Validation error messages -->
        <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <!-- Add Volume Form -->
        <form action="<?= base_url('admin/volumes/add') ?>" method="post" class="card shadow-sm p-4">
            <?= csrf_field() ?>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="year" class="form-label fw-semibold">Year <span class="text-danger">*</span></label>
                    <input type="text" name="year" id="year" class="form-control" required placeholder="e.g., 2024"
                        value="<?= old('year') ?>">
                </div>
                <div class="col-md-6">
                    <label for="volume_no" class="form-label fw-semibold">Volume Number <span
                            class="text-danger">*</span></label>
                    <input type="text" name="volume_no" id="volume_no" class="form-control" required
                        placeholder="e.g., 12" value="<?= old('volume_no') ?>">
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Save Volume
                </button>
            </div>
        </form>
    </div>
</main>
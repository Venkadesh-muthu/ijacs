<main class="main-content">
    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Upload Article XML</h2>
            <a href="<?= base_url('admin/articles') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <!-- Flash messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif (session()->getFlashdata('error')): ?>
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

        <!-- Upload XML Form -->
        <form action="<?= base_url('admin/upload-article-xml') ?>" method="post" enctype="multipart/form-data"
            class="card shadow-sm p-4">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="xml_file" class="form-label fw-semibold">Choose XML File <span
                        class="text-danger">*</span></label>
                <input type="file" name="xml_file" id="xml_file" class="form-control" accept=".xml" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-upload me-1"></i> Upload
                </button>
            </div>
        </form>
    </div>
</main>
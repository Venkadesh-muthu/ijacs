<main class="main-content" style="margin-left: 250px; padding-top: 70px;">
    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Edit Volume</h2>
            <a href="<?= base_url('admin/volumes') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <!-- Edit Volume Form -->
        <form action="<?= base_url('admin/volumes/edit/' . $volume['id']) ?>" method="post" class="card shadow-sm p-4">
            <?= csrf_field() ?>

            <input type="hidden" name="id" value="<?= esc($volume['id']) ?>">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="year" class="form-label fw-semibold">Year <span class="text-danger">*</span></label>
                    <input type="text" name="year" id="year" class="form-control" required
                        value="<?= esc($volume['year']) ?>" placeholder="e.g., 2024">
                </div>

                <div class="col-md-6">
                    <label for="volume_no" class="form-label fw-semibold">Volume Number <span
                            class="text-danger">*</span></label>
                    <input type="text" name="volume_no" id="volume_no" class="form-control" required
                        value="<?= esc($volume['volume_no']) ?>" placeholder="e.g., 12">
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Update Volume
                </button>
            </div>
        </form>
    </div>
</main>
<main class="main-content">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Edit News & Events</h2>
            <a href="<?= base_url('admin/news') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error') ?>
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/news/edit/' . $news['id']) ?>" method="post" class="card shadow-sm p-4">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Message <span class="text-danger">*</span></label>
                <textarea name="message" class="form-control" rows="4" required><?= esc($news['message']) ?></textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Volume <span class="text-danger">*</span></label>
                    <input type="text" name="volume" class="form-control" value="<?= esc($news['volume']) ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Issue <span class="text-danger">*</span></label>
                    <input type="text" name="issue" class="form-control" value="<?= esc($news['issue']) ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Year <span class="text-danger">*</span></label>
                    <input type="text" name="year" class="form-control" value="<?= esc($news['year']) ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Deadline <span class="text-danger">*</span></label>
                <input type="date" name="deadline" class="form-control" value="<?= esc($news['deadline']) ?>" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Update News
                </button>
            </div>
        </form>

    </div>
</main>

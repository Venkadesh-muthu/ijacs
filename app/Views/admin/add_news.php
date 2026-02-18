<main class="main-content">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Add News / Event</h2>
            <a href="<?= base_url('admin/news') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <!-- FLASH ERROR -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error') ?>
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- VALIDATION ERRORS -->
        <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/news/add') ?>"
              method="post"
              enctype="multipart/form-data"
              class="card shadow-sm p-4">

            <?= csrf_field() ?>

            <div class="row">

                <!-- TYPE -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-select" required>
                        <option value="">Select Type</option>
                        <option value="news" <?= old('type') == 'news' ? 'selected' : '' ?>>News</option>
                        <option value="event" <?= old('type') == 'event' ? 'selected' : '' ?>>Event</option>
                    </select>
                </div>

                <!-- TITLE -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                    <input type="text"
                           name="title"
                           class="form-control"
                           value="<?= old('title') ?>"
                           required>
                </div>

                <!-- DESCRIPTION -->
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                    <textarea name="message"
                              class="form-control"
                              rows="4"
                              required><?= old('message') ?></textarea>
                </div>

                <!-- LINK -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">External Link (optional)</label>
                    <input type="url"
                           name="link"
                           class="form-control"
                           placeholder="https://example.com"
                           value="<?= old('link') ?>">
                </div>

                <!-- FILE UPLOAD -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Upload File (PDF / Image)</label>
                    <input type="file"
                           name="attachment"
                           class="form-control"
                           accept=".pdf,.jpg,.jpeg,.png">
                </div>

                <!-- DEADLINE -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Deadline / Event Date</label>
                    <input type="date"
                           name="deadline"
                           class="form-control"
                           value="<?= old('deadline') ?>">
                </div>

            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Save
                </button>
            </div>

        </form>

    </div>
</main>

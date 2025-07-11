<main class="main-content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">
                <?= isset($article) ? 'Edit' : 'Add' ?> Article
            </h2>
            <a href="<?= base_url('admin/articles') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <form
            action="<?= isset($article) ? base_url('admin/articles/edit/' . $article['id']) : base_url('admin/articles/add') ?>"
            method="post" enctype="multipart/form-data" class="card shadow-sm p-4">
            <?= csrf_field() ?>

            <!-- Issue & Title -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="issue_id" class="form-label fw-semibold">Issue <span
                            class="text-danger">*</span></label>
                    <select name="issue_id" id="issue_id" class="form-select" required>
                        <option value="">-- Select Issue --</option>
                        <?php foreach ($issuesWithVolume as $issue): ?>
                            <option value="<?= $issue['id'] ?>" <?= isset($article) && $article['issue_id'] == $issue['id'] ? 'selected' : '' ?>>
                                Volume <?= esc($issue['volume_no']) ?> (<?= esc($issue['year']) ?>) -
                                Issue <?= esc($issue['issue_no']) ?> [<?= ucfirst($issue['issue_type']) ?>] -
                                <?= date('F j, Y', strtotime($issue['published_date'])) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <div class="col-md-6">
                    <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" required
                        value="<?= esc($article['title'] ?? '') ?>">
                </div>
            </div>

            <!-- Subtitle & Authors -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="subtitle" class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" id="subtitle" class="form-control"
                        value="<?= esc($article['subtitle'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label for="authors" class="form-label fw-semibold">Authors <span
                            class="text-danger">*</span></label>
                    <input type="text" name="authors" id="authors" class="form-control" required
                        value="<?= esc($article['authors'] ?? '') ?>">
                </div>
            </div>

            <!-- DOI / Pages / PDF -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="doi" class="form-label">DOI</label>
                    <input type="text" name="doi" id="doi" class="form-control"
                        value="<?= esc($article['doi'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label for="pages" class="form-label">Pages</label>
                    <input type="text" name="pages" id="pages" class="form-control"
                        value="<?= esc($article['pages'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label for="pdf_file" class="form-label">Upload PDF</label>
                    <input type="file" name="pdf_file" id="pdf_file" class="form-control">
                    <?php if (!empty($article['pdf_file'])): ?>
                        <div class="mt-2">
                            <a href="<?= base_url('uploads/articles/' . $article['pdf_file']) ?>" target="_blank">
                                View current PDF
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Image Upload -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="col-md-6">
                    <?php if (!empty($article['images'])): ?>
                        <label class="form-label d-block">Current Image</label>
                        <img src="<?= base_url('uploads/images/' . $article['images']) ?>" class="img-thumbnail"
                            style="max-height: 100px;" alt="Current Image">
                    <?php endif; ?>
                </div>
            </div>

            <!-- Abstract & Keywords -->
            <div class="mb-3">
                <label for="abstract" class="form-label">Abstract</label>
                <textarea name="abstract" id="abstract" class="form-control"
                    rows="4"><?= esc($article['abstract'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label for="keywords" class="form-label">Keywords</label>
                <textarea name="keywords" id="keywords" class="form-control"
                    rows="2"><?= esc($article['keywords'] ?? '') ?></textarea>
            </div>

            <!-- Submit -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <?= isset($article) ? 'Update' : 'Save' ?> Article
                </button>
            </div>
        </form>
    </div>
</main>
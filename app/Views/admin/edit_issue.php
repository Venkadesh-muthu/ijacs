<main class="main-content" style="margin-left: 250px; padding-top: 70px;">
  <div class="container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold">Edit Issue</h2>
      <a href="<?= base_url('admin/issues') ?>" class="btn btn-outline-secondary">Back</a>
    </div>

    <!-- Validation Errors -->
    <?php if (isset($validation)): ?>
      <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
    <?php endif; ?>

    <!-- Edit Issue Form -->
    <form action="<?= base_url('admin/issues/edit/' . $issue['id']) ?>" method="post" enctype="multipart/form-data"
      class="card shadow-sm p-4">
      <?= csrf_field() ?>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="volume_id" class="form-label fw-semibold">Volume <span class="text-danger">*</span></label>
          <select name="volume_id" id="volume_id" class="form-select" required>
            <?php foreach ($volumes as $vol): ?>
              <option value="<?= $vol['id'] ?>" <?= $issue['volume_id'] == $vol['id'] ? 'selected' : '' ?>>
                <?= esc($vol['volume_no']) ?> (<?= esc($vol['year']) ?>)
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6">
          <label for="issue_no" class="form-label fw-semibold">Issue Number <span class="text-danger">*</span></label>
          <input type="text" name="issue_no" id="issue_no" class="form-control" required
            value="<?= esc($issue['issue_no']) ?>">
        </div>
      </div>

      <div class="mb-3">
        <label for="published_date" class="form-label fw-semibold">Published Date <span
            class="text-danger">*</span></label>
        <input type="date" name="published_date" id="published_date" class="form-control" required
          value="<?= esc($issue['published_date']) ?>">
      </div>

      <!-- 🔽 Issue Type -->
      <div class="mb-3">
        <label for="issue_type" class="form-label fw-semibold">Issue Type <span class="text-danger">*</span></label>
        <select name="issue_type" id="issue_type" class="form-select" required>
          <option value="">-- Select Type --</option>
          <option value="normal" <?= $issue['issue_type'] == 'normal' ? 'selected' : '' ?>>Normal</option>
          <option value="special" <?= $issue['issue_type'] == 'special' ? 'selected' : '' ?>>Special</option>
        </select>
      </div>

      <!-- 📁 Issue Image -->
      <div class="mb-3">
        <label for="issue_image" class="form-label fw-semibold">Issue Image</label>
        <input type="file" name="issue_image" id="issue_image" class="form-control" accept="image/*">
        <?php if (!empty($issue['issue_image'])): ?>
          <div class="mt-2">
            <img src="<?= base_url('uploads/issues/' . $issue['issue_image']) ?>" alt="Issue Image"
              style="max-height: 100px;">
          </div>
        <?php endif; ?>
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-primary">Update Issue</button>
      </div>
    </form>
  </div>
</main>
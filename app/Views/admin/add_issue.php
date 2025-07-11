<main class="main-content" style="margin-left: 250px; padding-top: 70px;">
  <div class="container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold">Add Issue</h2>
      <a href="<?= base_url('admin/issues') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>Back
      </a>
    </div>

    <!-- Validation Errors -->
    <?php if (isset($validation)): ?>
      <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
      </div>
    <?php endif; ?>

    <!-- Add Issue Form -->
    <form action="<?= base_url('admin/issues/add') ?>" method="post" enctype="multipart/form-data"
      class="card shadow-sm p-4">
      <?= csrf_field() ?>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="volume_id" class="form-label fw-semibold">Volume <span class="text-danger">*</span></label>
          <select name="volume_id" id="volume_id" class="form-select" required>
            <option value="">-- Select Volume --</option>
            <?php foreach ($volumes as $vol): ?>
              <option value="<?= $vol['id'] ?>"><?= esc($vol['volume_no']) ?> (<?= esc($vol['year']) ?>)</option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6">
          <label for="issue_no" class="form-label fw-semibold">Issue Number <span class="text-danger">*</span></label>
          <input type="text" name="issue_no" id="issue_no" class="form-control" required placeholder="e.g., 1">
        </div>
      </div>

      <div class="mb-3">
        <label for="published_date" class="form-label fw-semibold">Published Date <span
            class="text-danger">*</span></label>
        <input type="date" name="published_date" id="published_date" class="form-control" required>
      </div>

      <!-- 🔽 Issue Type -->
      <div class="mb-3">
        <label for="issue_type" class="form-label fw-semibold">Issue Type <span class="text-danger">*</span></label>
        <select name="issue_type" id="issue_type" class="form-select" required>
          <option value="">-- Select Type --</option>
          <option value="normal">Normal</option>
          <option value="special">Special</option>
        </select>
      </div>

      <!-- 📁 Issue Image -->
      <div class="mb-3">
        <label for="issue_image" class="form-label fw-semibold">Issue Image (Optional)</label>
        <input type="file" name="issue_image" id="issue_image" class="form-control" accept="image/*">
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-primary">Save Issue</button>
      </div>
    </form>

  </div>
</main>
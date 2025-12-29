<main class="main-content">
  <div class="container-fluid">

    <!-- HEADER -->
    <div class="row align-items-center mb-4 mt-3">
      <div class="col-md-4">
        <h2 class="fw-bold mb-0">All Issues</h2>
      </div>

      <div class="col-md-5">
        <form method="get" class="d-flex gap-2">
          <select name="volume_id" class="form-select" onchange="this.form.submit()">
            <option value="">All Volumes</option>
            <?php foreach ($volumes as $volume): ?>
              <option value="<?= $volume['id'] ?>"
                <?= ($selectedVolume == $volume['id']) ? 'selected' : '' ?>>
                Volume <?= esc($volume['volume_no']) ?> (<?= esc($volume['year']) ?>)
              </option>
            <?php endforeach; ?>
          </select>

          <?php if (!empty($selectedVolume)): ?>
            <a href="<?= base_url('admin/issues') ?>" class="btn btn-secondary">Reset</a>
          <?php endif; ?>
        </form>
      </div>

      <div class="col-md-3 text-end">
        <a href="<?= base_url('admin/issues/add') ?>" class="btn btn-success">
          <i class="bi bi-plus-circle me-1"></i>Add Issue
        </a>
      </div>
    </div>

    <!-- FLASH MESSAGE -->
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <!-- TABLE -->
    <div class="card shadow-sm">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table id="articlesTable" class="table table-bordered mb-0 align-middle text-center">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Volume</th>
                <th>Issue Number</th>
                <th>Issue Type</th>
                <th>Image</th>
                <th>Published Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($issues)):
                  $i = 1; // start index
                  foreach ($issues as $issue): ?>
                    <tr>
                      <td><?= $i++ ?></td>
                      <td>Vol <?= esc($issue['volume_no']) ?></td>
                      <td><?= esc($issue['issue_no']) ?></td>
                      <td><?= ucfirst($issue['issue_type'] ?? 'Normal') ?></td>
                      <td>
                        <?php if (!empty($issue['issue_image'])): ?>
                          <img src="<?= base_url('uploads/issues/' . $issue['issue_image']) ?>" width="60">
                        <?php else: ?>
                          <span class="text-muted">No Image</span>
                        <?php endif; ?>
                      </td>
                      <td><?= esc($issue['published_date']) ?></td>
                      <td>
                        <a href="<?= base_url('admin/issues/edit/' . $issue['id']) ?>" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                        <a href="<?= base_url('admin/issues/delete/' . $issue['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</main>
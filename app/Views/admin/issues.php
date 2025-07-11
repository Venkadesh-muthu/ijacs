<main class="main-content">
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold">All Issues</h2>
      <a href="<?= base_url('admin/issues/add') ?>" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i>Add Issue
      </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <div class="card shadow-sm">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered mb-0 align-middle">
            <thead class="table-light text-center">
              <tr>
                <th>#</th>
                <th>Volume</th>
                <th>Issue Number</th>
                <th>Issue Type</th> <!-- NEW -->
                <th>Image</th> <!-- NEW -->
                <th>Published Date</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
              <?php if (!empty($issues)):
                $i = 1;
                foreach ($issues as $issue): ?>
                  <tr class="text-center">
                    <td><?= $i++ ?></td>
                    <td><?= esc($issue['volume_no'] ?? 'Volume #' . $issue['volume_id']) ?></td>
                    <td><?= esc($issue['issue_no']) ?></td>
                    <td><?= ucfirst($issue['issue_type'] ?? 'Normal') ?></td> <!-- NEW -->
                    <td>
                      <?php if (!empty($issue['issue_image'])): ?>
                        <img src="<?= base_url('uploads/issues/' . $issue['issue_image']) ?>" alt="Issue Image" width="60">
                      <?php else: ?>
                        <span class="text-muted">No Image</span>
                      <?php endif; ?>
                    </td>
                    <td><?= date('d M Y', strtotime($issue['published_date'])) ?></td>
                    <td>
                      <a href="<?= base_url('admin/issues/edit/' . $issue['id']) ?>"
                        class="btn btn-sm btn-outline-primary me-1">Edit</a>
                      <a href="<?= base_url('admin/issues/delete/' . $issue['id']) ?>" class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Are you sure you want to delete this issue?')">Delete</a>
                    </td>
                  </tr>
                <?php endforeach; else: ?>
                <tr>
                  <td colspan="7" class="text-center">No issues found.</td>
                </tr>
              <?php endif; ?>
            </tbody>

          </table>
          <div class="mt-4 ps-2">
            <?= $pager->links('default', 'bootstrap') ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
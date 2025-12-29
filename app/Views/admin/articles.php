<main class="main-content">
  <div class="container-fluid">

    <!-- HEADER -->
    <div class="row align-items-center mb-4 mt-3">
      <div class="col-md-4">
        <h2 class="fw-bold mb-0">All Articles</h2>
      </div>

      <!-- FILTERS -->
      <div class="col-md-6">
        <form method="get" class="d-flex gap-2">
          <!-- Volume -->
          <select name="volume_id" class="form-select" onchange="this.form.submit()">
            <option value="">All Volumes</option>
            <?php foreach ($volumes as $volume): ?>
              <option value="<?= $volume['id'] ?>"
                <?= ($selectedVolume == $volume['id']) ? 'selected' : '' ?>>
                Volume <?= esc($volume['volume_no']) ?>
              </option>
            <?php endforeach; ?>
          </select>

          <!-- Issue -->
          <select name="issue_id" class="form-select" onchange="this.form.submit()">
            <option value="">All Issues</option>
            <?php foreach ($issues as $issue): ?>
              <option value="<?= $issue['id'] ?>"
                <?= ($selectedIssue == $issue['id']) ? 'selected' : '' ?>>
                Issue <?= esc($issue['issue_no']) ?>
              </option>
            <?php endforeach; ?>
          </select>

          <?php if ($selectedVolume || $selectedIssue): ?>
            <a href="<?= base_url('admin/articles') ?>" class="btn btn-secondary">Reset</a>
          <?php endif; ?>
        </form>
      </div>

      <!-- ADD BUTTON -->
      <div class="col-md-2 text-end">
        <a href="<?= base_url('admin/articles/add') ?>" class="btn btn-success">
          <i class="bi bi-plus-circle me-1"></i>Add Article
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
                <th>Title</th>
                <th>Authors</th>
                <th>Volume</th>
                <th>Issue</th>
                <th>DOI</th>
                <th>Pages</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
              <?php if (!empty($articles)):
                  $i = 1; // Serial number
                  foreach ($articles as $article): ?>
                    <tr>
                      <td><?= $i++ ?></td>
                      <td><?= esc($article['title']) ?></td>
                      <td><?= esc($article['authors']) ?></td>
                      <td>Vol <?= esc($article['volume_no']) ?></td>
                      <td><?= esc($article['issue_no']) ?></td>
                      <td><?= esc($article['doi']) ?></td>
                      <td><?= esc($article['pages']) ?></td>
                      <td>
                        <div class="d-flex justify-content-center gap-2">
                          <a href="<?= base_url('admin/articles/edit/' . $article['id']) ?>"
                             class="btn btn-sm btn-outline-primary">Edit</a>
                          <a href="<?= base_url('admin/articles/delete/' . $article['id']) ?>"
                             class="btn btn-sm btn-outline-danger"
                             onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="8" class="text-center">No articles found.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</main>
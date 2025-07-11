<main class="main-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h2 class="mb-4">Dashboard</h2>

        <!-- 🔢 Stat Cards -->
        <div class="row g-4 mb-4">
          <div class="col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100">
              <div class="card-body d-flex align-items-center">
                <i class="bi bi-calendar3 fs-2 text-primary me-3"></i>
                <div>
                  <h6 class="mb-0 text-muted">Years</h6>
                  <h4 class="mb-0"><?= $total_years ?></h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100">
              <div class="card-body d-flex align-items-center">
                <i class="bi bi-collection fs-2 text-success me-3"></i>
                <div>
                  <h6 class="mb-0 text-muted">Volumes</h6>
                  <h4 class="mb-0"><?= $total_volumes ?></h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100">
              <div class="card-body d-flex align-items-center">
                <i class="bi bi-journals fs-2 text-info me-3"></i>
                <div>
                  <h6 class="mb-0 text-muted">Issues</h6>
                  <h4 class="mb-0"><?= $total_issues ?></h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100">
              <div class="card-body d-flex align-items-center">
                <i class="bi bi-file-earmark-check fs-2 text-warning me-3"></i>
                <div>
                  <h6 class="mb-0 text-muted">Uploaded Articles</h6>
                  <h4 class="mb-0"><?= $total_articles ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- 📄 Recent Issues Table -->
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white fw-bold">Recent Issues</div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped mb-0 align-middle w-100">
                <thead class="table-light">
                  <tr>
                    <th>Year</th>
                    <th>Volume</th>
                    <th>Issue</th>
                    <th>PDF</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($recent_issues)): ?>
                    <?php foreach ($recent_issues as $issue): ?>
                      <tr>
                        <td><?= esc($issue['year']) ?></td>
                        <td>Vol. <?= esc($issue['volume_no']) ?></td>
                        <td>Issue <?= esc($issue['issue_no']) ?></td>
                        <td>
                          <?php if (!empty($issue['pdf_file'])): ?>
                            <a href="<?= base_url('uploads/articles/' . $issue['pdf_file']) ?>" target="_blank">View</a>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        </td>

                        <td><?= date('d M Y', strtotime($issue['published_date'])) ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="5" class="text-center">No issues found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
</main>
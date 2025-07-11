<div class="container py-5">
  <h2 class="mb-5 fw-bold">Special Issues</h2>

  <?php if (!empty($articles)): ?>
    <?php
    // Group articles by issue_id
    $grouped = [];
    foreach ($articles as $article) {
      $grouped[$article['issue_id']][] = $article;
    }
    ?>

    <?php foreach ($grouped as $issueId => $articlesGroup): ?>
      <?php $first = $articlesGroup[0]; ?>

      <!-- Issue Info Card -->
      <div class="bg-warning text-dark rounded-1 p-4 p-md-5 mb-5 shadow-lg">
        <div class="row align-items-center g-4">
          <!-- Cover Image -->
          <div class="col-12 col-md-3 text-center text-md-start">
            <img
              src="<?= base_url(!empty($first['issue_image']) ? 'uploads/issues/' . $first['issue_image'] : 'assets/images/no-image.png') ?>"
              alt="Cover" class="rounded shadow-sm img-fluid"
              style="max-width: 140px; max-height: 180px; object-fit: cover;">
          </div>

          <!-- Text Info -->
          <div class="col-12 col-md-9">
            <h5 class="mb-2"><?= date('F, Y', strtotime($first['published_date'])) ?> (Special Issue)</h5>
            <h4 class="fw-bold mb-3">
              Volume: <?= esc($first['volume_no']) ?>, Issue: <?= esc($first['issue_no']) ?>
            </h4>
            <p class="mb-3 fs-6">
              📅 Published on:
              <strong><?= date('d M Y', strtotime($first['published_date'])) ?></strong>
            </p>

            <?php if (!empty($first['pdf_file'])): ?>
              <a href="<?= base_url('uploads/articles/' . $first['pdf_file']) ?>" target="_blank"
                class="btn btn-dark btn-sm shadow-sm">
                <i class="bi bi-file-earmark-pdf me-1"></i> View Full Issue PDF
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Articles in this Special Issue -->
      <h4 class="mb-4">Articles in Special Issue</h4>
      <?php foreach ($articlesGroup as $article): ?>
        <div class="card mb-5 border-0 shadow-sm rounded-1 p-4">
          <div class="row g-4 align-items-center">
            <div class="col-md-9">
              <div class="mb-3">
                <span class="badge bg-dark me-2">
                  <?= date('j M, Y', strtotime($article['published_date'])) ?>
                </span>
                <span class="badge bg-secondary">Review Article</span>
              </div>

              <h5 class="fw-bold mb-3"><?= esc($article['title']) ?></h5>
              <p class="text-muted mb-2"><strong>Authors:</strong> <?= esc($article['authors']) ?></p>

              <p class="mb-3 small">
                <strong>DOI:</strong>
                <a href="https://doi.org/<?= esc($article['doi']) ?>" target="_blank">
                  <?= esc($article['doi']) ?>
                </a> |
                <strong>Pages:</strong> <?= esc($article['pages']) ?>
              </p>

              <div class="d-flex flex-wrap gap-2 mt-4">
                <a href="<?= base_url('article/' . $article['id']) ?>" class="btn btn-outline-primary btn-sm">
                  <i class="bi bi-file-earmark-text me-1"></i> Abstract
                </a>
                <a href="<?= base_url('article/' . $article['id']) ?>?view=full" class="btn btn-outline-primary btn-sm">
                  <i class="bi bi-file-earmark-richtext me-1"></i> Full Text
                </a>
                <?php if (!empty($article['pdf_file'])): ?>
                  <a href="<?= base_url('uploads/articles/' . $article['pdf_file']) ?>" target="_blank"
                    class="btn btn-outline-dark btn-sm">
                    <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                  </a>
                <?php endif; ?>
              </div>
            </div>

            <div class="col-md-3 text-end">
              <img
                src="<?= base_url(!empty($article['image']) ? 'uploads/images/' . $article['image'] : 'assets/images/no-image.png') ?>"
                class="img-fluid rounded shadow-sm" alt="Article Image" style="max-height: 160px; object-fit: cover;">
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="text-muted">No special issues found.</p>
  <?php endif; ?>
</div>
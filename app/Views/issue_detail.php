<div class="container py-5">
    <h2 class="mb-5 fw-bold">Issue Details</h2>

    <!-- Issue Info Card -->
    <div class="bg-primary text-white rounded-1 p-5 mb-5 shadow-lg">
        <div class="d-flex align-items-start gap-4">
            <img src="<?= base_url(!empty($issue['issue_image']) ? 'uploads/issues/' . $issue['issue_image'] : 'assets/images/no-image.png') ?>"
                alt="Cover" class="rounded shadow-sm" style="max-width: 140px; max-height: 180px; object-fit: cover;">
            <div>
                <h5 class="mb-2"><?= date('F, Y', strtotime($issue['published_date'])) ?></h5>
                <h4 class="fw-bold mb-3">Volume: <?= esc($issue['volume_no']) ?>, Issue: <?= esc($issue['issue_no']) ?>
                </h4>
                <p class="mb-3 fs-6">📅 Published on:
                    <strong><?= date('d M Y', strtotime($issue['published_date'])) ?></strong>
                </p>

                <?php if (!empty($issue['pdf_file'])): ?>
                    <a href="<?= base_url('uploads/issues/' . $issue['pdf_file']) ?>" target="_blank"
                        class="btn btn-light btn-sm shadow-sm">
                        <i class="bi bi-file-earmark-pdf me-1"></i> View Full Issue PDF
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Article List -->
    <h4 class="mb-4">Articles in this Issue</h4>

    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <div class="card mb-5 border-0 shadow-sm rounded-1 p-4">
                <div class="row g-4 align-items-center">
                    <div class="col-md-9">
                        <div class="mb-3">
                            <span
                                class="badge bg-info text-dark me-2"><?= date('j M, Y', strtotime($article['published_date'])) ?></span>
                            <span class="badge bg-secondary">Review Article</span>
                        </div>

                        <h5 class="fw-bold mb-3"><?= esc($article['title']) ?></h5>
                        <p class="text-muted mb-2"><strong>Authors:</strong> <?= esc($article['authors']) ?></p>

                        <p class="mb-3 small">
                            <strong>DOI:</strong>
                            <a href="https://doi.org/<?= esc($article['doi']) ?>"
                                target="_blank"><?= esc($article['doi']) ?></a>
                            |
                            <strong>Pages:</strong> <?= esc($article['pages']) ?>
                        </p>

                        <div class="d-flex flex-wrap gap-2 mt-5">
                            <a href="<?= base_url('article/' . $article['id']) ?>" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-file-earmark-text me-1"></i> Abstract
                            </a>
                            <a href="<?= base_url('article/' . $article['id']) ?>?view=full"
                                class="btn btn-outline-primary btn-sm">
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
                        <img src="<?= base_url(!empty($article['image']) ? 'uploads/images/' . $article['image'] : 'assets/images/no-image.png') ?>"
                            class="img-fluid rounded shadow-sm" alt="Article Image"
                            style="max-height: 160px; object-fit: cover;">
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted">No articles found for this issue.</p>
    <?php endif; ?>
</div>
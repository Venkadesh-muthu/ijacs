<main class="container py-5">
    <!-- Title & Metadata -->
    <div class="mb-4">
        <h2 class="fw-bold text-dark"><?= esc($article['title']) ?></h2>
        <p class="text-muted mb-1"><?= esc($article['authors']) ?></p>
        <p class="mb-1">
            <strong>DOI:</strong>
            <a href="https://doi.org/<?= esc($article['doi']) ?>" target="_blank" class="text-decoration-underline">
                <?= esc($article['doi']) ?>
            </a>
        </p>
        <p class="mb-0">
            <strong>Volume <?= esc($article['volume_no']) ?>, Issue <?= esc($article['issue_no']) ?> | Pages:
                <?= esc($article['pages']) ?></strong>
        </p>
    </div>

    <!-- Optional Image -->
    <?php if (!empty($article['image'])): ?>
        <div class="text-center mb-4">
            <img src="<?= base_url('uploads/images/' . $article['image']) ?>" class="img-fluid rounded shadow"
                style="max-height: 220px;" alt="Article Image">
        </div>
    <?php endif; ?>

    <!-- Tabs -->
    <ul class="nav nav-pills mb-4 border-bottom pb-2" id="articleTabs" role="tablist">
        <li class="nav-item me-2">
            <button class="nav-link active" id="abstract-tab" data-bs-toggle="pill" data-bs-target="#abstract"
                type="button" role="tab">Abstract</button>
        </li>
        <li class="nav-item me-2">
            <button class="nav-link" id="references-tab" data-bs-toggle="pill" data-bs-target="#references"
                type="button" role="tab">References</button>
        </li>
        <!-- <li class="nav-item">
            <button class="nav-link" id="fulltext-tab" data-bs-toggle="pill" data-bs-target="#fulltext" type="button"
                role="tab">Full Text</button>
        </li> -->
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Abstract Tab -->
        <div class="tab-pane fade show active" id="abstract" role="tabpanel">
            <div class="bg-light p-4 rounded shadow-sm">
                <h5 class="text-primary mb-3">Abstract</h5>
                <p><?= nl2br(esc($article['abstract'])) ?></p>
            </div>

            <div class="mt-4">
                <h6 class="text-primary">Keywords</h6>
                <?php
                $keywords = explode(',', $article['keywords']);
                foreach ($keywords as $kw): ?>
                    <span class="badge bg-primary text-light me-1 mb-1"><?= esc(trim($kw)) ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- References Tab -->
        <div class="tab-pane fade" id="references" role="tabpanel">
            <div class="mt-4">
                <h5 class="text-primary">References</h5>
                <ol class="ps-3">
                    <?php if (!empty($references)): ?>
                        <?php foreach ($references as $ref): ?>
                            <li class="mb-3">
                                <?= esc($ref['authors']) ?>.
                                <strong><?= esc($ref['title']) ?></strong>.
                                <?= esc($ref['source']) ?>
                                <?php if (!empty($ref['volume'])): ?> <strong><?= esc($ref['volume']) ?></strong><?php endif; ?>
                                <?php if (!empty($ref['issue'])): ?> (<?= esc($ref['issue']) ?>)<?php endif; ?>
                                <?php if (!empty($ref['pages'])): ?>: <?= esc($ref['pages']) ?><?php endif; ?>,
                                <?= esc($ref['year']) ?>.
                                <?php if (!empty($ref['doi'])): ?>
                                    <br>
                                    <a href="https://doi.org/<?= esc($ref['doi']) ?>" target="_blank"
                                        class="text-decoration-underline small text-secondary">
                                        https://doi.org/<?= esc($ref['doi']) ?>
                                    </a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No references available for this article.</p>
                    <?php endif; ?>
                </ol>
            </div>
        </div>

        <!-- Full Text Tab -->
        <!-- <div class="tab-pane fade" id="fulltext" role="tabpanel">
            <div class="mt-4">
                <h5 class="text-primary">Full Text</h5>
                <p class="fst-italic text-muted">[Demo placeholder] Full text content will appear here...</p>
            </div>
        </div> -->
    </div>

    <!-- Citation -->
    <div class="mt-5 border-top pt-3">
        <h6 class="fw-bold">Citation</h6>
        <p class="small">
            <?= esc($article['authors']) ?>. <?= esc($article['title']) ?>.
            <i>J Appl Pharm Sci</i>. <?= date('Y', strtotime($article['published_date'])) ?>;
            <?= esc($article['volume_no']) ?>(<?= esc($article['issue_no']) ?>):<?= esc($article['pages']) ?>.
            <a href="https://doi.org/<?= esc($article['doi']) ?>" target="_blank">
                https://doi.org/<?= esc($article['doi']) ?>
            </a>
        </p>
    </div>
</main>
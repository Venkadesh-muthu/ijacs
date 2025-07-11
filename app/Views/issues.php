<style>
    body {
        overflow-y: scroll;
    }

    .accordion-collapse.collapse {
        transition: height 0.3s ease;
    }
</style>

<div class="container py-5">
    <h2 class="mb-4 fw-bold">Archives</h2>

    <div class="accordion" id="archivesDropdown">
        <?php foreach ($volumes as $index => $volume): ?>
            <div class="accordion-item border rounded mb-2 shadow-sm">
                <h2 class="accordion-header" id="heading<?= $index ?>">
                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
                        📚 <?= esc($volume['year']) ?> — Volume <?= esc($volume['volume_no']) ?>
                    </button>
                </h2>
                <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>">
                    <div class="accordion-body">
                        <ul class="list-unstyled mb-0">
                            <?php foreach ($volume['issues'] as $issue): ?>
                                <li class="mb-2">
                                    <i class="bi bi-journal-text me-2 text-secondary"></i>
                                    <a href="<?= base_url('issue/' . $issue['id']) ?>"
                                        class="text-primary fw-semibold text-decoration-none">
                                        Volume <?= esc($volume['volume_no']) ?>, Issue <?= esc($issue['issue_no']) ?> —
                                        <?= date('F Y', strtotime($issue['published_date'])) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
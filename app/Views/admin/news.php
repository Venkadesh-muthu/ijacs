<main class="main-content">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">All News & Events</h2>
            <a href="<?= base_url('admin/news/add') ?>" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Add News / Event
            </a>
        </div>

        <!-- FLASH MESSAGES -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success') ?>
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error') ?>
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Link</th>
                                <th>Attachment</th>
                                <th>Deadline</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($news)):

                                $currentPage = $pager->getCurrentPage();
                                $perPage = $pager->getPerPage();
                                $i = ($currentPage - 1) * $perPage + 1;

                                foreach ($news as $item): ?>
                                    <tr>
                                        <td class="text-center"><?= $i++ ?></td>

                                        <td class="text-center">
                                            <span class="badge bg-<?= $item['type'] === 'event' ? 'info' : 'primary' ?>">
                                                <?= ucfirst($item['type']) ?>
                                            </span>
                                        </td>

                                        <td><?= esc($item['title']) ?></td>

                                        <td><?= esc(word_limiter($item['message'], 12)) ?></td>

                                        <td class="text-center">
                                            <?php if (!empty($item['link'])): ?>
                                                <a href="<?= esc($item['link']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-box-arrow-up-right"></i>
                                                </a>
                                            <?php else: ?>
                                                —
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <?php if (!empty($item['attachment'])): ?>
                                                <a href="<?= base_url('uploads/news/' . $item['attachment']) ?>"
                                                   target="_blank" class="btn btn-sm btn-outline-success">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                            <?php else: ?>
                                                —
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <?= $item['deadline'] ? date('d M Y', strtotime($item['deadline'])) : '-' ?>
                                        </td>

                                        <td class="text-center">
                                            <a href="<?= base_url('admin/news/edit/' . $item['id']) ?>"
                                               class="btn btn-sm btn-outline-primary me-1">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <a href="<?= base_url('admin/news/delete/' . $item['id']) ?>"
                                               class="btn btn-sm btn-outline-danger"
                                               onclick="return confirm('Are you sure you want to delete this?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No records found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- PAGINATION -->
        <div class="mt-3 d-flex justify-content-end">
            <?= $pager->links() ?>
        </div>

    </div>
</main>

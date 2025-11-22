<main class="main-content">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">All News & Events</h2>
            <a href="<?= base_url('admin/news/add') ?>" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Add News
            </a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0 align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Message</th>
                                <th>Volume</th>
                                <th>Issue</th>
                                <th>Year</th>
                                <th>Deadline</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if ($news):
                                $currentPage = $pager->getCurrentPage('default');
                                $perPage = $pager->getPerPage('default');
                                $start = ($currentPage - 1) * $perPage + 1;

                                $i = $start;
                                foreach ($news as $item): ?>
                                    <tr class="text-center">
                                        <td><?= $i++ ?></td>
                                        <td><?= esc($item['message']) ?></td>
                                        <td><?= esc($item['volume']) ?></td>
                                        <td><?= esc($item['issue']) ?></td>
                                        <td><?= esc($item['year']) ?></td>
                                        <td><?= date('d M Y', strtotime($item['deadline'])) ?></td>

                                        <td>
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

                                <?php endforeach;
                            else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No news found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</main>

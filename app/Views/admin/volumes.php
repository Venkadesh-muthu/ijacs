<main class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">All Volumes</h2>
            <a href="<?= base_url('admin/volumes/add') ?>" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Add Volume
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
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Year</th>
                                <th>Volume No</th>
                                <th>Created At</th>
                                <th colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($volumes):
                                $i = 1;
                                foreach ($volumes as $volume): ?>
                                    <tr class="text-center">
                                        <td><?= $i++ ?></td>
                                        <td><?= esc($volume['year']) ?></td>
                                        <td><?= esc($volume['volume_no']) ?></td>
                                        <td><?= date('d M Y', strtotime($volume['created_at'])) ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/volumes/edit/' . $volume['id']) ?>"
                                                class="btn btn-sm btn-outline-primary me-1">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="<?= base_url('admin/volumes/delete/' . $volume['id']) ?>"
                                                class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">No volumes found.</td>
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
<main class="main-content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">All References</h2>
            <a href="<?= base_url('admin/references/add') ?>" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Add Reference
            </a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <table class="table table-bordered">
            <thead>
                <tr class="table-light">
                    <th>S.no</th>
                    <th>Reference No</th>
                    <th>Authors</th>
                    <th>Title</th>
                    <th>Source</th>
                    <th>Year</th>
                    <th>Type</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($references)): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">No references found.</td>
                    </tr>
                <?php else: ?>
                    <?php
                    $i = 0;
                    foreach ($references as $ref): ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= esc($ref['ref_no']) ?></td>
                            <td><?= esc($ref['authors']) ?></td>
                            <td><?= esc($ref['title']) ?></td>
                            <td><?= esc($ref['source']) ?></td>
                            <td><?= esc($ref['year']) ?></td>
                            <td><?= ucfirst($ref['type']) ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/references/edit/' . $ref['id']) ?>"
                                    class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/references/delete/' . $ref['id']) ?>"
                                    onclick="return confirm('Are you sure you want to delete this reference?');"
                                    class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif; ?>
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="mt-4 ps-2">
            <?= $pager->links('default', 'bootstrap') ?>
        </div>
    </div>
</main>
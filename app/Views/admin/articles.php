<?php // admin/articles.php ?>
<main class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">All Articles</h2>
            <a href="<?= base_url('admin/articles/add') ?>" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i>Add Article
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
                                <th>Title</th>
                                <th>Authors</th>
                                <th>Issue</th>
                                <th>DOI</th>
                                <th>Pages</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($articles)):
                                $i = 1;
                                foreach ($articles as $article): ?>
                                    <tr class="text-center">
                                        <td><?= $i++ ?></td>
                                        <td><?= esc($article['title']) ?></td>
                                        <td><?= esc($article['authors']) ?></td>
                                        <td><?= esc($article['issue_id']) ?></td>
                                        <td><?= esc($article['doi']) ?></td>
                                        <td><?= esc($article['pages']) ?></td>
                                        <td class="text-end">
                                            <a href="<?= base_url('admin/articles/edit/' . $article['id']) ?>"
                                                class="btn btn-sm btn-outline-primary">Edit</a>
                                            <a href="<?= base_url('admin/articles/delete/' . $article['id']) ?>"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No articles found.</td>
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
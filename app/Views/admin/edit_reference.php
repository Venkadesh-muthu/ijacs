<main class="main-content">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Edit Reference</h2>
            <a href="<?= base_url('admin/references') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to References
            </a>
        </div>

        <?php if (isset($validation)): ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <form action="<?= base_url('admin/references/edit/' . $reference['id']) ?>" method="post"
            class="card shadow-sm p-4">
            <?= csrf_field() ?>

            <!-- Reference No & Authors -->
            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="ref_no" class="form-label fw-semibold">Reference No *</label>
                    <input type="number" name="ref_no" id="ref_no" class="form-control"
                        value="<?= old('ref_no', $reference['ref_no']) ?>">
                </div>
                <div class="col-md-10">
                    <label for="authors" class="form-label fw-semibold">Authors *</label>
                    <input type="text" name="authors" id="authors" class="form-control"
                        value="<?= old('authors', $reference['authors']) ?>"
                        placeholder="e.g., Van Wyk BE, Campbell BM">
                </div>
            </div>

            <!-- Article dropdown -->
            <div class="mb-3">
                <label for="article_id" class="form-label fw-semibold">Select Article (optional)</label>
                <select name="article_id" id="article_id" class="form-select">
                    <option value="">-- Select an Article --</option>
                    <?php foreach ($articles as $article): ?>
                        <option value="<?= $article['id'] ?>" <?= old('article_id', $reference['article_id']) == $article['id'] ? 'selected' : '' ?>>
                            <?= esc($article['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Title & Source -->
            <div class="mb-3">
                <label for="title" class="form-label fw-semibold">Title *</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="<?= old('title', $reference['title']) ?>">
            </div>
            <div class="mb-3">
                <label for="source" class="form-label fw-semibold">Source *</label>
                <input type="text" name="source" id="source" class="form-control"
                    value="<?= old('source', $reference['source']) ?>">
            </div>

            <!-- Publisher Info -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="publisher" class="form-label fw-semibold">Publisher</label>
                    <input type="text" name="publisher" id="publisher" class="form-control"
                        value="<?= old('publisher', $reference['publisher']) ?>">
                </div>
                <div class="col-md-3">
                    <label for="publisher_loc" class="form-label fw-semibold">Publisher Location</label>
                    <input type="text" name="publisher_loc" id="publisher_loc" class="form-control"
                        value="<?= old('publisher_loc', $reference['publisher_loc']) ?>">
                </div>
                <div class="col-md-2">
                    <label for="year" class="form-label fw-semibold">Year *</label>
                    <input type="number" name="year" id="year" class="form-control"
                        value="<?= old('year', $reference['year']) ?>">
                </div>
                <div class="col-md-2">
                    <label for="volume" class="form-label fw-semibold">Volume</label>
                    <input type="text" name="volume" id="volume" class="form-control"
                        value="<?= old('volume', $reference['volume']) ?>">
                </div>
                <div class="col-md-2">
                    <label for="issue" class="form-label fw-semibold">Issue</label>
                    <input type="text" name="issue" id="issue" class="form-control"
                        value="<?= old('issue', $reference['issue']) ?>">
                </div>
            </div>

            <!-- Pages & DOI -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="pages" class="form-label fw-semibold">Pages</label>
                    <input type="text" name="pages" id="pages" class="form-control"
                        value="<?= old('pages', $reference['pages']) ?>" placeholder="e.g., 123–129">
                </div>
                <div class="col-md-6">
                    <label for="doi" class="form-label fw-semibold">DOI</label>
                    <input type="text" name="doi" id="doi" class="form-control"
                        value="<?= old('doi', $reference['doi']) ?>" placeholder="e.g., https://doi.org/10.xxxx">
                </div>
            </div>

            <!-- Type -->
            <div class="mb-3">
                <label for="type" class="form-label fw-semibold">Type *</label>
                <select name="type" id="type" class="form-select">
                    <option value="">-- Select Type --</option>
                    <option value="journal" <?= old('type', $reference['type']) == 'journal' ? 'selected' : '' ?>>Journal
                    </option>
                    <option value="book" <?= old('type', $reference['type']) == 'book' ? 'selected' : '' ?>>Book</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Update Reference
                </button>
            </div>
        </form>
    </div>
</main>
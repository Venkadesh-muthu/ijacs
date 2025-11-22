<style>
    /* Sidebar link style */
.nav-link {
    padding: 10px 15px;
    border-radius: 6px;
    transition: 0.2s ease;
    font-weight: 500;
}

/* Hover effect */
.nav-link:hover {
    background: #f1f5ff;
    color: #0d6efd !important;
}

/* Active menu style */
.nav-link.active {
    background: #0d6efd !important;
    color: #fff !important;
    font-weight: 600 !important;
    box-shadow: 0 2px 6px rgba(13, 110, 253, 0.3);
}

</style>
<?php $uri = service('uri'); ?>
<nav id="sidebar" class="offcanvas offcanvas-start d-lg-block bg-white border-end shadow-sm"
    tabindex="-1" aria-labelledby="sidebarLabel" data-bs-scroll="true" data-bs-backdrop="false"
    style="width: 250px; z-index: 1045;">

    <div class="offcanvas-header d-lg-none">
        <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column p-0">
        <div class="text-center border-bottom">
            <img src="<?= base_url('uploads/logos/logo.png') ?>" class="rounded-circle mb-2" width="80"
                height="80" alt="Admin">
            <h5 class="mb-1"><?= session()->get('adminUser')['username'] ?? 'Admin' ?></h5>
        </div>

        <ul class="nav flex-column px-3 pt-3">

            <!-- Dashboard -->
            <li class="nav-item mb-2">
                <a href="<?= base_url('admin/dashboard') ?>"
                    class="nav-link <?= $uri->getSegment(2) === 'dashboard' ? 'active' : '' ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>

            <!-- Volumes -->
            <li class="nav-item mb-2">
                <a href="<?= base_url('admin/volumes') ?>"
                    class="nav-link <?= $uri->getSegment(2) === 'volumes' ? 'active' : '' ?>">
                    <i class="bi bi-collection me-2"></i> Volumes
                </a>
            </li>

            <!-- Issues -->
            <li class="nav-item mb-2">
                <a href="<?= base_url('admin/issues') ?>"
                    class="nav-link <?= $uri->getSegment(2) === 'issues' ? 'active' : '' ?>">
                    <i class="bi bi-journal-text me-2"></i> Issues
                </a>
            </li>

            <!-- Articles -->
            <li class="nav-item mb-2">
                <a href="<?= base_url('admin/articles') ?>"
                    class="nav-link <?= $uri->getSegment(2) === 'articles' ? 'active' : '' ?>">
                    <i class="bi bi-file-earmark-text me-2"></i> Articles
                </a>
            </li>

            <!-- References -->
            <li class="nav-item mb-2">
                <a href="<?= base_url('admin/references') ?>"
                    class="nav-link <?= $uri->getSegment(2) === 'references' ? 'active' : '' ?>">
                    <i class="bi bi-bookmarks me-2"></i> References
                </a>
            </li>

            <!-- Upload Article XML -->
            <li class="nav-item mb-2">
                <a href="<?= base_url('admin/upload-article-xml') ?>"
                class="nav-link <?= uri_string() === 'admin/upload-article-xml' ? 'active' : '' ?>">
                    <i class="bi bi-upload me-2"></i> Upload Article XML
                </a>
            </li>

            <!-- News -->
            <li class="nav-item mb-2">
                <a href="<?= base_url('admin/news') ?>"
                    class="nav-link <?= $uri->getSegment(2) === 'news' ? 'active' : '' ?>">
                    <i class="bi bi-megaphone me-2"></i> News & Events
                </a>
            </li>

            <!-- Logout -->
            <li class="nav-item mt-auto mb-3">
                <a href="<?= base_url('admin/logout') ?>" class="nav-link text-dark">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </li>

        </ul>


    </div>
</nav>

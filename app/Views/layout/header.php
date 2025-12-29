<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>IJACS | Indian Journal of Advances in Chemical Science</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* Force icon + text in same line */
        .navbar-nav .nav-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        /* Adjust spacing on laptops */
        @media (max-width: 1399px) {
            .navbar-nav {
                gap: 0.5rem !important;
            }

            .navbar-nav .nav-link {
                font-size: 14px;
                padding: 8px 10px;
            }
        }
    </style>
</head>

<body>

<!-- Header / Navigation -->
<header class="sticky-top bg-white border-bottom shadow-sm" style="z-index: 998;">
    <nav class="navbar navbar-expand-xl navbar-light bg-white">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand fw-bold text-primary fs-2 d-flex align-items-center" href="<?= base_url() ?>">
                <i class="bi bi-journal-bookmark-fill me-2"></i> IJACS
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler border-0 shadow-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto fw-semibold gap-xl-3">

                    <li class="nav-item">
                        <a class="nav-link px-3 py-2" href="<?= base_url() ?>">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-3 py-2" href="<?= base_url() ?>about">
                            <i class="bi bi-info-circle"></i> About
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-3 py-2" href="<?= base_url() ?>author_guidelines">
                            <i class="bi bi-pen"></i> Guidelines
                        </a>
                    </li>

                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-3 py-2" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-journals"></i> Issues
                        </a>
                        <ul class="dropdown-menu shadow-sm border-0">
                            <li><a class="dropdown-item" href="<?= base_url('current-issue') ?>">Current Issue</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('issues') ?>">Archives</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('special-issues') ?>">Special Issues</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-3 py-2" href="<?= base_url() ?>aimscope">
                            <i class="bi bi-bullseye"></i> Aim & Scope
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-3 py-2" href="<?= base_url() ?>editorial-board">
                            <i class="bi bi-people"></i> Editorial Board
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-3 py-2" href="<?= base_url() ?>special-issues">
                            <i class="bi bi-stars"></i> Special Issues
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-3 py-2" href="<?= base_url() ?>contact">
                            <i class="bi bi-envelope"></i> Contact Us
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>


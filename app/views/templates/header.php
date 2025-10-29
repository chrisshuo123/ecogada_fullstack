<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/css/navbar2.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/css/style.css">
    <title>Halaman <?= $data['judul'] ?></title>
</head>
<body>
    <!-- Navbar -->
    <header class="fixed-navbar">
        <nav class="navbar navbar-expand-lg bg-custom"> <!-- Recently .navbar-light .bg-light -->
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <img src="<?= BASEURL; ?>/img/logo_ecogada.png" alt="Ecogada Logo" style="width: 80px;">
            </a>
            <button class="navbar-toggler" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="background-color: rgba(59, 205, 245, 1);">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Home -->
                    <li class="nav-item no-dropdown">
                    <a class="nav-link active" aria-current="page" href="<?= BASEURL; ?>">Home</a>
                    </li>
                    <!-- User Merchant -->
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userMerchantDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        User Merchant
                    </a>
                    <!-- Sub-Menu User Merchant -->
                    <ul class="dropdown-menu" aria-labelledby="userMerchantDropdown">
                        <li><a class="dropdown-item" href="<?= BASEURL; ?>/user/index">User List</a></li>
                        <li><a class="dropdown-item" href="<?= BASEURL; ?>/user/register">&nbsp;Register</a></li>
                        <li><a class="dropdown-item" href="<?= BASEURL; ?>/user/login">&nbsp;Login</a></li>
                    </ul>
                    </li>
                    <!-- Contoh #1 -->
                    <li class="nav-item dropdown">      <!-- id aboutDropdown changed to thirdDropdown -->
                        <a class="nav-link dropdown-toggle" href="#" id="contohDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Contoh #1
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="contohDropdown">
                            <li><a class="dropdown-item" href="#">Contoh #1-1</a></li>
                            <li><a class="dropdown-item" href="#">&nbsp;Contoh #1-2</a></li>
                            <li><a class="dropdown-item" href="#">&nbsp;Contoh #1-3</a></li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#" id="contohDropdownSubmenu">&nbsp;Contoh #1-4</a>
                                <ul class="dropdown-menu" aria-labelledby="contohDropdownSubmenu">
                                    <li><a class="dropdown-item active" href="#">&nbsp;Contoh #1-4</a></li>
                                    <li><a class="dropdown-item" href="#">&nbsp;&nbsp;Contoh #1-4-1</a></li>
                                    <li><a class="dropdown-item" href="#">&nbsp;&nbsp;Contoh #1-4-2</a></li>
                                    <li><a class="dropdown-item" href="#">&nbsp;&nbsp;Contoh #1-4-3</a></li>
                                    <li><a class="dropdown-item" href="#">&nbsp;&nbsp;Contoh #1-4-4</a></li>
                                    <li><a class="dropdown-item" href="#">&nbsp;&nbsp;Contoh #1-4-5</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        </nav>
    </header>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/css/navbar.css">
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
                    <li class="nav-item no-dropdown">
                    <a class="nav-link active" aria-current="page" href="<?= BASEURL; ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="newsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        User Merchant
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="newsDropdown">
                        <li><a class="dropdown-item" href="<?= BASEURL; ?>/user/index">User List</a></li>
                        <li><a class="dropdown-item" href="<?= BASEURL; ?>/user/register">&nbsp;Register</a></li>
                        <li><a class="dropdown-item" href="<?= BASEURL; ?>/user/login">&nbsp;Login</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </div>
        </nav>
    </header>
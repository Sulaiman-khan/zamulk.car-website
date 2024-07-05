<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= (isset($title)) ? ((strtolower($title) == strtolower($this->options->key->web_name)) ? $this->options->key->web_name : "{$title} - {$this->options->key->web_name}") : $this->options->key->web_name ?></title>
    <link rel="stylesheet" href="<?= base_url('public/admin/css/styles.css') ?>">
    <link rel="stylesheet" href="<?= assets_url('vendor/sweetalert2/dist/sweetalert2.min.css') ?>">
    <script src="<?= assets_url('vendor/sweetalert2/dist/sweetalert2.all.js') ?>"></script>
    <script src="<?= assets_url('js/jquery-1.11.3.min.js') ?>"></script>
    <script src="<?= assets_url('js/basic.js') ?>"></script>
    <script src="<?= assets_url('js/font-awesome-6.0.0.min.js') ?>"></script>
    <?= get_custom_header() ?>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?= base_url() ?>" target="_blank"><img class="img-fluid" style="max-height:80px" src="<?= images_url("main/{$this->options->key->secondary_logo}") ?>" alt="<?= ($this->options->key->web_name) ?>"></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?= base_url("{$this->uri->segment(1)}/profile/update") ?>">Settings</a></li>
                    <li><a class="dropdown-item" href="<?= base_url("{$this->uri->segment(1)}/profile/otp") ?>">OTP</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?= base_url("{$this->uri->segment(1)}/logout") ?>">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
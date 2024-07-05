<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= (isset($title)) ? ((strtolower($title) == strtolower($this->options->key->web_name)) ? $this->options->key->web_name : "{$title} - {$this->options->key->web_name}") : $this->options->key->web_name ?></title>
    <link rel="stylesheet" href="<?= assets_url('sass/main.css') ?>">
    <link rel="stylesheet" href="<?= assets_url('bootstrap/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= assets_url('font/all.css') ?>">
    <link rel="stylesheet" href="<?= assets_url('font/flaticon.css') ?>">
    <link rel="stylesheet" href="<?= assets_url('vendor/sweetalert2/dist/sweetalert2.min.css') ?>">
    <script src="<?= assets_url('vendor/sweetalert2/dist/sweetalert2.all.js') ?>"></script>
    <script src="<?= assets_url('js/jquery-1.11.3.min.js') ?>"></script>
    <script src="<?= assets_url('js/basic.js') ?>"></script>
    <?= get_custom_header() ?>
</head>


<body class="text-center">

    <style>
        body {
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <main class="form-signin">
        <form action="<?= current_url() ?>" id="login" method="POST">
            <img class="mb-4" src="<?= images_url("main/{$this->options->key->primary_logo}") ?>" alt="<?= $this->options->key->web_name ?>" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted"><?= $this->options->key->web_name ?> © <?= date("Y") ?>. All Rights Reserved</p>
        </form>
    </main>
    
    <script src="<?= assets_url('bootstrap/js/bootstrap.min.js') ?>"></script>
    <?= get_custom_footer() ?>
    <script src="<?= assets_url('js/script.js') ?>"></script>

    <?php if ($this->session->userdata('error') || $this->session->userdata('message')) : ?>
        <?php

        if ($message = ($this->session->userdata('error')))
            set_custom_footer('
        <script>
            errorMessage("' . $message . '")
        </script>        
        ');
        elseif ($message = ($this->session->userdata('message')))
            set_custom_footer('
        <script>
            successMessage("' . $message . '")
        </script>        
        ');

        ?>
    <?php endif ?>

</body>

</html>
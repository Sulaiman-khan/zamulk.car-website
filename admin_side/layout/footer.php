<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted"><?= $this->options->key->web_name ?> © <?= date("Y") ?>. All Rights Reserved</div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="<?= assets_url('bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<?= get_custom_footer() ?>
<script src="<?= assets_url('js/script.js') ?>"></script>

<?php if ($this->session->userdata('error') || $this->session->userdata('message')) : ?>
    <?php

    if ($message = ($this->session->userdata('error')))
        echo '<script>
                    errorMessage("' . $message . '")
                </script>';
    elseif ($message = ($this->session->userdata('message')))
        echo '<script>
                    successMessage("' . $message . '")
                </script> '
    ?>
<?php endif ?>
<script>
    window.addEventListener('DOMContentLoaded', event => {

        // Toggle the side navigation
        const sidebarToggle = document.body.querySelector('#sidebarToggle');
        if (sidebarToggle) {
            // Uncomment Below to persist sidebar toggle between refreshes
            // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            //     document.body.classList.toggle('sb-sidenav-toggled');
            // }
            sidebarToggle.addEventListener('click', event => {
                event.preventDefault();
                document.body.classList.toggle('sb-sidenav-toggled');
                localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
            });
        }

    });
</script>

</body>

</html>
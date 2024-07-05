<div class="container-fluid px-4">
    <h1 class="mt-4"><?= (isset($title)) ? $title : "" ?></h1>
    <?php if (isset($subtitle)) : ?>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?= $subtitle ?></li>
        </ol>
    <?php endif ?>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <?php if (empty($otp_secret_code)) : ?>
                        <div class="alert alert-danger" role="alert">
                            OTP is not activated! To activate please download <a href="https://play.google.com/store/apps/details?id=com.authy.authy" target="_blank">Authy</a> or <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank">Google Authenticator</a> form app/play store.<br>
                            And scan the below QR or try with to add Secret Code manaually, to get OTP.
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <img class="img-thumbnail" src="<?= $qrcode_url ?>" alt="<?= input_print($secret_code) ?>">
                            </div>
                            <div class="col-lg-8">
                                <form id="updateUserForm" method="POST">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-7">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="inputsecret_code" type="text" name="secret_code" value="<?= input_print($secret_code) ?>" required="required" readonly>
                                                        <label for="inputsecret_code">Secret Code</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="inputOTP" type="text" name="otp" placeholder="Enter OTP...!" required="required">
                                                        <label for="inputOTP">Enter OTP</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button class="btn btn-primary" type="button">Add OTP</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-success" role="alert">
                            OTP has been activated! You will be asked for OTP when try to login.
                        </div>
                        <table class="table table-light">
                            <tr>
                                <td>One time code is active on your account</td>
                                <td><?= date("d M, Y h:i A", strtotime($this->session->userdata('admin_otp_added_at'))) ?></td>
                                <td>

                                    <button type="button" class="btn btn-sm btn-danger deactive_btn" data-url="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/{$this->uri->segment(3)}/deactive") ?>">Remove OTP</button>
                                </td>
                            </tr>
                        </table>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>



<?= set_custom_footer("
<script>
    $('.deactive_btn').on('click', function() {

        Swal.fire({
            title: 'Are you sure?',
            text: `You want to deactivate OTP?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, deactivate it!'
        }).then((result) => {
            if (result.isConfirmed) {
                do_ajax($(this).attr('data-url'))
            }
        })
    });
</script>
")
?>
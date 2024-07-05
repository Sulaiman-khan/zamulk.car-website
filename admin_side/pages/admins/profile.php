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
                <div class="col-lg-6 mx-auto">
                    <form id="updateUserForm" method="POST">
                        <div class="row">
                            <div class="col-lg-6 text-end">
                                <label for="formUserFile" style="cursor: pointer;">
                                    <input class="form-control" type="file" name="image" id="formUserFile" style="display: none;">
                                    <img class="img-thumbnail" id="formUserImage" style="height: 60px;" src="<?= images_url("admins/" . image("public/images/admins/", $admin->image)) ?>" alt="<?= input_print($admin->first_name) ?>">
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputemail" type="text" name="email" value="<?= input_print($admin->email) ?>" placeholder="Enter user email...!" required="required" readonly>
                                    <label for="inputemail">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputfirst_name" type="text" name="first_name" value="<?= input_print($admin->first_name) ?>" placeholder="Enter first name...!" required="required">
                                            <label for="inputfirst_name">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputlast_name" type="text" name="last_name" value="<?= input_print($admin->last_name) ?>" placeholder="Enter last name...!" required="required">
                                            <label for="inputlast_name">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputaddress" type="text" name="address" value="<?= input_print($admin->address) ?>" placeholder="Enter user address...!" required="required">
                                    <label for="inputaddress">Address</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputcity" type="text" name="city" value="<?= input_print($admin->city) ?>" placeholder="Enter user city...!" required="required">
                                    <label for="inputcity">City</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputphone" type="text" name="phone" value="<?= input_print($admin->phone) ?>" placeholder="Enter user phone...!" required="required">
                                    <label for="inputphone">Phone</label>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-3 text-center">
                                <hr>
                                <span class="text-muted mb-3">To change password fill below</span>
                                <hr>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputphone" type="text" name="new_password" placeholder="Enter new password...!">
                                    <label for="inputphone">New Password</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputphone" type="text" name="confirm_new_password" placeholder="Enter new password again...!">
                                    <label for="inputphone">Confirm New Password</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-primary" type="button">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $("#inputStatusSelect").change(function() {
        do_ajax(`<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/admin_status/{$admin->id}/") ?>${$(this).val()}`)
    });

    $("#inputRoleSelect").change(function() {
        do_ajax(`<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/admin_role/{$admin->id}/") ?>${$(this).val()}`)
    });
</script>

<script>
    $("#formUserFile").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#formUserImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
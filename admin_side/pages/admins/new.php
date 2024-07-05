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
            </div>

            <div class="row">
                <form id="updateUserForm" method="POST">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3 mx-auto">
                                <div class="form-floating mb-3">
                                    <select id="inputStatusSelect" class="form-control" name="status">
                                        <option value="<?= strtolower('active') ?>" selected><?= ucwords('active') ?></option>
                                        <option value="<?= strtolower('suspended') ?>"><?= ucwords('suspended') ?></option>
                                    </select>
                                    <label for="inputStatusSelect">Status</label>
                                </div>
                            </div>
                            <div class="col-lg-3 mx-auto">
                                <div class="form-floating mb-3">
                                    <select id="inputRoleSelect" class="form-control" name="role_id">
                                        <option selected hidden disabled>Select a Role</option>
                                        <?php if ($admin_roles) : ?>
                                            <?php foreach ($admin_roles as $role) : ?>
                                                <option value="<?= $role->id ?>"><?= print_output($role->name) ?></option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                    <label for="inputRoleSelect">Role</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mx-auto">
                        <div class="text-center mb-3">
                            <span class="text-center btn btn-primary disabled">Admin Profile</span>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 text-end">
                                <label for="formUserFile" style="cursor: pointer;">
                                    <input class="form-control" type="file" name="image" id="formUserFile" style="display: none;">
                                    <img class="img-thumbnail" id="formUserImage" style="height: 60px;" src="<?= images_url("admins/" . image("public/images/admins/", 'no-image.png')) ?>" alt="new image">
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputemail" type="text" name="email" placeholder="Entry user email...!" required="required">
                                    <label for="inputemail">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputfirst_name" type="text" name="first_name" placeholder="Entry first name...!" required="required">
                                            <label for="inputfirst_name">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputlast_name" type="text" name="last_name" placeholder="Entry last name...!" required="required">
                                            <label for="inputlast_name">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputaddress" type="text" name="address" placeholder="Entry user address...!" required="required">
                                    <label for="inputaddress">Address</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputcity" type="text" name="city" placeholder="Entry user city...!" required="required">
                                    <label for="inputcity">City</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputphone" type="text" name="phone" placeholder="Entry user phone...!" required="required">
                                    <label for="inputphone">Phone</label>
                                </div>
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
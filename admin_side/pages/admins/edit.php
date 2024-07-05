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
                <div class="col-lg-3 mx-auto">
                    <?php
                    $status = ['pending verification' => 'warning', 'pending' => 'warning', 'active' => 'success', 'blocked' => 'danger', 'suspended' => 'info'];
                    ?>
                    <div class="form-floating mb-3">
                        <select id="inputStatusSelect" class="form-control text-white bg-<?= $status[$admin->status] ?>" name="status">
                            <option value="<?= strtolower('active') ?>" <?= ($admin->status == strtolower('active')) ? 'selected' : '' ?>><?= ucwords('active') ?></option>
                            <option value="<?= strtolower('suspended') ?>" <?= ($admin->status == strtolower('suspended')) ? 'selected' : '' ?>><?= ucwords('suspended') ?></option>
                        </select>
                        <label for="inputStatusSelect">Status</label>
                    </div>
                </div>
                <div class="col-lg-3 mx-auto">
                    <div class="form-floating mb-3">
                        <select id="inputRoleSelect" class="form-control" name="role_id">
                            <?php if ($admin_roles) : ?>
                                <?php foreach ($admin_roles as $role) : ?>
                                    <option value="<?= $role->id ?>" <?= ($role->id == $admin->role_id) ? 'selected' : '' ?>><?= print_output($role->name) ?></option>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
                        <label for="inputRoleSelect">Role</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="text-center mb-3">
                        <span class="text-center btn btn-primary disabled">Admin Profile</span>
                    </div>
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
                                    <input class="form-control" id="inputemail" type="text" name="email" value="<?= input_print($admin->email) ?>" placeholder="Entry user email...!" required="required" readonly>
                                    <label for="inputemail">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputfirst_name" type="text" name="first_name" value="<?= input_print($admin->first_name) ?>" placeholder="Entry first name...!" required="required">
                                            <label for="inputfirst_name">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputlast_name" type="text" name="last_name" value="<?= input_print($admin->last_name) ?>" placeholder="Entry last name...!" required="required">
                                            <label for="inputlast_name">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputaddress" type="text" name="address" value="<?= input_print($admin->address) ?>" placeholder="Entry user address...!" required="required">
                                    <label for="inputaddress">Address</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputcity" type="text" name="city" value="<?= input_print($admin->city) ?>" placeholder="Entry user city...!" required="required">
                                    <label for="inputcity">City</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputphone" type="text" name="phone" value="<?= input_print($admin->phone) ?>" placeholder="Entry user phone...!" required="required">
                                    <label for="inputphone">Phone</label>
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
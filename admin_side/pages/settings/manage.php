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
                    <form class="form-valide" action="#" method="post" id="update-form">
                        <?php if (!empty($this->options->key)) : ?>
                            <?php $query = (array)$this->options->key; ?>
                            <div class="row">
                                <?php foreach ($query as $key => $value) : ?>
                                    <?php if (in_array($key, ['web_name'])) : ?>
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="<?= $key ?>" value="<?= htmlentities($value); ?>">
                                                <label><?= ucwords(str_replace('_', ' ', $key)) ?>
                                                    <span class="text-danger">*</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php elseif (in_array($key, ['description', 'keywords'])) : ?>
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" name="<?= $key ?>"><?= htmlentities($value); ?></textarea>
                                                <label><?= ucwords(str_replace('_', ' ', $key)) ?>
                                                    <span class="text-danger">*</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php elseif (in_array($key, ['smtp_active'])) : ?>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <select id="inputRoleSelect" class="form-control" name="<?= $key ?>">
                                                    <option value="1" <?= ($value == 1) ? 'selected' : ''; ?>>Activate</option>
                                                    <option value="0" <?= ($value == 0) ? 'selected' : ''; ?>>Not Activate</option>
                                                </select>
                                                <label><?= ucwords(str_replace('_', ' ', $key)) ?>
                                                    <span class="text-danger">*</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php elseif (in_array($key, ['verify_every_order'])) : ?>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <select id="inputRoleSelect" class="form-control" name="<?= $key ?>">
                                                    <option value="1" <?= ($value == 1) ? 'selected' : ''; ?>>YES</option>
                                                    <option value="0" <?= ($value == 0) ? 'selected' : ''; ?>>NO</option>
                                                </select>
                                                <label><?= ucwords(str_replace('_', ' ', $key)) ?>
                                                    <span class="text-danger">*</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php elseif (!in_array($key, ['primary_logo', 'secondary_logo', 'transparent_logo', 'smtp_active'])) : ?>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="<?= $key ?>" value="<?= htmlentities($value); ?>">
                                                <label><?= ucwords(str_replace('_', ' ', $key)) ?>
                                                    <span class="text-danger">*</span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                <?php endforeach; ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php $i = 0;
                                        foreach ($query as $key => $value) : ?>
                                            <?php if (in_array($key, ['primary_logo', 'secondary_logo', 'transparent_logo'])) :  $i++; ?>
                                                <div class="row mb-3">
                                                    <div class="col-sm-6">
                                                        <span><?= ucwords(str_replace('_', ' ', $key)) ?></span>
                                                        <span class="text-danger mr-2">*</span>
                                                        <input class="form-control" type="file" name="<?= $key ?>" id="formFile-<?= $i ?>">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="formFile-<?= $i ?>" style="cursor: pointer;">
                                                            <img class="img-thumbnail <?= (in_array($key, ['secondary_logo', 'transparent_logo'])) ? 'bg-dark' : '' ?>" style="height: 60px;" id="formFileImage-<?= $i ?>" src="<?= images_url("main/" . image("public/images/main/", $value)) ?>" alt="<?= input_print($value) ?>">
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endif ?>
                                        <?php endforeach; ?>

                                        <?php if ($this->auth->admin_perm_auth('settings', 'edit')) : ?>
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="button" id="submitBtn" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    <?php $i = 0;
    foreach ($query as $key => $value) : ?>
        <?php if (in_array($key, ['primary_logo', 'secondary_logo', 'transparent_logo'])) : $i++; ?>
            $("#formFile-<?= $i ?>").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#formFileImage-<?= $i ?>').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        <?php endif ?>
    <?php endforeach; ?>
</script>
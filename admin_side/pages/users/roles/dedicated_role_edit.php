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
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <form id="updateForm" method="POST">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputrole_name" type="text" name="username" value="<?= input_print("{$user->first_name} {$user->last_name}") ?>" placeholder="Entry first name...!" disabled>
                                            <label for="inputrole_name">User full name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Name</th>
                                                    <th>View</th>
                                                    <th>Add</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($permissions)) : $i = 0; ?>
                                                    <?php foreach ($permissions as $permission) : ?>
                                                        <?php if ($role_permissions) : ?>
                                                            <?php foreach ($role_permissions as $role_permission) : ?>
                                                                <?php if ($permission->key == $role_permission->key) : ?>

                                                                    <?php if ($dedicated_role_permissions) : ?>
                                                                        <?php foreach ($dedicated_role_permissions as $dedicated_role_permission) : ?>
                                                                            <?php if ($role_permission->key == $dedicated_role_permission->key) : ?>

                                                                                <?php $perm_add = (($dedicated_role_permission->assign_perm_add == $dedicated_role_permission->perm_add) && ($role_permission->assign_perm_add == 1)) ? 'checked' : '' ?>
                                                                                <?php $perm_view = ($dedicated_role_permission->perm_view == $dedicated_role_permission->assign_perm_view && ($role_permission->assign_perm_view == 1)) ? 'checked' : '' ?>
                                                                                <?php $perm_edit = ($dedicated_role_permission->perm_edit == $dedicated_role_permission->assign_perm_edit && ($role_permission->assign_perm_edit == 1)) ? 'checked' : '' ?>
                                                                                <?php $perm_delete = ($dedicated_role_permission->perm_delete == $dedicated_role_permission->assign_perm_delete && ($role_permission->assign_perm_delete == 1)) ? 'checked' : '' ?>

                                                                                <?php $disabled_perm_add = (($role_permission->assign_perm_add == 0)) ? 'disabled' : '' ?>
                                                                                <?php $disabled_perm_view = (($role_permission->assign_perm_view == 0)) ? 'disabled' : '' ?>
                                                                                <?php $disabled_perm_edit = (($role_permission->assign_perm_edit == 0)) ? 'disabled' : '' ?>
                                                                                <?php $disabled_perm_delete = (($role_permission->assign_perm_delete == 0)) ? 'disabled' : '' ?>

                                                                                <?php $disabled_color_perm_add = ($disabled_perm_add == 'disabled') ? 'bg-danger' : '' ?>
                                                                                <?php $disabled_color_perm_view = ($disabled_perm_view == 'disabled') ? 'bg-danger' : '' ?>
                                                                                <?php $disabled_color_perm_edit = ($disabled_perm_edit == 'disabled') ? 'bg-danger' : '' ?>
                                                                                <?php $disabled_color_perm_delete = ($disabled_perm_delete == 'disabled') ? 'bg-danger' : '' ?>
                                                                            <?php endif ?>
                                                                        <?php endforeach ?>
                                                                    <?php endif ?>
                                                                <?php endif ?>
                                                            <?php endforeach ?>
                                                        <?php else : ?>
                                                            <?php $perm_add =  '' ?>
                                                            <?php $perm_view =  '' ?>
                                                            <?php $perm_edit =  '' ?>
                                                            <?php $perm_delete =  '' ?>
                                                        <?php endif ?>


                                                        <tr>
                                                            <td><?= ++$i ?></td>
                                                            <td>
                                                                <span class="btn btn-sm disabled btn-outline-dark"><?= ucwords($permission->name) ?></span>
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input <?= $disabled_color_perm_view ?>" type="checkbox" role="switch" id="view-<?= $permission->id ?>" name="<?= "{$permission->key}-view" ?>" value="1" <?= (isset($perm_view) && ($disabled_perm_view !== 'disabled')) ? $perm_view : '' ?> <?= $disabled_perm_view ?>>
                                                                    <label class="form-check-label" for="view-<?= $permission->id ?>"></label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input <?= $disabled_color_perm_add ?>" type="checkbox" role="switch" id="add-<?= $permission->id ?>" name="<?= "{$permission->key}-add" ?>" value="1" <?= (isset($perm_add) && ($disabled_perm_add !== 'disabled')) ? $perm_add : '' ?> <?= $disabled_perm_add ?>>
                                                                    <label class="form-check-label" for="add-<?= $permission->id ?>"></label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input <?= $disabled_color_perm_edit ?>" type="checkbox" role="switch" id="edit-<?= $permission->id ?>" name="<?= "{$permission->key}-edit" ?>" value="1" <?= (isset($perm_edit) && ($disabled_perm_edit !== 'disabled')) ? $perm_edit : '' ?> <?= $disabled_perm_edit ?>>
                                                                    <label class="form-check-label" for="edit-<?= $permission->id ?>"></label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input <?= $disabled_color_perm_delete ?>" type="checkbox" role="switch" id="edit-<?= $permission->id ?>" name="<?= "{$permission->key}-delete" ?>" value="1" <?= (isset($perm_delete) && ($disabled_perm_delete !== 'disabled')) ? $perm_delete : '' ?> <?= $disabled_perm_delete ?>>
                                                                    <label class="form-check-label" for="edit-<?= $permission->id ?>"></label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                <?php else : ?>
                                                    <tr>
                                                        <td colspan="6">No access assigned!</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                        </table>
                                        <div class="row position-relative overflow-hidden">
                                            <div id="spinner">
                                                <div class="position-absolute w-100 h-100 d-flex flex-column align-items-center bg-white justify-content-center rounded " style="opacity: 0.1; z-index:9999999999999999999999999999999999">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <p>How it works</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input bg-danger" type="checkbox" role="switch" disabled>
                                                    <label class="form-check-label"> Can't be set</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" readonly>
                                                    <label class="form-check-label"> Not Assign</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" checked readonly>
                                                    <label class="form-check-label"> Assigned</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <a href="<?= base_url("{$this->uri->segment(1)}/users/view/{$user->id}") ?>" class="btn btn-outline-secondary">Back</a>
                                    <button class="btn btn-primary float-end" type="button">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
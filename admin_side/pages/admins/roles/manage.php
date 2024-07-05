<div class="container-fluid px-4">
    <h1 class="mt-4"><?= (isset($title)) ? $title : "" ?></h1>
    <?php if (isset($subtitle)) : ?>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?= $subtitle ?></li>
        </ol>
    <?php endif ?>
    <div class="row">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Permission Name</th>
                    <th>View</th>
                    <th>Add</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($roles) : $i = 0;
                    $last_role_name = ''; ?>
                    <?php foreach ($roles->role_names as $role_id => $row) :
                        $firstRow = true;
                        $permissions = (array)$roles->{$row}->permissions;
                        ksort($permissions);
                    ?>
                        <tr>
                            <td><?= ++$i; ?></td>
                            <td>
                                <?php print($row) ?>
                            </td>
                            <td colspan="5" class="text-center"><?= (empty($permissions)) ? 'No access assigned!' : '' ?></td>
                            <td>
                                <a href="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/edit/{$role_id}") ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        <?php foreach ((object)$permissions as $key => $permission) : ?>
                            <tr>
                                <td></td>
                                <td></td>

                                <?php
                                $perm_add = (($permission->perm_add == $permission->assign_perm_add) && ($permission->perm_add == 1)) ? 'fa fa-check text-success' : 'fa fa-times text-danger';
                                $perm_view = (($permission->perm_view == $permission->assign_perm_view) && ($permission->perm_view == 1)) ? 'fa fa-check text-success' : 'fa fa-times text-danger';
                                $perm_edit = (($permission->perm_edit == $permission->assign_perm_edit) && ($permission->perm_edit == 1)) ? 'fa fa-check text-success' : 'fa fa-times text-danger';
                                $perm_delete = (($permission->perm_delete == $permission->assign_perm_delete) && ($permission->perm_delete == 1)) ? 'fa fa-check text-success' : 'fa fa-times text-danger';
                                ?>
                                <td>
                                    <span class="btn btn-sm disabled btn-outline-dark"><?= ucwords($permission->name) ?></span>
                                </td>
                                <td>
                                    <i class="<?= $perm_view ?>" aria-hidden="true"></i>
                                </td>
                                <td>
                                    <i class="<?= $perm_add ?>" aria-hidden="true"></i>
                                </td>
                                <td>
                                    <i class="<?= $perm_edit ?>" aria-hidden="true"></i>
                                </td>
                                <td>
                                    <i class="<?= $perm_delete ?>" aria-hidden="true"></i>
                                </td>
                                <td></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">No access available</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>
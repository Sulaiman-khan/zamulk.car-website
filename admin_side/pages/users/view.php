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
                <div class="col-lg-12">
                    <?php
                    $status = ['pending verification' => 'warning', 'pending' => 'warning', 'active' => 'success', 'blocked' => 'danger', 'suspended' => 'info'];
                    ?>

                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-light mb-4">
                                <div class="card-body">Total Orders</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <?= convert_price($total_orders, 0) ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-light mb-4">
                                <div class="card-body">Total <?= ($user->shop_id) ? 'Sale' : 'Spending' ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <?= "{$this->options->key->currency_unit}" . convert_price((($user->shop_id) ? $total_sale : $total_spending)) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-light mb-4">
                                <div class="card-body">Total Reviews</div>
                                <div class="card-footer d-flex align-items-center justify-content-between content-box">

                                    <ul class="rating clearfix">
                                        <?= rating_stars($total_reviews->stars) ?> (<?= convert_price($total_reviews->total, 0) ?>)
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-light mb-4">
                                <div class="card-body">Pending Delivery</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <?= convert_price($total_pending_delivery, 0) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 col-lg-3">
                            <img class="img-thumbnail" src="<?= images_url("users/" . image("public/images/users/", $user->image)) ?>" alt="<?= $user->first_name ?>">
                        </div>
                        <div class="col-sm-10 col-lg-9">
                            <table class="table table-sm table-borderless table-hover">
                                <tbody>
                                    <tr>
                                        <th>Name:</th>
                                        <td><?= "{$user->first_name} {$user->last_name}" ?></td>
                                        <td rowspan="5">
                                            <?php if ($this->auth->admin_perm_auth('users', 'edit')) : ?>
                                                <form id="loginForm" action="<?= base_url("{$this->uri->segment(1)}/users/login_as/{$user->id}") ?>" method="POST">
                                                    <span class="btn btn-sm disabled btn-<?= $status[$user->status] ?>"><?= ucwords($user->status) ?></span>
                                                    <button class="btn btn-sm btn-info">Login as <i class="fas fa-sign-in-alt"></i></button>
                                                </form>
                                            <?php else : ?>
                                                <span class="btn btn-sm disabled btn-<?= $status[$user->status] ?>"><?= ucwords($user->status) ?></span>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Address: </th>
                                        <td><?= "{$user->address}" ?></td>
                                    </tr>
                                    <tr>
                                        <th>City: </th>
                                        <td><?= "{$user->city}" ?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <td><?= "{$user->phone}" ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td><?= "{$user->email}" ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php if ($user->shop_id) : ?>
                        <div class="row mt-4">
                            <div class="col-sm-10 col-lg-9">
                                <table class="table table-sm table-borderless table-hover">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <a href="<?= strtolower(base_url("shop/" . url_title($user->shop_name)) . "/{$user->shop_id}") ?>" class="btn btn-sm btn-info" target="_blank">View Shop <i class="fas fa-link"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Shop Name:</th>
                                            <td><?= "{$user->shop_name}" ?></td>
                                        </tr>
                                        <tr>
                                            <th>Shop Address:</th>
                                            <td><?= "{$user->shop_address}" ?></td>
                                        </tr>
                                        <tr>
                                            <th>Shop City:</th>
                                            <td><?= "{$user->shop_city}" ?></td>
                                        </tr>
                                        <tr>
                                            <th>Shop Phone:</th>
                                            <td><?= "{$user->shop_phone}" ?></td>
                                        </tr>
                                        <tr>
                                            <th>Shop Email:</th>
                                            <td><?= "{$user->email}" ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2 col-lg-3 mt-5">
                                <img class="img-thumbnail" src="<?= images_url("shops/" . image("public/images/shops/", $user->shop_image)) ?>" alt="<?= $user->shop_name ?>">
                            </div>
                        </div>
                    <?php endif ?>

                    <div class="row">
                        <table class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th>S/N</th>
                                    <th>Permission Name</th>
                                    <th>View</th>
                                    <th>Add</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>Action</th>
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
                                                                <?php $perm_add = (($dedicated_role_permission->assign_perm_add == $dedicated_role_permission->perm_add) && ($role_permission->assign_perm_add == 1)) ? 'fa fa-check text-success' : 'fa fa-times text-danger' ?>
                                                                <?php $perm_view = ($dedicated_role_permission->perm_view == $dedicated_role_permission->assign_perm_view && ($role_permission->assign_perm_view == 1)) ? 'fa fa-check text-success' : 'fa fa-times text-danger' ?>
                                                                <?php $perm_edit = ($dedicated_role_permission->perm_edit == $dedicated_role_permission->assign_perm_edit && ($role_permission->assign_perm_edit == 1)) ? 'fa fa-check text-success' : 'fa fa-times text-danger' ?>
                                                                <?php $perm_delete = ($dedicated_role_permission->perm_delete == $dedicated_role_permission->assign_perm_delete && ($role_permission->assign_perm_delete == 1)) ? 'fa fa-check text-success' : 'fa fa-times text-danger' ?>
                                                            <?php endif ?>
                                                        <?php endforeach ?>
                                                    <?php endif ?>

                                                <?php endif ?>
                                            <?php endforeach ?>

                                        <?php else : ?>
                                            <?php $perm_add =  'fa fa-times text-danger' ?>
                                            <?php $perm_view =  'fa fa-times text-danger' ?>
                                            <?php $perm_edit =  'fa fa-times text-danger' ?>
                                            <?php $perm_delete =  'fa fa-times text-danger' ?>
                                        <?php endif ?>

                                        <tr>
                                            <td><?= ++$i ?></td>
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
                                            <?php if ($i == 1) : ?>
                                                <td rowspan="<?= count($permissions) ?>"><a href="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/role/edit/{$user->role_id}/{$user->id}") ?>" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a></td>
                                            <?php endif ?>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6">No access assigned!</td>
                                    </tr>
                                <?php endif ?>

                            </tbody>
                        </table>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-light">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Status Message</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($email_logs) : ?>
                                        <?php foreach ($email_logs as $row) : ?>
                                            <tr>
                                                <td><?= $row->id ?></td>
                                                <td><?= $row->recipient ?></td>
                                                <td><?= $row->subject ?></td>
                                                <td><?= date("d M, Y h:i:s A", strtotime($row->created_at)) ?></td>
                                                <td style="width:200px;"><?= input_print($row->status_message) ?></td>
                                                <td>
                                                    <span class="badge bg-<?= (strtolower($row->status) == 'delivered') ? 'success' : 'danger' ?>"><?= ucwords($row->status) ?></span>
                                                </td>
                                                <td>
                                                    <p>
                                                        <span class="btn btn-primary btn-sm view-email" data-title="<?= $row->subject ?>" data-email="<<?= "{$row->first_name} {$row->last_name}" ?>> <?= $row->recipient ?>" data-date="<?= date("d M, Y h:i:s A", strtotime($row->created_at)) ?>" data-status-message="<?= input_print($row->status_message) ?>" data-status="<?= ucwords($row->status) ?>" data-url="<?= base_url("{$this->uri->segment(1)}/email_logs/email/view/{$row->id}") ?>" data-id="<?= $row->id ?>" data-bs-toggle="modal" data-bs-target="#modal-email-view"><i class="fas fa-eye"></i></span>

                                                        <span class="btn btn-sm btn-danger resend-email" data-email="<?= $row->recipient ?>" data-url="<?= base_url("{$this->uri->segment(1)}/email_logs/email/resend/{$row->id}") ?>"><i class="fas fa-history"></i></span>
                                                    </p>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No email log available</td>
                                        </tr>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-email-view" tabindex="-1" aria-labelledby="modal-email-viewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row">
                        <h5 class="modal-title" id="modal-email-viewLabel"></h5>
                    </div>
                    <div class="row">
                        <small><span class="modal-email"></span> - <span class="modal-date"></span></small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-3 mx-auto">
                    <div class="d-grid gap-2 mx-auto">
                        <span class="btn btn-lg btn-outline-success disabled">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Fetching...
                        </span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('.view-email').on('click', function() {
            $(".modal-title").text($(this).attr('data-title'));
            $(".modal-email").text($(this).attr('data-email'));
            $(".modal-date").text($(this).attr('data-date'));
            $(".modal-status").text($(this).attr('data-status'));
            $(".modal-status-message").text($(this).attr('data-status-message'));
            $.ajax({
                type: "POST",
                url: $(this).attr('data-url'),
                data: {
                    id: $(this).attr('data-id')
                },
                beforeSend: function() {
                    $(".modal-body").html(`
                        <div class="col-lg-3 mx-auto">
                            <div class="d-grid gap-2 mx-auto">
                                <span class="btn btn-lg btn-outline-success disabled">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Fetching...
                                </span>
                            </div>
                        </div>
                    `);
                },
                success: function(data) {
                    $(".modal-body").html(data);
                }
            });
        })
    })

    $('.resend-email').on('click', function() {

        Swal.fire({
            title: 'Are you sure?',
            text: `You want resend email to: ${$(this).attr('data-email')}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, resend it!'
        }).then((result) => {
            if (result.isConfirmed) {
                do_ajax($(this).attr('data-url'))
            }
        })
    });
</script>
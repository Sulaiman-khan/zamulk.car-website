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
                    <th>Image</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($admins) :
                    $status = ['pending verification' => 'warning', 'pending' => 'warning', 'active' => 'success', 'blocked' => 'danger', 'suspended' => 'info'];
                ?>
                    <?php foreach ($admins as $row) : ?>
                        <tr>
                            <td><?= $row->id ?></td>
                            <td><img class="img-thumbnail" src="<?= images_url("admins/" . image("public/images/admins/", $row->image)) ?>" alt="<?= $row->first_name ?>" width="70" height="70"></td>
                            <td><?= "{$row->first_name} {$row->last_name}" ?></td>
                            <td><?= "{$row->address}" ?></td>
                            <td><?= "{$row->city}" ?></td>
                            <td><?= "{$row->phone}" ?></td>
                            <td>
                                <span class="badge rounded-pill bg-dark"><?= ucwords($row->role_name) ?></span>
                            </td>
                            <td>
                                <span class="badge bg-<?= $status[strtolower($row->status)] ?>"><?= ucwords($row->status) ?></span>
                            </td>
                            <td>
                                <p>
                                <form id="loginForm" action="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/login_as/{$row->id}") ?>" method="POST">
                                    <a href="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/edit/{$row->id}") ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm btn-info"><i class="fas fa-sign-in-alt"></i></button>
                                </form>
                                </p>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">No item available</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
        <div class="col-lg-12 mx-auto text-center">
            <?php if ($pagination) : ?>
                <?= $pagination ?>
            <?php endif ?>
        </div>

    </div>
</div>

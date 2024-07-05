<div class="container-fluid px-4">
    <h1 class="mt-4"><?= (isset($title)) ? $title : "" ?></h1>
    <?php if (isset($subtitle)) : ?>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?= $subtitle ?></li>
        </ol>
    <?php endif ?>
    <?php $status = ['pending verification' => 'warning', 'pending' => 'warning', 'active' => 'success', 'blocked' => 'danger', 'suspended' => 'info']; ?>
    <div class="row">
        <div class="col-lg-12 mx-auto text-center">
            <div class="row">
                <div class="col-lg-9">

                    <form method="get">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="status" id="inputstatus" class="form-control">
                                    <option selected hidden disabled>Select Status</option>
                                    <?php foreach ($status as $key => $val) : ?>
                                        <option value="<?= str_replace(' ', '-', $key) ?>" <?= str_replace(' ', '-', $key) == input_print($this->input->get('status')) ? 'selected' : '' ?>><?= ucwords($key) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <input type="text" name="email" value="<?= input_print($this->input->get('email')) ?>" class="form-control" placeholder="Search by email..." aria-label="Search by email..." aria-describedby="basic-addon2">
                            <input type="text" name="name" value="<?= input_print($this->input->get('name')) ?>" class="form-control" placeholder="Search by user, shop name..." aria-label="Search by user, shop name..." aria-describedby="basic-addon2">
                            <input type="text" name="query" value="<?= input_print($this->input->get('query')) ?>" class="form-control" placeholder="Search by address, city, phone..." aria-label="Search by address, city, phone..." aria-describedby="basic-addon2">

                            <div class="input-group-append">
                                <button class="input-group-text btn btn-primary" role="button" type="submit" id="basic-addon2">Search</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($users) : ?>
                    <?php foreach ($users as $row) : ?>
                        <tr>
                            <td <?= ($row->shop_id) ? 'rowspan="2" class="bg-info"' : '' ?>><?= $row->id ?></td>
                            <td><img class="img-thumbnail" src="<?= images_url("users/" . image("public/images/users/", $row->image)) ?>" alt="<?= $row->first_name ?>" width="70" height="70"></td>
                            <td><?= "{$row->first_name} {$row->last_name}" ?></td>
                            <td><?= "{$row->email}" ?></td>
                            <td><?= "{$row->city}" ?></td>
                            <td><?= "{$row->phone}" ?></td>
                            <td <?= ($row->shop_id) ? 'rowspan="2" ' : '' ?>>
                                <?= date("d M, Y h:i:s A", strtotime($row->created_at)) ?>
                            </td>
                            <td <?= ($row->shop_id) ? 'rowspan="2" ' : '' ?>>
                                <span class="badge bg-<?= $status[strtolower($row->status)] ?>"><?= ucwords($row->status) ?></span>
                            </td>
                            <td <?= ($row->shop_id) ? 'rowspan="2"' : '' ?>>
                                <?php if ($this->auth->admin_perm_auth('users', 'edit')) : ?>
                                    <form id="loginForm" action="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/login_as/{$row->id}") ?>" method="POST">
                                        <a href="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/edit/{$row->id}") ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                        <a href="<?= base_url("{$this->uri->segment(1)}/users/view/{$row->id}") ?>" class="btn btn-sm btn-info"><i class="fas fa-user"></i></a>
                                        <button class="btn btn-sm btn-info"><i class="fas fa-sign-in-alt"></i></button>
                                    </form>
                                <?php else : ?>
                                    <a href="<?= base_url("{$this->uri->segment(1)}/users/view/{$row->id}") ?>" class="btn btn-sm btn-info"><i class="fas fa-user"></i></a>
                                <?php endif ?>
                            </td>
                        </tr>
                        <?php if ($row->shop_id) : ?>
                            <tr>
                                <td><img class="img-thumbnail" src="<?= images_url("shops/" . image("public/images/shops/", $row->shop_image)) ?>" alt="<?= $row->shop_name ?>" width="70" height="70"></td>
                                <td><a href="<?= strtolower(base_url("shop/" . url_title($row->shop_name)) . "/{$row->shop_id}") ?>" target="_blank"><?= "{$row->shop_name}" ?></a></td>
                                <td><?= "{$row->shop_address}" ?></td>
                                <td><?= "{$row->shop_city}" ?></td>
                                <td><?= "{$row->shop_phone}" ?></td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">No record available</td>
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

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
                    <th>Title</th>
                    <th>Description</th>
                    <th>Extra Opt?</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($products) : ?>
                    <?php foreach ($products as $row) : ?>
                        <tr>
                            <td><?= $row->id ?></td>
                            <td><img class="img-thumbnail" src="<?= images_url("products/main/" . image("public/images/products/main/", $row->image)) ?>" alt="<?= $row->title ?>" width="70" height="70"></td>
                            <td><?= $row->title ?></td>
                            <td><?= short_description($row->description, 20) ?></td>
                            <td><span class="badge bg-<?= (empty($row->includes)) ? 'danger' : 'success' ?> disabled"><?= (empty($row->includes)) ? 'NO' : 'YES' ?></span></td>
                            <td>
                                <span class="badge bg-<?= (strtolower($row->status) == 'active') ? 'success' : 'danger' ?> disabled"><?= ucwords($row->status) ?></span>
                            </td>
                            <td style="width: 100px;">
                                <?php if ($this->auth->admin_perm_auth('products', 'edit')) : ?>
                                    <a href="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/edit/{$row->id}") ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>

                                    <?php if (strtolower($row->status) == 'active') : ?>
                                        <button class="btn btn-sm btn-danger" onclick="deactive(<?= $row->id ?>)"><i class="fas fa-eye-slash"></i></button>
                                    <?php else : ?>
                                        <button onclick="active(<?= $row->id ?>)" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></button>
                                    <?php endif ?>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
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
<script>
    function deactive(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "User will stop seeing items under this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, deactivate it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deactivated!',
                    'Product has been deactivated.',
                    'success'
                )
                setTimeout(() => {
                    window.location.replace(`<?= base_url("{$this->uri->segment(1)}/products/deactive/") ?>${id}`);
                }, 500);
            }
        })
    }

    function active(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "User will start seeing items under this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, activate it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Activated!',
                    'Product has been activated.',
                    'success'
                )
                setTimeout(() => {
                    window.location.replace(`<?= base_url("{$this->uri->segment(1)}/products/active/") ?>${id}`);
                }, 500);
            }
        })
    }
</script>
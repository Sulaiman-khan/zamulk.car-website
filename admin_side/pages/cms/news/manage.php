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
                    <th>Slug</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Updated By</th>
                    <th>Updated On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($query) : ?>
                    <?php foreach ($query as $row) : ?>
                        <tr>
                            <td><?= $row->id ?></td>
                            <td><img class="img-thumbnail" src="<?= images_url("news/" . image("public/images/news/", $row->image)) ?>" alt="<?= $row->title ?>" width="70" height="70"></td>
                            <td><?= $row->slug ?></td>
                            <td><?= $row->title ?></td>
                            <td><?= short_description($row->description, 20) ?></td>
                            <td><?= "{$row->first_name} {$row->last_name}" ?></td>
                            <td><?= date("d M, Y h:i A", strtotime($row->updated_at)) ?></td>
                            <td style="width: 150px;">
                                <?php if ($this->auth->admin_perm_auth('news', 'edit')) : ?>
                                    <a href="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/edit/{$row->id}") ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                <?php endif ?>
                                <a href="<?= base_url("news/{$row->slug}") ?>" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-eye"></i></a>
                                <?php if ($this->auth->admin_perm_auth('news', 'delete')) : ?>
                                    <button class="btn btn-sm btn-danger" onclick="deactive(<?= $row->id ?>)"><i class="fas fa-trash"></i></button>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8">No content available</td>
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
<?php if ($this->auth->admin_perm_auth('news', 'delete')) : ?>
    <script>
        function deactive(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to remove this content!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Content has been deleted.',
                        'success'
                    )
                    setTimeout(() => {
                        window.location.replace(`<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/delete/") ?>${id}`);
                    }, 500);
                }
            })
        }
    </script>
<?php endif ?>
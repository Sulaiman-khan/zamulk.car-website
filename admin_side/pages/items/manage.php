<div class="container-fluid px-4">
    <h1 class="mt-4"><?= (isset($title)) ? $title : "" ?></h1>
    <?php if (isset($subtitle)) : ?>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?= $subtitle ?></li>
        </ol>
    <?php endif ?>
    <div class="row">
        <div class="col-lg-12 mx-auto text-center">
            <div class="row">
                <div class="col-lg-9">

                    <form method="get">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select name="category" id="inputstatus" class="form-control">
                                    <option selected hidden disabled>Select category</option>
                                    <option value="">Any</option>
                                    <?php if ($products) : ?>
                                        <?php foreach ($products as $product) : ?>
                                            <option value="<?= input_print(str_replace(' ', '-', $product->title)) ?>" <?= $product->title == input_print($this->input->get('category')) ? 'selected' : '' ?>><?= ucwords($product->title) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <select name="status" id="inputstatus" class="form-control">
                                <option selected hidden disabled>Select Status</option>
                                <option value="">Any</option>
                                <option value="active" <?= 'active' == input_print($this->input->get('status')) ? 'selected' : '' ?>><?= ucwords('active') ?></option>
                                <option value="deactivated" <?= 'deactivated' == input_print($this->input->get('status')) ? 'selected' : '' ?>><?= ucwords('deactivated') ?></option>
                            </select>
                            <input type="text" name="email" value="<?= input_print($this->input->get('email')) ?>" class="form-control" placeholder="User email..." aria-label="User email..." aria-describedby="basic-addon2">
                            <input type="text" name="query" value="<?= input_print($this->input->get('query')) ?>" class="form-control" placeholder="Title, sku..." aria-label="Title, sku..." aria-describedby="basic-addon2">

                            <input type="text" name="max_qty" value="<?= input_print($this->input->get('max_qty')) ?>" class="form-control" placeholder="Qty less than..." aria-label="Qty less than..." aria-describedby="basic-addon2">

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
                    <th>Email</th>
                    <th>SKU</th>
                    <th>Title</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Discount?</th>
                    <th>Wholesale?</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($items) : ?>
                    <?php foreach ($items as $item) : ?>

                        <?php
                        $tile_in_box = 1;
                        $meter_of_tiles = 1;
                        if ($item->product_id == 1) : ?>
                            <?php if (!empty(json_decode($item->includes))) : ?>
                                <?php foreach (json_decode($item->includes) as $opt) : ?>

                                    <?php if ($opt->tag == 'input') : ?>
                                        <?php if (strtolower($opt->name) == 'tiles_in_box') : ?>
                                            <?php $tile_in_box = $opt->checked ?>
                                        <?php endif ?>
                                        <?php if (strtolower($opt->name) == 'meter_of_tiles') : ?>
                                            <?php $meter_of_tiles = $opt->checked ?>
                                        <?php endif ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        <?php endif ?>
                        <tr>
                            <td><?= $item->id ?></td>
                            <td><img class="img-thumbnail" src="<?= images_url("products/items/" . image("public/images/products/items/", $item->image)) ?>" alt="<?= $item->title ?>" width="70" height="70"></td>
                            <td><?= input_print($item->email) ?></td>
                            <td><?= input_print($item->sku) ?></td>
                            <td><a href="<?= strtolower(base_url("product/" . url_title($item->title)) . "/{$item->id}") ?>" target="_blank"><?= $item->title ?></a></td>
                            <td><a href="<?= strtolower(base_url("products/" . url_title($item->product_title))) ?>" target="_blank"><?= ucwords($item->product_title) ?></a></td>
                            <td><?= convert_price($item->quantity, 0) ?></td>
                            <td>
                                <?= ($item->discount) ? "{$this->options->key->currency_unit}" . convert_price(price($item->price / ($meter_of_tiles / $tile_in_box), $item->discount, $item->discount_type), 0) : "" ?>
                                <?= ($item->discount && $item->product_id == 1) ? ' /<span style="color: gray;">SQM</span>' : (($item->discount) ? '' : '') ?>

                                <?= ($item->discount) ? '<br/><span><del>' : '' ?>
                                <?= "{$this->options->key->currency_unit}" . convert_price(($item->price) / ($meter_of_tiles / $tile_in_box), 0) ?>
                                <?= ($item->product_id == 1) ? ' /<span style="color: gray;">SQM</span>' : '' ?>
                                <?= ($item->discount) ? '</del></span>' : '' ?>
                            </td>
                            <td><?= ($item->discount) ? (($item->discount_type == 'percentage') ? "{$item->discount}%" : "{$this->options->key->currency_unit}{$item->discount}") : 'N/A' ?></td>
                            <td>
                                <span class="badge bg-<?= isset($item->wholesale_price, $item->wholesale_min_quantity) ? 'success' : 'danger' ?> disabled"><?= isset($item->wholesale_price, $item->wholesale_min_quantity) ? 'YES' : 'NO' ?></span>
                            </td>
                            <td>
                                <span class="badge bg-<?= (strtolower($item->status) == 'active') ? 'success' : 'danger' ?> disabled"><?= ucwords($item->status) ?></span>
                            </td>
                            <td>
                                <p>
                                    <?php if ($this->auth->admin_perm_auth('items', 'edit')) : ?>
                                        <a href="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/edit/{$item->id}") ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                    <?php endif ?>
                                    <a href="<?= base_url("{$this->uri->segment(1)}/users/view/{$item->user_id}") ?>" class="btn btn-sm btn-info"><i class="fas fa-user"></i></a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><?= "{$item->first_name} {$item->last_name}" ?></td>
                            <td> <a href="<?= strtolower(base_url("shop/" . url_title($item->shop_name)) . "/{$item->shop_id}") ?>" target="_blank"><?= "{$item->shop_name}" ?></a></td>
                            <td colspan="3"><?= "Created At: " . date("d M, Y h:i A", strtotime($item->created_at)) ?></td>
                            <td colspan="3"><?= "Updated At: " . date("d M, Y h:i A", strtotime($item->updated_at)) ?></td>
                            <td></td>
                            <td>
                                <?php if ($this->auth->admin_perm_auth('items', 'edit')) : ?>
                                    <p>
                                        <?php if (strtolower($item->status) == 'active') : ?>
                                            <button class="btn btn-sm btn-danger" onclick="deactive(<?= $item->id ?>)"><i class="fas fa-eye-slash"></i></button>
                                        <?php else : ?>
                                            <button onclick="active(<?= $item->id ?>)" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></button>
                                        <?php endif ?>
                                        <button onclick="deleteItem(<?= $item->id ?>)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </p>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan="11" class="text-center">No record available</td>
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
<?php if ($this->auth->admin_perm_auth('items', 'edit')) : ?>
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Item has been deleted.',
                        'success'
                    )
                    setTimeout(() => {
                        window.location.replace(`<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/delete_item/") ?>${id}`);
                    }, 500);
                }
            })
        }

        function deactive(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Only shop will see it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, deactivate it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deactivated!',
                        'Item has been deactivated.',
                        'success'
                    )
                    setTimeout(() => {
                        window.location.replace(`<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/deactive/") ?>${id}`);
                    }, 500);
                }
            })
        }

        function active(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "User will start seeing this item!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, activate it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Activated!',
                        'Item has been activated.',
                        'success'
                    )
                    setTimeout(() => {
                        window.location.replace(`<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/active/") ?>${id}`);
                    }, 500);
                }
            })
        }
    </script>
<?php endif ?>
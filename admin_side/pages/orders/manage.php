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
                                <input type="text" name="order_id" value="<?= input_print($this->input->get('order_id')) ?>" class="form-control" placeholder="Order id..." aria-label="Order id..." aria-describedby="basic-addon2">
                            </div>
                            <select name="category" id="inputstatus" class="form-control">
                                <option selected hidden disabled>Select category</option>
                                <option value="">Any</option>
                                <?php if ($products) : ?>
                                    <?php foreach ($products as $product) : ?>
                                        <option value="<?= input_print(str_replace(' ', '-', $product->title)) ?>" <?= $product->title == input_print($this->input->get('category')) ? 'selected' : '' ?>><?= ucwords($product->title) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <?php $status = ['pending', 'placed', 'in progress', 'shipped', 'delivered', 'cancelled'] ?>
                            <select name="status" id="inputstatus" class="form-control">
                                <option selected hidden disabled>Select Status</option>
                                <option value="">Any</option>
                                <?php foreach ($status as $st) : ?>
                                    <option value="<?= str_replace(' ', '-', $st) ?>" <?= $st == str_replace(' ', '-', input_print($this->input->get('status'))) ? 'selected' : '' ?>><?= ucwords($st) ?></option>
                                <?php endforeach ?>
                            </select>
                            <input type="text" name="email" value="<?= input_print($this->input->get('email')) ?>" class="form-control" placeholder="User email..." aria-label="User email..." aria-describedby="basic-addon2">
                            <input type="text" name="query" value="<?= input_print($this->input->get('query')) ?>" class="form-control" placeholder="Title, sku..." aria-label="Title, sku..." aria-describedby="basic-addon2">

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
            <?php if ($orders) :
            ?>
                <?php foreach ($orders as $order) :
                    // $item_details = json_decode($order->item_details);
                    // $item = ($item_details->item);
                    // $order_item = ($item_details->order_item);
                    $pricing = json_decode($order->pricing);
                ?>
                    <tr>
                        <td>
                            <p class="mt-3 mb-3">
                                <span>
                                    <strong>Order</strong> <?php if (($this->auth->admin_perm_auth('orders', 'view', true))) : ?><a href="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/view/{$order->id}") ?>">#<?= $order->id ?></a><?php else : ?>#<?= $order->id ?><?php endif ?>
                                </span>
                                <br>
                                <span>Placed on
                                    <?= date('d M Y h:i:s A', strtotime($order->created_at)) ?></span>
                            </p>
                        </td>
                        <td>
                            <p class="mt-3 mb-3">
                                Buyer: <a href="<?= base_url("{$this->uri->segment(1)}/users/view/{$order->buyer_id}") ?>" target="_blank" class="btn badge rounded-pill bg-success">
                                    <?= "{$order->buyer_first_name} {$order->buyer_last_name}" ?>
                                </a>
                                <br>
                                Seller: <a href="<?= base_url("{$this->uri->segment(1)}/users/view/{$order->seller_id}") ?>" target="_blank" class="btn badge rounded-pill bg-info">
                                    <?= "{$order->seller_first_name} {$order->seller_last_name}" ?>
                                </a>
                            </p>
                        </td>
                        <td>
                            <p class="mt-3 mb-3">
                                <span><?= $order->total_items ?> product(s) in this order </span>
                            </p>
                        </td>
                        <td>
                            <p class="mt-3 ">
                                Total: <?= "{$this->options->key->currency_unit}" . convert_price($pricing->subtotal, 0) ?>
                                <br>
                                Discount: <?= "{$this->options->key->currency_unit}" . convert_price($pricing->discount, 0) ?>
                                <br>
                                Final Amount: <?= "{$this->options->key->currency_unit}" . convert_price($pricing->total, 0) ?>
                            </p>
                        </td>
                        <td>
                            <p class="mt-3 mb-3">
                                <span class="badge rounded-pill bg-<?= ($order->status == 'delivered') ? 'success' : 'secondary' ?>"><?= ucfirst($order->status) ?></span>
                            </p>
                            <p class="mt-3 mb-3">
                                <span class="badge rounded-pill bg-<?= ($order->payment_status == 'paid') ? 'success' : 'secondary' ?>"><?= ucfirst($order->payment_status) ?></span>
                            </p>
                        </td>
                        <td style="max-width: 40px;">
                            <p class="mt-3 mb-3">
                                <span>
                                    <a href="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/view/{$order->id}") ?>" class="btn btn-outline-primary float-end"> <i class="fas fa-edit"></i></a>
                                </span>
                            </p>
                            <p class="mt-3 mb-3">
                                <?= ($order->delivered_on) ? date("d M, Y h:i A", strtotime($order->delivered_on)) : '' ?>
                            </p>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="8" class="text-center">No orders available</td>
                </tr>
            <?php endif ?>
        </table>
        <div class="col-lg-12 mx-auto text-center">
            <?php if ($pagination) : ?>
                <?= $pagination ?>
            <?php endif ?>
        </div>

    </div>
</div>
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

                    <div class="container">
                        <?php if ($order) :
                            // $item_details = json_decode($order->item_details);
                            // $item = ($item_details->item);
                            // $order_item = ($item_details->order_item);
                            $payment_details = json_decode($order->payment_details);
                            $pricing = json_decode($order->pricing);
                            $delivery_address = json_decode($order->delivery_address);
                            $billing_address = json_decode($order->billing_address);
                        ?>

                            <?php if ($order->status !== 'cancelled') : ?>
                                <?php if (($this->auth->admin_perm_auth('orders', 'edit'))) : ?>
                                    <div class="row">
                                        <div class="col-lg-3 mx-auto">
                                            <?php
                                            $status = ['pending verification' => 'warning', 'pending' => 'warning', 'active' => 'success', 'blocked' => 'danger', 'suspended' => 'info'];
                                            ?>
                                            <div class="d-grid gap-2 mx-auto">
                                                <span class="btn btn-lg btn-outline-<?= ($order->order_status == 'verified') ? 'success' : 'danger' ?> disabled hidden" id="loadingSpinner">
                                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    Updating...
                                                </span>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select id="inputStatusSelect" class="form-control text-start btn btn-outline-<?= ($order->order_status == 'verified') ? 'success' : 'danger' ?>" name="order_status" <?= ($order->order_status == 'verified') ? 'disabled' : '' ?>>
                                                    <option value="<?= str_replace(' ', '-', strtolower('not verified')) ?>" <?= ($order->order_status == strtolower('not verified')) ? 'selected' : '' ?>><?= ucwords('not verified') ?></option>
                                                    <option value="<?= strtolower('verified') ?>" <?= ($order->order_status == strtolower('verified')) ? 'selected' : '' ?>><?= ucwords('verified') ?></option>
                                                </select>
                                                <label for="inputStatusSelect">Order Status</label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endif ?>

                            <div class="row">
                                <p class="mt-3 mb-3">
                                    <span class="float-end">Total: <?= "{$this->options->key->currency_unit}" . convert_price($pricing->total, 0) ?></span>
                                    <span>
                                        <strong>Order</strong> #<?= $order->id ?>
                                    </span>
                                    <br>
                                    <span>Placed on <?= date('d M Y h:i:s A', strtotime($order->created_at)) ?></span>
                                </p>

                            </div>
                            <div class="row">
                                <div class="float-end">

                                    <?php if ($order->status == 'delivered') : ?>

                                        <?php if (($this->auth->admin_perm_auth('reviews', 'edit', true))) : ?>
                                            <?php if ($order_review) : ?>
                                                <td>
                                                    <span class="btn btn-sm btn-success float-end write-a-review">Reviewed (<?= "{$order_review->stars} star" ?>)</span>

                                                </td>
                                                <div id="review-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/{$this->uri->segment(3)}/{$this->uri->segment(4)}/review") ?>" id="review-form" method="POST">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="my-modal-title">Write A Review</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="order-rating">
                                                                            <input type="radio" id="star5" name="star" value="5" <?= ($order_review) ? (($order_review->stars == 5) ? 'checked' : '') : '' ?> />
                                                                            <label for="star5" title="text">5 stars</label>
                                                                            <input type="radio" id="star4" name="star" value="4" <?= ($order_review) ? (($order_review->stars == 4) ? 'checked' : '') : '' ?> />
                                                                            <label for="star4" title="text">4 stars</label>
                                                                            <input type="radio" id="star3" name="star" value="3" <?= ($order_review) ? (($order_review->stars == 3) ? 'checked' : '') : '' ?> />
                                                                            <label for="star3" title="text">3 stars</label>
                                                                            <input type="radio" id="star2" name="star" value="2" <?= ($order_review) ? (($order_review->stars == 2) ? 'checked' : '') : '' ?> />
                                                                            <label for="star2" title="text">2 stars</label>
                                                                            <input type="radio" id="star1" name="star" value="1" <?= ($order_review) ? (($order_review->stars == 1) ? 'checked' : '') : '' ?> />
                                                                            <label for="star1" title="text">1 star</label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <textarea name="message" class="form-control" rows="3" placeholder="Type your message..." required><?= ($order_review) ? input_print($order_review->message) : '' ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-sm btn-success review-submit">Submit Review</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif ?>
                                        <?php endif ?>
                                    <?php endif ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered rounded">
                                            <?php foreach ($order_items as $order_single_item) : ?>
                                                <?php

                                                $item_details = json_decode($order_single_item->item_details);
                                                $item = ($item_details->item);
                                                $order_item = ($item_details->order_item);
                                                $item_pricing = json_decode($order_single_item->pricing);

                                                ?>
                                                <tr class="align-items-center">
                                                    <td>
                                                        <p class="mt-3 mb-3">
                                                            <a href="<?= strtolower(base_url("product/" . url_title($item->title)) . "/{$item->id}") ?>" target="_blank">
                                                                <img class="img-thumbnail" src="<?= images_url("products/items/" . image("public/images/products/items/", $item->image)); ?>" alt="<?= $item->title ?>" width="70" height="70">
                                                            </a>
                                                        </p>
                                                        <p>
                                                            Seller: <a href="<?= base_url("{$this->uri->segment(1)}/users/view/{$order->seller_id}") ?>" target="_blank" class="btn badge rounded-pill bg-info">
                                                                <?= "{$order->seller_first_name} {$order->seller_last_name}" ?>
                                                            </a>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <div><a href="<?= strtolower(base_url("product/" . url_title($item->title)) . "/{$item->id}") ?>" target="_blank"><?= $item->title ?></a></div>
                                                        <?php if ($order_item->options) : ?>
                                                            <?php foreach ($order_item->options as $key => $value) : ?>
                                                                <div><?= $key ?> : <?= $value ?></div>
                                                            <?php endforeach ?>
                                                        <?php endif ?>

                                                        <?php
                                                        $tiles_in_box = 1;
                                                        $meter_of_tiles = 1;
                                                        if ($item->product_id == 1) : ?>
                                                            <?php if (!empty(json_decode($item->includes))) : ?>
                                                                <?php foreach (json_decode($item->includes) as $opt) : ?>

                                                                    <?php if ($opt->tag == 'input') : ?>
                                                                        <?php if (strtolower($opt->name) == 'tiles_in_box') : ?>
                                                                            <?php $tiles_in_box = $opt->checked ?>
                                                                        <?php endif ?>
                                                                        <?php if (strtolower($opt->name) == 'meter_of_tiles') : ?>
                                                                            <?php $meter_of_tiles = $opt->checked ?>
                                                                        <?php endif ?>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            <?php endif ?>
                                                        <?php endif ?>

                                                        <?php if ($item->product_id == 1) : ?>
                                                            <?php
                                                            $one_tile_meter = $meter_of_tiles / $tiles_in_box;
                                                            $qty = $total_tiles = $order_item->qty;
                                                            $total_meters = round($one_tile_meter * $total_tiles, 3);

                                                            $weight_of_a_box = (isset($item->weight) ? round($item->weight, 2) : round(0, 2));
                                                            $weight_of_a_tile = ($weight_of_a_box / $tiles_in_box);
                                                            $total_weight = round(($weight_of_a_tile * $total_tiles), 2);
                                                            ?>

                                                            <div>Weight: <?= (isset($total_weight) ? round($total_weight, 2) : round(0, 2)) ?> KG</div>
                                                        <?php else : ?>
                                                            <?php
                                                            $total_weight = round(($order_item->qty * $item->weight), 2);
                                                            ?>
                                                            <div>Weight: <?= (isset($total_weight) ? round($total_weight, 2) : round(0, 2)) ?> KG</div>
                                                        <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <p class="mt-3 mb-3">
                                                            <?= $order_item->qty ?><?= ($item->product_id == 1) ? " Tiles" : "" ?>
                                                            <?php if ($item->product_id == 1) : ?>
                                                                <br /><?= round(($order_item->qty * $one_tile_meter), 3) ?> SQM
                                                            <?php endif ?>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p><?= "{$this->options->key->currency_unit}" . convert_price($item_pricing->price / ($meter_of_tiles / $tiles_in_box), 2) ?><?= ($item->product_id == 1) ? ' /<span style="color: gray;">SQM</span>' : '' ?></p>


                                                        <?php if (!$order_single_item->is_wholesale) : ?>
                                                            <?php if ($item->discount) : ?>
                                                                <del><?= "{$this->options->key->currency_unit}" . convert_price($order_item->original_price / ($meter_of_tiles / $tiles_in_box)); ?><?= ($item->product_id == 1) ? ' /<span style="color: gray;">SQM</span>' : '' ?></del>
                                                                <p><span class="btn btn-sm btn-outline-primary disabled"><?= ($order_item->discount_type === 'percentage') ? "" : "{$this->options->key->currency_unit}" ?> <?= convert_price($order_item->discount) ?><?= ($order_item->discount_type === 'percentage') ? " %" : '' ?> OFF</span></p>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <p class="mt-3 mb-3">
                                                            <?= "{$this->options->key->currency_unit}" . convert_price($item_pricing->total) ?>
                                                        </p>
                                                    </td>
                                                    <?php if ($order_single_item->is_wholesale) : ?>
                                                        <td>
                                                            <span class="btn btn-sm btn-outline-danger disabled float-end">Wholesale</span>
                                                        </td>
                                                    <?php endif ?>
                                                    <td>
                                                        <p class="mt-3 mb-3">
                                                            <span class="btn btn-sm btn-<?= ($order->status == 'cancelled') ? 'secondary' : (($order->status !== 'cancelled') ? 'outline-primary' : 'outline-secondary') ?> float-end disabled"><?= ucfirst($order->status) ?></span>
                                                        </p>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </table>
                                    </div>
                                </div>

                                <?php if ($order_events) : ?>
                                    <div class="row">
                                        <div class="container">
                                            <div class="col-lg-8 offset-2 mt-5 mb-5 p-3 bg-secondary bg-gradient text-white">
                                                <?php foreach ($order_events as $event) : ?>
                                                    <div><?= date('D d M Y h:i:s A', strtotime($event->created_at)) ?> : <?= $event->event_name ?></div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>

                                <div class="row">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="h5">Shipping Address</div>
                                            <div><?= "{$delivery_address->first_name} {$delivery_address->last_name}" ?></div>
                                            <div><?= "{$delivery_address->address}, {$delivery_address->province}, {$delivery_address->city}" ?></div>
                                            <p><?= $delivery_address->phone ?> <?= isset($delivery_address->phone_2) ? "<br/>{$delivery_address->phone_2}" : "" ?> <?= isset($delivery_address->phone_3) ? "<br/>{$delivery_address->phone_3}" : "" ?></p>
                                            <div>
                                                <hr>
                                            </div>
                                            <div class="h5">Billing Address</div>
                                            <div><?= "{$billing_address->first_name} {$billing_address->last_name}" ?></div>
                                            <div><?= "{$billing_address->address}, {$billing_address->province}, {$billing_address->city}" ?></div>
                                            <p><?= $billing_address->phone ?> <?= isset($billing_address->phone_2) ? "<br/>{$billing_address->phone_2}" : "" ?> <?= isset($billing_address->phone_3) ? "<br/>{$billing_address->phone_3}" : "" ?></p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="h5">Total Summary</div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="float-start">Subtotal</span>
                                                    <span class="float-end"><?= "{$this->options->key->currency_unit}" . convert_price($pricing->subtotal, 0) ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="float-start">Discount</span>
                                                    <span class="float-end"><?= "{$this->options->key->currency_unit}" . convert_price($pricing->discount, 0) ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="float-start">Shipping Fee</span>
                                                    <span class="float-end"><?= "{$this->options->key->currency_unit}" . convert_price($pricing->shipping_fee, 0) ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="float-start">Total</span>
                                                    <span class="float-end"><?= "{$this->options->key->currency_unit}" . convert_price($pricing->total, 0) ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="float-start">Payment Method</span>
                                                    <span class="float-end"><?= ucfirst($payment_details->name) ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <span class="float-start">Payment Status</span>
                                                    <span class="float-end btn btn-sm btn-outline-<?= ($order->payment_status == 'paid') ? 'success' : 'secondary' ?> disabled"><?= ucfirst($order->payment_status) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-12">

                                        <?php if (($this->auth->admin_perm_auth('orders', 'edit', true))) : ?>
                                            <?php if (!in_array($order->status, ['delivered', 'cancelled'])) : ?>
                                                <button class="btn btn-sm btn-outline-danger float-end" id="cancel_order">Cancel Order</button>
                                            <?php endif ?>
                                            <?php if (($order->payment_status == 'unpaid')) : ?>
                                                <button class="btn btn-sm btn-success" id="pay_order">Mark Order As Paid</button>
                                            <?php endif ?>
                                            <?php if (($order->payment_status == 'paid')) : ?>
                                                <button class="btn btn-sm btn-success" id="unpay_now">Mark Order As Unpaid</button>
                                            <?php endif ?>

                                            <?php if ($order->order_status == 'verified') : ?>
                                                <?php if ($order->status == 'placed') : ?>
                                                    <button class="btn btn-sm btn-success" id="prepare_order">Mark Order As Preparing </button>
                                                <?php elseif ($order->status == 'in progress') : ?>
                                                    <button class="btn btn-sm btn-success" id="ship_order">Ship Order</button>
                                                <?php elseif ($order->status == 'shipped') : ?>
                                                    <button class="btn btn-sm btn-success" id="delivered_order">Mark Order As Delivered</button>
                                                <?php endif ?>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <table>
                                    <tr>
                                        <td colspan="8" class="text-center">No order available</td>
                                    </tr>
                                </table>
                            <?php endif ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php if (($this->auth->admin_perm_auth('orders', 'edit', true))) : ?>
        <?php if ($order->order_status !== 'verified') : ?>
            <script>
                $("#inputStatusSelect").change(function() {
                    $(this).closest('div').hide();
                    $('#loadingSpinner').show();
                    do_ajax(`<?= current_url() . "/order_status/" ?>${$(this).val()}`)
                });
            </script>
        <?php endif ?>


        <script>
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-outline-success m-2',
                    cancelButton: 'btn btn-outline-danger m-2'
                },
                buttonsStyling: false
            })

            <?php if (!in_array($order->status, ['delivered', 'cancelled'])) : ?>
                $("#cancel_order").on('click', function() {
                    swalWithBootstrapButtons.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, cancel it!',
                        cancelButtonText: 'No!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            do_ajax('<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/cancel_it/{$order->id}") ?>', null, this, true);
                        }
                    })
                })
            <?php endif ?>
            <?php if ($order->order_status == 'verified') : ?>
                <?php if ($order->status == 'placed') : ?>
                    $("#prepare_order").on('click', function() {
                        swalWithBootstrapButtons.fire({
                            title: 'Set in progress mode?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, do it!',
                            cancelButtonText: 'No!',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                do_ajax('<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/in_progress/{$order->id}") ?>', null, this, true);
                            }
                        })
                    })
                <?php elseif ($order->status == 'in progress') : ?>
                    $("#ship_order").on('click', function() {
                        swalWithBootstrapButtons.fire({
                            title: 'Set in progress mode?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, do it!',
                            cancelButtonText: 'No!',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                do_ajax('<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/shipped/{$order->id}") ?>', null, "#ship_order", true);
                            }
                        })
                    })
                <?php elseif ($order->status == 'shipped') : ?>
                    $("#delivered_order").on('click', function() {
                        swalWithBootstrapButtons.fire({
                            title: 'Set in progress mode?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, do it!',
                            cancelButtonText: 'No!',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                do_ajax('<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/delivered/{$order->id}") ?>', null, this, true);
                            }
                        })
                    })
                <?php endif ?>
            <?php endif ?>

            <?php if (($order->payment_status == 'unpaid')) : ?>
                $("#pay_order").on('click', function() {
                    swalWithBootstrapButtons.fire({
                        title: 'Mark it as paid now?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, do it!',
                        cancelButtonText: 'No!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            do_ajax('<?= base_url("dashboard/orders/pay_now/{$order->id}") ?>', null, this, true);
                        }
                    })
                })
            <?php endif ?>

            <?php if (($order->payment_status == 'paid')) : ?>
                $("#unpay_now").on('click', function() {
                    swalWithBootstrapButtons.fire({
                        title: 'Mark it as unpaid now?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, do it!',
                        cancelButtonText: 'No!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            do_ajax('<?= base_url("dashboard/orders/unpay_now/{$order->id}") ?>', null, this, true);
                        }
                    })
                })
            <?php endif ?>
        </script>

    <?php endif ?>

    <?php if (($this->auth->admin_perm_auth('reviews', 'edit', true))) : ?>
        <?php if ($order->status == 'delivered') : ?>
            <?= set_custom_footer("
            <script>
            $('.write-a-review').on('click', function() {
                $('#review-modal').modal('show');
            });

            $('.review-submit').on('click', function(e) {
                e.preventDefault();

                if ($(e.target).is(':submit:disabled'))
                    return false;

                var form_id = $('#review-form').attr('id');
                var form_url = $('#review-form').attr('action');
                calling_ajax(form_url, form_id, this, true)
            });
            </script>
            ")
            ?>
        <?php endif ?>
    <?php endif ?>
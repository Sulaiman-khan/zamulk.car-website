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
                    <form id="deleteForm">
                        <div class="row">
                            <?php if ($item_images) : ?>
                                <?php foreach ($item_images as $item_image) : ?>
                                    <div class="col-md-2">
                                        <div style="position: relative;">
                                            <button type="button" class="btn btn-sm btn-danger" style="position: absolute; top:0; right:0; " data-delete-url="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/delete_item/image/{$item_image->id}") ?>"><i class="fas fa-trash"></i></button>
                                            <img class="img-thumbnail" src="<?= images_url("products/items/" . image("public/images/products/items/", $item_image->image)) ?>" alt="<?= $item->title ?>">
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php endif ?>
                        </div>
                    </form>
                </div>
            </div>
            <form method="post" id="updateForm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="images_uploader">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="text" id="inputtitle" class="form-control" name="title" value="<?= input_print($item->title) ?>" placeholder="Enter item title...">
                            <label for="inputtitle">Item Title</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="text" id="inputsku" class="form-control" name="sku" value="<?= input_print($item->sku) ?>" placeholder="Enter item sku/code">
                            <label for="inputsku">Item sku/code</label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <div class="text-area">
                                <textarea name="description" placeholder="Entry description for this item" id="editor" style="height: 250px;"><?= input_print($item->description) ?></textarea>
                            </div>
                        </div>
                    </div>
                    <?php if ($product) : ?>
                        <?php if ($item->includes) : ?>
                            <?php $includes = json_decode($item->includes, true) ?>
                            <?php foreach (json_decode($item->includes, true) as $include) : ?>
                                <?php if (isset($include['tag'])) : ?>
                                    <?php if ($include['tag'] == 'input') : ?>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="<?= $include['type'] ?>" class="form-control" id="input<?= $include['name'] ?>" name="<?= $include['name'] ?>" placeholder="<?= $include['placeholder'] ?>" value="<?= $include["checked"] ?>" <?= ($include['required']) ? 'required' : '' ?>>
                                                <label for="input<?= $include['name'] ?>"><?= $include['label'] ?></label>
                                            </div>
                                        </div>
                                    <?php endif ?>

                                    <?php if ($include['tag'] == 'select') : ?>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <select name="<?= $include['name'] ?>" class="form-select" id="input<?= $include['name'] ?>" <?= ($include['required']) ? 'required' : '' ?>>
                                                    <option selected disabled><?= $include['placeholder'] ?></option>
                                                    <?php foreach ($include['value'] as $value) : ?>
                                                        <option value="<?= $value ?>" <?= ($include["checked"] == $value) ? "selected" : "" ?>><?= $value ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <label for="input<?= $include['name'] ?>"><?= $include['label'] ?></label>
                                            </div>
                                        </div>
                                    <?php endif ?>

                                    <?php if ($include['tag'] == 'checkbox') : ?>
                                        <div class="col-lg-6">
                                            <h3><?= ucwords($include['label']) ?></h3>
                                            <?php foreach ($include['value'] as $value) : ?>
                                                <div class="form-floating mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="<?= $include['name'] ?>[]" value="<?= $value ?>" id="<?= $include['name'] ?>-<?= $value ?>" <?= (in_array($value, $include["checked"])) ? "checked" : "" ?>>
                                                        <label class="form-check-label" for="<?= $include['name'] ?>-<?= $value ?>">
                                                            <?= ucfirst($value) ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    <?php endif ?>

                                    <?php if ($include['tag'] == 'radio') : ?>
                                        <div class="col-lg-6">
                                            <h3><?= ucwords($include['label']) ?></h3>
                                            <?php foreach ($include['value'] as $value) : ?>
                                                <div class="form-floating mb-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="<?= $include['name'] ?>" value="<?= $value ?>" <?= ($include["checked"] == $value) ? "checked" : "" ?>>
                                                            <?= ucfirst($value) ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    <?php endif ?>
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php endif ?>
                    <?php endif ?>

                    <?php if ($item->product_id == 1) : ?>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="int" id="inputwidth" class="form-control" name="width" value="<?= input_print($item->width) ?>" placeholder="Enter width in cm">
                                <label for="inputwidth">Width</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="int" id="inputbreadth" class="form-control" name="breadth" value="<?= input_print($item->breadth) ?>" placeholder="Enter breadth in cm">
                                <label for="inputbreadth">Breadth</label>
                            </div>
                        </div>
                    <?php endif ?>

                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="number" id="inputquantity" class="form-control" name="quantity" value="<?= input_print($item->quantity) ?>" placeholder="Enter quantity">
                            <label for="inputquantity">Quantity</label>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-floating mb-3">
                            <input type="number" id="inputprice" class="form-control" name="price" value="<?= input_print($item->price) ?>" placeholder="Enter price each quantity">
                            <label for="inputprice">Price each quantity</label>
                        </div>
                    </div>


                    <div class="col-lg-3">
                        <div class="form-group form-floating">
                            <input type="number" class="form-control" min="0.00" step="0.01" name="weight" value="<?= input_print($item->weight) ?>" placeholder="Enter weight in KG">
                            <label for="floatingInput">Enter weight in KG</label>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-floating mb-3">
                            <input type="number" id="inputshipping_fee" class="form-control" name="shipping_fee" value="<?= input_print($item->shipping_fee) ?>" placeholder="Enter shipping fee">
                            <label for="inputshipping_fee">Shipping Fee</label>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-floating mb-3">
                            <input type="number" id="inputdiscount" class="form-control" name="discount" value="<?= input_print($item->discount) ?>" placeholder="Discount or Leave it empty!">
                            <label for="inputdiscount">Discount</label>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="inputdiscount_type" name="discount_type" <?= (!$item->discount) ? "disabled" : "" ?>>
                                <option selected disabled>Discount Type</option>
                                <option value="percentage" <?= ($item->discount_type == 'percentage') ? 'selected' : '' ?>>Percentage</option>
                                <option value="price" <?= ($item->discount_type == 'price') ? 'selected' : '' ?>>Price</option>
                            </select>
                            <label for="inputdiscount_type">Discount Type</label>
                        </div>
                    </div>
                    <div class="row  mt-3">
                        <div class="col-lg-2">
                            <h3>Whole Sale</h3>
                            <div class="form-floating mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="allow_wholesale" value="1" <?= (isset($item->wholesale_price, $item->wholesale_min_quantity)) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Allow Whole Sale</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-floating mb-3" <?= (!isset($item->wholesale_price, $item->wholesale_min_quantity)) ? 'disabled style="display:none;"' : '' ?>>
                                <input type="number" class="form-control" id="inputwholesale_min_quantity" name="wholesale_min_quantity" value="<?= input_print($item->wholesale_min_quantity) ?>" placeholder="Enter whole sale min quantity">
                                <label for="inputwholesale_min_quantity">Wholesale Min Quantity</label>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-floating mb-3" <?= (!isset($item->wholesale_price, $item->wholesale_min_quantity)) ? 'disabled style="display:none;"' : '' ?>>
                                <input type="number" class="form-control" id="inputwholesale_price" name="wholesale_price" value="<?= input_print($item->wholesale_price) ?>" placeholder="Enter whole sale price each quantity">
                                <label for="inputwholesale_price">Wholesale Price</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <button class="btn btn-primary" type="button">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

set_custom_footer('
<link rel="stylesheet" href="' . assets_url('vendor/drag-drop-image/image-uploader.min.css') . '">
');

set_custom_footer('
<script src="' . assets_url('vendor/drag-drop-image/image-uploader.min.js') . '"></script>
');

set_custom_footer('
<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
');

set_custom_footer("<script>
    $('input[name=discount]').on('keyup', function(e) {
        if ($(this).val().length !== 0) {
            $('select[name=discount_type]').attr('disabled', false);
        } else {
            $('select[name=discount_type]').attr('disabled', true);
        }
    });
    
    $('input[name=allow_wholesale]').change(function() {
        if ($(this).is(':checked')) {
            $('input[name=wholesale_min_quantity]').closest('div').show();
            $('input[name=wholesale_price]').closest('div').show();
            $('input[name=wholesale_min_quantity]').attr('disabled', false);
            $('input[name=wholesale_price]').attr('disabled', false);
        } else {
            $('input[name=wholesale_min_quantity]').closest('div').hide();
            $('input[name=wholesale_price]').closest('div').hide();
            $('input[name=wholesale_min_quantity]').attr('disabled', true);
            $('input[name=wholesale_price]').attr('disabled', true);
        }
    });
</script>
");

?>
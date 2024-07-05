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
                <div class="col-lg-3 mx-auto">
                    <?php
                    $status = ['pending verification' => 'warning', 'pending' => 'warning', 'active' => 'success', 'blocked' => 'danger', 'suspended' => 'info'];
                    ?>
                    <div class="d-grid gap-2 mx-auto">
                        <span class="btn btn-lg btn-outline-<?= $status[$user->status] ?> disabled hidden" id="loadingSpinner">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Updating...
                        </span>
                    </div>
                    <div class="form-floating mb-3">
                        <select id="inputStatusSelect" class="form-control text-start
                            btn btn-outline-<?= $status[$user->status] ?>" name="status">
                            <option value="<?= str_replace(' ', '-', strtolower('pending verification')) ?>" <?= ($user->status == strtolower('pending verification')) ? 'selected' : '' ?>><?= ucwords('pending verification') ?></option>
                            <option value="<?= strtolower('pending') ?>" <?= ($user->status == strtolower('pending')) ? 'selected' : '' ?>><?= ucwords('pending') ?></option>
                            <option value="<?= strtolower('active') ?>" <?= ($user->status == strtolower('active')) ? 'selected' : '' ?>><?= ucwords('active') ?></option>
                            <option value="<?= strtolower('blocked') ?>" <?= ($user->status == strtolower('blocked')) ? 'selected' : '' ?>><?= ucwords('blocked') ?></option>
                            <option value="<?= strtolower('suspended') ?>" <?= ($user->status == strtolower('suspended')) ? 'selected' : '' ?>><?= ucwords('suspended') ?></option>
                        </select>
                        <label for="inputStatusSelect">Status</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="text-center mb-3">
                        <span class="text-center btn btn-primary disabled">User Profile</span>
                    </div>
                    <form id="updateUserForm" action="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/user_update/{$user->id}") ?>" method="POST">
                        <div class="row">
                            <div class="col-lg-6 text-end">
                                <label for="formUserFile" style="cursor: pointer;">
                                    <input class="form-control" type="file" name="image" id="formUserFile" style="display: none;">
                                    <img class="img-thumbnail" id="formUserImage" style="height: 60px;" src="<?= images_url("users/" . image("public/images/users/", $user->image)) ?>" alt="<?= input_print($user->first_name) ?>">
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputemail" type="text" name="email" value="<?= input_print($user->email) ?>" placeholder="Entry user email...!" required="required" readonly>
                                    <label for="inputemail">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputfirst_name" type="text" name="first_name" value="<?= input_print($user->first_name) ?>" placeholder="Entry first name...!" required="required">
                                            <label for="inputfirst_name">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputlast_name" type="text" name="last_name" value="<?= input_print($user->last_name) ?>" placeholder="Entry last name...!" required="required">
                                            <label for="inputlast_name">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputaddress" type="text" name="address" value="<?= input_print($user->address) ?>" placeholder="Entry user address...!" required="required">
                                    <label for="inputaddress">Address</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputcity" type="text" name="city" value="<?= input_print($user->city) ?>" placeholder="Entry user city...!" required="required">
                                    <label for="inputcity">City</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputstate" type="text" name="province" value="<?= input_print($user->province) ?>" placeholder="Entry user province...!" required="required">
                                    <label for="inputstate">Province</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputcountry" type="text" name="country" value="<?= input_print($user->country) ?>" placeholder="Entry user country...!" required="required">
                                    <label for="inputcountry">Country</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputphone" type="text" name="phone" value="<?= input_print($user->phone) ?>" placeholder="Entry user phone...!" required="required">
                                    <label for="inputphone">Phone</label>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <hr>
                                <span class="text-muted">To change password fill these</span>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputnew_password" type="text" name="new_password" value="" placeholder="Entry new password...!" required="required">
                                            <label for="inputnew_password">New Password</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputconfirm_new_password" type="text" name="confirm_new_password" value="" placeholder="Entry new password again...!" required="required">
                                            <label for="inputconfirm_new_password">Confirm New Password</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-primary" type="button">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>

                <?php if ($user->shop_id) : ?>
                    <div class="col-lg-6">
                        <div class="text-center mb-3">
                            <span class="text-center btn btn-primary disabled">Shop Profile</span>
                        </div>
                        <form id="updateShopForm" action="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/shop_update/{$user->id}") ?>" method="POST">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputshop_name" type="text" name="shop_name" value="<?= input_print($user->shop_name) ?>" placeholder="Entry shop name...!" required="required">
                                        <label for="inputshop_name">Shop Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="formShopFile" style="cursor: pointer;">
                                        <input class="form-control" type="file" name="image" id="formShopFile" style="display: none;">
                                        <img class="img-thumbnail" id="formShopImage" style="height: 60px;" src="<?= images_url("shops/" . image("public/images/shops/", $user->shop_image)) ?>" alt="<?= input_print($user->shop_name) ?>">
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputshop_address" type="text" name="shop_address" value="<?= input_print($user->shop_address) ?>" placeholder="Entry shop address...!" required="required">
                                        <label for="inputshop_address">Shop Address</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputshop_city" type="text" name="shop_city" value="<?= input_print($user->shop_city) ?>" placeholder="Entry shop city...!" required="required">
                                        <label for="inputshop_city">Shop City</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputshop_province" type="text" name="shop_province" value="<?= input_print($user->shop_province) ?>" placeholder="Entry shop province...!" required="required">
                                        <label for="inputshop_province">Shop Province</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputshop_country" type="text" name="shop_country" value="<?= input_print($user->shop_country) ?>" placeholder="Entry shop country...!" required="required">
                                        <label for="inputshop_country">Shop Country</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputshop_phone" type="text" name="shop_phone" value="<?= input_print($user->shop_phone) ?>" placeholder="Entry shop phone...!" required="required">
                                        <label for="inputshop_phone">Shop Phone</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 ">
                                    <div class="mb-3">
                                        <textarea name="shop_overview" placeholder="Shop Overview" id="editor" style="height: 50px;"><?= input_print($user->shop_overview) ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div style="width: 100%">
                                            <div class="img-thumbnail">
                                                <div id="map" style="width: 100%; height: 300px;"></div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="shop_lat" value="<?= input_print($user->shop_lat) ?>">
                                        <input type="hidden" name="shop_lon" value="<?= input_print($user->shop_lon) ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-primary" type="button">Update Shop</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?php if ($user->shop_id) : ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<?php endif ?>

<script>
    $("#inputStatusSelect").change(function() {
        $(this).closest('div').hide();
        $('#loadingSpinner').show();
        do_ajax(`<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/user_status/{$user->id}/") ?>${$(this).val()}`)
    });
</script>

<script>
    $("#formUserFile").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#formUserImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    <?php if ($user->shop_id) : ?>
        $("#formShopFile").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#formShopImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        // MAP init
        var center = [<?= "{$user->shop_lat}, {$user->shop_lon}" ?>];

        // Set up the OSM layer
        var grayscale = L.tileLayer(
                'http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>',
                    maxZoom: 20,
                }),
            streets = L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a>',
                    maxZoom: 18,
                }),
            googleMap = L.tileLayer(
                'https://mt1.google.com/vt/lyrs=r&x={x}&y={y}&z={z}', {
                    attribution: 'Google Map',
                    maxZoom: 20,
                }),
            googleSatellite = L.tileLayer(
                'https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
                    attribution: 'Google Satelite',
                    maxZoom: 20,
                }),
            darkmode = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="http://cartodb.com/attributions">CartoDB</a>',
                maxZoom: 20,
            });

        // Create the map
        var map = L.map('map', {
            fullscreenControl: {
                pseudoFullscreen: false
            },
            layers: [googleMap]
        }).setView(center, 15);

        // add a marker in the given location
        var marker = new L.marker(center, {
            draggable: true
        }).addTo(map);

        L.control.layers({
            "Grayscale": grayscale,
            "Streets": streets,
            "Google Map": googleMap,
            "Google Satellite": googleSatellite,
            "Dark Mode": darkmode,
        }).addTo(map);

        marker.on('dragend', function(e) {
            $("input[name=shop_lat]").val(marker.getLatLng().lat);
            $("input[name=shop_lon]").val(marker.getLatLng().lng);
        });

        $("input[name=shop_lat]").val(marker.getLatLng().lat);
        $("input[name=shop_lon]").val(marker.getLatLng().lng);
    <?php endif ?>
</script>
<?php

set_custom_footer('
<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
');

?>
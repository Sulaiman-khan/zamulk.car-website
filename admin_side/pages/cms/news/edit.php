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
                            <div class="col-md-2">
                                <div style="position: relative;">
                                    <img class="img-thumbnail" src="<?= images_url("news/" . image("public/images/news/", $query->image)) ?>" alt="<?= $query->title ?>">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <form method="post" id="addForm">
                <div class="row">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="image_uploader">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputtitle" type="text" name="title" value="<?= $query->title ?>" placeholder="Entry unique query...!" required="required">
                            <label for="inputtitle">Title</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputslug" type="text" name="slug" value="<?= $query->slug ?>" placeholder="Entry unique slug...!" required="required">
                            <label for="inputslug">Slug</label>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <div class="text-area">
                                <textarea name="description" placeholder="Entry description for this item" id="editor" style="height: 350px;"><?= $query->description ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-primary" type="button">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php

set_custom_footer('
<script>
    $("input[name=title]").on("keyup", function() {
        $("input[name=slug]").val(slugMaker($(this).val()));
    })

    function slugMaker(str) {
        return str.replace(/[^a-zA-Z0-9]/g, "-").toLowerCase();
    }
</script>
');

set_custom_footer('
<link rel="stylesheet" href="' . assets_url('vendor/drag-drop-image/image-uploader.min.css') . '">
');

set_custom_footer('
<script src="' . assets_url('vendor/drag-drop-image/image-uploader.min.js') . '"></script>
');

set_custom_footer('
<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
');

?>
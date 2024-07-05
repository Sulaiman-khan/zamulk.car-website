<div class="container-fluid px-4">
    <h1 class="mt-4"><?= (isset($title)) ? $title : "" ?></h1>
    <?php if (isset($subtitle)) : ?>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?= $subtitle ?></li>
        </ol>
    <?php endif ?>
    <div class="row">
        <div class="container">
            <form method="post" id="updateForm">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputtitle" type="text" name="title" value="<?= input_print($query->title) ?>" placeholder="Entry unique query...!" required="required">
                            <label for="inputtitle">Title</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputslug" type="text" name="slug" value="<?= input_print($query->slug) ?>" placeholder="Entry unique slug...!" required="required">
                            <label for="inputslug">Slug</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <div class="text-area">
                                <textarea name="description" placeholder="Entry description for this item" id="editor" style="height: 250px;"><?= input_print($query->description) ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-primary" type="button">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

set_custom_footer('
<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
');

?>
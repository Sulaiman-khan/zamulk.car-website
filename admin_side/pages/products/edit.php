<style>
    .box.over {
        border: 3px dotted #666;
     }
</style>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= (isset($title)) ? $title : "" ?></h1>
    <?php if (isset($subtitle)) : ?>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?= $subtitle ?></li>
        </ol>
    <?php endif ?>
    <div class="row">
        <div class="text-end mb-2">
            <button class="btn btn-primary" onclick="addFields()">Add Field</button>
        </div>
        <div class="modal fade " id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-lg-down">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">Add New Field</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" name="new-name" id="input-new-name">
                                        <label for="input-new-name">Name of Field</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" name="new-label" id="input-new-label">
                                        <label for="input-new-label">Label of Field</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="text" name="new-placeholder" id="input-new-placeholder">
                                        <label for="input-new-placeholder">New Placeholder</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <select name="new-required" id="input-new-required" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        <label for="input-new-required">Required?</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <select name="new-select-tag" id="input-new-select-tag" class="form-control" disabled>
                                            <option selected disabled>No Field Selected</option>
                                            <option value="radio">Radio Field</option>
                                            <option value="checkbox">Checkbox Field</option>
                                            <option value="select">Select Field</option>
                                            <option value="input">Input Field</option>
                                        </select>
                                        <label for="input-new-select-tag">Select A Field</label>
                                    </div>
                                </div>
                                <input type="hidden" name="fields" value="0">
                                <input type="hidden" name="field_name" value="">
                                <input type="hidden" name="edit_fields" value="0">

                                <div class="col-lg-12 text-center">
                                    <div class="row" id="fields-values">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" onclick="add_to_form_fields()">Add To Form</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container">
            <form method="post" id="updateForm">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputtitle" type="text" name="title" value="<?= input_print($query->title) ?>" placeholder="Entry unique title...!" required="required">
                            <label for="inputtitle">Product Title</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="mb-3">
                                    <label for="formFile">Product Image</label>
                                    <input class="form-control" type="file" name="image" id="formFile">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <img class="img-thumbnail" id="formImage" style="height: 60px;" src="<?= images_url("products/main/" . image("public/images/products/main/", $query->image)) ?>" alt="<?= input_print($query->title) ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-floating mb-3">
                            <textarea name="description" id="inputdescription" class="form-control" style="height: 100px" placeholder="Entry description for this product...!" required="required"><?= input_print($query->description) ?></textarea>
                            <label for="inputdescription">Product Description</label>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center extrafield-container">
                        <!-- <hr> -->
                        <span class="text-muted">Extra fields</span>
                        <hr>
                    </div>
                    
                    <div class="col-lg-12">
                        <div id="otherfields" class="row">
                            <?php
                            if (!empty($query->includes)) :
                                $includes = json_decode($query->includes);
                                foreach ($includes as $inc_opt) :
                                    $inc_values = (isset($inc_opt->value)) ? json_decode(json_encode($inc_opt->value)) : [];
                                    $rowspan = count($inc_values) + ((isset($inc_opt->type)) ? 6 : 5);
                            ?>
                                    <div class="col-lg-6 class_<?= $inc_opt->name ?> box" draggable="true">
                                        <table class="table table-light">
                                            <tbody>
                                                <tr>
                                                    <th>Name</th>
                                                    <td><?= $inc_opt->name ?></td>
                                                    <td class="rowspan" style="vertical-align : middle;text-align:center;" rowspan="<?= $rowspan ?>">
                                                        <a class="btn btn-sm btn-primary" role="button" onclick="editFields('.input_field_<?= $inc_opt->name ?>', '<?= $inc_opt->name ?>')"><i class="fas fa-pencil" aria-hidden="true"></i></a>
                                                        <a class="btn btn-sm btn-danger" role="button" onclick="removeField(this)"><i class="fas fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Label</th>
                                                    <td><?= $inc_opt->label ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tag</th>
                                                    <td><?= $inc_opt->tag ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Placeholder</th>
                                                    <td><?= (isset($inc_opt->placeholder)) ? $inc_opt->placeholder : $inc_opt->label ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Required</th>
                                                    <td><?= ($inc_opt->required) ? 'Yes' : 'No' ?></td>
                                                </tr>
                                                <?php if (isset($inc_values)) : ?>
                                                    <?php foreach ($inc_values as $key => $inc_value) : ?>
                                                        <tr>
                                                            <th>Value <?= $key + 1 ?></th>
                                                            <td><?= $inc_value ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <?php if (isset($inc_opt->type)) : ?>
                                                    <tr>
                                                        <th>Type</th>
                                                        <td><?= $inc_opt->type ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <div class="class_input_<?= $inc_opt->name ?>">
                                            <input type="hidden" class="input_field_<?= $inc_opt->name ?>" name="extra_field[<?= input_print($inc_opt->name) ?>][name]" value="<?= input_print($inc_opt->name) ?>">
                                            <input type="hidden" class="input_field_<?= $inc_opt->name ?>" name="extra_field[<?= input_print($inc_opt->name) ?>][tag]" value="<?= input_print($inc_opt->tag) ?>">
                                            <input type="hidden" class="input_field_<?= $inc_opt->name ?>" name="extra_field[<?= input_print($inc_opt->name) ?>][placeholder]" value="<?= input_print((isset($inc_opt->placeholder)) ? $inc_opt->placeholder : $inc_opt->label) ?>">
                                            <input type="hidden" class="input_field_<?= $inc_opt->name ?>" name="extra_field[<?= input_print($inc_opt->name) ?>][label]" value="<?= input_print($inc_opt->label) ?>">
                                            <input type="hidden" class="input_field_<?= $inc_opt->name ?>" name="extra_field[<?= input_print($inc_opt->name) ?>][required]" value="<?= input_print($inc_opt->required) ?>">
                                            <?php if (isset($inc_values)) : ?>
                                                <?php foreach ($inc_values as $key => $inc_value) : ?>
                                                    <input type="hidden" class="input_field_<?= $inc_opt->name ?>" name="extra_field[<?= input_print($inc_opt->name) ?>][value][]" value="<?= input_print($inc_value) ?>">
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <?php if (isset($inc_opt->type)) : ?>
                                                <input type="hidden" class="input_field_<?= $inc_opt->name ?>" name="extra_field[company][type]" value="<?= input_print($inc_opt->type) ?>">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                            <?php
                                endforeach;
                            endif;
                            ?>
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


<script>
    function addFields() {
        clear_fields();
        $('#exampleModalToggle').modal('show');
    }

    function editFields(input_field, name) {
        clear_fields();
        $('#exampleModalToggle').modal('show');
        $('input[name=edit_fields]').val(1);
        $("#exampleModalToggleLabel").text('Edit Field');

        var inputs = $(input_field);
        console.log(inputs)
        for (var i = 0; i < inputs.length; i++) {
            $attrs = getAttributes($(inputs[i]));
            console.log($attrs)

            var new_attrs = {};
            new_attrs[$attrs.name] = $attrs.value;
            fillField($attrs, name);
        }
    }

    function fillField(attrs, name) {
        if (attrs.name == `extra_field[${name}][name]`) {
            $("input[name='new-name']").val(attrs.value);
            $("input[name='field_name']").val(attrs.value);
        }

        if (attrs.name == `extra_field[${name}][tag]`)
            $("input[name='new-select-tag']").val(attrs.value);

        if (attrs.name == `extra_field[${name}][placeholder]`)
            $("input[name='new-placeholder']").val(attrs.value);

        if (attrs.name == `extra_field[${name}][label]`)
            $("input[name='new-label']").val(attrs.value);

        if (attrs.name == `extra_field[${name}][required]`)
            $("select[name='new-required']").val(attrs.value);

        if (attrs.name == `extra_field[${name}][tag]`) {
            $("select[name='new-select-tag']").val(attrs.value);
            $("#input-new-select-tag").attr('disabled', false);
            $('#fields-values').html('');
            if ($("select[name='new-select-tag']").val() == 'input') {
                generateBoxes($("select[name='new-select-tag']").val());
            }
        }

        if (attrs.name == `extra_field[${name}][type]`)
            $("select[name='new-type']").val(attrs.value);

        if (attrs.name == `extra_field[${name}][value][]`) {
            var fields = $('input[name=fields]');
            let fields_values = $('#fields-values');
            add_new_input_field(attrs.value);
        }
    }

    function removeDiv(div_class) {
        $(div_class).remove();
    }

    function getAttributes($node) {
        var attrs = {};
        $.each($node[0].attributes, function(index, attribute) {
            attrs[attribute.name] = attribute.value;
        });

        return attrs;
    }

    document.addEventListener('DOMContentLoaded', (event) => {

        var dragSrcEl = null;

        function handleDragStart(e) {
            this.style.opacity = '0.4';

            dragSrcEl = this;

            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/html', this.innerHTML);
        }

        function handleDragOver(e) {
            if (e.preventDefault) {
                e.preventDefault();
            }

            e.dataTransfer.dropEffect = 'move';

            return false;
        }

        function handleDragEnter(e) {
            this.classList.add('over');
        }

        function handleDragLeave(e) {
            this.classList.remove('over');
        }

        function handleDrop(e) {
            if (e.stopPropagation) {
                e.stopPropagation(); // stops the browser from redirecting.
            }

            if (dragSrcEl != this) {
                dragSrcEl.innerHTML = this.innerHTML;
                this.innerHTML = e.dataTransfer.getData('text/html');
            }

            return false;
        }

        function handleDragEnd(e) {
            this.style.opacity = '1';

            items.forEach(function(item) {
                item.classList.remove('over');
            });
        }


        let items = document.querySelectorAll('#otherfields .box');
        items.forEach(function(item) {
            item.addEventListener('dragstart', handleDragStart, false);
            item.addEventListener('dragenter', handleDragEnter, false);
            item.addEventListener('dragover', handleDragOver, false);
            item.addEventListener('dragleave', handleDragLeave, false);
            item.addEventListener('drop', handleDrop, false);
            item.addEventListener('dragend', handleDragEnd, false);
        });
    });
</script>
<script>
    $("#formFile").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#formImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    function clear_fields() {
        $("#exampleModalToggleLabel").text('Add New Field');
        $("input[name='new-name']").val('');
        $("input[name='new-label']").val('');
        $("input[name='new-placeholder']").val('');
        $("input[name='field_name']").val('');
        $("#input-new-select-tag").val('No Field Selected');
        $("#input-new-select-tag").attr('disabled', true);
        $('input[name=fields]').val(0);
        $('input[name=edit_fields]').val(0);
        $('#fields-values').html('');
        $('.modal').modal('hide');
        $('.extrafield-container').show();
    }

    function add_to_form_fields() {
        if (
            ($("input[name='new-name']").val() !== '') &&
            ($("input[name='new-label']").val() !== '') &&
            ($("input[name='new-placeholder']").val() !== '') &&
            ($("input[name='fields']").val() !== '0') &&
            ($("input[name='field_name']").val() !== '')
        ) {
            let field_values = [];
            let field_tag = ($('#input-new-select-tag').val());
            let field_name = $('input[name=field_name]').val();
            let field_placeholder = ($('input[name=new-placeholder]').val());
            let field_label = ($("input[name='new-label']").val());
            let field_required = ($("#input-new-required").val());
            let is_field_required = ($("#input-new-required").val() == '1') ? 'Yes' : 'No';


            if ($('input[name=edit_fields]').val() == 1) {
                $(`.class_${field_name}`).remove()
            } else {
                if ($(`.class_${field_name}`)[0]) {
                    // Do something if class exists
                    alert("Field name already exists!");
                    return;
                }
            }

            if (field_tag == 'input') {
                let field_type = removeSpecialCharacters($("select[name=new-type]").val());

                $("#otherfields").append(`
                        <div class="col-lg-6 class_${field_name}">
                            <table class="table table-light">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>${field_name}</td>
                                        <td class="rowspan" rowspan="5" style="vertical-align : middle;text-align:center;">
                                            <a class="btn btn-sm btn-primary" role="button" onclick="editFields('.input_field_${field_name}', '${field_name}')"><i class="fas fa-pencil" aria-hidden="true"></i></a>
                                            <a class="btn btn-sm btn-danger" role="button" onclick="removeField(this)"><i class="fas fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Label</th>
                                        <td>${field_label}</td>
                                    </tr>
                                    <tr>
                                        <th>Tag</th>
                                        <td>${field_tag}</td>
                                    </tr>
                                    <tr>
                                        <th>Placeholder</th>
                                        <td>${field_placeholder}</td>
                                    </tr>
                                    <tr>
                                        <th>Required</th>
                                        <td>${is_field_required}</td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td>${field_type}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="class_input_${field_name}">
                                <input type="hidden" class="input_field_${field_name}" name="extra_field[${field_name}][name]" value="${field_name}">
                                <input type="hidden" class="input_field_${field_name}" name="extra_field[${field_name}][tag]" value="${field_tag}">
                                <input type="hidden" class="input_field_${field_name}" name="extra_field[${field_name}][placeholder]" value="${field_placeholder}">
                                <input type="hidden" class="input_field_${field_name}" name="extra_field[${field_name}][label]" value="${field_label}">
                                <input type="hidden" class="input_field_${field_name}" name="extra_field[${field_name}][required]" value="${field_required}">
                                <input type="hidden" class="input_field_${field_name}" name="extra_field[${field_name}][type]" value="${field_type}">
                            </div>
                        </div>
                    `);

                $(`div.class_${field_name} table tbody tr .rowspan`).attr('rowspan', $(`div.class_${field_name} table tbody tr`).length);

                clear_fields();
                successMessage(`New ${field_tag} field added`);
                return;
            } else {
                for (var i = 1; i <= parseInt($("input[name='fields']").val()); i++)
                    if ($(`input[name='new-input-${i}']`).length > 0 && $(`input[name='new-input-${i}']`).val() !== '')
                        field_values.push($(`input[name='new-input-${i}']`).val())

                if (field_values.length > 0) {
                    $("#otherfields").append(`
                        <div class="col-lg-6 class_${field_name}">
                            <table class="table table-light">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>${field_name}</td>
                                        <td class="rowspan" rowspan="5" style="vertical-align : middle;text-align:center;">
                                            <a class="btn btn-sm btn-primary" role="button" onclick="editFields('.input_field_${field_name}', '${field_name}')"><i class="fas fa-pencil" aria-hidden="true"></i></a>
                                            <a class="btn btn-sm btn-danger" role="button" onclick="removeField(this)"><i class="fas fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Label</th>
                                        <td>${field_label}</td>
                                    </tr>
                                    <tr>
                                        <th>Tag</th>
                                        <td>${field_tag}</td>
                                    </tr>
                                    <tr>
                                        <th>Placeholder</th>
                                        <td>${field_placeholder}</td>
                                    </tr>
                                    <tr>
                                        <th>Required</th>
                                        <td>${is_field_required}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="class_input_${field_name}">
                                <input type="hidden" class="input_field_${field_name}" name="extra_field[${field_name}][name]" value="${field_name}">
                                <input type="hidden" class="input_field_${field_name}" name="extra_field[${field_name}][tag]" value="${field_tag}">
                                <input type="hidden" class="input_field_${field_name}" name="extra_field[${field_name}][placeholder]" value="${field_placeholder}">
                                <input type="hidden" class="input_field_${field_name}" name="extra_field[${field_name}][label]" value="${field_label}">
                                <input type="hidden" class="input_field_${field_name}" name="extra_field[${field_name}][required]" value="${field_required}">
                            </div>
                        </div>
                    `);

                    $.each(field_values,
                        function(index, item) {
                            if (item.length > 0) {
                                $(`div.class_${field_name} table tbody`).append(`
                                        <tr>
                                            <th>Value ${parseInt(index)+1}</th>
                                            <td>${(item)}</td>
                                        </tr>
                                    `)
                                $(`div.class_input_${field_name}`).append(`
                                        <input type="hidden" class="input_field_${field_name}" name="extra_field[${field_name}][value][]" value="${(item)}">
                                    `)
                            }
                        });

                    $(`div.class_${field_name} table tbody tr .rowspan`).attr('rowspan', $(`div.class_${field_name} table tbody tr`).length);


                    clear_fields();
                    successMessage(`New ${field_tag} field added`);
                    return;
                }
            }

        }
        errorMessage('Please fill all the fields');
    }

    function add_new_input_field(value = '') {
        $("#add_new_input_field").remove();
        if (($("input[name='new-name']").val() !== '') && ($("input[name='new-label']").val() !== '') && ($("input[name='new-placeholder']").val() !== '')) {
            if (value == '')
                generateBoxes($("#input-new-select-tag").val());
            else
                generateBoxes($("#input-new-select-tag").val(), value);

        } else
            alert('error')
    }

    function generateBoxes(tag, value = '') {
        var fields = $('input[name=fields]');
        let fields_values = $('#fields-values');
        fields = fields.val(parseInt(fields.val()) + 1)
        var new_name = $("input[name='new-name']").val().replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
        $('input[name=field_name]').val(new_name);
        if (tag == 'input')
            fields_values.append(`
                <div class="col-lg-6">
                    <div class="form-floating mb-3">
                        <select name="new-type" class="form-control">
                            <option value="text">Text</option>
                            <option value="number">Number</option>
                        </select>
                        <label for="input-new-input">New Type</label>
                    </div>
                </div>
            `);
        else {
            if (value == '')
                fields_values.append(`
                    <div class="col-lg-6 new-input-div-${fields.val()}">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="new-input-${fields.val()}" id="input-new-input-${fields.val()}" >
                                    <label for="input-new-input">New Input Field-${fields.val()} ${new_name}</label>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <i class="fas fa-times text-danger" aria-hidden="true" style="cursor:pointer" onclick="removeDiv('.new-input-div-${fields.val()}')"></i>
                            </div>
                        </div>
                    </div>
                    <a role="button" class="btn btn-primary btn-sm btn-block" id="add_new_input_field" onclick="add_new_input_field()">+ New Input Field</a>
            `);
            else
                fields_values.append(`
                    <div class="col-lg-6 new-input-div-${fields.val()}">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="new-input-${fields.val()}" id="input-new-input-${fields.val()}" value="${value}">
                                    <label for="input-new-input">New Input Field-${fields.val()} ${new_name}</label>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <i class="fas fa-times text-danger" aria-hidden="true" style="cursor:pointer" onclick="removeDiv('.new-input-div-${fields.val()}')"></i>
                            </div>
                        </div>
                    </div>
                    <a role="button" class="btn btn-primary btn-sm btn-block" id="add_new_input_field" onclick="add_new_input_field()">+ New Input Field</a>
            `);

        }
    }

    $(function() {
        $("#exampleModalToggle").on('keyup', function() {
            if (($("input[name='new-name']").val() !== '') && ($("input[name='new-label']").val() !== '') && ($("input[name='new-placeholder']").val() !== '')) {
                $("#input-new-select-tag").attr('disabled', false);
                var new_name = $("input[name='new-name']").val().replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
                $('input[name=field_name]').val(new_name);
            } else {
                $("#input-new-select-tag").attr('disabled', true);
                $('input[name=fields]').val(0);
                $('#fields-values').html('');
            }
        })
        $("#new-required").on("change", function() {
            if (($("input[name='new-name']").val() !== '') && ($("input[name='new-label']").val() !== '') && ($("input[name='new-placeholder']").val() !== '')) {
                $("#input-new-select-tag").attr('disabled', false);
                var new_name = $("input[name='new-name']").val().replace(/[^a-zA-Z0-9]/g, '_').toLowerCase();
                $('input[name=field_name]').val(new_name);
            } else {
                $("#input-new-select-tag").attr('disabled', true);
                $('input[name=fields]').val(0);
                $('#fields-values').html('');
            }
        });

        $("#input-new-select-tag").on("change", function() {
            if (($("input[name='new-name']").val() !== '') && ($("input[name='new-label']").val() !== '') && ($("input[name='new-placeholder']").val() !== '')) {
                $('input[name=fields]').val(0);
                $('#fields-values').html('');
                generateBoxes($(this).val());
            } else
                alert('error')
        });
    })

    function removeField(field) {
        $(field).closest('div').remove();
    }

    function removeSpecialCharacters(str) {
        return str.replace(/[^a-zA-Z0-9 ]/g, '').toLowerCase();
    }
</script>
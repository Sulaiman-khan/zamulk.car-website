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
                <div class="col-lg-6">
                    <form method="get">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <input type="text" name="order_id" value="<?= input_print($this->input->get('order_id')) ?>" class="form-control" placeholder="Order id..." aria-label="Order id..." aria-describedby="basic-addon2">
                            </div>
                            <input type="text" name="query" value="<?= input_print($this->input->get('query')) ?>" class="form-control" placeholder="Email / message..." aria-label="Email / message..." aria-describedby="basic-addon2">
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
                    <th>Order ID</th>
                    <th>Seller</th>
                    <th>Reviewer</th>
                    <th>Reviewer Email</th>
                    <th>Rating</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($query) :  ?>
                    <?php foreach ($query as $row) : ?>
                        <tr>
                            <td><?= $row->id ?></td>
                            <td>
                                <?= isset($row->order_id) ? "<a href='" . base_url("{$this->uri->segment(1)}/orders/view/{$row->order_id}") . "'>{$row->order_id}</a>" : 'N/A' ?>
                            </td>
                            <td>
                                <?= isset($row->seller_first_name) ? "<a href='" . base_url("{$this->uri->segment(1)}/users/view/{$row->seller_id}") . "'>{$row->seller_first_name} {$row->seller_last_name}</a>" : 'N/A' ?>
                            </td>
                            <td>
                                <?= isset($row->first_name) ? "<a href='" . base_url("{$this->uri->segment(1)}/users/view/{$row->user_id}") . "'>{$row->first_name} {$row->last_name}</a>" : 'N/A' ?>
                            </td>
                            <td style="width:200px;"><?= input_print($row->email) ?></td>
                            <td>
                                <ul class="rating clearfix">
                                    <?= rating_stars($row->stars) ?> (<?= convert_price($row->total_stars, 0) ?>)
                                </ul>
                            </td>
                            <td style="width:200px;"><?= input_print($row->message) ?></td>
                            <td><?= date("d M, Y h:i:s A", strtotime($row->created_at)) ?></td>
                            <td>
                                <p>

                                    <?php if ($this->auth->admin_perm_auth('reviews', 'edit')) : ?>
                                        <span class="btn btn-success btn-sm view-review" data-url="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/view/{$row->id}") ?>" data-edit-url="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/edit/{$row->id}") ?>" data-bs-toggle="modal" data-bs-target="#modal-review-view"><i class="fas fa-edit"></i></span>
                                    <?php endif ?>

                                    <?php if ($this->auth->admin_perm_auth('reviews', 'delete')) : ?>
                                        <button type="button" class="btn btn-sm btn-danger delete_btn" data-delete-url="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/delete/{$row->id}") ?>"><i class="fas fa-trash"></i></button>
                                    <?php endif ?>
                                </p>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">No record available</td>
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



<?php if ($this->auth->admin_perm_auth('reviews', 'edit')) : ?>
    <div id="modal-review-view" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="#" id="review-form" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Edit Review</h5>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-3 mx-auto">
                            <div class="d-grid gap-2 mx-auto">
                                <span class="btn btn-lg btn-outline-success disabled">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Fetching...
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success review-submit" disabled>Update Review</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('.review-submit').on('click', function(e) {
            e.preventDefault();

            if ($(e.target).is(':submit:disabled'))
                return false;

            var form_id = $('#review-form').attr('id');
            var form_url = $('#review-form').attr('action');
            calling_ajax(form_url, form_id, this, true)
        });
    </script>
    <script>
        $(function() {
            $('.view-review').on('click', function() {
                $('#review-form').attr('action', $(this).attr('data-edit-url'))
                $.ajax({
                    type: "POST",
                    url: $(this).attr('data-url'),
                    data: {
                        id: $(this).attr('data-id')
                    },
                    beforeSend: function() {
                        $(".modal-body").html(`
                        <div class="col-lg-3 mx-auto">
                            <div class="d-grid gap-2 mx-auto">
                                <span class="btn btn-lg btn-outline-success disabled">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Fetching...
                                </span>
                            </div>
                        </div>
                    `);
                        $(".review-submit").attr('disabled', true);
                    },
                    success: function(data) {
                        $(".modal-body").html(data);
                        $(".review-submit").attr('disabled', false);
                    }
                });
            })
        })
    </script>
<?php endif ?>

<?php if ($this->auth->admin_perm_auth('reviews', 'delete')) : ?>
    <?= set_custom_footer("
<script>
    $('.delete_btn').on('click', function() {

        Swal.fire({
            title: 'Are you sure?',
            text: `You want to delete?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                do_ajax($(this).attr('data-delete-url'))
            }
        })
    });
</script>
")
    ?>
<?php endif ?>
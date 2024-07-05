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
                                <input type="text" name="email" value="<?= input_print($this->input->get('email')) ?>" class="form-control" placeholder="Search by email..." aria-label="Search by email..." aria-describedby="basic-addon2">
                            </div>
                            <input type="text" name="query" value="<?= input_print($this->input->get('query')) ?>" class="form-control" placeholder="Search by name or subject..." aria-label="Search by name or subject..." aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="input-group-text btn btn-primary" role="button" type="submit" id="basic-addon2">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <?php if ($this->auth->admin_perm_auth('email_logs', 'delete')) : ?>
                    <div class="col-lg-6 float-end">
                        <form id="deleteForm" class="float-end">
                            <button type="button" class="btn btn-primary btn-sm float-end" data-delete-url="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/delete_all") ?>">Clear All <i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status Message</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($query) : ?>
                    <?php foreach ($query as $row) : ?>
                        <tr>
                            <td><?= $row->id ?></td>
                            <td><?= isset($row->first_name) ? "<a href='" . base_url("{$this->uri->segment(1)}/users/view/{$row->user_id}") . "'>{$row->first_name} {$row->last_name}</a>" : 'N/A' ?></td>
                            <td><?= $row->recipient ?></td>
                            <td><?= $row->subject ?></td>
                            <td><?= date("d M, Y h:i:s A", strtotime($row->created_at)) ?></td>
                            <td style="width:200px;"><?= input_print($row->status_message) ?></td>
                            <td>
                                <span class="badge bg-<?= (strtolower($row->status) == 'delivered') ? 'success' : 'danger' ?>"><?= ucwords($row->status) ?></span>
                            </td>
                            <td>
                                <p>
                                <form id="deleteForm">
                                    <span class="btn btn-primary btn-sm view-email" data-title="<?= $row->subject ?>" data-email="<<?= "{$row->first_name} {$row->last_name}" ?>> <?= $row->recipient ?>" data-date="<?= date("d M, Y h:i:s A", strtotime($row->created_at)) ?>" data-status-message="<?= input_print($row->status_message) ?>" data-status="<?= ucwords($row->status) ?>" data-url="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/email/view/{$row->id}") ?>" data-id="<?= $row->id ?>" data-bs-toggle="modal" data-bs-target="#modal-email-view"><i class="fas fa-eye"></i></span>

                                    <?php if ($this->auth->admin_perm_auth('email_logs', 'edit')) : ?>
                                        <span class="btn btn-sm btn-danger resend-email" data-email="<?= $row->recipient ?>" data-url="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/email/resend/{$row->id}") ?>"><i class="fas fa-history"></i></span>
                                    <?php endif ?>

                                    <?php if ($this->auth->admin_perm_auth('email_logs', 'delete')) : ?>
                                        <button type="button" class="btn btn-sm btn-danger" data-delete-url="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/delete_email/{$row->id}") ?>"><i class="fas fa-trash"></i></button>
                                    <?php endif ?>
                                </form>
                                </p>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">No log available</td>
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

<div class="modal fade" id="modal-email-view" tabindex="-1" aria-labelledby="modal-email-viewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row">
                        <h5 class="modal-title" id="modal-email-viewLabel"></h5>
                    </div>
                    <div class="row">
                        <small><span class="modal-email"></span> - <span class="modal-date"></span></small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('.view-email').on('click', function() {
            $(".modal-title").text($(this).attr('data-title'));
            $(".modal-email").text($(this).attr('data-email'));
            $(".modal-date").text($(this).attr('data-date'));
            $(".modal-status").text($(this).attr('data-status'));
            $(".modal-status-message").text($(this).attr('data-status-message'));
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
                },
                success: function(data) {
                    $(".modal-body").html(data);
                }
            });
        })
    })

    <?php if ($this->auth->admin_perm_auth('email_logs', 'edit')) : ?>
        $('.resend-email').on('click', function() {

            Swal.fire({
                title: 'Are you sure?',
                text: `You want resend email to: ${$(this).attr('data-email')}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, resend it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    do_ajax($(this).attr('data-url'))
                }
            })
        });
    <?php endif ?>
</script>
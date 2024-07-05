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
                                <input type="text" name="email" value="<?= input_print($this->input->get('email')) ?>" class="form-control" placeholder="Search by email..." aria-label="Search by email..." aria-describedby="basic-addon2">
                            </div>
                            <input type="text" name="query" value="<?= input_print($this->input->get('query')) ?>" class="form-control" placeholder="Search by name or uri..." aria-label="Search by name or uri..." aria-describedby="basic-addon2">
                            <input type="text" name="ip" value="<?= input_print($this->input->get('ip')) ?>" class="form-control" placeholder="Search by ip..." aria-label="Search by ip..." aria-describedby="basic-addon2">

                            <div class="input-group-append">
                                <button class="input-group-text btn btn-primary" role="button" type="submit" id="basic-addon2">Search</button>
                            </div>
                        </div>

                    </form>
                </div>
                <?php if ($this->auth->admin_perm_auth('admins_activities', 'delete')) : ?>
                    <div class="col-lg-3 float-end">
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Method</th>
                    <th>URI</th>
                    <th>IP</th>
                    <th>UserAgent</th>
                    <th>Payload</th>
                    <th>Date</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <?php if ($query) : ?>
                    <?php foreach ($query as $row) : ?>
                        <tr>
                            <td><?= $row->id ?></td>
                            <td><?= isset($row->first_name) ? "<a href='" . base_url("{$this->uri->segment(1)}/admins/edit/{$row->admin_id}") . "'>{$row->first_name} {$row->last_name}</a>"  : 'N/A' ?></td>
                            <td><?= print_output($row->email) ?></td>
                            <td><?= print_output($row->request_method) ?></td>
                            <td>
                                <?= print_output($row->request_uri) ?>
                                <?= ($row->referer) ? "<br/> Referrer: " . print_output($row->referer) : '' ?>
                            </td>
                            <td><?= print_output($row->ip) ?></td>
                            <td><?= print_output($row->user_agent) ?></td>
                            <td><?= (isset($row->payload) && !empty(json_decode($row->payload))) ? '<span class="btn btn-primary data-payload" data-payload=\'' . input_print(json_encode(json_decode($row->payload), JSON_PRETTY_PRINT)) . '\' >View payload</span>' : 'N/A' ?></td>
                            <td><?= date("d M, Y h:i:s A", strtotime($row->created_at)) ?></td>
                            <td>
                                <?php if ($this->auth->admin_perm_auth('admins_activities', 'delete')) : ?>
                                    <form id="deleteForm">
                                        <button type="button" class="btn btn-sm btn-danger" data-delete-url="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/delete_activity/{$row->id}") ?>"><i class="fas fa-trash"></i></button>
                                    </form>
                                <?php endif ?>
                            </td>
                        </tr>

                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan="10" class="text-center">No log available</td>
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
                <h5 class="modal-title">Log Payload</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <pre id="modal-content" style="white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"></pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.data-payload').on('click', function() {
        $("#modal-email-view").modal('show')
        $("#modal-content").text($(this).attr('data-payload'));
    })
</script>
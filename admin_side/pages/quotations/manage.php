<div class="container-fluid px-4">
    <h1 class="mt-4"><?= (isset($title)) ? $title : "" ?></h1>
    <?php if (isset($subtitle)) : ?>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?= $subtitle ?></li>
        </ol>
    <?php endif ?>
    <div class="row">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Sender</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($quotations) : $i = 1; ?>
                    <?php foreach ($quotations as $quotation) :
                        $image = (($quotation->image_thumb) ? $quotation->image_thumb : $quotation->image);
                    ?>
                        <tr class="<?= (!$quotation->admin_read) ? 'text-danger' : '' ?>">
                            <td><?= $i++ ?></td>
                            <td>
                                <?php if ($quotation->item_title) : ?>
                                    <a href="<?= strtolower(base_url("product/" . url_title($quotation->item_title)) . "/{$quotation->item_id}") ?>" target="_blank">
                                        <img class="img-thumbnail" src="<?= images_url("products/items/{$image}"); ?>" alt="<?= $quotation->item_title ?>" width="70" height="70">
                                    </a>
                                <?php else : ?>
                                    N/A
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if ($quotation->item_title) : ?>
                                    <a href="<?= strtolower(base_url("product/" . url_title($quotation->item_title)) . "/{$quotation->item_id}") ?>" target="_blank">
                                        <?= print_output($quotation->item_title) ?>
                                    </a>
                                <?php else : ?>
                                    N/A
                                <?php endif ?>
                            </td>
                            <td><?= print_output(($quotation->name)) ?></td>
                            <td><?= print_output(short_description($quotation->message)) ?></td>
                            <td><?= date('D d M Y h:i:s A', strtotime($quotation->created_at)) ?></td>
                            <td>
                                <form id="deleteForm">
                                    <span type="button" data-id="<?= $quotation->id ?>" class="btn btn-sm btn-primary text-white view-quotation"><i class="fas fa-eye"></i></span>
                                    <?php if ($this->auth->admin_perm_auth('quotations', 'delete')) : ?>
                                        <button type="button" class="btn btn-sm btn-danger" data-delete-url="<?= base_url("{$this->uri->segment(1)}/{$this->uri->segment(2)}/delete_quotation/{$quotation->id}") ?>"><i class="fas fa-trash"></i></button>
                                    <?php endif ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">No quotation available</td>
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

<div id="view-quotation" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= current_url() . "/review" ?>" id="review-form" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Loading...</h5>
                </div>
                <div class="modal-body" style="display: none;">
                    Loading...
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $(".view-quotation").on("click", function() {
        $(".modal-body").hide();
        $(".modal-header .modal-title").text("Loading...");
        $("#view-quotation").modal("show");

        var button = this;
        var id = $(this).attr("data-id");
        var old_text = $(button).html();

        $.ajax({
            type: "GET",
            url: "<?= base_url("adminino/quotations/view/") ?>" + id,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $(button).prop("disabled", true);
                $(button).text("Processing..");
            },
            success: function(data) {
                $(button).prop("disabled", false);
                $(button).html(old_text);

                if (data.error == false) {
                    $(".modal-body").show();

                    $(".modal-header .modal-title").html(
                        `${data.response.name}`
                    );
                    $(button).closest("tr").removeClass('text-danger');
                    $(".modal-body").html(
                        `
						<table class="table table-borderless">
							<tr>
								<td>
									<small>From: ${data.response.name}</small>
								</td>
								<td>
									<small>City: ${data.response.city}</small>
								</td>
							</tr>
							<tr>
								<td>
									<small>Email: ${data.response.email}</small>
								</td>
								<td>
									<small>Phone: ${data.response.phone}</small>
								</td>
							</tr>
							<tr>
								<td colspan="2">
								${data.response.message}
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<small>${data.response.created_at}</small>
								</td>
							</tr>
						<table>
						`
                    );
                } else {
                    $("#view-quotation").modal("hide");
                    if (data.message != false) {
                        if (error_alert == "sweet")
                            errorMessageAlert(data.message);
                        else
                            errorMessage(data.message);
                    }
                }
            },
            error: function(data) {
                $("#view-quotation").modal("hide");
                if (error_alert == "sweet") {
                    errorMessageAlert("Unexpected error! Try again");
                } else {
                    errorMessage("Unexpected error! Try again");
                }
            }
        });
    });
</script>
<?php

/**
 * It will load your header to inculde header.
 */

$this->load->view('admin_side/layout/header');

/**
 * It will load your sidebar file to inculde sidebar.
 */

$this->load->view('admin_side/layout/sidebar');


/**
 * This content will include loading view and its data.
 */
echo $template_contents;


/**
 * It will load your footer to inculde footer.
 */
$this->load->view('admin_side/layout/footer');

/* End of file admin_template.php and path \application\views\admin_side\admin_template.php */

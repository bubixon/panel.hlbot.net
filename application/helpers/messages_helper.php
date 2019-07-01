<?php
defined('BASEPATH') OR exit('No direct script access allowed!');

function message($message, $location = "/", $type = "danger") {
    $_SESSION['message'] = '
<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  ' . $message . '
</div>
	';
    redirect($location);
    return;
}

function viewMessage() {
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    return;
}
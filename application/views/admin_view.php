<?php

    if($this->session->flashdata('login_success')){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>'.$this->session->userdata('username').'</strong> has been logged in successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>';
}

?>
<h1>Admin View Page</h1>
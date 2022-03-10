<?php
    if($this->session->flashdata('login_failed')){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username/Password does not match :(
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
    }else if($this->session->flashdata('logout_success')){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    User successfully logged out.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
    }else if($this->session->flashdata('register_success')){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    User successfully registered.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
    }
    
?>
    
<h1 class="text-center">Hello, world! This is my view!</h1>

<?php 

    var_dump($this->session->flashdata());
    echo '<br>';
    var_dump($this->session->userdata());
    
       
?>
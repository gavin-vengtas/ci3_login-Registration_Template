<h2 class="text-center">Logout form</h2>

<?php $attributes =  array('id' => 'logout_form', 'class' => 'form_horizontal');?>

<?php 
        if($this->session->flashdata('errors')){
            echo $this->session->flashdata('errors');
        }

?>
<p>
    You are logged in as <strong><?php echo $this->session->userdata('username');?></strong>
</p>
<div class="form-group">
    <?php

            echo form_open('users/logout',$attributes);

            $loginbtnattr = array(
                'class' => 'btn btn-outline-dark',
                'name' => 'submit',
                'value' => 'Logout' );

            echo form_submit($loginbtnattr);

    ?>
</div>

<?php echo form_close();?>
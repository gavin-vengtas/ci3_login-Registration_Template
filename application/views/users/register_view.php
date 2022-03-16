
<?php
    if($this->session->flashdata('register_failed')){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    An error occurred during registration :(
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
    }?>
<h2 class="text-center">Register form</h2>

<div class="form-group col-md-5 justify-content-center">

    <?php 
        $attributes =  array('id' => 'register_form', 'class' => 'form_horizontal');
        
        echo form_open('users/register',$attributes);
        
        $labeldata = array('class' => 'font-weight-normal' );
        
        //username
        echo form_label('Username','usernamelbl',$labeldata); 
    
        $forminputdata = array(
        'class' => 'form-control'.$this->session->flashdata('usernameClass'),
        'name' => 'username',
        'placeholder' => 'Enter Username',
        'value' => $this->session->flashdata('usernameValue'));
    
        echo form_input($forminputdata); 
        echo $this->session->flashdata('usernameIsInvalid')?'<div id="validationUsername" class="invalid-feedback">'.$this->session->flashdata('usernameIsInvalid').'</div>':'<br>';
        
        //password
        echo form_label('Password','passwordlbl',$labeldata); 
    
        $formpdata = array(
        'class' => 'form-control'.$this->session->flashdata('passwordClass'),
        'name' => 'password',
        'placeholder' => 'Enter Password');
    
        echo form_password($formpdata); 
        echo $this->session->flashdata('passwordIsInvalid')?'<div id="validationPassword" class="invalid-feedback">'.$this->session->flashdata('passwordIsInvalid').'</div>':'<br>';


        //confirm password
        echo form_label('Confirm Password','passwordconflbl',$labeldata); 
    
        $formpdata = array(
        'class' => 'form-control'.$this->session->flashdata('passwordconfClass'),
        'name' => 'passwordconf',
        'placeholder' => 'Confirm Password');
    
        echo form_password($formpdata); 
        echo $this->session->flashdata('passwordconfIsInvalid')?'<div id="validationPasswordconf" class="invalid-feedback">'.$this->session->flashdata('passwordconfIsInvalid').'</div>':'<br>';


        //first name
        echo form_label('First Name','usernamelbl',$labeldata); 
    
        $forminputdata = array(
        'class' => 'form-control'.$this->session->flashdata('firstnameClass'),
        'name' => 'firstname',
        'placeholder' => 'Enter first name',
        'value' => $this->session->flashdata('firstnameValue'));
    
        echo form_input($forminputdata); 
        echo $this->session->flashdata('firstnameIsInvalid')?'<div id="validationFirstname" class="invalid-feedback">'.$this->session->flashdata('firstnameIsInvalid').'</div>':'<br>';


        //last name
        echo form_label('Last Name','usernamelbl',$labeldata); 
    
        $forminputdata = array(
        'class' => 'form-control'.$this->session->flashdata('lastnameClass'),
        'name' => 'lastname',
        'placeholder' => 'Enter last name',
        'value' => $this->session->flashdata('lastnameValue'));
    
        echo form_input($forminputdata); 
        echo $this->session->flashdata('lastnameIsInvalid')?'<div id="validationLastname" class="invalid-feedback">'.$this->session->flashdata('lastnameIsInvalid').'</div>':'<br>';


        //Email
        echo form_label('Email Address','usernamelbl',$labeldata); 
    
        $forminputdata = array(
        'class'      => 'form-control'.$this->session->flashdata('emailClass'),
        'type'       => 'email',
        'name'       => 'email',
        'placeholder'=> 'Enter Email',
        'value' => $this->session->flashdata('emailValue'));
    
        echo form_input($forminputdata); 
        echo $this->session->flashdata('emailIsInvalid')?'<div id="validationEmail" class="invalid-feedback">'.$this->session->flashdata('emailIsInvalid').'</div>':'<br>';

        //submit
        $loginbtnattr = array(
            'class' => 'btn btn-outline-dark',
            'name'  => 'submit',
            'value' => 'Register',
            'style' => 'min-width: fit-content;' );

        echo form_submit($loginbtnattr);

        //back
        $registerbtnattr = array(
            'class' => 'btn btn-outline-dark col-md-4',
            'name'  => 'back',
            'role'  => 'button',
            'style' => 'min-width: fit-content;
                        max-width: fit-content;');
    
        echo anchor('home', 'Back', $registerbtnattr);

        echo form_close();
    ?>

</div>
<?php 

    var_dump($this->session->flashdata());

    echo "<br>Query result:<br>";
?>
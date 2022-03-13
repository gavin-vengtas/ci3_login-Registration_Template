<h2 class="text-center">Login form</h2>
<div class="form-group">
    <?php 

        $attributes =  array('id' => 'login_form', 'class' => 'form_horizontal');
        echo form_open('users/login',$attributes);

        $labeldata = array('class' => 'font-weight-normal' );

        //username
        echo form_label('Username','usernamelbl',$labeldata); 
    
        $forminputdata = array(
            'class' => 'form-control'.$this->session->flashdata('lusernameClass'),
            'name' => 'lusername',
            'placeholder' => 'Enter Username',
            'value' => $this->session->flashdata('lusernameValue'));
    
        echo form_input($forminputdata); 
        echo $this->session->flashdata('lusernameIsInvalid')?'<div id="validationUsername" class="invalid-feedback">'.$this->session->flashdata('lusernameIsInvalid').'</div>':'<br>';
        
        //password
        echo form_label('Password','passwordlbl',$labeldata); 
    
        $formpdata = array(
            'class' => 'form-control'.$this->session->flashdata('lpasswordClass'),
            'name' => 'lpassword',
            'placeholder' => 'Enter Password');
    
        echo form_password($formpdata); 
        echo $this->session->flashdata('lpasswordIsInvalid')?'<div id="validationPassword" class="invalid-feedback">'.$this->session->flashdata('lpasswordIsInvalid').'</div>':'<br>';
        
        //passworconf
        echo form_label('Confirm Password','passwordconflbl',$labeldata); 
    
        $formpcdata = array(
            'class' => 'form-control'.$this->session->flashdata('lpasswordconfClass'),
            'name' => 'lpasswordconf',
            'placeholder' => 'Confirm Password');
    
        echo form_password($formpcdata); 
        echo $this->session->flashdata('lpasswordconfIsInvalid')?'<div id="validationPasswordconf" class="invalid-feedback">'.$this->session->flashdata('lpasswordconfIsInvalid').'</div>':'';
        
        //submit
        $loginbtnattr = array(
            'class' => 'btn btn-outline-dark col-md-4',
            'name' => 'submit',
            'value' => 'Login',
            'style' => 'min-width: fit-content;
                        margin-top: 10px;' );

        echo form_submit($loginbtnattr);

        //register
        $registerbtnattr = array(
            'class' => 'btn btn-outline-dark col-md-4',
            'name'          => 'register',
            'role'         => 'button',
            'style' => 'min-width: fit-content;
                        margin-top: 10px;');
    
        echo anchor('users/register', 'Register', $registerbtnattr);

        echo form_close();

    ?>
</div>
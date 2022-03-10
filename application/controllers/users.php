<?php

class Users extends CI_Controller {

	
	public function login(){

        //validate field values
        $this->form_validation->set_rules('lusername', 'Username', 'trim|required|min_length[5]', array(
            'required' => 'Username must not be empty',
            'min_length' => 'Username must be more than 4 characters'));

        $this->form_validation->set_rules('lpassword', 'Password', 'trim|required|min_length[3]|matches[lpasswordconf]', array(
            'required' => 'Password must not be empty',
            'min_length' => 'Password must be more than 2 characters',
            'matches' => 'Passwords do not match'));

        $this->form_validation->set_rules('lpasswordconf', 'Confirm Password', 'trim|required|matches[lpassword]', array(
            'required' => 'Confirm Password must not be empty',
            'matches' => 'Passwords do not match'));
        
        //sets session data and redirects page if fields pass validation check and user logs in successfully
        if($this->form_validation->run() == FALSE){

            $validationdata = array(
                'errors' => validation_errors(),
                'lusernameIsInvalid' => form_error('lusername'),
                'lpasswordIsInvalid' => form_error('lpassword'),
                'lpasswordconfIsInvalid' => form_error('lpasswordconf'),
                'lusernameClass' => form_error('lusername')?' is-invalid':' is-valid',
                'lpasswordClass' => form_error('lpassword')?' is-invalid':' is-valid',
                'lpasswordconfClass' => form_error('lpasswordconf')?' is-invalid':' is-valid',
                'lusernameValue' => $this->input->post('lusername'));

            $this->session->set_flashdata($validationdata);
            $data['main_view'] = "home_view";

		    redirect('home');

        } else {

            $username = $this->input->post('lusername');
            $password = $this->input->post('lpassword');

            $result = $this->user_model->login_user($username,$password); //returns false if data does not match records, or if more than 1 record is found.

            if($result){

                $user_data = array(
                    'user_id' => '',
                    'username' => '',
                    'logged_in' => true);

                foreach ($result as $key){
                    $user_data['user_id'] = $key->Userid;
                    $user_data['username'] = $key->Username;
                }

                $login_data = array(
                    'login_success' => true);

                $this->session->set_userdata($user_data);
                $this->session->set_flashdata($login_data);
                
                
                $data['main_view'] = "admin_view";

	        	$this->load->view('layouts/main',$data);            
                
            } else {
                
                $logindata = array(
                    'login_failed' => true,
                    'usernameValue' => $this->input->post('username'));
    
                $this->session->set_flashdata($logindata);
                $data['main_view'] = "home_view";
    
                redirect('home');
            }
        }

	}

    public function logout(){

        //destroy session data and redirect to homepage (dont use this, instead unset user data)
        //$this->session->sess_destroy();
        
        $this->session->unset_userdata(array(
            'user_id',
            'username',
            'logged_in'));
        
        $this->session->set_flashdata(array(
            'logout_success' => true));
        

        redirect('home');
    }

    public function register(){

        //set validation rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[255]', array(
            'required' => 'Username must not be empty',
            'min_length' => 'Minumum character length is 4',
            'max_length' => 'Maximum character length is 255'));
            
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[255]|matches[passwordconf]', array(
            'required' => 'Password must not be empty',
            'min_length' => 'Minumum character length is 4',
            'max_length' => 'Maximum character length is 255',
            'matches' => 'Passwords do not match'));

        $this->form_validation->set_rules('passwordconf', 'Passwordconf', 'trim|required|min_length[4]|max_length[255]|matches[password]', array(
            'required' => 'Password confirmation must not be empty',
            'min_length' => 'Minumum character length is 4',
            'max_length' => 'Maximum character length is 255',
            'matches' => 'Passwords do not match'));

        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|max_length[30]', array(
            'required' => 'First name must not be empty',
            'max_length' => 'Maximum character length is 30'));
        
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|max_length[30]', array(
            'required' => 'Last name must not be empty',
            'max_length' => 'Maximum character length is 30'));

        $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[330]|valid_email', array(
            'required' => 'Email must not be empty',
            'max_length' => 'Maximum character length is 330',
            'valid_email' => 'Please enter a valid email address'));
        
        if($this->form_validation->run() == FALSE){
            //statement runs if any fields fail the validation check
            $formfielddata = $this->set_reg_form_fields();

            $this->session->set_flashdata($formfielddata);

            $this->load->view('users/register_view'); 

        } else {
            //runs if the forms fields pass validation check
            $isuser = $this->user_model->is_user($this->input->post('username'));

            if($isuser){
                //run if username already exists in DB
                $formfielddata = $this->set_reg_form_fields();
                $formfielddata['usernameIsInvalid'] = 'This username is already taken';
                $formfielddata['usernameClass'] = ' is-invalid';
    
                $this->session->set_flashdata($formfielddata);
                $this->load->view('users/register_view'); 

            } else {

                //else add new user to database and load main page
                //run db query to add fields to user table
                $values = array(
                    'Username' => $this->input->post('username'),
                    'Password' => $this->input->post('password'),
                    'Firstname' => $this->input->post('firstname'),
                    'Lastname' => $this->input->post('lastname'),
                    'Email_Primary' => $this->input->post('email'),
                    'Date_Registered' => date("Y-m-d") );

                $result = $this->user_model->create_user($values);

                if($result['query_success']){

                    //redirect user to home page if query is successful
                    $this->session->set_flashdata(array('register_success'=>true));
                    $data['main_view'] = "home_view";

	            	$this->load->view('layouts/main',$data);

                }else{

                    //display error if a DB error occured
                    $formfielddata = $this->set_reg_form_fields();
                    $formfielddata['register_failed'] = TRUE;

                    $this->session->set_flashdata($formfielddata);
                    $this->load->view('users/register_view'); 

                }

            }

        }
    }

    //returns array of data related to the register_view.php form
    private function set_reg_form_fields(){

        $validationdata = array(
            'errors' => validation_errors(),
            'usernameIsInvalid' => form_error('username'),
            'passwordIsInvalid' => form_error('password'),
            'passwordconfIsInvalid' => form_error('passwordconf'),
            'firstnameIsInvalid' => form_error('firstname'),
            'lastnameIsInvalid' => form_error('lastname'),
            'emailIsInvalid' => form_error('email'),
            'usernameClass' => form_error('username')?' is-invalid':' is-valid',
            'passwordClass' => ' is-invalid',
            'passwordconfClass' => ' is-invalid',
            'firstnameClass' => form_error('firstname')?' is-invalid':' is-valid',
            'lastnameClass' => form_error('lastname')?' is-invalid':' is-valid',
            'emailClass' => form_error('email')?' is-invalid':' is-valid',
            'usernameValue' => $this->input->post('username'),
            'firstnameValue' => $this->input->post('firstname'),
            'lastnameValue' => $this->input->post('lastname'),
            'emailValue' => $this->input->post('email'));

        return $validationdata;
    }
}
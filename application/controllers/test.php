<?php

class Test extends CI_Controller {

	
	public function index()
	{
        $isuser = $this->user_model->is_user('Gavin');
        var_dump($isuser);

        if($isuser){
            echo '<br> user found!';
        } else {
            echo '<br> user not found :)';
        }

	}
}
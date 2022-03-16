<?php  

class User_model extends CI_Model {
    
    public function get_users(){

        $query = $this->db->get('Users');

        return $query->result();
    }

    public function login_user($username, $password){

        $this->db->where('Username', $username);

        $query = $this->db->get('Users');

        $result = $query->result_array();

        if(count($result)>0){
            $isMatch = password_verify($password,$result[0]['Password']);

            if($isMatch){
                return array('result'=>array('Username' => $result[0]['Username'],'Userid' => $result[0]['Userid']));
            } else {
                return array('result'=>false);
            }
        }else{
            return array('result'=>false);
        }
    }

    public function create_user($values){
        

        $query = $this->db->insert('Users', $values);

        return array(
            'query_success' => $query,
            'db_error' => $this->db->error());
    }

    //returns true if username exists
    public function is_user($username){

        $this->db->where('Username', $username);

        $query = $this->db->get('Users');

        if($query->num_rows() > 0){
            return $query->result();;
        } else { 
            return FALSE;
        }

    }

}


?>
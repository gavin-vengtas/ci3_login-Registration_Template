<?php  

class User_model extends CI_Model {
    
    public function get_users(){

        $query = $this->db->get('Users');

        return $query->result();
    }

    public function login_user($username, $password){
            $this->db->where('Username', $username);
            $this->db->where('Password', $password);

            $query = $this->db->get('Users');

            if($query->num_rows() == 1){
                return $query->result();
            } else { 
                return false;
            }
    }

    public function create_user($values){
        

        $query = $this->db->insert('Users', $values);

        return array(
            'query_success' => $query,
            'db_error' => $this->db->error());
        // if($query->num_rows() == 1){
        //     return $query->result();
        // } else { 
        //     return false;
        // }
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
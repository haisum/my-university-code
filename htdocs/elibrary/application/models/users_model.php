<?php
class Users_model extends Model{
    function Users_model(){
        parent::Model();
        $this->load->database();
    }

    function getUsersByRoll($roll)
    {
        $QueryResult = $this->db->query("
        SELECT *
        FROM users, user_types
        WHERE user_type_id = type_id AND user_isapproved=1;"
            );
        return $QueryResult;
    }
    function insertNewUser($user_name, $user_roll_no, $user_password, $user_department_id){
       $this->db->query("
            INSERT INTO users(
                    user_name,
                    user_roll_no,
                    user_password,
                    user_department_id
                    )
            values('" .
                    htmlspecialchars($user_name, ENT_QUOTES) . "','" .
                    htmlspecialchars($user_roll_no, ENT_QUOTES) . "','" .
                    sha1(htmlspecialchars($user_password, ENT_QUOTES)) . "'," .
                    htmlspecialchars($user_department_id, ENT_QUOTES)  .
                 ");"
            );
    }
    function checkRoll($roll){
        $query = $this->db->query("SELECT * FROM users WHERE user_roll_no ='" . htmlspecialchars($roll, ENT_QUOTES) . "';");
        if($query->num_rows() == 0 )
                return true;
        else
                return false;

    }
}
?>
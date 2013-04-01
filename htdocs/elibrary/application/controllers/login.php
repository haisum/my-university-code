<?php
session_start();
class Login extends Controller
{
	function Login()
	{
		parent::Controller();
                $this->load->database();
	}
	
	function index()
	{
                //$this->output->cache(365*24*60);
		$this->load->view('login_view');
	}

        function doLogin(){
            $message="";
            if(isset ($_REQUEST['user_password']) && isset ($_REQUEST['user_roll_no'])){

                $this->load->model('users_model');
                $Results = $this->users_model->getUsersByRoll($_REQUEST['user_roll_no']);
                foreach($Results->result() as $row){
                    if($row->user_password == sha1($_REQUEST['user_password'])){
                      $message = "success " . $row->user_name;
                      $_SESSION['user_roll_no'] = $row->user_roll_no;
                      $_SESSION['user_password'] = $row->user_password;
                      $_SESSION['user_name'] = $row->user_name;
                      $_SESSION['user_id'] = $row->user_id;
                      $_SESSION['type_name'] = $row->type_name;
                    }
                }
                if($message=="")
                     $message = "error";
                $data['message'] = $message;
                $this->load->view('message_view', $data);
            }
	
        }
}
?>
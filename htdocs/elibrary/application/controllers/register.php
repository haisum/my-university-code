<?php
class Register extends Controller
{
	function Register()
	{
		parent::Controller();
                $this->load->database();
	}
	
	function index()
	{
            $this->load->model('departments_model');
            $departments = $this->departments_model->getDepartments();
            $html="";
            foreach ($departments->result() as $department)
                            $html .= "<option value='" . $department->department_id . "'>" . $department->department_name . "</option>";
            $data['departments'] = $html;
            //$this->output->cache(2*24*60);
            $this->load->view('register_view' , $data);
	}

        function InsertData()
        {
            
            $this->load->model('users_model');
            if(isset ($_REQUEST['user_name']) && isset ($_REQUEST['user_roll_no']) && isset($_REQUEST['user_password']) && isset($_REQUEST['user_department_id']))
            {
                if($this->users_model->checkRoll($_REQUEST['user_roll_no']))
                {
                    $this->users_model->insertNewUser($_REQUEST['user_name'], $_REQUEST['user_roll_no'], $_REQUEST['user_password'], $_REQUEST['user_department_id']);
                    $message = "Hello {$_REQUEST['user_name']} Your registeration has successfully completed. You can upload files now.";
                }
                else
                    $message = "This role number is already registered. Contact admin for more details.";
            }
            else {
                $message = "There was an error registering you";
            }
            $data['message'] = $message;
            $this->load->view('message_view', $data);
        }

}
?>
<?php
session_start();
class Logout extends Controller
{
	function Logout()
	{
		parent::Controller();
	}
	
	function index()
	{
            $_SESSION = array ();
            if(isset ($_COOKIE[session_name()]))
                setcookie(session_name(), '', time()-42000,  '/');
            session_destroy();
            $data['message'] = 'success';
            $this->load->view("message_view", $data);
	}
}
?>
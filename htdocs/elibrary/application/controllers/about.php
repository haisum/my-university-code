<?php
class About extends Controller
{
	function About()
	{
		parent::Controller();
	}
	
	function index()
	{
                //$this->output->cache(365*24*60);
		$this->load->view('about_view');
	}
}
?>
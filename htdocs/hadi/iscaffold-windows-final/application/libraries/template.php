<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require "template_lite/class.template.php";

class Template extends Template_Lite{

    var $theme = "default";

    function __construct()
    {
		// Init Template Lite
		//
		// Make it available for the class
		$this->tpl = new Template_Lite();
		$this->tpl->reserved_template_varname 	= "tpl";
		$this->tpl->_cache_dir 		= BASEPATH . 'cache/';
        $this->tpl->template_dir 	= APPPATH . "views/";
        $this->tpl->compile_dir 	= APPPATH . "compiled/";
        
        // Say hello to CI super class
        $CI =& get_instance();
        
        // Default assigns
        //var_dump($CI->config);
        $this->tpl->assign('config', $CI->config->config);
        $this->tpl->assign('domain', $_SERVER['HTTP_HOST']);
    }

    function assign($key,$value)
    {
        $this->tpl->assign($key,$value);
    }

    function display($template)
    {
        $this->tpl->display($template);
    }

    function fetch($template)
    {
        return $this->tpl->fetch($template);
    }

    function layout($inner_template,$array)
    {
          foreach($array as $key=>$val) {
               $this->assign($key,$val);
          }

          $this->assign("inner_template",$inner_template);

          $this->display($this->theme.".tpl");
          exit;
    }
}
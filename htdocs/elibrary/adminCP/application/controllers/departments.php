<?php

class Departments extends Controller 
{
    
	function Departments ()
	{
		parent::Controller();	

		$this->load->library( 'template' ); 
		$this->load->model( 'model_departments' ); 
		

		$this->load->helper('form');
		$this->load->helper('language'); 
		$this->load->helper('url');

		$this->lang->load('db_fields', 'english'); // This is the language file
	}

    /**
     *  LISTS MODEL DATA INTO A TABLE
     */         
    function index( $page = 0 )
    {
        $this->model_departments->pagination( FALSE );
		$data_info = $this->model_departments->lister( $page );
        $fields = $this->model_departments->fields( TRUE );

        $this->template->assign( 'pager', $this->model_departments->pager );
		$this->template->assign( 'departments_fields', $fields );
		$this->template->assign( 'departments_data', $data_info );
		$this->template->assign( 'table_name', 'Departments' );
		$this->template->assign( 'template', 'list_departments' );
		$this->template->display( 'frame_public.tpl' );
    }

    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_departments->get( $id );
        $fields = $this->model_departments->fields( TRUE );

		$this->template->assign( 'id', $id );
		$this->template->assign( 'departments_fields', $fields );
		$this->template->assign( 'departments_data', $data );
		$this->template->assign( 'table_name', 'Departments' );
		$this->template->assign( 'template', 'show_departments' );
		$this->template->display( 'frame_public.tpl' );
    }

    /**
     *  SHOWS A FROM, AND HANDLES SAVING IT
     */         
    function create( $id = false )
    {
		$this->load->library('form_validation');
        
		switch ( $_SERVER ['REQUEST_METHOD'] )
        {
            case 'GET':
                $fields = $this->model_departments->fields();
                

                
                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'departments_fields', $fields );
                $this->template->assign( 'metadata', $this->model_departments->metadata() );
        		$this->template->assign( 'table_name', 'Departments' );
        		$this->template->assign( 'template', 'form_departments' );
        		$this->template->display( 'frame_public.tpl' );
            break;

            /**
             *  Insert data TO departments table
             */
            case 'POST':
                $fields = $this->model_departments->fields();

                /* we set the rules */
                /* dont forget to edit these */
$this->form_validation->set_rules( 'department_name', lang('department_name'), 'required|max_length[50]' );

    
$data_post['department_name'] = $this->input->post( 'department_name' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    

                    

                    
                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'departments_data', $data_post );
            		$this->template->assign( 'departments_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_departments->metadata() );
            		$this->template->assign( 'table_name', 'Departments' );
            		$this->template->assign( 'template', 'form_departments' );
            		$this->template->display( 'frame_public.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_departments->insert( $data_post );
                    
					redirect( 'index.php/departments/');
                }
            break;
        }
    }

    function edit( $id = false )
    {
        $this->load->library('form_validation');

        switch ( $_SERVER ['REQUEST_METHOD'] )
        {
            case 'GET':
                $this->model_departments->raw_data = TRUE;
        		$data = $this->model_departments->get( $id );
                $fields = $this->model_departments->fields();
                
                

                
                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'departments_data', $data );
        		$this->template->assign( 'departments_fields', $fields );
                $this->template->assign( 'metadata', $this->model_departments->metadata() );
        		$this->template->assign( 'table_name', 'Departments' );
        		$this->template->assign( 'template', 'form_departments' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_public.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_departments->fields();
                /* we set the rules */
                /* dont forget to edit these */
$this->form_validation->set_rules( 'department_name', lang('department_name'), 'required|max_length[50]' );

    
$data_post['department_name'] = $this->input->post( 'department_name' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    

                    

                    
                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'departments_data', $data_post );
            		$this->template->assign( 'departments_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_departments->metadata() );
            		$this->template->assign( 'table_name', 'Departments' );
            		$this->template->assign( 'template', 'form_departments' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_public.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_departments->update( $id, $data_post );
				    
					redirect('index.php/departments/');
                }
            break;
        }
    }
    
    /**
     *  DELETES RECORD
     */
    function delete( $id )
    {
        $this->model_departments->delete( $id );
        redirect( $_SERVER['HTTP_REFERER'] );
    }
}


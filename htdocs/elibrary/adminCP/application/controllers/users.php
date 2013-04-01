<?php

class Users extends Controller 
{
    
	function Users ()
	{
		parent::Controller();	

		$this->load->library( 'template' ); 
		$this->load->model( 'model_users' ); 
		

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
        $this->model_users->pagination( FALSE );
		$data_info = $this->model_users->lister( $page );
        $fields = $this->model_users->fields( TRUE );

        $this->template->assign( 'pager', $this->model_users->pager );
		$this->template->assign( 'users_fields', $fields );
		$this->template->assign( 'users_data', $data_info );
		$this->template->assign( 'table_name', 'Users' );
		$this->template->assign( 'template', 'list_users' );
		$this->template->display( 'frame_public.tpl' );
    }

    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_users->get( $id );
        $fields = $this->model_users->fields( TRUE );

		$this->template->assign( 'id', $id );
		$this->template->assign( 'users_fields', $fields );
		$this->template->assign( 'users_data', $data );
		$this->template->assign( 'table_name', 'Users' );
		$this->template->assign( 'template', 'show_users' );
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
                $fields = $this->model_users->fields();
                $departments_set = $this->model_users->related_departments();
$user_types_set = $this->model_users->related_user_types();


                $this->template->assign( 'related_departments', $departments_set );
$this->template->assign( 'related_user_types', $user_types_set );

                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'users_fields', $fields );
                $this->template->assign( 'metadata', $this->model_users->metadata() );
        		$this->template->assign( 'table_name', 'Users' );
        		$this->template->assign( 'template', 'form_users' );
        		$this->template->display( 'frame_public.tpl' );
            break;

            /**
             *  Insert data TO users table
             */
            case 'POST':
                $fields = $this->model_users->fields();

                /* we set the rules */
                /* dont forget to edit these */
$this->form_validation->set_rules( 'user_name', lang('user_name'), 'required|max_length[50]' );
$this->form_validation->set_rules( 'user_roll_no', lang('user_roll_no'), 'required|max_length[20]' );
$this->form_validation->set_rules( 'user_department_id', lang('user_department_id'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'user_type_id', lang('user_type_id'), 'required|max_length[4]|integer' );
$this->form_validation->set_rules( 'user_isApproved', lang('user_isApproved'), 'required|max_length[4]|integer' );

    
$data_post['user_name'] = $this->input->post( 'user_name' );
$data_post['user_roll_no'] = $this->input->post( 'user_roll_no' );
$data_post['user_department_id'] = $this->input->post( 'user_department_id' );
$data_post['user_type_id'] = $this->input->post( 'user_type_id' );
$data_post['user_isApproved'] = $this->input->post( 'user_isApproved' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    

                    $departments_set = $this->model_users->related_departments();
$user_types_set = $this->model_users->related_user_types();


                    $this->template->assign( 'related_departments', $departments_set );
$this->template->assign( 'related_user_types', $user_types_set );

                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'users_data', $data_post );
            		$this->template->assign( 'users_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_users->metadata() );
            		$this->template->assign( 'table_name', 'Users' );
            		$this->template->assign( 'template', 'form_users' );
            		$this->template->display( 'frame_public.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_users->insert( $data_post );
                    
					redirect( 'index.php/users' );
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
                $this->model_users->raw_data = TRUE;
        		$data = $this->model_users->get( $id );
                $fields = $this->model_users->fields();
                $departments_set = $this->model_users->related_departments();
$user_types_set = $this->model_users->related_user_types();

                

                $this->template->assign( 'related_departments', $departments_set );
$this->template->assign( 'related_user_types', $user_types_set );

                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'users_data', $data );
        		$this->template->assign( 'users_fields', $fields );
                $this->template->assign( 'metadata', $this->model_users->metadata() );
        		$this->template->assign( 'table_name', 'Users' );
        		$this->template->assign( 'template', 'form_users' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_public.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_users->fields();
                /* we set the rules */
                /* dont forget to edit these */
$this->form_validation->set_rules( 'user_name', lang('user_name'), 'required|max_length[50]' );
$this->form_validation->set_rules( 'user_roll_no', lang('user_roll_no'), 'required|max_length[20]' );
$this->form_validation->set_rules( 'user_department_id', lang('user_department_id'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'user_type_id', lang('user_type_id'), 'required|max_length[4]|integer' );
$this->form_validation->set_rules( 'user_isApproved', lang('user_isApproved'), 'required|max_length[4]|integer' );

    
$data_post['user_name'] = $this->input->post( 'user_name' );
$data_post['user_roll_no'] = $this->input->post( 'user_roll_no' );
$data_post['user_department_id'] = $this->input->post( 'user_department_id' );
$data_post['user_type_id'] = $this->input->post( 'user_type_id' );
$data_post['user_isApproved'] = $this->input->post( 'user_isApproved' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    

                    $departments_set = $this->model_users->related_departments();
$user_types_set = $this->model_users->related_user_types();


                    $this->template->assign( 'related_departments', $departments_set );
$this->template->assign( 'related_user_types', $user_types_set );

                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'users_data', $data_post );
            		$this->template->assign( 'users_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_users->metadata() );
            		$this->template->assign( 'table_name', 'Users' );
            		$this->template->assign( 'template', 'form_users' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_public.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_users->update( $id, $data_post );
				    
					redirect( 'index.php/users' );
                }
            break;
        }
    }
    
    /**
     *  DELETES RECORD
     */
    function delete( $id )
    {
        $this->model_users->delete( $id );
        redirect( $_SERVER['HTTP_REFERER'] );
    }
}


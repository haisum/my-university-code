<?php

class Categories extends Controller 
{
    
	function Categories ()
	{
		parent::Controller();	

		$this->load->library( 'template' ); 
		$this->load->model( 'model_categories' ); 
		

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
        $this->model_categories->pagination( FALSE );
		$data_info = $this->model_categories->lister( $page );
        $fields = $this->model_categories->fields( TRUE );

        $this->template->assign( 'pager', $this->model_categories->pager );
		$this->template->assign( 'categories_fields', $fields );
		$this->template->assign( 'categories_data', $data_info );
		$this->template->assign( 'table_name', 'Categories' );
		$this->template->assign( 'template', 'list_categories' );
		$this->template->display( 'frame_public.tpl' );
    }

    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_categories->get( $id );
        $fields = $this->model_categories->fields( TRUE );

		$this->template->assign( 'id', $id );
		$this->template->assign( 'categories_fields', $fields );
		$this->template->assign( 'categories_data', $data );
		$this->template->assign( 'table_name', 'Categories' );
		$this->template->assign( 'template', 'show_categories' );
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
                $fields = $this->model_categories->fields();
                $departments_set = $this->model_categories->related_departments();


                $this->template->assign( 'related_departments', $departments_set );

                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'categories_fields', $fields );
                $this->template->assign( 'metadata', $this->model_categories->metadata() );
        		$this->template->assign( 'table_name', 'Categories' );
        		$this->template->assign( 'template', 'form_categories' );
        		$this->template->display( 'frame_public.tpl' );
            break;

            /**
             *  Insert data TO categories table
             */
            case 'POST':
                $fields = $this->model_categories->fields();

                /* we set the rules */
                /* dont forget to edit these */
$this->form_validation->set_rules( 'category_department_id', lang('category_department_id'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'Category_name', lang('Category_name'), 'required|max_length[50]' );

    
$data_post['category_department_id'] = $this->input->post( 'category_department_id' );
$data_post['Category_name'] = htmlspecialchars($this->input->post( 'Category_name' ), ENT_QUOTES);

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    

                    $departments_set = $this->model_categories->related_departments();


                    $this->template->assign( 'related_departments', $departments_set );

                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'categories_data', $data_post );
            		$this->template->assign( 'categories_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_categories->metadata() );
            		$this->template->assign( 'table_name', 'Categories' );
            		$this->template->assign( 'template', 'form_categories' );
            		$this->template->display( 'frame_public.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_categories->insert( $data_post );
                    
					redirect( 'index.php/categories' );
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
                $this->model_categories->raw_data = TRUE;
        		$data = $this->model_categories->get( $id );
                $fields = $this->model_categories->fields();
                $departments_set = $this->model_categories->related_departments();

                

                $this->template->assign( 'related_departments', $departments_set );

                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'categories_data', $data );
        		$this->template->assign( 'categories_fields', $fields );
                $this->template->assign( 'metadata', $this->model_categories->metadata() );
        		$this->template->assign( 'table_name', 'Categories' );
        		$this->template->assign( 'template', 'form_categories' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_public.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_categories->fields();
                /* we set the rules */
                /* dont forget to edit these */
$this->form_validation->set_rules( 'category_department_id', lang('category_department_id'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'Category_name', lang('Category_name'), 'required|max_length[50]' );

    
$data_post['category_department_id'] = $this->input->post( 'category_department_id' );
$data_post['Category_name'] = htmlspecialchars($this->input->post( 'Category_name' ), ENT_QUOTES);

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    

                    $departments_set = $this->model_categories->related_departments();


                    $this->template->assign( 'related_departments', $departments_set );

                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'categories_data', $data_post );
            		$this->template->assign( 'categories_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_categories->metadata() );
            		$this->template->assign( 'table_name', 'Categories' );
            		$this->template->assign( 'template', 'form_categories' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_public.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_categories->update( $id, $data_post );
				    
					redirect( 'index.php/categories/');
                }
            break;
        }
    }
    
    /**
     *  DELETES RECORD
     */
    function delete( $id )
    {
        $this->model_categories->delete( $id );
        redirect( $_SERVER['HTTP_REFERER'] );
    }
}


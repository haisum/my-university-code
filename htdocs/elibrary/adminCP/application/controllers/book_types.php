<?php

class Book_types extends Controller 
{
    
	function Book_types ()
	{
		parent::Controller();	

		$this->load->library( 'template' ); 
		$this->load->model( 'model_book_types' ); 
		

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
        $this->model_book_types->pagination( FALSE );
		$data_info = $this->model_book_types->lister( $page );
        $fields = $this->model_book_types->fields( TRUE );

        $this->template->assign( 'pager', $this->model_book_types->pager );
		$this->template->assign( 'book_types_fields', $fields );
		$this->template->assign( 'book_types_data', $data_info );
		$this->template->assign( 'table_name', 'Book_types' );
		$this->template->assign( 'template', 'list_book_types' );
		$this->template->display( 'frame_public.tpl' );
    }

    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_book_types->get( $id );
        $fields = $this->model_book_types->fields( TRUE );

		$this->template->assign( 'id', $id );
		$this->template->assign( 'book_types_fields', $fields );
		$this->template->assign( 'book_types_data', $data );
		$this->template->assign( 'table_name', 'Book_types' );
		$this->template->assign( 'template', 'show_book_types' );
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
                $fields = $this->model_book_types->fields();
                

                
                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'book_types_fields', $fields );
                $this->template->assign( 'metadata', $this->model_book_types->metadata() );
        		$this->template->assign( 'table_name', 'Book_types' );
        		$this->template->assign( 'template', 'form_book_types' );
        		$this->template->display( 'frame_public.tpl' );
            break;

            /**
             *  Insert data TO book_types table
             */
            case 'POST':
                $fields = $this->model_book_types->fields();

                /* we set the rules */
                /* dont forget to edit these */
$this->form_validation->set_rules( 'type_name', lang('type_name'), 'required|max_length[15]' );

    
$data_post['type_name'] = $this->input->post( 'type_name' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    

                    

                    
                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'book_types_data', $data_post );
            		$this->template->assign( 'book_types_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_book_types->metadata() );
            		$this->template->assign( 'table_name', 'Book_types' );
            		$this->template->assign( 'template', 'form_book_types' );
            		$this->template->display( 'frame_public.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_book_types->insert( $data_post );
                    
					redirect( 'index.php/book_types/');
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
                $this->model_book_types->raw_data = TRUE;
        		$data = $this->model_book_types->get( $id );
                $fields = $this->model_book_types->fields();
                
                

                
                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'book_types_data', $data );
        		$this->template->assign( 'book_types_fields', $fields );
                $this->template->assign( 'metadata', $this->model_book_types->metadata() );
        		$this->template->assign( 'table_name', 'Book_types' );
        		$this->template->assign( 'template', 'form_book_types' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_public.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_book_types->fields();
                /* we set the rules */
                /* dont forget to edit these */
$this->form_validation->set_rules( 'type_name', lang('type_name'), 'required|max_length[15]' );

    
$data_post['type_name'] = $this->input->post( 'type_name' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    

                    

                    
                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'book_types_data', $data_post );
            		$this->template->assign( 'book_types_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_book_types->metadata() );
            		$this->template->assign( 'table_name', 'Book_types' );
            		$this->template->assign( 'template', 'form_book_types' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_public.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_book_types->update( $id, $data_post );
				    
					redirect( 'index.php/book_types/');
                }
            break;
        }
    }
    
    /**
     *  DELETES RECORD
     */
    function delete( $id )
    {
        $this->model_book_types->delete( $id );
        redirect( $_SERVER['HTTP_REFERER'] );
    }
}


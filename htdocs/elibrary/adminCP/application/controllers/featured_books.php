<?php

class Featured_books extends Controller 
{
    
	function Featured_books ()
	{
		parent::Controller();	

		$this->load->library( 'template' ); 
		$this->load->model( 'model_featured_books' ); 
		

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
        $this->model_featured_books->pagination( FALSE );
		$data_info = $this->model_featured_books->lister( $page );
        $fields = $this->model_featured_books->fields( TRUE );

        $this->template->assign( 'pager', $this->model_featured_books->pager );
		$this->template->assign( 'featured_books_fields', $fields );
		$this->template->assign( 'featured_books_data', $data_info );
		$this->template->assign( 'table_name', 'Featured_books' );
		$this->template->assign( 'template', 'list_featured_books' );
		$this->template->display( 'frame_public.tpl' );
    }

    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_featured_books->get( $id );
        $fields = $this->model_featured_books->fields( TRUE );

		$this->template->assign( 'id', $id );
		$this->template->assign( 'featured_books_fields', $fields );
		$this->template->assign( 'featured_books_data', $data );
		$this->template->assign( 'table_name', 'Featured_books' );
		$this->template->assign( 'template', 'show_featured_books' );
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
                $fields = $this->model_featured_books->fields();
                $books_set = $this->model_featured_books->related_books();


                $this->template->assign( 'related_books', $books_set );

                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'featured_books_fields', $fields );
                $this->template->assign( 'metadata', $this->model_featured_books->metadata() );
        		$this->template->assign( 'table_name', 'Featured_books' );
        		$this->template->assign( 'template', 'form_featured_books' );
        		$this->template->display( 'frame_public.tpl' );
            break;

            /**
             *  Insert data TO featured_books table
             */
            case 'POST':
                $fields = $this->model_featured_books->fields();

                /* we set the rules */
                /* dont forget to edit these */
$this->form_validation->set_rules( 'Featured_Book_Id', lang('Featured_Book_Id'), 'required|max_length[10]|integer' );

    
$data_post['Featured_Book_Id'] = $this->input->post( 'Featured_Book_Id' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    

                    $books_set = $this->model_featured_books->related_books();


                    $this->template->assign( 'related_books', $books_set );

                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'featured_books_data', $data_post );
            		$this->template->assign( 'featured_books_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_featured_books->metadata() );
            		$this->template->assign( 'table_name', 'Featured_books' );
            		$this->template->assign( 'template', 'form_featured_books' );
            		$this->template->display( 'frame_public.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_featured_books->insert( $data_post );
                    
					redirect( 'index.php/featured_books');
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
                $this->model_featured_books->raw_data = TRUE;
        		$data = $this->model_featured_books->get( $id );
                $fields = $this->model_featured_books->fields();
                $books_set = $this->model_featured_books->related_books();

                

                $this->template->assign( 'related_books', $books_set );

                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'featured_books_data', $data );
        		$this->template->assign( 'featured_books_fields', $fields );
                $this->template->assign( 'metadata', $this->model_featured_books->metadata() );
        		$this->template->assign( 'table_name', 'Featured_books' );
        		$this->template->assign( 'template', 'form_featured_books' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_public.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_featured_books->fields();
                /* we set the rules */
                /* dont forget to edit these */
$this->form_validation->set_rules( 'Featured_Book_Id', lang('Featured_Book_Id'), 'required|max_length[10]|integer' );

    
$data_post['Featured_Book_Id'] = $this->input->post( 'Featured_Book_Id' );

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    

                    $books_set = $this->model_featured_books->related_books();


                    $this->template->assign( 'related_books', $books_set );

                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'featured_books_data', $data_post );
            		$this->template->assign( 'featured_books_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_featured_books->metadata() );
            		$this->template->assign( 'table_name', 'Featured_books' );
            		$this->template->assign( 'template', 'form_featured_books' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_public.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_featured_books->update( $id, $data_post );
				    
					redirect( 'index.php/featured_books' );
                }
            break;
        }
    }
    
    /**
     *  DELETES RECORD
     */
    function delete( $id )
    {
        $this->model_featured_books->delete( $id );
        redirect( $_SERVER['HTTP_REFERER'] );
    }
}


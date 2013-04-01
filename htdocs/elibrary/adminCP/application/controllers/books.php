<?php

class Books extends Controller 
{
    
	function Books ()
	{
		parent::Controller();	

		$this->load->library( 'template' ); 
		$this->load->model( 'model_books' ); 
		

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
        $this->model_books->pagination( FALSE );
		$data_info = $this->model_books->lister( $page );
        $fields = $this->model_books->fields( TRUE );

        $this->template->assign( 'pager', $this->model_books->pager );
		$this->template->assign( 'books_fields', $fields );
		$this->template->assign( 'books_data', $data_info );
		$this->template->assign( 'table_name', 'Books' );
		$this->template->assign( 'template', 'list_books' );
		$this->template->display( 'frame_public.tpl' );
    }

    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_books->get( $id );
        $fields = $this->model_books->fields( TRUE );

		$this->template->assign( 'id', $id );
		$this->template->assign( 'books_fields', $fields );
		$this->template->assign( 'books_data', $data );
		$this->template->assign( 'table_name', 'Books' );
		$this->template->assign( 'template', 'show_books' );
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
                $fields = $this->model_books->fields();
                $publishers_set = $this->model_books->related_publishers();
$categories_set = $this->model_books->related_categories();
$users_set = $this->model_books->related_users();
$book_types_set = $this->model_books->related_book_types();


                $this->template->assign( 'related_publishers', $publishers_set );
$this->template->assign( 'related_categories', $categories_set );
$this->template->assign( 'related_users', $users_set );
$this->template->assign( 'related_book_types', $book_types_set );

                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'books_fields', $fields );
                $this->template->assign( 'metadata', $this->model_books->metadata() );
        		$this->template->assign( 'table_name', 'Books' );
        		$this->template->assign( 'template', 'form_books' );
        		$this->template->display( 'frame_public.tpl' );
            break;

            /**
             *  Insert data TO books table
             */
            case 'POST':
                $fields = $this->model_books->fields();

                /* we set the rules */
                /* dont forget to edit these */
$this->form_validation->set_rules( 'Book_Title', lang('Book_Title'), 'required|max_length[100]' );
$this->form_validation->set_rules( 'Book_Author', lang('Book_Author'), 'required|max_length[30]' );
$this->form_validation->set_rules( 'Book_ISBN', lang('Book_ISBN'), 'required|max_length[40]' );
$this->form_validation->set_rules( 'book_publisher_id', lang('book_publisher_id'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'book_category_id', lang('book_category_id'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'book_uploader_id', lang('book_uploader_id'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'book_type_id', lang('book_type_id'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'book_downloads', lang('book_downloads'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'book_size', lang('book_size'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'Book_Path', lang('Book_Path'), 'required|max_length[150]' );
$this->form_validation->set_rules( 'book_IsApproved', lang('book_IsApproved'), 'required|max_length[1]|integer' );
$this->form_validation->set_rules( 'book_Date_Inserted', lang('book_Date_Inserted'), 'required' );

    
$data_post['Book_Title'] = htmlspecialchars($this->input->post( 'Book_Title' ), ENT_QUOTES);
$data_post['Book_Author'] = htmlspecialchars($this->input->post( 'Book_Author' ), ENT_QUOTES);
$data_post['Book_ISBN'] = htmlspecialchars($this->input->post( 'Book_ISBN' ), ENT_QUOTES);
$data_post['book_publisher_id'] = $this->input->post( 'book_publisher_id' );
$data_post['book_category_id'] = $this->input->post( 'book_category_id' );
$data_post['book_uploader_id'] = $this->input->post( 'book_uploader_id' );
$data_post['book_type_id'] = $this->input->post( 'book_type_id' );
$data_post['book_downloads'] = $this->input->post( 'book_downloads' );
$data_post['book_size'] = $this->input->post( 'book_size' );
$data_post['Book_Path'] = htmlspecialchars($this->input->post( 'Book_Path' ), ENT_QUOTES);
$data_post['book_IsApproved'] = $this->input->post( 'book_IsApproved' );
$data_post['book_Date_Inserted'] =strftime("%Y-%m-%d %H:%M:%S", strtotime( htmlspecialchars($this->input->post( 'book_Date_Inserted' ), ENT_QUOTES)));

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    

                    $publishers_set = $this->model_books->related_publishers();
$categories_set = $this->model_books->related_categories();
$users_set = $this->model_books->related_users();
$book_types_set = $this->model_books->related_book_types();


                    $this->template->assign( 'related_publishers', $publishers_set );
$this->template->assign( 'related_categories', $categories_set );
$this->template->assign( 'related_users', $users_set );
$this->template->assign( 'related_book_types', $book_types_set );

                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'books_data', $data_post );
            		$this->template->assign( 'books_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_books->metadata() );
            		$this->template->assign( 'table_name', 'Books' );
            		$this->template->assign( 'template', 'form_books' );
            		$this->template->display( 'frame_public.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_books->insert( $data_post );
                    
					redirect( 'index.php/books/' );
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
                $this->model_books->raw_data = TRUE;
        		$data = $this->model_books->get( $id );
                $fields = $this->model_books->fields();
                $publishers_set = $this->model_books->related_publishers();
$categories_set = $this->model_books->related_categories();
$users_set = $this->model_books->related_users();
$book_types_set = $this->model_books->related_book_types();

                

                $this->template->assign( 'related_publishers', $publishers_set );
$this->template->assign( 'related_categories', $categories_set );
$this->template->assign( 'related_users', $users_set );
$this->template->assign( 'related_book_types', $book_types_set );

                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'books_data', $data );
        		$this->template->assign( 'books_fields', $fields );
                $this->template->assign( 'metadata', $this->model_books->metadata() );
        		$this->template->assign( 'table_name', 'Books' );
        		$this->template->assign( 'template', 'form_books' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_public.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_books->fields();
                /* we set the rules */
                /* dont forget to edit these */
$this->form_validation->set_rules( 'Book_Title', lang('Book_Title'), 'required|max_length[100]' );
$this->form_validation->set_rules( 'Book_Author', lang('Book_Author'), 'required|max_length[30]' );
$this->form_validation->set_rules( 'Book_ISBN', lang('Book_ISBN'), 'required|max_length[40]' );
$this->form_validation->set_rules( 'book_publisher_id', lang('book_publisher_id'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'book_category_id', lang('book_category_id'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'book_uploader_id', lang('book_uploader_id'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'book_type_id', lang('book_type_id'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'book_downloads', lang('book_downloads'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'book_size', lang('book_size'), 'required|max_length[10]|integer' );
$this->form_validation->set_rules( 'Book_Path', lang('Book_Path'), 'required|max_length[150]' );
$this->form_validation->set_rules( 'book_IsApproved', lang('book_IsApproved'), 'required|max_length[1]|integer' );
$this->form_validation->set_rules( 'book_Date_Inserted', lang('book_Date_Inserted'), 'required' );

    
$data_post['Book_Title'] = htmlspecialchars($this->input->post( 'Book_Title' ), ENT_QUOTES);
$data_post['Book_Author'] = htmlspecialchars($this->input->post( 'Book_Author' ), ENT_QUOTES);
$data_post['Book_ISBN'] = htmlspecialchars($this->input->post( 'Book_ISBN' ), ENT_QUOTES);
$data_post['book_publisher_id'] = $this->input->post( 'book_publisher_id' );
$data_post['book_category_id'] = $this->input->post( 'book_category_id' );
$data_post['book_uploader_id'] = $this->input->post( 'book_uploader_id' );
$data_post['book_type_id'] = $this->input->post( 'book_type_id' );
$data_post['book_downloads'] = $this->input->post( 'book_downloads' );
$data_post['book_size'] = $this->input->post( 'book_size' );
$data_post['Book_Path'] = htmlspecialchars($this->input->post( 'Book_Path' ), ENT_QUOTES);
$data_post['book_IsApproved'] = $this->input->post( 'book_IsApproved' );
$data_post['book_Date_Inserted'] =strftime("%Y-%m-%d %H:%M:%S", strtotime( htmlspecialchars($this->input->post( 'book_Date_Inserted' ), ENT_QUOTES)));

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    

                    $publishers_set = $this->model_books->related_publishers();
$categories_set = $this->model_books->related_categories();
$users_set = $this->model_books->related_users();
$book_types_set = $this->model_books->related_book_types();


                    $this->template->assign( 'related_publishers', $publishers_set );
$this->template->assign( 'related_categories', $categories_set );
$this->template->assign( 'related_users', $users_set );
$this->template->assign( 'related_book_types', $book_types_set );

                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'books_data', $data_post );
            		$this->template->assign( 'books_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_books->metadata() );
            		$this->template->assign( 'table_name', 'Books' );
            		$this->template->assign( 'template', 'form_books' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_public.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_books->update( $id, $data_post );
				    
					redirect( 'index.php/books');
                }
            break;
        }
    }
    
    /**
     *  DELETES RECORD
     */
    function delete( $id )
    {
        $this->model_books->delete( $id );
        redirect( $_SERVER['HTTP_REFERER'] );
    }
}


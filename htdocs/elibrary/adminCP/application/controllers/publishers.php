<?php

class Publishers extends Controller 
{
    
	function Publishers ()
	{
		parent::Controller();	

		$this->load->library( 'template' ); 
		$this->load->model( 'model_publishers' ); 
		

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
        $this->model_publishers->pagination( FALSE );
		$data_info = $this->model_publishers->lister( $page );
        $fields = $this->model_publishers->fields( TRUE );

        $this->template->assign( 'pager', $this->model_publishers->pager );
		$this->template->assign( 'publishers_fields', $fields );
		$this->template->assign( 'publishers_data', $data_info );
		$this->template->assign( 'table_name', 'Publishers' );
		$this->template->assign( 'template', 'list_publishers' );
		$this->template->display( 'frame_public.tpl' );
    }

    /**
     *  SHOWS A RECORD VIEW
     */
    function show( $id )
    {
		$data = $this->model_publishers->get( $id );
        $fields = $this->model_publishers->fields( TRUE );

		$this->template->assign( 'id', $id );
		$this->template->assign( 'publishers_fields', $fields );
		$this->template->assign( 'publishers_data', $data );
		$this->template->assign( 'table_name', 'Publishers' );
		$this->template->assign( 'template', 'show_publishers' );
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
                $fields = $this->model_publishers->fields();
                

                
                
                $this->template->assign( 'action_mode', 'create' );
        		$this->template->assign( 'publishers_fields', $fields );
                $this->template->assign( 'metadata', $this->model_publishers->metadata() );
        		$this->template->assign( 'table_name', 'Publishers' );
        		$this->template->assign( 'template', 'form_publishers' );
        		$this->template->display( 'frame_public.tpl' );
            break;

            /**
             *  Insert data TO publishers table
             */
            case 'POST':
                $fields = $this->model_publishers->fields();

                /* we set the rules */
                /* dont forget to edit these */
$this->form_validation->set_rules( 'publisher_name', lang('publisher_name'), 'required|max_length[50]' );

    
$data_post['publisher_name'] = htmlspecialchars($this->input->post( 'publisher_name' ), ENT_QUOTES);

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    

                    

                    
                    
              		$this->template->assign( 'errors', $errors );
              		$this->template->assign( 'action_mode', 'create' );
            		$this->template->assign( 'publishers_data', $data_post );
            		$this->template->assign( 'publishers_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_publishers->metadata() );
            		$this->template->assign( 'table_name', 'Publishers' );
            		$this->template->assign( 'template', 'form_publishers' );
            		$this->template->display( 'frame_public.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
                    $insert_id = $this->model_publishers->insert( $data_post );
                    
					redirect( 'index.php/publishers/' );
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
                $this->model_publishers->raw_data = TRUE;
        		$data = $this->model_publishers->get( $id );
                $fields = $this->model_publishers->fields();
                
                

                
                
          		$this->template->assign( 'action_mode', 'edit' );
        		$this->template->assign( 'publishers_data', $data );
        		$this->template->assign( 'publishers_fields', $fields );
                $this->template->assign( 'metadata', $this->model_publishers->metadata() );
        		$this->template->assign( 'table_name', 'Publishers' );
        		$this->template->assign( 'template', 'form_publishers' );
        		$this->template->assign( 'record_id', $id );
        		$this->template->display( 'frame_public.tpl' );
            break;
    
            case 'POST':
    
                $fields = $this->model_publishers->fields();
                /* we set the rules */
                /* dont forget to edit these */
$this->form_validation->set_rules( 'publisher_name', lang('publisher_name'), 'required|max_length[50]' );

    
$data_post['publisher_name'] = htmlspecialchars($this->input->post( 'publisher_name' ), ENT_QUOTES);

                if ( $this->form_validation->run() == FALSE )
                {
                    $errors = validation_errors();
                    

                    

                    
                    
              		$this->template->assign( 'action_mode', 'edit' );
              		$this->template->assign( 'errors', $errors );
            		$this->template->assign( 'publishers_data', $data_post );
            		$this->template->assign( 'publishers_fields', $fields );
                    $this->template->assign( 'metadata', $this->model_publishers->metadata() );
            		$this->template->assign( 'table_name', 'Publishers' );
            		$this->template->assign( 'template', 'form_publishers' );
        		    $this->template->assign( 'record_id', $id );
            		$this->template->display( 'frame_public.tpl' );
                }
                elseif ( $this->form_validation->run() == TRUE )
                {
				    $this->model_publishers->update( $id, $data_post );
				    
					redirect( 'index.php/publishers/' );
                }
            break;
        }
    }
    
    /**
     *  DELETES RECORD
     */
    function delete( $id )
    {
        $this->model_publishers->delete( $id );
        redirect( $_SERVER['HTTP_REFERER'] );
    }
}


<?php

class Model_books extends Model 
{
    function Model_books()
    {
        parent::Model(); 
		$this->load->database();
		
		// Paginaiton defaults
		$this->pagination_enabled = FALSE;
		$this->pagination_per_page = 10;
		$this->pagination_num_links = 5;
		$this->pager = '';
		
        /**
		 *    bool $this->raw_data		
		 *    Used to decide what data should the SQL queries retrieve if tables are joined
		 *     - TRUE:  just the field names of the books table
		 *     - FALSE: related fields are replaced with the forign tables values
		 *    Triggered to TRUE in the controller/edit method		 
		 */
        $this->raw_data = FALSE;  
    }

	function get ( $id, $get_one = false )
	{
        
	    $select_statement = ( $this->raw_data ) ? 'Book_Id,Book_Title,Book_Author,Book_ISBN,book_publisher_id,book_category_id,book_uploader_id,book_type_id,book_downloads,book_size,Book_Path,book_IsApproved,book_Date_Inserted' : 'Book_Id,Book_Title,Book_Author,Book_ISBN,publishers.publisher_name AS book_publisher_id,categories.Category_name AS book_category_id,users.user_name AS book_uploader_id,book_types.type_name AS book_type_id,book_downloads,book_size,Book_Path,book_IsApproved,book_Date_Inserted';
		$this->db->select( $select_statement );
		$this->db->from('books');
        $this->db->join( 'publishers', 'book_publisher_id = publisher_id', 'left' );
$this->db->join( 'categories', 'book_category_id = category_id', 'left' );
$this->db->join( 'users', 'book_uploader_id = user_id', 'left' );
$this->db->join( 'book_types', 'book_type_id = type_id', 'left' );


		// Pick one record
		// Field order sample may be empty because no record is requested, eg. create/GET event
		if( $get_one )
        {
            $this->db->limit(1,0);
        }
		else // Select the desired record
        {
            $this->db->where( 'Book_Id', $id );
        }

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
	'Book_Id' => $row['Book_Id'],
	'Book_Title' => $row['Book_Title'],
	'Book_Author' => $row['Book_Author'],
	'Book_ISBN' => $row['Book_ISBN'],
	'book_publisher_id' => $row['book_publisher_id'],
	'book_category_id' => $row['book_category_id'],
	'book_uploader_id' => $row['book_uploader_id'],
	'book_type_id' => $row['book_type_id'],
	'book_downloads' => $row['book_downloads'],
	'book_size' => $row['book_size'],
	'Book_Path' => $row['Book_Path'],
	'book_IsApproved' => $row['book_IsApproved'],
	'book_Date_Inserted' => $row['book_Date_Inserted'],
 );
		}
        else
        {
            return array();
        }
	}

	function insert ( $data )
	{
		$this->db->insert( 'books', $data );
		return $this->db->insert_id();
	}
	
	function update ( $id, $data )
	{
		$this->db->where( 'Book_Id', $id );
		$this->db->update( 'books',  $data);
	}
	
	function delete ( $id )
	{
		$this->db->where( 'Book_Id', $id );
		$this->db->delete( 'books' );
	}
	
	function lister ( $page = FALSE )
	{
        
	    $this->db->start_cache();
		$this->db->select( 'Book_Id,Book_Title,Book_Author,Book_ISBN,publishers.publisher_name AS book_publisher_id,categories.Category_name AS book_category_id,users.user_name AS book_uploader_id,book_types.type_name AS book_type_id,book_downloads,book_size,Book_Path,book_IsApproved,book_Date_Inserted');
		$this->db->from( 'books' );
		//$this->db->order_by( '', 'ASC' );
        $this->db->join( 'publishers', 'book_publisher_id = publisher_id', 'left' );
$this->db->join( 'categories', 'book_category_id = category_id', 'left' );
$this->db->join( 'users', 'book_uploader_id = user_id', 'left' );
$this->db->join( 'book_types', 'book_type_id = type_id', 'left' );


        /**
         *   PAGINATION
         */
        if( $this->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results('books');
            $config['base_url']    = '/books/index/';
            $config['uri_segment'] = 3;
            $config['per_page']    = $this->pagination_per_page;
            $config['num_links']   = $this->pagination_num_links;
    
            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $this->pager = $this->pagination->create_links();
    
            $this->db->limit( $config['per_page'], $page );
        }

        // Get the results
		$query = $this->db->get();
		
		$temp_result = array();

		foreach ( $query->result_array() as $row )
		{
			$temp_result[] = array( 
	'Book_Id' => $row['Book_Id'],
	'Book_Title' => $row['Book_Title'],
	'Book_Author' => $row['Book_Author'],
	'Book_ISBN' => $row['Book_ISBN'],
	'book_publisher_id' => $row['book_publisher_id'],
	'book_category_id' => $row['book_category_id'],
	'book_uploader_id' => $row['book_uploader_id'],
	'book_type_id' => $row['book_type_id'],
	'book_downloads' => $row['book_downloads'],
	'book_size' => $row['book_size'],
	'Book_Path' => $row['Book_Path'],
	'book_IsApproved' => $row['book_IsApproved'],
	'book_Date_Inserted' => $row['book_Date_Inserted'],
 );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}

	function search ( $keyword, $page = FALSE )
	{
	    $meta = $this->metadata();
	    $this->db->start_cache();
		$this->db->select( 'Book_Id,Book_Title,Book_Author,Book_ISBN,publishers.publisher_name AS book_publisher_id,categories.Category_name AS book_category_id,users.user_name AS book_uploader_id,book_types.type_name AS book_type_id,book_downloads,book_size,Book_Path,book_IsApproved,book_Date_Inserted');
		$this->db->from( 'books' );
        $this->db->join( 'publishers', 'book_publisher_id = publisher_id', 'left' );
$this->db->join( 'categories', 'book_category_id = category_id', 'left' );
$this->db->join( 'users', 'book_uploader_id = user_id', 'left' );
$this->db->join( 'book_types', 'book_type_id = type_id', 'left' );


		// Delete this line after setting up the search conditions 
        die('Please see models/model_books.php for setting up the search method.');
		
        /**
         *  Rename field_name_to_search to the field you wish to search 
         *  or create advanced search conditions here
		 */
        $this->db->where( 'field_name_to_search LIKE "%'.$keyword.'%"' );

        /**
         *   PAGINATION
         */
        if( $this->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results('books');
            $config['base_url']    = '/books/search/'.$keyword.'/';
            $config['uri_segment'] = 4;
            $config['per_page']    = $this->pagination_per_page;
            $config['num_links']   = $this->pagination_num_links;
    
            $this->load->library('pagination');
            $this->pagination->initialize($config);
            $this->pager = $this->pagination->create_links();
    
            $this->db->limit( $config['per_page'], $page );
        }

		$query = $this->db->get();

		$temp_result = array();

		foreach ( $query->result_array() as $row )
		{
			$temp_result[] = array( 
	'Book_Id' => $row['Book_Id'],
	'Book_Title' => $row['Book_Title'],
	'Book_Author' => $row['Book_Author'],
	'Book_ISBN' => $row['Book_ISBN'],
	'book_publisher_id' => $row['book_publisher_id'],
	'book_category_id' => $row['book_category_id'],
	'book_uploader_id' => $row['book_uploader_id'],
	'book_type_id' => $row['book_type_id'],
	'book_downloads' => $row['book_downloads'],
	'book_size' => $row['book_size'],
	'Book_Path' => $row['Book_Path'],
	'book_IsApproved' => $row['book_IsApproved'],
	'book_Date_Inserted' => $row['book_Date_Inserted'],
 );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}

	function related_publishers()
    {
        $this->db->select( 'publisher_id AS publishers_id, publisher_name AS publishers_name' );
        $rel_data = $this->db->get( 'publishers' );
        return $rel_data->result_array();
    }



	function related_categories()
    {
        $this->db->select( 'category_id AS categories_id, Category_name AS categories_name' );
        $rel_data = $this->db->get( 'categories' );
        return $rel_data->result_array();
    }



	function related_users()
    {
        $this->db->select( 'user_id AS users_id, user_name AS users_name' );
        $rel_data = $this->db->get( 'users' );
        return $rel_data->result_array();
    }



	function related_book_types()
    {
        $this->db->select( 'type_id AS book_types_id, type_name AS book_types_name' );
        $rel_data = $this->db->get( 'book_types' );
        return $rel_data->result_array();
    }







    /**
     *  Some utility methods
     */
    function fields( $withID = FALSE )
    {
        $fs = array(
	'Book_Id' => lang('Book_Id'),
	'Book_Title' => lang('Book_Title'),
	'Book_Author' => lang('Book_Author'),
	'Book_ISBN' => lang('Book_ISBN'),
	'book_publisher_id' => lang('book_publisher_id'),
	'book_category_id' => lang('book_category_id'),
	'book_uploader_id' => lang('book_uploader_id'),
	'book_type_id' => lang('book_type_id'),
	'book_downloads' => lang('book_downloads'),
	'book_size' => lang('book_size'),
	'Book_Path' => lang('Book_Path'),
	'book_IsApproved' => lang('book_IsApproved'),
	'book_Date_Inserted' => lang('book_Date_Inserted')
);

        if( $withID == FALSE )
        {
            unset( $fs[0] );
        }
        return $fs;
    }  
    
    function pagination( $bool )
    {
        $this->pagination_enabled = ( $bool === TRUE ) ? TRUE : FALSE;
    }

    /**
     *  Parses the table data and look for enum values, to match them with language variables
     */             
    function metadata()
    {
        $this->load->library('explain_table');

        $metadata = $this->explain_table->parse( 'books' );

        foreach( $metadata as $k => $md )
        {
            if( !empty( $md['enum_values'] ) )
            {
                $metadata[ $k ]['enum_names'] = array_map( 'lang', $md['enum_values'] );                
            } 
        }
        return $metadata; 
    }
}

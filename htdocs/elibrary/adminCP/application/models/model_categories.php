<?php

class Model_categories extends Model 
{
    function Model_categories()
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
		 *     - TRUE:  just the field names of the categories table
		 *     - FALSE: related fields are replaced with the forign tables values
		 *    Triggered to TRUE in the controller/edit method		 
		 */
        $this->raw_data = FALSE;  
    }

	function get ( $id, $get_one = false )
	{
        
	    $select_statement = ( $this->raw_data ) ? 'category_id,category_department_id,Category_name' : 'category_id,departments.department_name AS category_department_id,Category_name';
		$this->db->select( $select_statement );
		$this->db->from('categories');
        $this->db->join( 'departments', 'category_department_id = department_id', 'left' );


		// Pick one record
		// Field order sample may be empty because no record is requested, eg. create/GET event
		if( $get_one )
        {
            $this->db->limit(1,0);
        }
		else // Select the desired record
        {
            $this->db->where( 'category_id', $id );
        }

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
	'category_id' => $row['category_id'],
	'category_department_id' => $row['category_department_id'],
	'Category_name' => $row['Category_name'],
 );
		}
        else
        {
            return array();
        }
	}

	function insert ( $data )
	{
		$this->db->insert( 'categories', $data );
		return $this->db->insert_id();
	}
	
	function update ( $id, $data )
	{
		$this->db->where( 'category_id', $id );
		$this->db->update( 'categories', $data );
	}
	
	function delete ( $id )
	{
		$this->db->where( 'category_id', $id );
		$this->db->delete( 'categories' );
	}
	
	function lister ( $page = FALSE )
	{
        
	    $this->db->start_cache();
		$this->db->select( 'category_id,departments.department_name AS category_department_id,Category_name');
		$this->db->from( 'categories' );
		//$this->db->order_by( '', 'ASC' );
        $this->db->join( 'departments', 'category_department_id = department_id', 'left' );


        /**
         *   PAGINATION
         */
        if( $this->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results('categories');
            $config['base_url']    = '/categories/index/';
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
	'category_id' => $row['category_id'],
	'category_department_id' => $row['category_department_id'],
	'Category_name' => $row['Category_name'],
 );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}

	function search ( $keyword, $page = FALSE )
	{
	    $meta = $this->metadata();
	    $this->db->start_cache();
		$this->db->select( 'category_id,departments.department_name AS category_department_id,Category_name');
		$this->db->from( 'categories' );
        $this->db->join( 'departments', 'category_department_id = department_id', 'left' );


		// Delete this line after setting up the search conditions 
        die('Please see models/model_categories.php for setting up the search method.');
		
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
            $config['total_rows']  = $this->db->count_all_results('categories');
            $config['base_url']    = '/categories/search/'.$keyword.'/';
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
	'category_id' => $row['category_id'],
	'category_department_id' => $row['category_department_id'],
	'Category_name' => $row['Category_name'],
 );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}

	function related_departments()
    {
        $this->db->select( 'department_id AS departments_id, department_name AS departments_name' );
        $rel_data = $this->db->get( 'departments' );
        return $rel_data->result_array();
    }







    /**
     *  Some utility methods
     */
    function fields( $withID = FALSE )
    {
        $fs = array(
	'category_id' => lang('category_id'),
	'category_department_id' => lang('category_department_id'),
	'Category_name' => lang('Category_name')
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

        $metadata = $this->explain_table->parse( 'categories' );

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

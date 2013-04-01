<?php

class Model_batch extends Model 
{
    function Model_batch()
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
		 *     - TRUE:  just the field names of the batch table
		 *     - FALSE: related fields are replaced with the forign tables values
		 *    Triggered to TRUE in the controller/edit method		 
		 */
        $this->raw_data = FALSE;  
    }

	function get ( $id, $get_one = false )
	{
        $meta = $this->metadata();
	    $select_statement = ( $this->raw_data ) ? 'batch.batchid,batch.batchname,batch.semester,batch.section,batch.programid,batch.shift' : 'batch.batchid,batch.batchname,batch.semester,batch.section,program.programname AS programid,batch.shift';
		$this->db->select( $select_statement );
		$this->db->from('batch');
        $this->db->join( 'program', 'batch.programid = program.programid', 'left' );


		// Pick one record
		// Field order sample may be empty because no record is requested, eg. create/GET event
		if( $get_one )
        {
            $this->db->limit(1,0);
        }
		else // Select the desired record
        {
            $this->db->where( 'batchid', $id );
        }

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
	'batchid' => $row['batchid'],
	'batchname' => $row['batchname'],
	'semester' => $row['semester'],
	'section' => $row['section'],
	'programid' => $row['programid'],
	'shift' => $row['shift'] /*( array_search( $row['shift'], $meta['shift']['enum_values'] ) !== FALSE ) ? $meta['shift']['enum_names'][ array_search( $row['shift'], $meta['shift']['enum_values'] ) ] : '' */,
 );
		}
        else
        {
            return array();
        }
	}

	function insert ( $data )
	{
		$this->db->insert( 'batch', $data );
		return $this->db->insert_id();
	}
	
	function update ( $id, $data )
	{
		$this->db->where( 'batchid', $id );
		$this->db->update( 'batch', $data );
	}
	
	function delete ( $id )
	{
		$this->db->where( 'batchid', $id );
		$this->db->delete( 'batch' );
	}
	
	function lister ( $page = FALSE )
	{
        $meta = $this->metadata();
	    $this->db->start_cache();
		$this->db->select( 'batch.batchid,batch.batchname,batch.semester,batch.section,program.programname AS programid,batch.shift');
		$this->db->from( 'batch' );
		$this->db->order_by( 'batchid', 'DESC' );
        $this->db->join( 'program', 'batch.programid = program.programid', 'left' );


        /**
         *   PAGINATION
         */
        if( $this->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results('batch');
            $config['base_url']    = 'index.php/batch/index/';
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
	'batchid' => $row['batchid'],
	'batchname' => $row['batchname'],
	'semester' => $row['semester'],
	'section' => $row['section'],
	'programid' => $row['programid'],
	'shift' => $row['shift'] /*( array_search( $row['shift'], $meta['shift']['enum_values'] ) !== FALSE ) ? $meta['shift']['enum_names'][ array_search( $row['shift'], $meta['shift']['enum_values'] ) ] : '' */,
 );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}

	function search ( $keyword, $page = FALSE )
	{
	    $meta = $this->metadata();
	    $this->db->start_cache();
		$this->db->select( 'batch.batchid,batch.batchname,batch.semester,batch.section,program.programname AS programid,batch.shift');
		$this->db->from( 'batch' );
        $this->db->join( 'program', 'batch.programid = program.programid', 'left' );


		// Delete this line after setting up the search conditions 
        die('Please see models/model_batch.php for setting up the search method.');
		
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
            $config['total_rows']  = $this->db->count_all_results('batch');
            $config['base_url']    = '/batch/search/'.$keyword.'/';
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
	'batchid' => $row['batchid'],
	'batchname' => $row['batchname'],
	'semester' => $row['semester'],
	'section' => $row['section'],
	'programid' => $row['programid'],
	'shift' => $row['shift'] /*( array_search( $row['shift'], $meta['shift']['enum_values'] ) !== FALSE ) ? $meta['shift']['enum_names'][ array_search( $row['shift'], $meta['shift']['enum_values'] ) ] : '' */,
 );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}

	function related_program()
    {
        $this->db->select( 'programid AS program_id, programname AS program_name' );
        $rel_data = $this->db->get( 'program' );
        return $rel_data->result_array();
    }







    /**
     *  Some utility methods
     */
    function fields( $withID = FALSE )
    {
        $fs = array(
	'batch.batchid' => lang('batch.batchid'),
	'batch.batchname' => lang('batch.batchname'),
	'batch.semester' => lang('batch.semester'),
	'batch.section' => lang('batch.section'),
	'batch.programid' => lang('batch.programid'),
	'batch.shift' => lang('batch.shift')
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

        $metadata = $this->explain_table->parse( 'batch' );

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

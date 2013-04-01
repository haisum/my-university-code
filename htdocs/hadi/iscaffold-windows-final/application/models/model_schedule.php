<?php

class Model_schedule extends Model 
{
    function Model_schedule()
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
		 *     - TRUE:  just the field names of the schedule table
		 *     - FALSE: related fields are replaced with the forign tables values
		 *    Triggered to TRUE in the controller/edit method		 
		 */
        $this->raw_data = FALSE;  
    }

	function get ( $id, $get_one = false )
	{
        $meta = $this->metadata();
	    $select_statement = ( $this->raw_data ) ? 'schedule.scheduleid,schedule.courseid,schedule.teacherid,schedule.room,schedule.batchid,schedule.programid,schedule.fromdate,schedule.todate,schedule.day,schedule.slotid' : 'schedule.scheduleid,course.coursename AS courseid,teacher.teachername AS teacherid,schedule.room, schedule.batchid AS batchid,program.programname AS programid,schedule.fromdate,schedule.todate,schedule.day,slot.duration AS slotid';
		$this->db->select( $select_statement );
		$this->db->from('schedule');
        $this->db->join( 'course', 'schedule.courseid = course.courseid', 'left' );
$this->db->join( 'teacher', 'schedule.teacherid = teacher.teacherid', 'left' );
$this->db->join( 'batch', 'schedule.batchid = batch.batchid', 'left' );
$this->db->join( 'program', 'schedule.programid = program.programid', 'left' );
$this->db->join( 'slot', 'schedule.slotid = slot.slotid', 'left' );


		// Pick one record
		// Field order sample may be empty because no record is requested, eg. create/GET event
		if( $get_one )
        {
            $this->db->limit(1,0);
        }
		else // Select the desired record
        {
            $this->db->where( 'scheduleid', $id );
        }

		$query = $this->db->get();

		if ( $query->num_rows() > 0 )
		{
			$row = $query->row_array();
			return array( 
	'scheduleid' => $row['scheduleid'],
	'courseid' => $row['courseid'],
	'teacherid' => $row['teacherid'],
	'room' => $row['room'],
	'batchid' => $row['batchid'],
	'programid' => $row['programid'],
	'fromdate' => $row['fromdate'],
	'todate' => $row['todate'],
	'day' => $row['day'] /*( array_search( $row['day'], $meta['day']['enum_values'] ) !== FALSE ) ? $meta['day']['enum_names'][ array_search( $row['day'], $meta['day']['enum_values'] ) ] : '' */,
	'slotid' => $row['slotid'],
 );
		}
        else
        {
            return array();
        }
	}

	function insert ( $data )
	{
		$this->db->insert( 'schedule', $data );
		return $this->db->insert_id();
	}
	
	function update ( $id, $data )
	{
		$this->db->where( 'scheduleid', $id );
		$this->db->update( 'schedule', $data );
	}
	
	function delete ( $id )
	{
		$this->db->where( 'scheduleid', $id );
		$this->db->delete( 'schedule' );
	}
	
	function lister ( $page = FALSE )
	{
        $meta = $this->metadata();
	    $this->db->start_cache();
		$this->db->select( 'schedule.scheduleid,course.coursename AS courseid,teacher.teachername AS teacherid,schedule.room, CONCAT( batch.batchname , batch.semester , batch.section ) AS batchid,program.programname AS programid,schedule.fromdate,schedule.todate,schedule.day,slot.duration AS slotid');
		$this->db->from( 'schedule' );
		$this->db->order_by( 'scheduleid', 'DESC' );
        $this->db->join( 'course', 'schedule.courseid = course.courseid', 'left' );
$this->db->join( 'teacher', 'schedule.teacherid = teacher.teacherid', 'left' );
$this->db->join( 'batch', 'schedule.batchid = batch.batchid', 'left' );
$this->db->join( 'program', 'schedule.programid = program.programid', 'left' );
$this->db->join( 'slot', 'schedule.slotid = slot.slotid', 'left' );


        /**
         *   PAGINATION
         */
        if( $this->pagination_enabled == TRUE )
        {
            $config = array();
            $config['total_rows']  = $this->db->count_all_results('schedule');
            $config['base_url']    = 'index.php/schedule/index/';
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
	'scheduleid' => $row['scheduleid'],
	'courseid' => $row['courseid'],
	'teacherid' => $row['teacherid'],
	'room' => $row['room'],
	'batchid' => $row['batchid'],
	'programid' => $row['programid'],
	'fromdate' => $row['fromdate'],
	'todate' => $row['todate'],
	'day' => $row['day'] /*( array_search( $row['day'], $meta['day']['enum_values'] ) !== FALSE ) ? $meta['day']['enum_names'][ array_search( $row['day'], $meta['day']['enum_values'] ) ] : '' */,
	'slotid' => $row['slotid'],
 );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}

	function search ( $keyword, $page = FALSE )
	{
	    $meta = $this->metadata();
	    $this->db->start_cache();
		$this->db->select( 'schedule.scheduleid,course.coursename AS courseid,teacher.teachername AS teacherid,schedule.room,batch.batchname AS batchid,program.programname AS programid,schedule.fromdate,schedule.todate,schedule.day,slot.duration AS slotid');
		$this->db->from( 'schedule' );
        $this->db->join( 'course', 'schedule.courseid = course.courseid', 'left' );
$this->db->join( 'teacher', 'schedule.teacherid = teacher.teacherid', 'left' );
$this->db->join( 'batch', 'schedule.batchid = batch.batchid', 'left' );
$this->db->join( 'program', 'schedule.programid = program.programid', 'left' );
$this->db->join( 'slot', 'schedule.slotid = slot.slotid', 'left' );


		// Delete this line after setting up the search conditions 
        die('Please see models/model_schedule.php for setting up the search method.');
		
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
            $config['total_rows']  = $this->db->count_all_results('schedule');
            $config['base_url']    = '/schedule/search/'.$keyword.'/';
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
	'scheduleid' => $row['scheduleid'],
	'courseid' => $row['courseid'],
	'teacherid' => $row['teacherid'],
	'room' => $row['room'],
	'batchid' => $row['batchid'],
	'programid' => $row['programid'],
	'fromdate' => $row['fromdate'],
	'todate' => $row['todate'],
	'day' => $row['day'] /*( array_search( $row['day'], $meta['day']['enum_values'] ) !== FALSE ) ? $meta['day']['enum_names'][ array_search( $row['day'], $meta['day']['enum_values'] ) ] : '' */,
	'slotid' => $row['slotid'],
 );
		}
        $this->db->flush_cache(); 
		return $temp_result;
	}

	function related_course()
    {
        $this->db->select( 'courseid AS course_id, coursename AS course_name' );
        $rel_data = $this->db->get( 'course' );
        return $rel_data->result_array();
    }



	function related_teacher()
    {
        $this->db->select( 'teacherid AS teacher_id, teachername AS teacher_name' );
        $rel_data = $this->db->get( 'teacher' );
        return $rel_data->result_array();
    }



	function related_batch()
    {
        $this->db->select( 'batchid AS batch_id, CONCAT( batch.batchname , batch.semester , batch.section ) AS batch_name' );
        $rel_data = $this->db->get( 'batch' );
        return $rel_data->result_array();
    }



	function related_program()
    {
        $this->db->select( 'programid AS program_id, programname AS program_name' );
        $rel_data = $this->db->get( 'program' );
        return $rel_data->result_array();
    }



	function related_slot()
    {
        $this->db->select( 'slotid AS slot_id, duration AS slot_name' );
        $rel_data = $this->db->get( 'slot' );
        return $rel_data->result_array();
    }







    /**
     *  Some utility methods
     */
    function fields( $withID = FALSE )
    {
        $fs = array(
	'schedule.scheduleid' => lang('schedule.scheduleid'),
	'schedule.courseid' => lang('schedule.courseid'),
	'schedule.teacherid' => lang('schedule.teacherid'),
	'schedule.room' => lang('schedule.room'),
	'schedule.batchid' => lang('schedule.batchid'),
	'schedule.programid' => lang('schedule.programid'),
	'schedule.fromdate' => lang('schedule.fromdate'),
	'schedule.todate' => lang('schedule.todate'),
	'schedule.day' => lang('schedule.day'),
	'schedule.slotid' => lang('schedule.slotid')
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

        $metadata = $this->explain_table->parse( 'schedule' );

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

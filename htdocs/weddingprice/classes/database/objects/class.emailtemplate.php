<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `emailtemplate` (
	`emailtemplateid` int(11) NOT NULL auto_increment,
	`type` VARCHAR(255) NOT NULL,
	`body` VARCHAR(255) NOT NULL,
	`subject` VARCHAR(255) NOT NULL,
	`from` VARCHAR(255) NOT NULL,
	`fromname` VARCHAR(255) NOT NULL,
	`to` VARCHAR(255) NOT NULL, PRIMARY KEY  (`emailtemplateid`)) ENGINE=MyISAM;
*/

/**
* <b>EmailTemplate</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=EmailTemplate&attributeList=array+%28%0A++0+%3D%3E+%27type%27%2C%0A++1+%3D%3E+%27body%27%2C%0A++2+%3D%3E+%27subject%27%2C%0A++3+%3D%3E+%27from%27%2C%0A++4+%3D%3E+%27fromName%27%2C%0A++5+%3D%3E+%27to%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++4+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++5+%3D%3E+%27VARCHAR%28255%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class EmailTemplate extends POG_Base
{
	public $emailtemplateId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $type;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $body;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $subject;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $from;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $fromName;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $to;
	
	public $pog_attribute_type = array(
		"emailtemplateId" => array('db_attributes' => array("NUMERIC", "INT")),
		"type" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"body" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"subject" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"from" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"fromName" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"to" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		);
	public $pog_query;
	
	
	/**
	* Getter for some private attributes
	* @return mixed $attribute
	*/
	public function __get($attribute)
	{
		if (isset($this->{"_".$attribute}))
		{
			return $this->{"_".$attribute};
		}
		else
		{
			return false;
		}
	}
	
	function EmailTemplate($type='', $body='', $subject='', $from='', $fromName='', $to='')
	{
		$this->type = $type;
		$this->body = $body;
		$this->subject = $subject;
		$this->from = $from;
		$this->fromName = $fromName;
		$this->to = $to;
	}
	
	
	/**
	* Gets object from database
	* @param integer $emailtemplateId 
	* @return object $EmailTemplate
	*/
	function Get($emailtemplateId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `emailtemplate` where `emailtemplateid`='".intval($emailtemplateId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->emailtemplateId = $row['emailtemplateid'];
			$this->type = $this->Unescape($row['type']);
			$this->body = $this->Unescape($row['body']);
			$this->subject = $this->Unescape($row['subject']);
			$this->from = $this->Unescape($row['from']);
			$this->fromName = $this->Unescape($row['fromname']);
			$this->to = $this->Unescape($row['to']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $emailtemplateList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `emailtemplate` ";
		$emailtemplateList = Array();
		if (sizeof($fcv_array) > 0)
		{
			$this->pog_query .= " where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$this->pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) != 1)
					{
						$this->pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						if ($GLOBALS['configuration']['db_encoding'] == 1)
						{
							$value = POG_Base::IsColumn($fcv_array[$i][2]) ? "BASE64_DECODE(".$fcv_array[$i][2].")" : "'".$fcv_array[$i][2]."'";
							$this->pog_query .= "BASE64_DECODE(`".$fcv_array[$i][0]."`) ".$fcv_array[$i][1]." ".$value;
						}
						else
						{
							$value =  POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$this->Escape($fcv_array[$i][2])."'";
							$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
						}
					}
					else
					{
						$value = POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$fcv_array[$i][2]."'";
						$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
					}
				}
			}
		}
		if ($sortBy != '')
		{
			if (isset($this->pog_attribute_type[$sortBy]['db_attributes']) && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'SET')
			{
				if ($GLOBALS['configuration']['db_encoding'] == 1)
				{
					$sortBy = "BASE64_DECODE($sortBy) ";
				}
				else
				{
					$sortBy = "$sortBy ";
				}
			}
			else
			{
				$sortBy = "$sortBy ";
			}
		}
		else
		{
			$sortBy = "emailtemplateid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$emailtemplate = new $thisObjectName();
			$emailtemplate->emailtemplateId = $row['emailtemplateid'];
			$emailtemplate->type = $this->Unescape($row['type']);
			$emailtemplate->body = $this->Unescape($row['body']);
			$emailtemplate->subject = $this->Unescape($row['subject']);
			$emailtemplate->from = $this->Unescape($row['from']);
			$emailtemplate->fromName = $this->Unescape($row['fromname']);
			$emailtemplate->to = $this->Unescape($row['to']);
			$emailtemplateList[] = $emailtemplate;
		}
		return $emailtemplateList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $emailtemplateId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `emailtemplateid` from `emailtemplate` where `emailtemplateid`='".$this->emailtemplateId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `emailtemplate` set 
			`type`='".$this->Escape($this->type)."', 
			`body`='".$this->Escape($this->body)."', 
			`subject`='".$this->Escape($this->subject)."', 
			`from`='".$this->Escape($this->from)."', 
			`fromname`='".$this->Escape($this->fromName)."', 
			`to`='".$this->Escape($this->to)."' where `emailtemplateid`='".$this->emailtemplateId."'";
		}
		else
		{
			$this->pog_query = "insert into `emailtemplate` (`type`, `body`, `subject`, `from`, `fromname`, `to` ) values (
			'".$this->Escape($this->type)."', 
			'".$this->Escape($this->body)."', 
			'".$this->Escape($this->subject)."', 
			'".$this->Escape($this->from)."', 
			'".$this->Escape($this->fromName)."', 
			'".$this->Escape($this->to)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->emailtemplateId == "")
		{
			$this->emailtemplateId = $insertId;
		}
		return $this->emailtemplateId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $emailtemplateId
	*/
	function SaveNew()
	{
		$this->emailtemplateId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `emailtemplate` where `emailtemplateid`='".$this->emailtemplateId."'";
		return Database::NonQuery($this->pog_query, $connection);
	}
	
	
	/**
	* Deletes a list of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param bool $deep 
	* @return 
	*/
	function DeleteList($fcv_array)
	{
		if (sizeof($fcv_array) > 0)
		{
			$connection = Database::Connect();
			$pog_query = "delete from `emailtemplate` where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) !== 1)
					{
						$pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$this->Escape($fcv_array[$i][2])."'";
					}
					else
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$fcv_array[$i][2]."'";
					}
				}
			}
			return Database::NonQuery($pog_query, $connection);
		}
	}
}
?>
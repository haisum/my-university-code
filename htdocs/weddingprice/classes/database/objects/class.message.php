<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `message` (
	`messageid` int(11) NOT NULL auto_increment,
	`fromid` INT NOT NULL,
	`toid` INT NOT NULL,
	`content` TEXT NOT NULL,
	`date` DATETIME NOT NULL,
	`isread` ENUM('YES', 'NO') NOT NULL,
	`status` ENUM('SHOW','HIDE') NOT NULL,
	`weddingid` int(11) NOT NULL,
	`from` enum('Buyer', 'Supplier') NOT NULL, INDEX(`weddingid`), PRIMARY KEY  (`messageid`)) ENGINE=MyISAM;
*/

/**
* <b>Message</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=Message&attributeList=array+%28%0A++0+%3D%3E+%27fromId%27%2C%0A++1+%3D%3E+%27toId%27%2C%0A++2+%3D%3E+%27content%27%2C%0A++3+%3D%3E+%27date%27%2C%0A++4+%3D%3E+%27isRead%27%2C%0A++5+%3D%3E+%27status%27%2C%0A++6+%3D%3E+%27Wedding%27%2C%0A++7+%3D%3E+%27from%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27INT%27%2C%0A++2+%3D%3E+%27TEXT%27%2C%0A++3+%3D%3E+%27DATETIME%27%2C%0A++4+%3D%3E+%27ENUM%28%5C%5C%5C%27YES%5C%5C%5C%27%2C+%5C%5C%5C%27NO%5C%5C%5C%27%29%27%2C%0A++5+%3D%3E+%27ENUM%28%5C%5C%5C%27SHOW%5C%5C%5C%27%2C%5C%5C%5C%27HIDE%5C%5C%5C%27%29%27%2C%0A++6+%3D%3E+%27BELONGSTO%27%2C%0A++7+%3D%3E+%27enum%28%5C%5C%5C%27Buyer%5C%5C%5C%27%2C+%5C%5C%5C%27Supplier%5C%5C%5C%27%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class Message extends POG_Base
{
	public $messageId = '';

	/**
	 * @var INT
	 */
	public $fromId;
	
	/**
	 * @var INT
	 */
	public $toId;
	
	/**
	 * @var TEXT
	 */
	public $content;
	
	/**
	 * @var DATETIME
	 */
	public $date;
	
	/**
	 * @var ENUM('YES', 'NO')
	 */
	public $isRead;
	
	/**
	 * @var ENUM('SHOW','HIDE')
	 */
	public $status;
	
	/**
	 * @var INT(11)
	 */
	public $weddingId;
	
	/**
	 * @var enum('Buyer', 'Supplier')
	 */
	public $from;
	
	public $pog_attribute_type = array(
		"messageId" => array('db_attributes' => array("NUMERIC", "INT")),
		"fromId" => array('db_attributes' => array("NUMERIC", "INT")),
		"toId" => array('db_attributes' => array("NUMERIC", "INT")),
		"content" => array('db_attributes' => array("TEXT", "TEXT")),
		"date" => array('db_attributes' => array("TEXT", "DATETIME")),
		"isRead" => array('db_attributes' => array("SET", "ENUM", "'YES', 'NO'")),
		"status" => array('db_attributes' => array("SET", "ENUM", "'SHOW','HIDE'")),
		"Wedding" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"from" => array('db_attributes' => array("SET", "ENUM", "'Buyer', 'Supplier'")),
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
	
	function Message($fromId='', $toId='', $content='', $date='', $isRead='', $status='', $from='Buyer')
	{
		$this->fromId = $fromId;
		$this->toId = $toId;
		$this->content = $content;
		$this->date = $date;
		$this->isRead = $isRead;
		$this->status = $status;
		$this->from = $from;
	}
	
	
	/**
	* Gets object from database
	* @param integer $messageId 
	* @return object $Message
	*/
	function Get($messageId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `message` where `messageid`='".intval($messageId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->messageId = $row['messageid'];
			$this->fromId = $this->Unescape($row['fromid']);
			$this->toId = $this->Unescape($row['toid']);
			$this->content = $this->Unescape($row['content']);
			$this->date = $row['date'];
			$this->isRead = $row['isread'];
			$this->status = $row['status'];
			$this->weddingId = $row['weddingid'];
			$this->from = $row['from'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $messageList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `message` ";
		$messageList = Array();
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
			$sortBy = "messageid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$message = new $thisObjectName();
			$message->messageId = $row['messageid'];
			$message->fromId = $this->Unescape($row['fromid']);
			$message->toId = $this->Unescape($row['toid']);
			$message->content = $this->Unescape($row['content']);
			$message->date = $row['date'];
			$message->isRead = $row['isread'];
			$message->status = $row['status'];
			$message->weddingId = $row['weddingid'];
			$message->from = $row['from'];
			$messageList[] = $message;
		}
		return $messageList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $messageId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `messageid` from `message` where `messageid`='".$this->messageId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `message` set 
			`fromid`='".$this->Escape($this->fromId)."', 
			`toid`='".$this->Escape($this->toId)."', 
			`content`='".$this->Escape($this->content)."', 
			`date`='".$this->date."', 
			`isread`='".$this->isRead."', 
			`status`='".$this->status."', 
			`weddingid`='".$this->weddingId."', 
			`from`='".$this->from."' where `messageid`='".$this->messageId."'";
		}
		else
		{
			$this->pog_query = "insert into `message` (`fromid`, `toid`, `content`, `date`, `isread`, `status`, `weddingid`, `from` ) values (
			'".$this->Escape($this->fromId)."', 
			'".$this->Escape($this->toId)."', 
			'".$this->Escape($this->content)."', 
			'".$this->date."', 
			'".$this->isRead."', 
			'".$this->status."', 
			'".$this->weddingId."', 
			'".$this->from."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->messageId == "")
		{
			$this->messageId = $insertId;
		}
		return $this->messageId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $messageId
	*/
	function SaveNew()
	{
		$this->messageId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `message` where `messageid`='".$this->messageId."'";
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
			$pog_query = "delete from `message` where ";
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
	
	
	/**
	* Associates the Wedding object to this one
	* @return boolean
	*/
	function GetWedding()
	{
		$wedding = new Wedding();
		return $wedding->Get($this->weddingId);
	}
	
	
	/**
	* Associates the Wedding object to this one
	* @return 
	*/
	function SetWedding(&$wedding)
	{
		$this->weddingId = $wedding->weddingId;
	}
}
?>
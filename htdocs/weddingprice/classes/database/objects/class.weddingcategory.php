<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `weddingcategory` (
	`weddingcategoryid` int(11) NOT NULL auto_increment,
	`weddingid` INT NOT NULL,
	`categoryid` INT NOT NULL,
	`budgetto` INT NOT NULL,
	`budgetfrom` INT NOT NULL,
	`status` ENUM('PENDING', 'ACCEPTED') NOT NULL,
	`detail` TEXT NOT NULL,
	`biddeadline` DATETIME NOT NULL,
	`lastmodified` DATETIME NOT NULL,
	`posteddate` DATETIME NOT NULL, PRIMARY KEY  (`weddingcategoryid`)) ENGINE=MyISAM;
*/

/**
* <b>WeddingCategory</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=WeddingCategory&attributeList=array+%28%0A++0+%3D%3E+%27weddingId%27%2C%0A++1+%3D%3E+%27categoryId%27%2C%0A++2+%3D%3E+%27budgetTo%27%2C%0A++3+%3D%3E+%27budgetFrom%27%2C%0A++4+%3D%3E+%27status%27%2C%0A++5+%3D%3E+%27detail%27%2C%0A++6+%3D%3E+%27bidDeadline%27%2C%0A++7+%3D%3E+%27lastModified%27%2C%0A++8+%3D%3E+%27postedDate%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27INT%27%2C%0A++2+%3D%3E+%27INT%27%2C%0A++3+%3D%3E+%27INT%27%2C%0A++4+%3D%3E+%27ENUM%28%5C%5C%5C%27PENDING%5C%5C%5C%27%2C+%5C%5C%5C%27ACCEPTED%5C%5C%5C%27%29%27%2C%0A++5+%3D%3E+%27TEXT%27%2C%0A++6+%3D%3E+%27DATETIME%27%2C%0A++7+%3D%3E+%27DATETIME%27%2C%0A++8+%3D%3E+%27DATETIME%27%2C%0A%29
*/
include_once('class.pog_base.php');
class WeddingCategory extends POG_Base
{
	public $weddingcategoryId = '';

	/**
	 * @var INT
	 */
	public $weddingId;
	
	/**
	 * @var INT
	 */
	public $categoryId;
	
	/**
	 * @var INT
	 */
	public $budgetTo;
	
	/**
	 * @var INT
	 */
	public $budgetFrom;
	
	/**
	 * @var ENUM('PENDING', 'ACCEPTED')
	 */
	public $status;
	
	/**
	 * @var TEXT
	 */
	public $detail;
	
	/**
	 * @var DATETIME
	 */
	public $bidDeadline;
	
	/**
	 * @var DATETIME
	 */
	public $lastModified;
	
	/**
	 * @var DATETIME
	 */
	public $postedDate;
	
	public $pog_attribute_type = array(
		"weddingcategoryId" => array('db_attributes' => array("NUMERIC", "INT")),
		"weddingId" => array('db_attributes' => array("NUMERIC", "INT")),
		"categoryId" => array('db_attributes' => array("NUMERIC", "INT")),
		"budgetTo" => array('db_attributes' => array("NUMERIC", "INT")),
		"budgetFrom" => array('db_attributes' => array("NUMERIC", "INT")),
		"status" => array('db_attributes' => array("SET", "ENUM", "'PENDING', 'ACCEPTED'")),
		"detail" => array('db_attributes' => array("TEXT", "TEXT")),
		"bidDeadline" => array('db_attributes' => array("TEXT", "DATETIME")),
		"lastModified" => array('db_attributes' => array("TEXT", "DATETIME")),
		"postedDate" => array('db_attributes' => array("TEXT", "DATETIME")),
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
	
	function WeddingCategory($weddingId='', $categoryId='', $budgetTo='', $budgetFrom='', $status='', $detail='', $bidDeadline='', $lastModified='', $postedDate='')
	{
		$this->weddingId = $weddingId;
		$this->categoryId = $categoryId;
		$this->budgetTo = $budgetTo;
		$this->budgetFrom = $budgetFrom;
		$this->status = $status;
		$this->detail = $detail;
		$this->bidDeadline = $bidDeadline;
		$this->lastModified = $lastModified;
		$this->postedDate = $postedDate;
	}
	
	
	/**
	* Gets object from database
	* @param integer $weddingcategoryId 
	* @return object $WeddingCategory
	*/
	function Get($weddingcategoryId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `weddingcategory` where `weddingcategoryid`='".intval($weddingcategoryId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->weddingcategoryId = $row['weddingcategoryid'];
			$this->weddingId = $this->Unescape($row['weddingid']);
			$this->categoryId = $this->Unescape($row['categoryid']);
			$this->budgetTo = $this->Unescape($row['budgetto']);
			$this->budgetFrom = $this->Unescape($row['budgetfrom']);
			$this->status = $row['status'];
			$this->detail = $this->Unescape($row['detail']);
			$this->bidDeadline = $row['biddeadline'];
			$this->lastModified = $row['lastmodified'];
			$this->postedDate = $row['posteddate'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $weddingcategoryList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `weddingcategory` ";
		$weddingcategoryList = Array();
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
			$sortBy = "weddingcategoryid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$weddingcategory = new $thisObjectName();
			$weddingcategory->weddingcategoryId = $row['weddingcategoryid'];
			$weddingcategory->weddingId = $this->Unescape($row['weddingid']);
			$weddingcategory->categoryId = $this->Unescape($row['categoryid']);
			$weddingcategory->budgetTo = $this->Unescape($row['budgetto']);
			$weddingcategory->budgetFrom = $this->Unescape($row['budgetfrom']);
			$weddingcategory->status = $row['status'];
			$weddingcategory->detail = $this->Unescape($row['detail']);
			$weddingcategory->bidDeadline = $row['biddeadline'];
			$weddingcategory->lastModified = $row['lastmodified'];
			$weddingcategory->postedDate = $row['posteddate'];
			$weddingcategoryList[] = $weddingcategory;
		}
		return $weddingcategoryList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $weddingcategoryId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `weddingcategoryid` from `weddingcategory` where `weddingcategoryid`='".$this->weddingcategoryId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `weddingcategory` set 
			`weddingid`='".$this->Escape($this->weddingId)."', 
			`categoryid`='".$this->Escape($this->categoryId)."', 
			`budgetto`='".$this->Escape($this->budgetTo)."', 
			`budgetfrom`='".$this->Escape($this->budgetFrom)."', 
			`status`='".$this->status."', 
			`detail`='".$this->Escape($this->detail)."', 
			`biddeadline`='".$this->bidDeadline."', 
			`lastmodified`='".$this->lastModified."', 
			`posteddate`='".$this->postedDate."' where `weddingcategoryid`='".$this->weddingcategoryId."'";
		}
		else
		{
			$this->pog_query = "insert into `weddingcategory` (`weddingid`, `categoryid`, `budgetto`, `budgetfrom`, `status`, `detail`, `biddeadline`, `lastmodified`, `posteddate` ) values (
			'".$this->Escape($this->weddingId)."', 
			'".$this->Escape($this->categoryId)."', 
			'".$this->Escape($this->budgetTo)."', 
			'".$this->Escape($this->budgetFrom)."', 
			'".$this->status."', 
			'".$this->Escape($this->detail)."', 
			'".$this->bidDeadline."', 
			'".$this->lastModified."', 
			'".$this->postedDate."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->weddingcategoryId == "")
		{
			$this->weddingcategoryId = $insertId;
		}
		return $this->weddingcategoryId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $weddingcategoryId
	*/
	function SaveNew()
	{
		$this->weddingcategoryId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `weddingcategory` where `weddingcategoryid`='".$this->weddingcategoryId."'";
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
			$pog_query = "delete from `weddingcategory` where ";
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
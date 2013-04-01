<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `bid` (
	`bidid` int(11) NOT NULL auto_increment,
	`weddingcategoryid` int(11) NOT NULL,
	`amount` INT NOT NULL,
	`date` VARCHAR(255) NOT NULL,
	`supplierid` int(11) NOT NULL,
	`biddescription` TEXT NOT NULL,
	`lastmodified` DATETIME NOT NULL,
	`status` ENUM(\\\\\\\'ACCEPTED\\\\\\\', \\\\\\\'REJECTED\\\\\\\', \\\\\\\'PENDING\\\\\\\') NOT NULL,
	`weddingid` INT NOT NULL,
	`categoryid` INT NOT NULL, INDEX(`weddingcategoryid`,`supplierid`), PRIMARY KEY  (`bidid`)) ENGINE=MyISAM;
*/

/**
* <b>Bid</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=Bid&attributeList=array+%28%0A++0+%3D%3E+%27WeddingCategory%27%2C%0A++1+%3D%3E+%27amount%27%2C%0A++2+%3D%3E+%27date%27%2C%0A++3+%3D%3E+%27Supplier%27%2C%0A++4+%3D%3E+%27bidDescription%27%2C%0A++5+%3D%3E+%27lastModified%27%2C%0A++6+%3D%3E+%27status%27%2C%0A++7+%3D%3E+%27weddingId%27%2C%0A++8+%3D%3E+%27categoryId%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27BELONGSTO%27%2C%0A++1+%3D%3E+%27INT%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27BELONGSTO%27%2C%0A++4+%3D%3E+%27TEXT%27%2C%0A++5+%3D%3E+%27DATETIME%27%2C%0A++6+%3D%3E+%27ENUM%28%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%27ACCEPTED%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%27%2C+%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%27REJECTED%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%27%2C+%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%27PENDING%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%5C%27%29%27%2C%0A++7+%3D%3E+%27INT%27%2C%0A++8+%3D%3E+%27INT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class Bid extends POG_Base
{
	public $bidId = '';

	/**
	 * @var INT(11)
	 */
	public $weddingcategoryId;
	
	/**
	 * @var INT
	 */
	public $amount;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $date;
	
	/**
	 * @var INT(11)
	 */
	public $supplierId;
	
	/**
	 * @var TEXT
	 */
	public $bidDescription;
	
	/**
	 * @var DATETIME
	 */
	public $lastModified;
	
	/**
	 * @var ENUM(\\\\\\\'ACCEPTED\\\\\\\', \\\\\\\'REJECTED\\\\\\\', \\\\\\\'PENDING\\\\\\\')
	 */
	public $status;
	
	/**
	 * @var INT
	 */
	public $weddingId;
	
	/**
	 * @var INT
	 */
	public $categoryId;
	
	public $pog_attribute_type = array(
		"bidId" => array('db_attributes' => array("NUMERIC", "INT")),
		"WeddingCategory" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"amount" => array('db_attributes' => array("NUMERIC", "INT")),
		"date" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"Supplier" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"bidDescription" => array('db_attributes' => array("TEXT", "TEXT")),
		"lastModified" => array('db_attributes' => array("TEXT", "DATETIME")),
		"status" => array('db_attributes' => array("SET", "ENUM", "\\\\\\\'ACCEPTED\\\\\\\', \\\\\\\'REJECTED\\\\\\\', \\\\\\\'PENDING\\\\\\\'")),
		"weddingId" => array('db_attributes' => array("NUMERIC", "INT")),
		"categoryId" => array('db_attributes' => array("NUMERIC", "INT")),
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
	
	function Bid($amount='', $date='', $bidDescription='', $lastModified='', $status='', $weddingId='', $categoryId='')
	{
		$this->amount = $amount;
		$this->date = $date;
		$this->bidDescription = $bidDescription;
		$this->lastModified = $lastModified;
		$this->status = $status;
		$this->weddingId = $weddingId;
		$this->categoryId = $categoryId;
	}
	
	
	/**
	* Gets object from database
	* @param integer $bidId 
	* @return object $Bid
	*/
	function Get($bidId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `bid` where `bidid`='".intval($bidId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->bidId = $row['bidid'];
			$this->weddingcategoryId = $row['weddingcategoryid'];
			$this->amount = $this->Unescape($row['amount']);
			$this->date = $this->Unescape($row['date']);
			$this->supplierId = $row['supplierid'];
			$this->bidDescription = $this->Unescape($row['biddescription']);
			$this->lastModified = $row['lastmodified'];
			$this->status = $row['status'];
			$this->weddingId = $this->Unescape($row['weddingid']);
			$this->categoryId = $this->Unescape($row['categoryid']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $bidList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `bid` ";
		$bidList = Array();
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
			$sortBy = "bidid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$bid = new $thisObjectName();
			$bid->bidId = $row['bidid'];
			$bid->weddingcategoryId = $row['weddingcategoryid'];
			$bid->amount = $this->Unescape($row['amount']);
			$bid->date = $this->Unescape($row['date']);
			$bid->supplierId = $row['supplierid'];
			$bid->bidDescription = $this->Unescape($row['biddescription']);
			$bid->lastModified = $row['lastmodified'];
			$bid->status = $row['status'];
			$bid->weddingId = $this->Unescape($row['weddingid']);
			$bid->categoryId = $this->Unescape($row['categoryid']);
			$bidList[] = $bid;
		}
		return $bidList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $bidId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `bidid` from `bid` where `bidid`='".$this->bidId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `bid` set 
			`weddingcategoryid`='".$this->weddingcategoryId."', 
			`amount`='".$this->Escape($this->amount)."', 
			`date`='".$this->Escape($this->date)."', 
			`supplierid`='".$this->supplierId."', 
			`biddescription`='".$this->Escape($this->bidDescription)."', 
			`lastmodified`='".$this->lastModified."', 
			`status`='".$this->status."', 
			`weddingid`='".$this->Escape($this->weddingId)."', 
			`categoryid`='".$this->Escape($this->categoryId)."' where `bidid`='".$this->bidId."'";
		}
		else
		{
			$this->pog_query = "insert into `bid` (`weddingcategoryid`, `amount`, `date`, `supplierid`, `biddescription`, `lastmodified`, `status`, `weddingid`, `categoryid` ) values (
			'".$this->weddingcategoryId."', 
			'".$this->Escape($this->amount)."', 
			'".$this->Escape($this->date)."', 
			'".$this->supplierId."', 
			'".$this->Escape($this->bidDescription)."', 
			'".$this->lastModified."', 
			'".$this->status."', 
			'".$this->Escape($this->weddingId)."', 
			'".$this->Escape($this->categoryId)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->bidId == "")
		{
			$this->bidId = $insertId;
		}
		return $this->bidId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $bidId
	*/
	function SaveNew()
	{
		$this->bidId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `bid` where `bidid`='".$this->bidId."'";
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
			$pog_query = "delete from `bid` where ";
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
	* Associates the WeddingCategory object to this one
	* @return boolean
	*/
	function GetWeddingcategory()
	{
		$weddingcategory = new WeddingCategory();
		return $weddingcategory->Get($this->weddingcategoryId);
	}
	
	
	/**
	* Associates the WeddingCategory object to this one
	* @return 
	*/
	function SetWeddingcategory(&$weddingcategory)
	{
		$this->weddingcategoryId = $weddingcategory->weddingcategoryId;
	}
	
	
	/**
	* Associates the Supplier object to this one
	* @return boolean
	*/
	function GetSupplier()
	{
		$supplier = new Supplier();
		return $supplier->Get($this->supplierId);
	}
	
	
	/**
	* Associates the Supplier object to this one
	* @return 
	*/
	function SetSupplier(&$supplier)
	{
		$this->supplierId = $supplier->supplierId;
	}
}
?>
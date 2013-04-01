<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `goldpayment` (
	`goldpaymentid` int(11) NOT NULL auto_increment,
	`supplierid` INT NOT NULL,
	`package` enum('3', '6', '12') NOT NULL,
	`amount` INT NOT NULL,
	`status` enum('VERIFIED', 'PENDING') NOT NULL,
	`date` DATETIME NOT NULL,
	`expiredate` DATETIME NOT NULL,
	`responsearray` TEXT NOT NULL, PRIMARY KEY  (`goldpaymentid`)) ENGINE=MyISAM;
*/

/**
* <b>GoldPayment</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=GoldPayment&attributeList=array+%28%0A++0+%3D%3E+%27supplierId%27%2C%0A++1+%3D%3E+%27package%27%2C%0A++2+%3D%3E+%27amount%27%2C%0A++3+%3D%3E+%27status%27%2C%0A++4+%3D%3E+%27date%27%2C%0A++5+%3D%3E+%27expireDate%27%2C%0A++6+%3D%3E+%27responseArray%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27enum%28%5C%5C%5C%273%5C%5C%5C%27%2C+%5C%5C%5C%276%5C%5C%5C%27%2C+%5C%5C%5C%2712%5C%5C%5C%27%29%27%2C%0A++2+%3D%3E+%27INT%27%2C%0A++3+%3D%3E+%27enum%28%5C%5C%5C%27VERIFIED%5C%5C%5C%27%2C+%5C%5C%5C%27PENDING%5C%5C%5C%27%29%27%2C%0A++4+%3D%3E+%27DATETIME%27%2C%0A++5+%3D%3E+%27DATETIME%27%2C%0A++6+%3D%3E+%27TEXT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class GoldPayment extends POG_Base
{
	public $goldpaymentId = '';

	/**
	 * @var INT
	 */
	public $supplierId;
	
	/**
	 * @var enum('3', '6', '12')
	 */
	public $package;
	
	/**
	 * @var INT
	 */
	public $amount;
	
	/**
	 * @var enum('VERIFIED', 'PENDING')
	 */
	public $status;
	
	/**
	 * @var DATETIME
	 */
	public $date;
	
	/**
	 * @var DATETIME
	 */
	public $expireDate;
	
	/**
	 * @var TEXT
	 */
	public $responseArray;
	
	public $pog_attribute_type = array(
		"goldpaymentId" => array('db_attributes' => array("NUMERIC", "INT")),
		"supplierId" => array('db_attributes' => array("NUMERIC", "INT")),
		"package" => array('db_attributes' => array("SET", "ENUM", "'3', '6', '12'")),
		"amount" => array('db_attributes' => array("NUMERIC", "INT")),
		"status" => array('db_attributes' => array("SET", "ENUM", "'VERIFIED', 'PENDING'")),
		"date" => array('db_attributes' => array("TEXT", "DATETIME")),
		"expireDate" => array('db_attributes' => array("TEXT", "DATETIME")),
		"responseArray" => array('db_attributes' => array("TEXT", "TEXT")),
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
	
	function GoldPayment($supplierId='', $package='', $amount='', $status='', $date='', $expireDate='', $responseArray='')
	{
		$this->supplierId = $supplierId;
		$this->package = $package;
		$this->amount = $amount;
		$this->status = $status;
		$this->date = $date;
		$this->expireDate = $expireDate;
		$this->responseArray = $responseArray;
	}
	
	
	/**
	* Gets object from database
	* @param integer $goldpaymentId 
	* @return object $GoldPayment
	*/
	function Get($goldpaymentId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `goldpayment` where `goldpaymentid`='".intval($goldpaymentId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->goldpaymentId = $row['goldpaymentid'];
			$this->supplierId = $this->Unescape($row['supplierid']);
			$this->package = $row['package'];
			$this->amount = $this->Unescape($row['amount']);
			$this->status = $row['status'];
			$this->date = $row['date'];
			$this->expireDate = $row['expiredate'];
			$this->responseArray = $this->Unescape($row['responsearray']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $goldpaymentList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `goldpayment` ";
		$goldpaymentList = Array();
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
			$sortBy = "goldpaymentid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$goldpayment = new $thisObjectName();
			$goldpayment->goldpaymentId = $row['goldpaymentid'];
			$goldpayment->supplierId = $this->Unescape($row['supplierid']);
			$goldpayment->package = $row['package'];
			$goldpayment->amount = $this->Unescape($row['amount']);
			$goldpayment->status = $row['status'];
			$goldpayment->date = $row['date'];
			$goldpayment->expireDate = $row['expiredate'];
			$goldpayment->responseArray = $this->Unescape($row['responsearray']);
			$goldpaymentList[] = $goldpayment;
		}
		return $goldpaymentList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $goldpaymentId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `goldpaymentid` from `goldpayment` where `goldpaymentid`='".$this->goldpaymentId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `goldpayment` set 
			`supplierid`='".$this->Escape($this->supplierId)."', 
			`package`='".$this->package."', 
			`amount`='".$this->Escape($this->amount)."', 
			`status`='".$this->status."', 
			`date`='".$this->date."', 
			`expiredate`='".$this->expireDate."', 
			`responsearray`='".$this->Escape($this->responseArray)."' where `goldpaymentid`='".$this->goldpaymentId."'";
		}
		else
		{
			$this->pog_query = "insert into `goldpayment` (`supplierid`, `package`, `amount`, `status`, `date`, `expiredate`, `responsearray` ) values (
			'".$this->Escape($this->supplierId)."', 
			'".$this->package."', 
			'".$this->Escape($this->amount)."', 
			'".$this->status."', 
			'".$this->date."', 
			'".$this->expireDate."', 
			'".$this->Escape($this->responseArray)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->goldpaymentId == "")
		{
			$this->goldpaymentId = $insertId;
		}
		return $this->goldpaymentId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $goldpaymentId
	*/
	function SaveNew()
	{
		$this->goldpaymentId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `goldpayment` where `goldpaymentid`='".$this->goldpaymentId."'";
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
			$pog_query = "delete from `goldpayment` where ";
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
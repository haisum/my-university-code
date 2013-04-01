<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `paypaladpayment` (
	`paypaladpaymentid` int(11) NOT NULL auto_increment,
	`specialofferid` INT NOT NULL,
	`content` TEXT NOT NULL, PRIMARY KEY  (`paypaladpaymentid`)) ENGINE=MyISAM;
*/

/**
* <b>PaypalAdPayment</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=PaypalAdPayment&attributeList=array+%28%0A++0+%3D%3E+%27specialofferid%27%2C%0A++1+%3D%3E+%27content%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27INT%27%2C%0A++1+%3D%3E+%27TEXT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class PaypalAdPayment extends POG_Base
{
	public $paypaladpaymentId = '';

	/**
	 * @var INT
	 */
	public $specialofferid;
	
	/**
	 * @var TEXT
	 */
	public $content;
	
	public $pog_attribute_type = array(
		"paypaladpaymentId" => array('db_attributes' => array("NUMERIC", "INT")),
		"specialofferid" => array('db_attributes' => array("NUMERIC", "INT")),
		"content" => array('db_attributes' => array("TEXT", "TEXT")),
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
	
	function PaypalAdPayment($specialofferid='', $content='')
	{
		$this->specialofferid = $specialofferid;
		$this->content = $content;
	}
	
	
	/**
	* Gets object from database
	* @param integer $paypaladpaymentId 
	* @return object $PaypalAdPayment
	*/
	function Get($paypaladpaymentId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `paypaladpayment` where `paypaladpaymentid`='".intval($paypaladpaymentId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->paypaladpaymentId = $row['paypaladpaymentid'];
			$this->specialofferid = $this->Unescape($row['specialofferid']);
			$this->content = $this->Unescape($row['content']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $paypaladpaymentList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `paypaladpayment` ";
		$paypaladpaymentList = Array();
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
			$sortBy = "paypaladpaymentid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$paypaladpayment = new $thisObjectName();
			$paypaladpayment->paypaladpaymentId = $row['paypaladpaymentid'];
			$paypaladpayment->specialofferid = $this->Unescape($row['specialofferid']);
			$paypaladpayment->content = $this->Unescape($row['content']);
			$paypaladpaymentList[] = $paypaladpayment;
		}
		return $paypaladpaymentList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $paypaladpaymentId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `paypaladpaymentid` from `paypaladpayment` where `paypaladpaymentid`='".$this->paypaladpaymentId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `paypaladpayment` set 
			`specialofferid`='".$this->Escape($this->specialofferid)."', 
			`content`='".$this->Escape($this->content)."' where `paypaladpaymentid`='".$this->paypaladpaymentId."'";
		}
		else
		{
			$this->pog_query = "insert into `paypaladpayment` (`specialofferid`, `content` ) values (
			'".$this->Escape($this->specialofferid)."', 
			'".$this->Escape($this->content)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->paypaladpaymentId == "")
		{
			$this->paypaladpaymentId = $insertId;
		}
		return $this->paypaladpaymentId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $paypaladpaymentId
	*/
	function SaveNew()
	{
		$this->paypaladpaymentId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `paypaladpayment` where `paypaladpaymentid`='".$this->paypaladpaymentId."'";
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
			$pog_query = "delete from `paypaladpayment` where ";
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
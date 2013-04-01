<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `country` (
	`countryid` int(11) NOT NULL auto_increment,
	`name` VARCHAR(255) NOT NULL,
	`abbreviation` VARCHAR(3) NOT NULL,
	`isactive` ENUM ('YES', 'NO') NOT NULL, PRIMARY KEY  (`countryid`)) ENGINE=MyISAM;
*/

/**
* <b>Country</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=Country&attributeList=array+%28%0A++0+%3D%3E+%27name%27%2C%0A++1+%3D%3E+%27abbreviation%27%2C%0A++2+%3D%3E+%27Region%27%2C%0A++3+%3D%3E+%27Supplier%27%2C%0A++4+%3D%3E+%27Buyer%27%2C%0A++5+%3D%3E+%27isActive%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%283%29%27%2C%0A++2+%3D%3E+%27HASMANY%27%2C%0A++3+%3D%3E+%27HASMANY%27%2C%0A++4+%3D%3E+%27HASMANY%27%2C%0A++5+%3D%3E+%27ENUM+%28%5C%5C%5C%27YES%5C%5C%5C%27%2C+%5C%5C%5C%27NO%5C%5C%5C%27%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class Country extends POG_Base
{
	public $countryId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $name;
	
	/**
	 * @var VARCHAR(3)
	 */
	public $abbreviation;
	
	/**
	 * @var private array of Region objects
	 */
	private $_regionList = array();
	
	/**
	 * @var private array of Supplier objects
	 */
	private $_supplierList = array();
	
	/**
	 * @var private array of Buyer objects
	 */
	private $_buyerList = array();
	
	/**
	 * @var ENUM ('YES', 'NO')
	 */
	public $isActive;
	
	public $pog_attribute_type = array(
		"countryId" => array('db_attributes' => array("NUMERIC", "INT")),
		"name" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"abbreviation" => array('db_attributes' => array("TEXT", "VARCHAR", "3")),
		"Region" => array('db_attributes' => array("OBJECT", "HASMANY")),
		"Supplier" => array('db_attributes' => array("OBJECT", "HASMANY")),
		"Buyer" => array('db_attributes' => array("OBJECT", "HASMANY")),
		"isActive" => array('db_attributes' => array("SET", "ENUM", "'YES', 'NO'")),
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
	
	function Country($name='', $abbreviation='', $isActive='')
	{
		$this->name = $name;
		$this->abbreviation = $abbreviation;
		$this->_regionList = array();
		$this->_supplierList = array();
		$this->_buyerList = array();
		$this->isActive = $isActive;
	}
	
	
	/**
	* Gets object from database
	* @param integer $countryId 
	* @return object $Country
	*/
	function Get($countryId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `country` where `countryid`='".intval($countryId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->countryId = $row['countryid'];
			$this->name = $this->Unescape($row['name']);
			$this->abbreviation = $this->Unescape($row['abbreviation']);
			$this->isActive = $row['isactive'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $countryList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `country` ";
		$countryList = Array();
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
			$sortBy = "countryid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$country = new $thisObjectName();
			$country->countryId = $row['countryid'];
			$country->name = $this->Unescape($row['name']);
			$country->abbreviation = $this->Unescape($row['abbreviation']);
			$country->isActive = $row['isactive'];
			$countryList[] = $country;
		}
		return $countryList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $countryId
	*/
	function Save($deep = true)
	{
		$connection = Database::Connect();
		$this->pog_query = "select `countryid` from `country` where `countryid`='".$this->countryId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `country` set 
			`name`='".$this->Escape($this->name)."', 
			`abbreviation`='".$this->Escape($this->abbreviation)."', 
			`isactive`='".$this->isActive."' where `countryid`='".$this->countryId."'";
		}
		else
		{
			$this->pog_query = "insert into `country` (`name`, `abbreviation`, `isactive` ) values (
			'".$this->Escape($this->name)."', 
			'".$this->Escape($this->abbreviation)."', 
			'".$this->isActive."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->countryId == "")
		{
			$this->countryId = $insertId;
		}
		if ($deep)
		{
			foreach ($this->_regionList as $region)
			{
				$region->countryId = $this->countryId;
				$region->Save($deep);
			}
			foreach ($this->_supplierList as $supplier)
			{
				$supplier->countryId = $this->countryId;
				$supplier->Save($deep);
			}
			foreach ($this->_buyerList as $buyer)
			{
				$buyer->countryId = $this->countryId;
				$buyer->Save($deep);
			}
		}
		return $this->countryId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $countryId
	*/
	function SaveNew($deep = false)
	{
		$this->countryId = '';
		return $this->Save($deep);
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete($deep = false, $across = false)
	{
		if ($deep)
		{
			$regionList = $this->GetRegionList();
			foreach ($regionList as $region)
			{
				$region->Delete($deep, $across);
			}
			$supplierList = $this->GetSupplierList();
			foreach ($supplierList as $supplier)
			{
				$supplier->Delete($deep, $across);
			}
			$buyerList = $this->GetBuyerList();
			foreach ($buyerList as $buyer)
			{
				$buyer->Delete($deep, $across);
			}
		}
		$connection = Database::Connect();
		$this->pog_query = "delete from `country` where `countryid`='".$this->countryId."'";
		return Database::NonQuery($this->pog_query, $connection);
	}
	
	
	/**
	* Deletes a list of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param bool $deep 
	* @return 
	*/
	function DeleteList($fcv_array, $deep = false, $across = false)
	{
		if (sizeof($fcv_array) > 0)
		{
			if ($deep || $across)
			{
				$objectList = $this->GetList($fcv_array);
				foreach ($objectList as $object)
				{
					$object->Delete($deep, $across);
				}
			}
			else
			{
				$connection = Database::Connect();
				$pog_query = "delete from `country` where ";
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
	
	
	/**
	* Gets a list of Region objects associated to this one
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array of Region objects
	*/
	function GetRegionList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$region = new Region();
		$fcv_array[] = array("countryId", "=", $this->countryId);
		$dbObjects = $region->GetList($fcv_array, $sortBy, $ascending, $limit);
		return $dbObjects;
	}
	
	
	/**
	* Makes this the parent of all Region objects in the Region List array. Any existing Region will become orphan(s)
	* @return null
	*/
	function SetRegionList(&$list)
	{
		$this->_regionList = array();
		$existingRegionList = $this->GetRegionList();
		foreach ($existingRegionList as $region)
		{
			$region->countryId = '';
			$region->Save(false);
		}
		$this->_regionList = $list;
	}
	
	
	/**
	* Associates the Region object to this one
	* @return 
	*/
	function AddRegion(&$region)
	{
		$region->countryId = $this->countryId;
		$found = false;
		foreach($this->_regionList as $region2)
		{
			if ($region->regionId > 0 && $region->regionId == $region2->regionId)
			{
				$found = true;
				break;
			}
		}
		if (!$found)
		{
			$this->_regionList[] = $region;
		}
	}
	
	
	/**
	* Gets a list of Supplier objects associated to this one
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array of Supplier objects
	*/
	function GetSupplierList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$supplier = new Supplier();
		$fcv_array[] = array("countryId", "=", $this->countryId);
		$dbObjects = $supplier->GetList($fcv_array, $sortBy, $ascending, $limit);
		return $dbObjects;
	}
	
	
	/**
	* Makes this the parent of all Supplier objects in the Supplier List array. Any existing Supplier will become orphan(s)
	* @return null
	*/
	function SetSupplierList(&$list)
	{
		$this->_supplierList = array();
		$existingSupplierList = $this->GetSupplierList();
		foreach ($existingSupplierList as $supplier)
		{
			$supplier->countryId = '';
			$supplier->Save(false);
		}
		$this->_supplierList = $list;
	}
	
	
	/**
	* Associates the Supplier object to this one
	* @return 
	*/
	function AddSupplier(&$supplier)
	{
		$supplier->countryId = $this->countryId;
		$found = false;
		foreach($this->_supplierList as $supplier2)
		{
			if ($supplier->supplierId > 0 && $supplier->supplierId == $supplier2->supplierId)
			{
				$found = true;
				break;
			}
		}
		if (!$found)
		{
			$this->_supplierList[] = $supplier;
		}
	}
	
	
	/**
	* Gets a list of Buyer objects associated to this one
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array of Buyer objects
	*/
	function GetBuyerList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$buyer = new Buyer();
		$fcv_array[] = array("countryId", "=", $this->countryId);
		$dbObjects = $buyer->GetList($fcv_array, $sortBy, $ascending, $limit);
		return $dbObjects;
	}
	
	
	/**
	* Makes this the parent of all Buyer objects in the Buyer List array. Any existing Buyer will become orphan(s)
	* @return null
	*/
	function SetBuyerList(&$list)
	{
		$this->_buyerList = array();
		$existingBuyerList = $this->GetBuyerList();
		foreach ($existingBuyerList as $buyer)
		{
			$buyer->countryId = '';
			$buyer->Save(false);
		}
		$this->_buyerList = $list;
	}
	
	
	/**
	* Associates the Buyer object to this one
	* @return 
	*/
	function AddBuyer(&$buyer)
	{
		$buyer->countryId = $this->countryId;
		$found = false;
		foreach($this->_buyerList as $buyer2)
		{
			if ($buyer->buyerId > 0 && $buyer->buyerId == $buyer2->buyerId)
			{
				$found = true;
				break;
			}
		}
		if (!$found)
		{
			$this->_buyerList[] = $buyer;
		}
	}
}
?>
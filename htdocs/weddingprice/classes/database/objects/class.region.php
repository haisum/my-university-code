<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `region` (
	`regionid` int(11) NOT NULL auto_increment,
	`name` VARCHAR(255) NOT NULL,
	`countryid` int(11) NOT NULL, INDEX(`countryid`), PRIMARY KEY  (`regionid`)) ENGINE=MyISAM;
*/

/**
* <b>Region</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=Region&attributeList=array+%28%0A++0+%3D%3E+%27name%27%2C%0A++1+%3D%3E+%27Country%27%2C%0A++2+%3D%3E+%27Wedding%27%2C%0A++3+%3D%3E+%27Supplier%27%2C%0A++4+%3D%3E+%27Buyer%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27BELONGSTO%27%2C%0A++2+%3D%3E+%27HASMANY%27%2C%0A++3+%3D%3E+%27JOIN%27%2C%0A++4+%3D%3E+%27HASMANY%27%2C%0A%29
*/
include_once('class.pog_base.php');
include_once('class.regionsuppliermap.php');
class Region extends POG_Base
{
	public $regionId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $name;
	
	/**
	 * @var INT(11)
	 */
	public $countryId;
	
	/**
	 * @var private array of Wedding objects
	 */
	private $_weddingList = array();
	
	/**
	 * @var private array of Supplier objects
	 */
	private $_supplierList = array();
	
	/**
	 * @var private array of Buyer objects
	 */
	private $_buyerList = array();
	
	public $pog_attribute_type = array(
		"regionId" => array('db_attributes' => array("NUMERIC", "INT")),
		"name" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"Country" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"Wedding" => array('db_attributes' => array("OBJECT", "HASMANY")),
		"Supplier" => array('db_attributes' => array("OBJECT", "JOIN")),
		"Buyer" => array('db_attributes' => array("OBJECT", "HASMANY")),
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
	
	function Region($name='')
	{
		$this->name = $name;
		$this->_weddingList = array();
		$this->_supplierList = array();
		$this->_buyerList = array();
	}
	
	
	/**
	* Gets object from database
	* @param integer $regionId 
	* @return object $Region
	*/
	function Get($regionId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `region` where `regionid`='".intval($regionId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->regionId = $row['regionid'];
			$this->name = $this->Unescape($row['name']);
			$this->countryId = $row['countryid'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $regionList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `region` ";
		$regionList = Array();
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
			$sortBy = "regionid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$region = new $thisObjectName();
			$region->regionId = $row['regionid'];
			$region->name = $this->Unescape($row['name']);
			$region->countryId = $row['countryid'];
			$regionList[] = $region;
		}
		return $regionList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $regionId
	*/
	function Save($deep = true)
	{
		$connection = Database::Connect();
		$this->pog_query = "select `regionid` from `region` where `regionid`='".$this->regionId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `region` set 
			`name`='".$this->Escape($this->name)."', 
			`countryid`='".$this->countryId."'where `regionid`='".$this->regionId."'";
		}
		else
		{
			$this->pog_query = "insert into `region` (`name`, `countryid`) values (
			'".$this->Escape($this->name)."', 
			'".$this->countryId."')";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->regionId == "")
		{
			$this->regionId = $insertId;
		}
		if ($deep)
		{
			foreach ($this->_weddingList as $wedding)
			{
				$wedding->regionId = $this->regionId;
				$wedding->Save($deep);
			}
			foreach ($this->_supplierList as $supplier)
			{
				$supplier->Save();
				$map = new RegionSupplierMap();
				$map->AddMapping($this, $supplier);
			}
			foreach ($this->_buyerList as $buyer)
			{
				$buyer->regionId = $this->regionId;
				$buyer->Save($deep);
			}
		}
		return $this->regionId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $regionId
	*/
	function SaveNew($deep = false)
	{
		$this->regionId = '';
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
			$weddingList = $this->GetWeddingList();
			foreach ($weddingList as $wedding)
			{
				$wedding->Delete($deep, $across);
			}
			$buyerList = $this->GetBuyerList();
			foreach ($buyerList as $buyer)
			{
				$buyer->Delete($deep, $across);
			}
		}
		if ($across)
		{
			$supplierList = $this->GetSupplierList();
			$map = new RegionSupplierMap();
			$map->RemoveMapping($this);
			foreach ($supplierList as $supplier)
			{
				$supplier->Delete($deep, $across);
			}
		}
		else
		{
			$map = new RegionSupplierMap();
			$map->RemoveMapping($this);
		}
		$connection = Database::Connect();
		$this->pog_query = "delete from `region` where `regionid`='".$this->regionId."'";
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
				$pog_query = "delete from `region` where ";
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
	* Associates the Country object to this one
	* @return boolean
	*/
	function GetCountry()
	{
		$country = new Country();
		return $country->Get($this->countryId);
	}
	
	
	/**
	* Associates the Country object to this one
	* @return 
	*/
	function SetCountry(&$country)
	{
		$this->countryId = $country->countryId;
	}
	
	
	/**
	* Gets a list of Wedding objects associated to this one
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array of Wedding objects
	*/
	function GetWeddingList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$wedding = new Wedding();
		$fcv_array[] = array("regionId", "=", $this->regionId);
		$dbObjects = $wedding->GetList($fcv_array, $sortBy, $ascending, $limit);
		return $dbObjects;
	}
	
	
	/**
	* Makes this the parent of all Wedding objects in the Wedding List array. Any existing Wedding will become orphan(s)
	* @return null
	*/
	function SetWeddingList(&$list)
	{
		$this->_weddingList = array();
		$existingWeddingList = $this->GetWeddingList();
		foreach ($existingWeddingList as $wedding)
		{
			$wedding->regionId = '';
			$wedding->Save(false);
		}
		$this->_weddingList = $list;
	}
	
	
	/**
	* Associates the Wedding object to this one
	* @return 
	*/
	function AddWedding(&$wedding)
	{
		$wedding->regionId = $this->regionId;
		$found = false;
		foreach($this->_weddingList as $wedding2)
		{
			if ($wedding->weddingId > 0 && $wedding->weddingId == $wedding2->weddingId)
			{
				$found = true;
				break;
			}
		}
		if (!$found)
		{
			$this->_weddingList[] = $wedding;
		}
	}
	
	
	/**
	* Creates mappings between this and all objects in the Supplier List array. Any existing mapping will become orphan(s)
	* @return null
	*/
	function SetSupplierList(&$supplierList)
	{
		$map = new RegionSupplierMap();
		$map->RemoveMapping($this);
		$this->_supplierList = $supplierList;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $regionList
	*/
	function GetSupplierList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$connection = Database::Connect();
		$supplier = new Supplier();
		$supplierList = Array();
		$this->pog_query = "select distinct * from `supplier` a INNER JOIN `regionsuppliermap` m ON m.supplierid = a.supplierid where m.regionid = '$this->regionId' ";
		if (sizeof($fcv_array) > 0)
		{
			$this->pog_query .= " AND ";
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
					if (isset($supplier->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $supplier->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $supplier->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						if ($GLOBALS['configuration']['db_encoding'] == 1)
						{
							$value = POG_Base::IsColumn($fcv_array[$i][2]) ? "BASE64_DECODE(".$fcv_array[$i][2].")" : "'".$fcv_array[$i][2]."'";
							$this->pog_query .= "BASE64_DECODE(`".$fcv_array[$i][0]."`) ".$fcv_array[$i][1]." ".$value;
						}
						else
						{
							$value =  POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$this->Escape($fcv_array[$i][2])."'";
							$this->pog_query .= "a.`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
						}
					}
					else
					{
						$value = POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$fcv_array[$i][2]."'";
						$this->pog_query .= "a.`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
					}
				}
			}
		}
		if ($sortBy != '')
		{
			if (isset($supplier->pog_attribute_type[$sortBy]['db_attributes']) && $supplier->pog_attribute_type[$sortBy]['db_attributes'][0] != 'NUMERIC' && $supplier->pog_attribute_type[$sortBy]['db_attributes'][0] != 'SET')
			{
				if ($GLOBALS['configuration']['db_encoding'] == 1)
				{
					$sortBy = "BASE64_DECODE(a.$sortBy) ";
				}
				else
				{
					$sortBy = "a.$sortBy ";
				}
			}
			else
			{
				$sortBy = "a.$sortBy ";
			}
		}
		else
		{
			$sortBy = "a.supplierid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$cursor = Database::Reader($this->pog_query, $connection);
		while($rows = Database::Read($cursor))
		{
			$supplier = new Supplier();
			foreach ($supplier->pog_attribute_type as $attribute_name => $attrubute_type)
			{
				if ($attrubute_type['db_attributes'][1] != "HASMANY" && $attrubute_type['db_attributes'][1] != "JOIN")
				{
					if ($attrubute_type['db_attributes'][1] == "BELONGSTO")
					{
						$supplier->{strtolower($attribute_name).'Id'} = $rows[strtolower($attribute_name).'id'];
						continue;
					}
					$supplier->{$attribute_name} = $this->Unescape($rows[strtolower($attribute_name)]);
				}
			}
			$supplierList[] = $supplier;
		}
		return $supplierList;
	}
	
	
	/**
	* Associates the Supplier object to this one
	* @return 
	*/
	function AddSupplier(&$supplier)
	{
		if ($supplier instanceof Supplier)
		{
			if (in_array($this, $supplier->regionList, true))
			{
				return false;
			}
			else
			{
				$found = false;
				foreach ($this->_supplierList as $supplier2)
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
		$fcv_array[] = array("regionId", "=", $this->regionId);
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
			$buyer->regionId = '';
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
		$buyer->regionId = $this->regionId;
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
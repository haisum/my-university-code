<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `category` (
	`categoryid` int(11) NOT NULL auto_increment,
	`name` VARCHAR(255) NOT NULL, PRIMARY KEY  (`categoryid`)) ENGINE=MyISAM;
*/

/**
* <b>Category</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=Category&attributeList=array+%28%0A++0+%3D%3E+%27name%27%2C%0A++1+%3D%3E+%27Supplier%27%2C%0A++2+%3D%3E+%27BidPerCategory%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27JOIN%27%2C%0A++2+%3D%3E+%27HASMANY%27%2C%0A%29
*/
include_once('class.pog_base.php');
include_once('class.categorysuppliermap.php');
class Category extends POG_Base
{
	public $categoryId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $name;
	
	/**
	 * @var private array of Supplier objects
	 */
	private $_supplierList = array();
	
	/**
	 * @var private array of BidPerCategory objects
	 */
	private $_bidpercategoryList = array();
	
	public $pog_attribute_type = array(
		"categoryId" => array('db_attributes' => array("NUMERIC", "INT")),
		"name" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"Supplier" => array('db_attributes' => array("OBJECT", "JOIN")),
		"BidPerCategory" => array('db_attributes' => array("OBJECT", "HASMANY")),
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
	
	function Category($name='')
	{
		$this->name = $name;
		$this->_supplierList = array();
		$this->_bidpercategoryList = array();
	}
	
	
	/**
	* Gets object from database
	* @param integer $categoryId 
	* @return object $Category
	*/
	function Get($categoryId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `category` where `categoryid`='".intval($categoryId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->categoryId = $row['categoryid'];
			$this->name = $this->Unescape($row['name']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $categoryList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `category` ";
		$categoryList = Array();
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
			$sortBy = "categoryid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$category = new $thisObjectName();
			$category->categoryId = $row['categoryid'];
			$category->name = $this->Unescape($row['name']);
			$categoryList[] = $category;
		}
		return $categoryList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $categoryId
	*/
	function Save($deep = true)
	{
		$connection = Database::Connect();
		$this->pog_query = "select `categoryid` from `category` where `categoryid`='".$this->categoryId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `category` set 
			`name`='".$this->Escape($this->name)."'where `categoryid`='".$this->categoryId."'";
		}
		else
		{
			$this->pog_query = "insert into `category` (`name`) values (
			'".$this->Escape($this->name)."')";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->categoryId == "")
		{
			$this->categoryId = $insertId;
		}
		if ($deep)
		{
			foreach ($this->_supplierList as $supplier)
			{
				$supplier->Save();
				$map = new CategorySupplierMap();
				$map->AddMapping($this, $supplier);
			}
			foreach ($this->_bidpercategoryList as $bidpercategory)
			{
				$bidpercategory->categoryId = $this->categoryId;
				$bidpercategory->Save($deep);
			}
		}
		return $this->categoryId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $categoryId
	*/
	function SaveNew($deep = false)
	{
		$this->categoryId = '';
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
			$bidpercategoryList = $this->GetBidpercategoryList();
			foreach ($bidpercategoryList as $bidpercategory)
			{
				$bidpercategory->Delete($deep, $across);
			}
		}
		if ($across)
		{
			$supplierList = $this->GetSupplierList();
			$map = new CategorySupplierMap();
			$map->RemoveMapping($this);
			foreach ($supplierList as $supplier)
			{
				$supplier->Delete($deep, $across);
			}
		}
		else
		{
			$map = new CategorySupplierMap();
			$map->RemoveMapping($this);
		}
		$connection = Database::Connect();
		$this->pog_query = "delete from `category` where `categoryid`='".$this->categoryId."'";
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
				$pog_query = "delete from `category` where ";
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
	* Creates mappings between this and all objects in the Supplier List array. Any existing mapping will become orphan(s)
	* @return null
	*/
	function SetSupplierList(&$supplierList)
	{
		$map = new CategorySupplierMap();
		$map->RemoveMapping($this);
		$this->_supplierList = $supplierList;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $categoryList
	*/
	function GetSupplierList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$connection = Database::Connect();
		$supplier = new Supplier();
		$supplierList = Array();
		$this->pog_query = "select distinct * from `supplier` a INNER JOIN `categorysuppliermap` m ON m.supplierid = a.supplierid where m.categoryid = '$this->categoryId' ";
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
			if (in_array($this, $supplier->categoryList, true))
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
	* Gets a list of BidPerCategory objects associated to this one
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array of BidPerCategory objects
	*/
	function GetBidpercategoryList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$bidpercategory = new BidPerCategory();
		$fcv_array[] = array("categoryId", "=", $this->categoryId);
		$dbObjects = $bidpercategory->GetList($fcv_array, $sortBy, $ascending, $limit);
		return $dbObjects;
	}
	
	
	/**
	* Makes this the parent of all BidPerCategory objects in the BidPerCategory List array. Any existing BidPerCategory will become orphan(s)
	* @return null
	*/
	function SetBidpercategoryList(&$list)
	{
		$this->_bidpercategoryList = array();
		$existingBidpercategoryList = $this->GetBidpercategoryList();
		foreach ($existingBidpercategoryList as $bidpercategory)
		{
			$bidpercategory->categoryId = '';
			$bidpercategory->Save(false);
		}
		$this->_bidpercategoryList = $list;
	}
	
	
	/**
	* Associates the BidPerCategory object to this one
	* @return 
	*/
	function AddBidpercategory(&$bidpercategory)
	{
		$bidpercategory->categoryId = $this->categoryId;
		$found = false;
		foreach($this->_bidpercategoryList as $bidpercategory2)
		{
			if ($bidpercategory->bidpercategoryId > 0 && $bidpercategory->bidpercategoryId == $bidpercategory2->bidpercategoryId)
			{
				$found = true;
				break;
			}
		}
		if (!$found)
		{
			$this->_bidpercategoryList[] = $bidpercategory;
		}
	}
}
?>
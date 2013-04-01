<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `supplier` (
	`supplierid` int(11) NOT NULL auto_increment,
	`name` VARCHAR(255) NOT NULL,
	`salesemail` VARCHAR(255) NOT NULL,
	`nonsalesemail` VARCHAR(255) NOT NULL,
	`phone` VARCHAR(255) NOT NULL,
	`contactperson` VARCHAR(255) NOT NULL,
	`countryid` int(11) NOT NULL,
	`zip` VARCHAR(255) NOT NULL,
	`address` TEXT NOT NULL,
	`recieverequests` ENUM('Yes', 'No') NOT NULL,
	`userid` int(11) NOT NULL,
	`primaryregionid` int(11) NOT NULL,
	`address2` TEXT NOT NULL,
	`city` VARCHAR(255) NOT NULL,
	`companyprofile` TEXT NOT NULL,
	`primarycategoryid` INT NOT NULL,
	`accounttype` enum('FREE','GOLD','INVALIDURL', 'OUTOFFREEBIDS') NOT NULL,
	`goldexpires` DATETIME NOT NULL, INDEX(`countryid`,`userid`,`primaryregionid`), PRIMARY KEY  (`supplierid`)) ENGINE=MyISAM;
*/

/**
* <b>Supplier</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=Supplier&attributeList=array+%28%0A++0+%3D%3E+%27name%27%2C%0A++1+%3D%3E+%27salesEmail%27%2C%0A++2+%3D%3E+%27nonSalesEmail%27%2C%0A++3+%3D%3E+%27phone%27%2C%0A++4+%3D%3E+%27contactPerson%27%2C%0A++5+%3D%3E+%27Country%27%2C%0A++6+%3D%3E+%27zip%27%2C%0A++7+%3D%3E+%27address%27%2C%0A++8+%3D%3E+%27recieveRequests%27%2C%0A++9+%3D%3E+%27User%27%2C%0A++10+%3D%3E+%27primaryRegion%27%2C%0A++11+%3D%3E+%27address2%27%2C%0A++12+%3D%3E+%27city%27%2C%0A++13+%3D%3E+%27Region%27%2C%0A++14+%3D%3E+%27Category%27%2C%0A++15+%3D%3E+%27Website%27%2C%0A++16+%3D%3E+%27Bid%27%2C%0A++17+%3D%3E+%27Wedding%27%2C%0A++18+%3D%3E+%27companyProfile%27%2C%0A++19+%3D%3E+%27primaryCategoryId%27%2C%0A++20+%3D%3E+%27accountType%27%2C%0A++21+%3D%3E+%27goldExpires%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++4+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++5+%3D%3E+%27BELONGSTO%27%2C%0A++6+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++7+%3D%3E+%27TEXT%27%2C%0A++8+%3D%3E+%27ENUM%28%5C%5C%5C%27Yes%5C%5C%5C%27%2C+%5C%5C%5C%27No%5C%5C%5C%27%29%27%2C%0A++9+%3D%3E+%27BELONGSTO%27%2C%0A++10+%3D%3E+%27BELONGSTO%27%2C%0A++11+%3D%3E+%27TEXT%27%2C%0A++12+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++13+%3D%3E+%27JOIN%27%2C%0A++14+%3D%3E+%27JOIN%27%2C%0A++15+%3D%3E+%27HASMANY%27%2C%0A++16+%3D%3E+%27HASMANY%27%2C%0A++17+%3D%3E+%27HASMANY%27%2C%0A++18+%3D%3E+%27TEXT%27%2C%0A++19+%3D%3E+%27INT%27%2C%0A++20+%3D%3E+%27enum%28%5C%5C%5C%27FREE%5C%5C%5C%27%2C%5C%5C%5C%27GOLD%5C%5C%5C%27%2C%5C%5C%5C%27INVALIDURL%5C%5C%5C%27%2C+%5C%5C%5C%27OUTOFFREEBIDS%5C%5C%5C%27%29%27%2C%0A++21+%3D%3E+%27DATETIME%27%2C%0A%29
*/
include_once('class.pog_base.php');
include_once('class.regionsuppliermap.php');
include_once('class.categorysuppliermap.php');
class Supplier extends POG_Base
{
	public $supplierId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $name;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $salesEmail;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $nonSalesEmail;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $phone;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $contactPerson;
	
	/**
	 * @var INT(11)
	 */
	public $countryId;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $zip;
	
	/**
	 * @var TEXT
	 */
	public $address;
	
	/**
	 * @var ENUM('Yes', 'No')
	 */
	public $recieveRequests;
	
	/**
	 * @var INT(11)
	 */
	public $userId;
	
	/**
	 * @var INT(11)
	 */
	public $primaryregionId;
	
	/**
	 * @var TEXT
	 */
	public $address2;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $city;
	
	/**
	 * @var private array of Region objects
	 */
	private $_regionList = array();
	
	/**
	 * @var private array of Category objects
	 */
	private $_categoryList = array();
	
	/**
	 * @var private array of Website objects
	 */
	private $_websiteList = array();
	
	/**
	 * @var private array of Bid objects
	 */
	private $_bidList = array();
	
	/**
	 * @var private array of Wedding objects
	 */
	private $_weddingList = array();
	
	/**
	 * @var TEXT
	 */
	public $companyProfile;
	
	/**
	 * @var INT
	 */
	public $primaryCategoryId;
	
	/**
	 * @var enum('FREE','GOLD','INVALIDURL', 'OUTOFFREEBIDS')
	 */
	public $accountType;
	
	/**
	 * @var DATETIME
	 */
	public $goldExpires;
	
	public $pog_attribute_type = array(
		"supplierId" => array('db_attributes' => array("NUMERIC", "INT")),
		"name" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"salesEmail" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"nonSalesEmail" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"phone" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"contactPerson" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"Country" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"zip" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"address" => array('db_attributes' => array("TEXT", "TEXT")),
		"recieveRequests" => array('db_attributes' => array("SET", "ENUM", "'Yes', 'No'")),
		"User" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"primaryRegion" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"address2" => array('db_attributes' => array("TEXT", "TEXT")),
		"city" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"Region" => array('db_attributes' => array("OBJECT", "JOIN")),
		"Category" => array('db_attributes' => array("OBJECT", "JOIN")),
		"Website" => array('db_attributes' => array("OBJECT", "HASMANY")),
		"Bid" => array('db_attributes' => array("OBJECT", "HASMANY")),
		"Wedding" => array('db_attributes' => array("OBJECT", "HASMANY")),
		"companyProfile" => array('db_attributes' => array("TEXT", "TEXT")),
		"primaryCategoryId" => array('db_attributes' => array("NUMERIC", "INT")),
		"accountType" => array('db_attributes' => array("SET", "ENUM", "'FREE','GOLD','INVALIDURL', 'OUTOFFREEBIDS'")),
		"goldExpires" => array('db_attributes' => array("TEXT", "DATETIME")),
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
	
	function Supplier($name='', $salesEmail='', $nonSalesEmail='', $phone='', $contactPerson='', $zip='', $address='', $recieveRequests='', $address2='', $city='', $companyProfile='', $primaryCategoryId='', $accountType='', $goldExpires='')
	{
		$this->name = $name;
		$this->salesEmail = $salesEmail;
		$this->nonSalesEmail = $nonSalesEmail;
		$this->phone = $phone;
		$this->contactPerson = $contactPerson;
		$this->zip = $zip;
		$this->address = $address;
		$this->recieveRequests = $recieveRequests;
		$this->address2 = $address2;
		$this->city = $city;
		$this->_regionList = array();
		$this->_categoryList = array();
		$this->_websiteList = array();
		$this->_bidList = array();
		$this->_weddingList = array();
		$this->companyProfile = $companyProfile;
		$this->primaryCategoryId = $primaryCategoryId;
		$this->accountType = $accountType;
		$this->goldExpires = $goldExpires;
	}
	
	
	/**
	* Gets object from database
	* @param integer $supplierId 
	* @return object $Supplier
	*/
	function Get($supplierId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `supplier` where `supplierid`='".intval($supplierId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->supplierId = $row['supplierid'];
			$this->name = $this->Unescape($row['name']);
			$this->salesEmail = $this->Unescape($row['salesemail']);
			$this->nonSalesEmail = $this->Unescape($row['nonsalesemail']);
			$this->phone = $this->Unescape($row['phone']);
			$this->contactPerson = $this->Unescape($row['contactperson']);
			$this->countryId = $row['countryid'];
			$this->zip = $this->Unescape($row['zip']);
			$this->address = $this->Unescape($row['address']);
			$this->recieveRequests = $row['recieverequests'];
			$this->userId = $row['userid'];
			$this->primaryregionId = $row['primaryregionid'];
			$this->address2 = $this->Unescape($row['address2']);
			$this->city = $this->Unescape($row['city']);
			$this->companyProfile = $this->Unescape($row['companyprofile']);
			$this->primaryCategoryId = $this->Unescape($row['primarycategoryid']);
			$this->accountType = $row['accounttype'];
			$this->goldExpires = $row['goldexpires'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $supplierList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `supplier` ";
		$supplierList = Array();
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
			$sortBy = "supplierid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$supplier = new $thisObjectName();
			$supplier->supplierId = $row['supplierid'];
			$supplier->name = $this->Unescape($row['name']);
			$supplier->salesEmail = $this->Unescape($row['salesemail']);
			$supplier->nonSalesEmail = $this->Unescape($row['nonsalesemail']);
			$supplier->phone = $this->Unescape($row['phone']);
			$supplier->contactPerson = $this->Unescape($row['contactperson']);
			$supplier->countryId = $row['countryid'];
			$supplier->zip = $this->Unescape($row['zip']);
			$supplier->address = $this->Unescape($row['address']);
			$supplier->recieveRequests = $row['recieverequests'];
			$supplier->userId = $row['userid'];
			$supplier->primaryregionId = $row['primaryregionid'];
			$supplier->address2 = $this->Unescape($row['address2']);
			$supplier->city = $this->Unescape($row['city']);
			$supplier->companyProfile = $this->Unescape($row['companyprofile']);
			$supplier->primaryCategoryId = $this->Unescape($row['primarycategoryid']);
			$supplier->accountType = $row['accounttype'];
			$supplier->goldExpires = $row['goldexpires'];
			$supplierList[] = $supplier;
		}
		return $supplierList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $supplierId
	*/
	function Save($deep = true)
	{
		$connection = Database::Connect();
		$this->pog_query = "select `supplierid` from `supplier` where `supplierid`='".$this->supplierId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `supplier` set 
			`name`='".$this->Escape($this->name)."', 
			`salesemail`='".$this->Escape($this->salesEmail)."', 
			`nonsalesemail`='".$this->Escape($this->nonSalesEmail)."', 
			`phone`='".$this->Escape($this->phone)."', 
			`contactperson`='".$this->Escape($this->contactPerson)."', 
			`countryid`='".$this->countryId."', 
			`zip`='".$this->Escape($this->zip)."', 
			`address`='".$this->Escape($this->address)."', 
			`recieverequests`='".$this->recieveRequests."', 
			`userid`='".$this->userId."', 
			`primaryregionid`='".$this->primaryregionId."', 
			`address2`='".$this->Escape($this->address2)."', 
			`city`='".$this->Escape($this->city)."', 
			`companyprofile`='".$this->Escape($this->companyProfile)."', 
			`primarycategoryid`='".$this->Escape($this->primaryCategoryId)."', 
			`accounttype`='".$this->accountType."', 
			`goldexpires`='".$this->goldExpires."' where `supplierid`='".$this->supplierId."'";
		}
		else
		{
			$this->pog_query = "insert into `supplier` (`name`, `salesemail`, `nonsalesemail`, `phone`, `contactperson`, `countryid`, `zip`, `address`, `recieverequests`, `userid`, `primaryregionid`, `address2`, `city`, `companyprofile`, `primarycategoryid`, `accounttype`, `goldexpires` ) values (
			'".$this->Escape($this->name)."', 
			'".$this->Escape($this->salesEmail)."', 
			'".$this->Escape($this->nonSalesEmail)."', 
			'".$this->Escape($this->phone)."', 
			'".$this->Escape($this->contactPerson)."', 
			'".$this->countryId."', 
			'".$this->Escape($this->zip)."', 
			'".$this->Escape($this->address)."', 
			'".$this->recieveRequests."', 
			'".$this->userId."', 
			'".$this->primaryregionId."', 
			'".$this->Escape($this->address2)."', 
			'".$this->Escape($this->city)."', 
			'".$this->Escape($this->companyProfile)."', 
			'".$this->Escape($this->primaryCategoryId)."', 
			'".$this->accountType."', 
			'".$this->goldExpires."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->supplierId == "")
		{
			$this->supplierId = $insertId;
		}
		if ($deep)
		{
			foreach ($this->_regionList as $region)
			{
				$region->Save();
				$map = new RegionSupplierMap();
				$map->AddMapping($this, $region);
			}
			foreach ($this->_categoryList as $category)
			{
				$category->Save();
				$map = new CategorySupplierMap();
				$map->AddMapping($this, $category);
			}
			foreach ($this->_websiteList as $website)
			{
				$website->supplierId = $this->supplierId;
				$website->Save($deep);
			}
			foreach ($this->_bidList as $bid)
			{
				$bid->supplierId = $this->supplierId;
				$bid->Save($deep);
			}
			foreach ($this->_weddingList as $wedding)
			{
				$wedding->supplierId = $this->supplierId;
				$wedding->Save($deep);
			}
		}
		return $this->supplierId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $supplierId
	*/
	function SaveNew($deep = false)
	{
		$this->supplierId = '';
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
			$websiteList = $this->GetWebsiteList();
			foreach ($websiteList as $website)
			{
				$website->Delete($deep, $across);
			}
			$bidList = $this->GetBidList();
			foreach ($bidList as $bid)
			{
				$bid->Delete($deep, $across);
			}
			$weddingList = $this->GetWeddingList();
			foreach ($weddingList as $wedding)
			{
				$wedding->Delete($deep, $across);
			}
		}
		if ($across)
		{
			$regionList = $this->GetRegionList();
			$map = new RegionSupplierMap();
			$map->RemoveMapping($this);
			foreach ($regionList as $region)
			{
				$region->Delete($deep, $across);
			}
			$categoryList = $this->GetCategoryList();
			$map = new CategorySupplierMap();
			$map->RemoveMapping($this);
			foreach ($categoryList as $category)
			{
				$category->Delete($deep, $across);
			}
		}
		else
		{
			$map = new RegionSupplierMap();
			$map->RemoveMapping($this);
			$map = new CategorySupplierMap();
			$map->RemoveMapping($this);
		}
		$connection = Database::Connect();
		$this->pog_query = "delete from `supplier` where `supplierid`='".$this->supplierId."'";
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
				$pog_query = "delete from `supplier` where ";
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
	* Associates the User object to this one
	* @return boolean
	*/
	function GetUser()
	{
		$user = new User();
		return $user->Get($this->userId);
	}
	
	
	/**
	* Associates the User object to this one
	* @return 
	*/
	function SetUser(&$user)
	{
		$this->userId = $user->userId;
	}
	
	
	/**
	* Associates the primaryRegion object to this one
	* @return boolean
	*/
	function GetPrimaryregion()
	{
		$primaryregion = new primaryRegion();
		return $primaryregion->Get($this->primaryregionId);
	}
	
	
	/**
	* Associates the primaryRegion object to this one
	* @return 
	*/
	function SetPrimaryregion(&$primaryregion)
	{
		$this->primaryregionId = $primaryregion->primaryregionId;
	}
	
	
	/**
	* Creates mappings between this and all objects in the Region List array. Any existing mapping will become orphan(s)
	* @return null
	*/
	function SetRegionList(&$regionList)
	{
		$map = new RegionSupplierMap();
		$map->RemoveMapping($this);
		$this->_regionList = $regionList;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $supplierList
	*/
	function GetRegionList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$connection = Database::Connect();
		$region = new Region();
		$regionList = Array();
		$this->pog_query = "select distinct * from `region` a INNER JOIN `regionsuppliermap` m ON m.regionid = a.regionid where m.supplierid = '$this->supplierId' ";
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
					if (isset($region->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $region->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $region->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
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
			if (isset($region->pog_attribute_type[$sortBy]['db_attributes']) && $region->pog_attribute_type[$sortBy]['db_attributes'][0] != 'NUMERIC' && $region->pog_attribute_type[$sortBy]['db_attributes'][0] != 'SET')
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
			$sortBy = "a.regionid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$cursor = Database::Reader($this->pog_query, $connection);
		while($rows = Database::Read($cursor))
		{
			$region = new Region();
			foreach ($region->pog_attribute_type as $attribute_name => $attrubute_type)
			{
				if ($attrubute_type['db_attributes'][1] != "HASMANY" && $attrubute_type['db_attributes'][1] != "JOIN")
				{
					if ($attrubute_type['db_attributes'][1] == "BELONGSTO")
					{
						$region->{strtolower($attribute_name).'Id'} = $rows[strtolower($attribute_name).'id'];
						continue;
					}
					$region->{$attribute_name} = $this->Unescape($rows[strtolower($attribute_name)]);
				}
			}
			$regionList[] = $region;
		}
		return $regionList;
	}
	
	
	/**
	* Associates the Region object to this one
	* @return 
	*/
	function AddRegion(&$region)
	{
		if ($region instanceof Region)
		{
			if (in_array($this, $region->supplierList, true))
			{
				return false;
			}
			else
			{
				$found = false;
				foreach ($this->_regionList as $region2)
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
		}
	}
	
	
	/**
	* Creates mappings between this and all objects in the Category List array. Any existing mapping will become orphan(s)
	* @return null
	*/
	function SetCategoryList(&$categoryList)
	{
		$map = new CategorySupplierMap();
		$map->RemoveMapping($this);
		$this->_categoryList = $categoryList;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $supplierList
	*/
	function GetCategoryList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$connection = Database::Connect();
		$category = new Category();
		$categoryList = Array();
		$this->pog_query = "select distinct * from `category` a INNER JOIN `categorysuppliermap` m ON m.categoryid = a.categoryid where m.supplierid = '$this->supplierId' ";
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
					if (isset($category->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $category->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $category->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
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
			if (isset($category->pog_attribute_type[$sortBy]['db_attributes']) && $category->pog_attribute_type[$sortBy]['db_attributes'][0] != 'NUMERIC' && $category->pog_attribute_type[$sortBy]['db_attributes'][0] != 'SET')
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
			$sortBy = "a.categoryid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$cursor = Database::Reader($this->pog_query, $connection);
		while($rows = Database::Read($cursor))
		{
			$category = new Category();
			foreach ($category->pog_attribute_type as $attribute_name => $attrubute_type)
			{
				if ($attrubute_type['db_attributes'][1] != "HASMANY" && $attrubute_type['db_attributes'][1] != "JOIN")
				{
					if ($attrubute_type['db_attributes'][1] == "BELONGSTO")
					{
						$category->{strtolower($attribute_name).'Id'} = $rows[strtolower($attribute_name).'id'];
						continue;
					}
					$category->{$attribute_name} = $this->Unescape($rows[strtolower($attribute_name)]);
				}
			}
			$categoryList[] = $category;
		}
		return $categoryList;
	}
	
	
	/**
	* Associates the Category object to this one
	* @return 
	*/
	function AddCategory(&$category)
	{
		if ($category instanceof Category)
		{
			if (in_array($this, $category->supplierList, true))
			{
				return false;
			}
			else
			{
				$found = false;
				foreach ($this->_categoryList as $category2)
				{
					if ($category->categoryId > 0 && $category->categoryId == $category2->categoryId)
					{
						$found = true;
						break;
					}
				}
				if (!$found)
				{
					$this->_categoryList[] = $category;
				}
			}
		}
	}
	
	
	/**
	* Gets a list of Website objects associated to this one
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array of Website objects
	*/
	function GetWebsiteList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$website = new Website();
		$fcv_array[] = array("supplierId", "=", $this->supplierId);
		$dbObjects = $website->GetList($fcv_array, $sortBy, $ascending, $limit);
		return $dbObjects;
	}
	
	
	/**
	* Makes this the parent of all Website objects in the Website List array. Any existing Website will become orphan(s)
	* @return null
	*/
	function SetWebsiteList(&$list)
	{
		$this->_websiteList = array();
		$existingWebsiteList = $this->GetWebsiteList();
		foreach ($existingWebsiteList as $website)
		{
			$website->supplierId = '';
			$website->Save(false);
		}
		$this->_websiteList = $list;
	}
	
	
	/**
	* Associates the Website object to this one
	* @return 
	*/
	function AddWebsite(&$website)
	{
		$website->supplierId = $this->supplierId;
		$found = false;
		foreach($this->_websiteList as $website2)
		{
			if ($website->websiteId > 0 && $website->websiteId == $website2->websiteId)
			{
				$found = true;
				break;
			}
		}
		if (!$found)
		{
			$this->_websiteList[] = $website;
		}
	}
	
	
	/**
	* Gets a list of Bid objects associated to this one
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array of Bid objects
	*/
	function GetBidList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$bid = new Bid();
		$fcv_array[] = array("supplierId", "=", $this->supplierId);
		$dbObjects = $bid->GetList($fcv_array, $sortBy, $ascending, $limit);
		return $dbObjects;
	}
	
	
	/**
	* Makes this the parent of all Bid objects in the Bid List array. Any existing Bid will become orphan(s)
	* @return null
	*/
	function SetBidList(&$list)
	{
		$this->_bidList = array();
		$existingBidList = $this->GetBidList();
		foreach ($existingBidList as $bid)
		{
			$bid->supplierId = '';
			$bid->Save(false);
		}
		$this->_bidList = $list;
	}
	
	
	/**
	* Associates the Bid object to this one
	* @return 
	*/
	function AddBid(&$bid)
	{
		$bid->supplierId = $this->supplierId;
		$found = false;
		foreach($this->_bidList as $bid2)
		{
			if ($bid->bidId > 0 && $bid->bidId == $bid2->bidId)
			{
				$found = true;
				break;
			}
		}
		if (!$found)
		{
			$this->_bidList[] = $bid;
		}
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
		$fcv_array[] = array("supplierId", "=", $this->supplierId);
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
			$wedding->supplierId = '';
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
		$wedding->supplierId = $this->supplierId;
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
}
?>
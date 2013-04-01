<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `buyer` (
	`buyerid` int(11) NOT NULL auto_increment,
	`name` VARCHAR(255) NOT NULL,
	`contactemail` VARCHAR(255) NOT NULL,
	`phone` VARCHAR(255) NOT NULL,
	`contactperson` VARCHAR(255) NOT NULL,
	`countryid` int(11) NOT NULL,
	`primaryregionid` int(11) NOT NULL,
	`zip` VARCHAR(255) NOT NULL,
	`address` TEXT NOT NULL,
	`recievequotes` ENUM('Yes', 'No') NOT NULL,
	`userid` int(11) NOT NULL,
	`address2` TEXT NOT NULL,
	`city` VARCHAR(255) NOT NULL, INDEX(`countryid`,`primaryregionid`,`userid`), PRIMARY KEY  (`buyerid`)) ENGINE=MyISAM;
*/

/**
* <b>Buyer</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=Buyer&attributeList=array+%28%0A++0+%3D%3E+%27name%27%2C%0A++1+%3D%3E+%27contactEmail%27%2C%0A++2+%3D%3E+%27phone%27%2C%0A++3+%3D%3E+%27contactPerson%27%2C%0A++4+%3D%3E+%27Country%27%2C%0A++5+%3D%3E+%27primaryRegion%27%2C%0A++6+%3D%3E+%27zip%27%2C%0A++7+%3D%3E+%27address%27%2C%0A++8+%3D%3E+%27recieveQuotes%27%2C%0A++9+%3D%3E+%27User%27%2C%0A++10+%3D%3E+%27address2%27%2C%0A++11+%3D%3E+%27city%27%2C%0A++12+%3D%3E+%27Wedding%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++4+%3D%3E+%27BELONGSTO%27%2C%0A++5+%3D%3E+%27BELONGSTO%27%2C%0A++6+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++7+%3D%3E+%27TEXT%27%2C%0A++8+%3D%3E+%27ENUM%28%5C%5C%5C%27Yes%5C%5C%5C%27%2C+%5C%5C%5C%27No%5C%5C%5C%27%29%27%2C%0A++9+%3D%3E+%27BELONGSTO%27%2C%0A++10+%3D%3E+%27TEXT%27%2C%0A++11+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++12+%3D%3E+%27HASMANY%27%2C%0A%29
*/
include_once('class.pog_base.php');
class Buyer extends POG_Base
{
	public $buyerId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $name;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $contactEmail;
	
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
	 * @var INT(11)
	 */
	public $primaryregionId;
	
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
	public $recieveQuotes;
	
	/**
	 * @var INT(11)
	 */
	public $userId;
	
	/**
	 * @var TEXT
	 */
	public $address2;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $city;
	
	/**
	 * @var private array of Wedding objects
	 */
	private $_weddingList = array();
	
	public $pog_attribute_type = array(
		"buyerId" => array('db_attributes' => array("NUMERIC", "INT")),
		"name" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"contactEmail" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"phone" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"contactPerson" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"Country" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"primaryRegion" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"zip" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"address" => array('db_attributes' => array("TEXT", "TEXT")),
		"recieveQuotes" => array('db_attributes' => array("SET", "ENUM", "'Yes', 'No'")),
		"User" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"address2" => array('db_attributes' => array("TEXT", "TEXT")),
		"city" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"Wedding" => array('db_attributes' => array("OBJECT", "HASMANY")),
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
	
	function Buyer($name='', $contactEmail='', $phone='', $contactPerson='', $zip='', $address='', $recieveQuotes='', $address2='', $city='')
	{
		$this->name = $name;
		$this->contactEmail = $contactEmail;
		$this->phone = $phone;
		$this->contactPerson = $contactPerson;
		$this->zip = $zip;
		$this->address = $address;
		$this->recieveQuotes = $recieveQuotes;
		$this->address2 = $address2;
		$this->city = $city;
		$this->_weddingList = array();
	}
	
	
	/**
	* Gets object from database
	* @param integer $buyerId 
	* @return object $Buyer
	*/
	function Get($buyerId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `buyer` where `buyerid`='".intval($buyerId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->buyerId = $row['buyerid'];
			$this->name = $this->Unescape($row['name']);
			$this->contactEmail = $this->Unescape($row['contactemail']);
			$this->phone = $this->Unescape($row['phone']);
			$this->contactPerson = $this->Unescape($row['contactperson']);
			$this->countryId = $row['countryid'];
			$this->primaryregionId = $row['primaryregionid'];
			$this->zip = $this->Unescape($row['zip']);
			$this->address = $this->Unescape($row['address']);
			$this->recieveQuotes = $row['recievequotes'];
			$this->userId = $row['userid'];
			$this->address2 = $this->Unescape($row['address2']);
			$this->city = $this->Unescape($row['city']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $buyerList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `buyer` ";
		$buyerList = Array();
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
			$sortBy = "buyerid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$buyer = new $thisObjectName();
			$buyer->buyerId = $row['buyerid'];
			$buyer->name = $this->Unescape($row['name']);
			$buyer->contactEmail = $this->Unescape($row['contactemail']);
			$buyer->phone = $this->Unescape($row['phone']);
			$buyer->contactPerson = $this->Unescape($row['contactperson']);
			$buyer->countryId = $row['countryid'];
			$buyer->primaryregionId = $row['primaryregionid'];
			$buyer->zip = $this->Unescape($row['zip']);
			$buyer->address = $this->Unescape($row['address']);
			$buyer->recieveQuotes = $row['recievequotes'];
			$buyer->userId = $row['userid'];
			$buyer->address2 = $this->Unescape($row['address2']);
			$buyer->city = $this->Unescape($row['city']);
			$buyerList[] = $buyer;
		}
		return $buyerList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $buyerId
	*/
	function Save($deep = true)
	{
		$connection = Database::Connect();
		$this->pog_query = "select `buyerid` from `buyer` where `buyerid`='".$this->buyerId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `buyer` set 
			`name`='".$this->Escape($this->name)."', 
			`contactemail`='".$this->Escape($this->contactEmail)."', 
			`phone`='".$this->Escape($this->phone)."', 
			`contactperson`='".$this->Escape($this->contactPerson)."', 
			`countryid`='".$this->countryId."', 
			`primaryregionid`='".$this->primaryregionId."', 
			`zip`='".$this->Escape($this->zip)."', 
			`address`='".$this->Escape($this->address)."', 
			`recievequotes`='".$this->recieveQuotes."', 
			`userid`='".$this->userId."', 
			`address2`='".$this->Escape($this->address2)."', 
			`city`='".$this->Escape($this->city)."'where `buyerid`='".$this->buyerId."'";
		}
		else
		{
			$this->pog_query = "insert into `buyer` (`name`, `contactemail`, `phone`, `contactperson`, `countryid`, `primaryregionid`, `zip`, `address`, `recievequotes`, `userid`, `address2`, `city`) values (
			'".$this->Escape($this->name)."', 
			'".$this->Escape($this->contactEmail)."', 
			'".$this->Escape($this->phone)."', 
			'".$this->Escape($this->contactPerson)."', 
			'".$this->countryId."', 
			'".$this->primaryregionId."', 
			'".$this->Escape($this->zip)."', 
			'".$this->Escape($this->address)."', 
			'".$this->recieveQuotes."', 
			'".$this->userId."', 
			'".$this->Escape($this->address2)."', 
			'".$this->Escape($this->city)."')";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->buyerId == "")
		{
			$this->buyerId = $insertId;
		}
		if ($deep)
		{
			foreach ($this->_weddingList as $wedding)
			{
				$wedding->buyerId = $this->buyerId;
				$wedding->Save($deep);
			}
		}
		return $this->buyerId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $buyerId
	*/
	function SaveNew($deep = false)
	{
		$this->buyerId = '';
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
		}
		$connection = Database::Connect();
		$this->pog_query = "delete from `buyer` where `buyerid`='".$this->buyerId."'";
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
				$pog_query = "delete from `buyer` where ";
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
		$fcv_array[] = array("buyerId", "=", $this->buyerId);
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
			$wedding->buyerId = '';
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
		$wedding->buyerId = $this->buyerId;
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
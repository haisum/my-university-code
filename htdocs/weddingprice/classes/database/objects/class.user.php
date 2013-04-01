<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `user` (
	`userid` int(11) NOT NULL auto_increment,
	`email` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`isactive` ENUM ('Yes', 'No') NOT NULL,
	`registrationdate` TIMESTAMP NOT NULL,
	`lastlogin` TIMESTAMP NOT NULL,
	`forgotpassword` VARCHAR(255) NOT NULL,
	`type` ENUM ('Buyer', 'Supplier', 'Normal') NOT NULL, PRIMARY KEY  (`userid`)) ENGINE=MyISAM;
*/

/**
* <b>User</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=User&attributeList=array+%28%0A++0+%3D%3E+%27email%27%2C%0A++1+%3D%3E+%27password%27%2C%0A++2+%3D%3E+%27isActive%27%2C%0A++3+%3D%3E+%27registrationDate%27%2C%0A++4+%3D%3E+%27lastLogin%27%2C%0A++5+%3D%3E+%27forgotPassword%27%2C%0A++6+%3D%3E+%27type%27%2C%0A++7+%3D%3E+%27Buyer%27%2C%0A++8+%3D%3E+%27Supplier%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27ENUM+%28%5C%5C%5C%27Yes%5C%5C%5C%27%2C+%5C%5C%5C%27No%5C%5C%5C%27%29%27%2C%0A++3+%3D%3E+%27TIMESTAMP%27%2C%0A++4+%3D%3E+%27TIMESTAMP%27%2C%0A++5+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++6+%3D%3E+%27ENUM+%28%5C%5C%5C%27Buyer%5C%5C%5C%27%2C+%5C%5C%5C%27Supplier%5C%5C%5C%27%2C+%5C%5C%5C%27Normal%5C%5C%5C%27%29%27%2C%0A++7+%3D%3E+%27HASMANY%27%2C%0A++8+%3D%3E+%27HASMANY%27%2C%0A%29
*/
include_once('class.pog_base.php');
class User extends POG_Base
{
	public $userId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $email;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $password;
	
	/**
	 * @var ENUM ('Yes', 'No')
	 */
	public $isActive;
	
	/**
	 * @var TIMESTAMP
	 */
	public $registrationDate;
	
	/**
	 * @var TIMESTAMP
	 */
	public $lastLogin;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $forgotPassword;
	
	/**
	 * @var ENUM ('Buyer', 'Supplier', 'Normal')
	 */
	public $type;
	
	/**
	 * @var private array of Buyer objects
	 */
	private $_buyerList = array();
	
	/**
	 * @var private array of Supplier objects
	 */
	private $_supplierList = array();
	
	public $pog_attribute_type = array(
		"userId" => array('db_attributes' => array("NUMERIC", "INT")),
		"email" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"password" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"isActive" => array('db_attributes' => array("SET", "ENUM", "'Yes', 'No'")),
		"registrationDate" => array('db_attributes' => array("NUMERIC", "TIMESTAMP")),
		"lastLogin" => array('db_attributes' => array("NUMERIC", "TIMESTAMP")),
		"forgotPassword" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"type" => array('db_attributes' => array("SET", "ENUM", "'Buyer', 'Supplier', 'Normal'")),
		"Buyer" => array('db_attributes' => array("OBJECT", "HASMANY")),
		"Supplier" => array('db_attributes' => array("OBJECT", "HASMANY")),
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
	
	function User($email='', $password='', $isActive='', $registrationDate='', $lastLogin='', $forgotPassword='', $type='')
	{
		$this->email = $email;
		$this->password = $password;
		$this->isActive = $isActive;
		$this->registrationDate = $registrationDate;
		$this->lastLogin = $lastLogin;
		$this->forgotPassword = $forgotPassword;
		$this->type = $type;
		$this->_buyerList = array();
		$this->_supplierList = array();
	}
	
	
	/**
	* Gets object from database
	* @param integer $userId 
	* @return object $User
	*/
	function Get($userId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `user` where `userid`='".intval($userId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->userId = $row['userid'];
			$this->email = $this->Unescape($row['email']);
			$this->password = $this->Unescape($row['password']);
			$this->isActive = $row['isactive'];
			$this->registrationDate = $row['registrationdate'];
			$this->lastLogin = $row['lastlogin'];
			$this->forgotPassword = $this->Unescape($row['forgotpassword']);
			$this->type = $row['type'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $userList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `user` ";
		$userList = Array();
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
			$sortBy = "userid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$user = new $thisObjectName();
			$user->userId = $row['userid'];
			$user->email = $this->Unescape($row['email']);
			$user->password = $this->Unescape($row['password']);
			$user->isActive = $row['isactive'];
			$user->registrationDate = $row['registrationdate'];
			$user->lastLogin = $row['lastlogin'];
			$user->forgotPassword = $this->Unescape($row['forgotpassword']);
			$user->type = $row['type'];
			$userList[] = $user;
		}
		return $userList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $userId
	*/
	function Save($deep = true)
	{
		$connection = Database::Connect();
		$this->pog_query = "select `userid` from `user` where `userid`='".$this->userId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `user` set 
			`email`='".$this->Escape($this->email)."', 
			`password`='".$this->Escape($this->password)."', 
			`isactive`='".$this->isActive."', 
			`registrationdate`='".$this->registrationDate."', 
			`lastlogin`='".$this->lastLogin."', 
			`forgotpassword`='".$this->Escape($this->forgotPassword)."', 
			`type`='".$this->type."'where `userid`='".$this->userId."'";
		}
		else
		{
			$this->pog_query = "insert into `user` (`email`, `password`, `isactive`, `registrationdate`, `lastlogin`, `forgotpassword`, `type`) values (
			'".$this->Escape($this->email)."', 
			'".$this->Escape($this->password)."', 
			'".$this->isActive."', 
			'".$this->registrationDate."', 
			'".$this->lastLogin."', 
			'".$this->Escape($this->forgotPassword)."', 
			'".$this->type."')";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->userId == "")
		{
			$this->userId = $insertId;
		}
		if ($deep)
		{
			foreach ($this->_buyerList as $buyer)
			{
				$buyer->userId = $this->userId;
				$buyer->Save($deep);
			}
			foreach ($this->_supplierList as $supplier)
			{
				$supplier->userId = $this->userId;
				$supplier->Save($deep);
			}
		}
		return $this->userId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $userId
	*/
	function SaveNew($deep = false)
	{
		$this->userId = '';
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
			$buyerList = $this->GetBuyerList();
			foreach ($buyerList as $buyer)
			{
				$buyer->Delete($deep, $across);
			}
			$supplierList = $this->GetSupplierList();
			foreach ($supplierList as $supplier)
			{
				$supplier->Delete($deep, $across);
			}
		}
		$connection = Database::Connect();
		$this->pog_query = "delete from `user` where `userid`='".$this->userId."'";
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
				$pog_query = "delete from `user` where ";
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
		$fcv_array[] = array("userId", "=", $this->userId);
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
			$buyer->userId = '';
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
		$buyer->userId = $this->userId;
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
		$fcv_array[] = array("userId", "=", $this->userId);
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
			$supplier->userId = '';
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
		$supplier->userId = $this->userId;
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
}
?>
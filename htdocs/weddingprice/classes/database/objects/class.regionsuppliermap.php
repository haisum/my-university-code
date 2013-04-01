<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `regionsuppliermap` (
	`regionid` int(11) NOT NULL,
	`supplierid` int(11) NOT NULL,INDEX(`regionid`, `supplierid`)) ENGINE=MyISAM;
*/

/**
* <b>RegionSupplierMap</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
*/
class RegionSupplierMap
{
	public $regionId = '';

	public $supplierId = '';

	public $pog_attribute_type = array(
		"regionId" => array('db_attributes' => array("NUMERIC", "INT")),
		"supplierId" => array('db_attributes' => array("NUMERIC", "INT")));
		public $pog_query;
	
	
	/**
	* Creates a mapping between the two objects
	* @param Region $object 
	* @param Supplier $otherObject 
	* @return 
	*/
	function AddMapping($object, $otherObject)
	{
		if ($object instanceof Region && $object->regionId != '')
		{
			$this->regionId = $object->regionId;
			$this->supplierId = $otherObject->supplierId;
			return $this->Save();
		}
		else if ($object instanceof Supplier && $object->supplierId != '')
		{
			$this->supplierId = $object->supplierId;
			$this->regionId = $otherObject->regionId;
			return $this->Save();
		}
		else
		{
			return false;
		}
	}
	
	
	/**
	* Removes the mapping between the two objects
	* @param Object $object 
	* @param Object $object2 
	* @return 
	*/
	function RemoveMapping($object, $otherObject = null)
	{
		$connection = Database::Connect();
		if ($object instanceof Region)
		{
			$this->pog_query = "delete from `regionsuppliermap` where `regionid` = '".$object->regionId."'";
			if ($otherObject != null && $otherObject instanceof Supplier)
			{
				$this->pog_query .= " and `supplierid` = '".$otherObject->supplierId."'";
			}
		}
		else if ($object instanceof Supplier)
		{
			$this->pog_query = "delete from `regionsuppliermap` where `supplierid` = '".$object->supplierId."'";
			if ($otherObject != null && $otherObject instanceof Region)
			{
				$this->pog_query .= " and `regionid` = '".$otherObject->regionId."'";
			}
		}
		Database::NonQuery($this->pog_query, $connection);
	}
	
	
	/**
	* Physically saves the mapping to the database
	* @return 
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `regionid` from `regionsuppliermap` where `regionid`='".$this->regionId."' AND `supplierid`='".$this->supplierId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows == 0)
		{
			$this->pog_query = "insert into `regionsuppliermap` (`regionid`, `supplierid`) values ('".$this->regionId."', '".$this->supplierId."')";
		}
		return Database::InsertOrUpdate($this->pog_query, $connection);
	}
}
?>
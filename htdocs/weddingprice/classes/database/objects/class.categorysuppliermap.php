<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `categorysuppliermap` (
	`categoryid` int(11) NOT NULL,
	`supplierid` int(11) NOT NULL,INDEX(`categoryid`, `supplierid`)) ENGINE=MyISAM;
*/

/**
* <b>CategorySupplierMap</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
*/
class CategorySupplierMap
{
	public $categoryId = '';

	public $supplierId = '';

	public $pog_attribute_type = array(
		"categoryId" => array('db_attributes' => array("NUMERIC", "INT")),
		"supplierId" => array('db_attributes' => array("NUMERIC", "INT")));
		public $pog_query;
	
	
	/**
	* Creates a mapping between the two objects
	* @param Category $object 
	* @param Supplier $otherObject 
	* @return 
	*/
	function AddMapping($object, $otherObject)
	{
		if ($object instanceof Category && $object->categoryId != '')
		{
			$this->categoryId = $object->categoryId;
			$this->supplierId = $otherObject->supplierId;
			return $this->Save();
		}
		else if ($object instanceof Supplier && $object->supplierId != '')
		{
			$this->supplierId = $object->supplierId;
			$this->categoryId = $otherObject->categoryId;
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
		if ($object instanceof Category)
		{
			$this->pog_query = "delete from `categorysuppliermap` where `categoryid` = '".$object->categoryId."'";
			if ($otherObject != null && $otherObject instanceof Supplier)
			{
				$this->pog_query .= " and `supplierid` = '".$otherObject->supplierId."'";
			}
		}
		else if ($object instanceof Supplier)
		{
			$this->pog_query = "delete from `categorysuppliermap` where `supplierid` = '".$object->supplierId."'";
			if ($otherObject != null && $otherObject instanceof Category)
			{
				$this->pog_query .= " and `categoryid` = '".$otherObject->categoryId."'";
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
		$this->pog_query = "select `categoryid` from `categorysuppliermap` where `categoryid`='".$this->categoryId."' AND `supplierid`='".$this->supplierId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows == 0)
		{
			$this->pog_query = "insert into `categorysuppliermap` (`categoryid`, `supplierid`) values ('".$this->categoryId."', '".$this->supplierId."')";
		}
		return Database::InsertOrUpdate($this->pog_query, $connection);
	}
}
?>
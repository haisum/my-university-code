<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `faqcategory` (
	`faqcategoryid` int(11) NOT NULL auto_increment,
	`title` VARCHAR(255) NOT NULL,
	`position` INT NOT NULL,
	`date` DATETIME NOT NULL, PRIMARY KEY  (`faqcategoryid`)) ENGINE=MyISAM;
*/

/**
* <b>FaqCategory</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=FaqCategory&attributeList=array+%28%0A++0+%3D%3E+%27title%27%2C%0A++1+%3D%3E+%27position%27%2C%0A++2+%3D%3E+%27date%27%2C%0A++3+%3D%3E+%27Faq%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27INT%27%2C%0A++2+%3D%3E+%27DATETIME%27%2C%0A++3+%3D%3E+%27HASMANY%27%2C%0A%29
*/
include_once('class.pog_base.php');
class FaqCategory extends POG_Base
{
	public $faqcategoryId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $title;
	
	/**
	 * @var INT
	 */
	public $position;
	
	/**
	 * @var DATETIME
	 */
	public $date;
	
	/**
	 * @var private array of Faq objects
	 */
	private $_faqList = array();
	
	public $pog_attribute_type = array(
		"faqcategoryId" => array('db_attributes' => array("NUMERIC", "INT")),
		"title" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"position" => array('db_attributes' => array("NUMERIC", "INT")),
		"date" => array('db_attributes' => array("TEXT", "DATETIME")),
		"Faq" => array('db_attributes' => array("OBJECT", "HASMANY")),
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
	
	function FaqCategory($title='', $position='', $date='')
	{
		$this->title = $title;
		$this->position = $position;
		$this->date = $date;
		$this->_faqList = array();
	}
	
	
	/**
	* Gets object from database
	* @param integer $faqcategoryId 
	* @return object $FaqCategory
	*/
	function Get($faqcategoryId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `faqcategory` where `faqcategoryid`='".intval($faqcategoryId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->faqcategoryId = $row['faqcategoryid'];
			$this->title = $this->Unescape($row['title']);
			$this->position = $this->Unescape($row['position']);
			$this->date = $row['date'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $faqcategoryList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `faqcategory` ";
		$faqcategoryList = Array();
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
			$sortBy = "faqcategoryid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$faqcategory = new $thisObjectName();
			$faqcategory->faqcategoryId = $row['faqcategoryid'];
			$faqcategory->title = $this->Unescape($row['title']);
			$faqcategory->position = $this->Unescape($row['position']);
			$faqcategory->date = $row['date'];
			$faqcategoryList[] = $faqcategory;
		}
		return $faqcategoryList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $faqcategoryId
	*/
	function Save($deep = true)
	{
		$connection = Database::Connect();
		$this->pog_query = "select `faqcategoryid` from `faqcategory` where `faqcategoryid`='".$this->faqcategoryId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `faqcategory` set 
			`title`='".$this->Escape($this->title)."', 
			`position`='".$this->Escape($this->position)."', 
			`date`='".$this->date."'where `faqcategoryid`='".$this->faqcategoryId."'";
		}
		else
		{
			$this->pog_query = "insert into `faqcategory` (`title`, `position`, `date`) values (
			'".$this->Escape($this->title)."', 
			'".$this->Escape($this->position)."', 
			'".$this->date."')";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->faqcategoryId == "")
		{
			$this->faqcategoryId = $insertId;
		}
		if ($deep)
		{
			foreach ($this->_faqList as $faq)
			{
				$faq->faqcategoryId = $this->faqcategoryId;
				$faq->Save($deep);
			}
		}
		return $this->faqcategoryId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $faqcategoryId
	*/
	function SaveNew($deep = false)
	{
		$this->faqcategoryId = '';
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
			$faqList = $this->GetFaqList();
			foreach ($faqList as $faq)
			{
				$faq->Delete($deep, $across);
			}
		}
		$connection = Database::Connect();
		$this->pog_query = "delete from `faqcategory` where `faqcategoryid`='".$this->faqcategoryId."'";
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
				$pog_query = "delete from `faqcategory` where ";
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
	* Gets a list of Faq objects associated to this one
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array of Faq objects
	*/
	function GetFaqList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$faq = new Faq();
		$fcv_array[] = array("faqcategoryId", "=", $this->faqcategoryId);
		$dbObjects = $faq->GetList($fcv_array, $sortBy, $ascending, $limit);
		return $dbObjects;
	}
	
	
	/**
	* Makes this the parent of all Faq objects in the Faq List array. Any existing Faq will become orphan(s)
	* @return null
	*/
	function SetFaqList(&$list)
	{
		$this->_faqList = array();
		$existingFaqList = $this->GetFaqList();
		foreach ($existingFaqList as $faq)
		{
			$faq->faqcategoryId = '';
			$faq->Save(false);
		}
		$this->_faqList = $list;
	}
	
	
	/**
	* Associates the Faq object to this one
	* @return 
	*/
	function AddFaq(&$faq)
	{
		$faq->faqcategoryId = $this->faqcategoryId;
		$found = false;
		foreach($this->_faqList as $faq2)
		{
			if ($faq->faqId > 0 && $faq->faqId == $faq2->faqId)
			{
				$found = true;
				break;
			}
		}
		if (!$found)
		{
			$this->_faqList[] = $faq;
		}
	}
}
?>
<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `specialoffer` (
	`specialofferid` int(11) NOT NULL auto_increment,
	`title` VARCHAR(255) NOT NULL,
	`link` VARCHAR(255) NOT NULL,
	`content` VARCHAR(255) NOT NULL,
	`days` INT NOT NULL,
	`supplierid` VARCHAR(255) NOT NULL,
	`status` ENUM('ACTIVE', 'INACTIVE') NOT NULL,
	`date` DATETIME NOT NULL,
	`dateend` DATETIME NOT NULL, PRIMARY KEY  (`specialofferid`)) ENGINE=MyISAM;
*/

/**
* <b>SpecialOffer</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=SpecialOffer&attributeList=array+%28%0A++0+%3D%3E+%27title%27%2C%0A++1+%3D%3E+%27link%27%2C%0A++2+%3D%3E+%27content%27%2C%0A++3+%3D%3E+%27days%27%2C%0A++4+%3D%3E+%27supplierId%27%2C%0A++5+%3D%3E+%27status%27%2C%0A++6+%3D%3E+%27date%27%2C%0A++7+%3D%3E+%27dateEnd%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++2+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++3+%3D%3E+%27INT%27%2C%0A++4+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++5+%3D%3E+%27ENUM%28%5C%5C%5C%27ACTIVE%5C%5C%5C%27%2C+%5C%5C%5C%27INACTIVE%5C%5C%5C%27%29%27%2C%0A++6+%3D%3E+%27DATETIME%27%2C%0A++7+%3D%3E+%27DATETIME%27%2C%0A%29
*/
include_once('class.pog_base.php');
class SpecialOffer extends POG_Base
{
	public $specialofferId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $title;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $link;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $content;
	
	/**
	 * @var INT
	 */
	public $days;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $supplierId;
	
	/**
	 * @var ENUM('ACTIVE', 'INACTIVE')
	 */
	public $status;
	
	/**
	 * @var DATETIME
	 */
	public $date;
	
	/**
	 * @var DATETIME
	 */
	public $dateEnd;
	
	public $pog_attribute_type = array(
		"specialofferId" => array('db_attributes' => array("NUMERIC", "INT")),
		"title" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"link" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"content" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"days" => array('db_attributes' => array("NUMERIC", "INT")),
		"supplierId" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"status" => array('db_attributes' => array("SET", "ENUM", "'ACTIVE', 'INACTIVE'")),
		"date" => array('db_attributes' => array("TEXT", "DATETIME")),
		"dateEnd" => array('db_attributes' => array("TEXT", "DATETIME")),
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
	
	function SpecialOffer($title='', $link='', $content='', $days='', $supplierId='', $status='', $date='', $dateEnd='')
	{
		$this->title = $title;
		$this->link = $link;
		$this->content = $content;
		$this->days = $days;
		$this->supplierId = $supplierId;
		$this->status = $status;
		$this->date = $date;
		$this->dateEnd = $dateEnd;
	}
	
	
	/**
	* Gets object from database
	* @param integer $specialofferId 
	* @return object $SpecialOffer
	*/
	function Get($specialofferId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `specialoffer` where `specialofferid`='".intval($specialofferId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->specialofferId = $row['specialofferid'];
			$this->title = $this->Unescape($row['title']);
			$this->link = $this->Unescape($row['link']);
			$this->content = $this->Unescape($row['content']);
			$this->days = $this->Unescape($row['days']);
			$this->supplierId = $this->Unescape($row['supplierid']);
			$this->status = $row['status'];
			$this->date = $row['date'];
			$this->dateEnd = $row['dateend'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $specialofferList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `specialoffer` ";
		$specialofferList = Array();
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
			$sortBy = "specialofferid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$specialoffer = new $thisObjectName();
			$specialoffer->specialofferId = $row['specialofferid'];
			$specialoffer->title = $this->Unescape($row['title']);
			$specialoffer->link = $this->Unescape($row['link']);
			$specialoffer->content = $this->Unescape($row['content']);
			$specialoffer->days = $this->Unescape($row['days']);
			$specialoffer->supplierId = $this->Unescape($row['supplierid']);
			$specialoffer->status = $row['status'];
			$specialoffer->date = $row['date'];
			$specialoffer->dateEnd = $row['dateend'];
			$specialofferList[] = $specialoffer;
		}
		return $specialofferList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $specialofferId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `specialofferid` from `specialoffer` where `specialofferid`='".$this->specialofferId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `specialoffer` set 
			`title`='".$this->Escape($this->title)."', 
			`link`='".$this->Escape($this->link)."', 
			`content`='".$this->Escape($this->content)."', 
			`days`='".$this->Escape($this->days)."', 
			`supplierid`='".$this->Escape($this->supplierId)."', 
			`status`='".$this->status."', 
			`date`='".$this->date."', 
			`dateend`='".$this->dateEnd."' where `specialofferid`='".$this->specialofferId."'";
		}
		else
		{
			$this->pog_query = "insert into `specialoffer` (`title`, `link`, `content`, `days`, `supplierid`, `status`, `date`, `dateend` ) values (
			'".$this->Escape($this->title)."', 
			'".$this->Escape($this->link)."', 
			'".$this->Escape($this->content)."', 
			'".$this->Escape($this->days)."', 
			'".$this->Escape($this->supplierId)."', 
			'".$this->status."', 
			'".$this->date."', 
			'".$this->dateEnd."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->specialofferId == "")
		{
			$this->specialofferId = $insertId;
		}
		return $this->specialofferId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $specialofferId
	*/
	function SaveNew()
	{
		$this->specialofferId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `specialoffer` where `specialofferid`='".$this->specialofferId."'";
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
			$pog_query = "delete from `specialoffer` where ";
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
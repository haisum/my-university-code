<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `faq` (
	`faqid` int(11) NOT NULL auto_increment,
	`question` TEXT NOT NULL,
	`answer` TEXT NOT NULL,
	`position` INT NOT NULL,
	`date` DATETIME NOT NULL,
	`faqcategoryid` int(11) NOT NULL, INDEX(`faqcategoryid`), PRIMARY KEY  (`faqid`)) ENGINE=MyISAM;
*/

/**
* <b>Faq</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=Faq&attributeList=array+%28%0A++0+%3D%3E+%27question%27%2C%0A++1+%3D%3E+%27answer%27%2C%0A++2+%3D%3E+%27position%27%2C%0A++3+%3D%3E+%27date%27%2C%0A++4+%3D%3E+%27FaqCategory%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27TEXT%27%2C%0A++1+%3D%3E+%27TEXT%27%2C%0A++2+%3D%3E+%27INT%27%2C%0A++3+%3D%3E+%27DATETIME%27%2C%0A++4+%3D%3E+%27BELONGSTO%27%2C%0A%29
*/
include_once('class.pog_base.php');
class Faq extends POG_Base
{
	public $faqId = '';

	/**
	 * @var TEXT
	 */
	public $question;
	
	/**
	 * @var TEXT
	 */
	public $answer;
	
	/**
	 * @var INT
	 */
	public $position;
	
	/**
	 * @var DATETIME
	 */
	public $date;
	
	/**
	 * @var INT(11)
	 */
	public $faqcategoryId;
	
	public $pog_attribute_type = array(
		"faqId" => array('db_attributes' => array("NUMERIC", "INT")),
		"question" => array('db_attributes' => array("TEXT", "TEXT")),
		"answer" => array('db_attributes' => array("TEXT", "TEXT")),
		"position" => array('db_attributes' => array("NUMERIC", "INT")),
		"date" => array('db_attributes' => array("TEXT", "DATETIME")),
		"FaqCategory" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
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
	
	function Faq($question='', $answer='', $position='', $date='')
	{
		$this->question = $question;
		$this->answer = $answer;
		$this->position = $position;
		$this->date = $date;
	}
	
	
	/**
	* Gets object from database
	* @param integer $faqId 
	* @return object $Faq
	*/
	function Get($faqId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `faq` where `faqid`='".intval($faqId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->faqId = $row['faqid'];
			$this->question = $this->Unescape($row['question']);
			$this->answer = $this->Unescape($row['answer']);
			$this->position = $this->Unescape($row['position']);
			$this->date = $row['date'];
			$this->faqcategoryId = $row['faqcategoryid'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $faqList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `faq` ";
		$faqList = Array();
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
			$sortBy = "faqid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$faq = new $thisObjectName();
			$faq->faqId = $row['faqid'];
			$faq->question = $this->Unescape($row['question']);
			$faq->answer = $this->Unescape($row['answer']);
			$faq->position = $this->Unescape($row['position']);
			$faq->date = $row['date'];
			$faq->faqcategoryId = $row['faqcategoryid'];
			$faqList[] = $faq;
		}
		return $faqList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $faqId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `faqid` from `faq` where `faqid`='".$this->faqId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `faq` set 
			`question`='".$this->Escape($this->question)."', 
			`answer`='".$this->Escape($this->answer)."', 
			`position`='".$this->Escape($this->position)."', 
			`date`='".$this->date."', 
			`faqcategoryid`='".$this->faqcategoryId."' where `faqid`='".$this->faqId."'";
		}
		else
		{
			$this->pog_query = "insert into `faq` (`question`, `answer`, `position`, `date`, `faqcategoryid` ) values (
			'".$this->Escape($this->question)."', 
			'".$this->Escape($this->answer)."', 
			'".$this->Escape($this->position)."', 
			'".$this->date."', 
			'".$this->faqcategoryId."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->faqId == "")
		{
			$this->faqId = $insertId;
		}
		return $this->faqId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $faqId
	*/
	function SaveNew()
	{
		$this->faqId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `faq` where `faqid`='".$this->faqId."'";
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
			$pog_query = "delete from `faq` where ";
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
	
	
	/**
	* Associates the FaqCategory object to this one
	* @return boolean
	*/
	function GetFaqcategory()
	{
		$faqcategory = new FaqCategory();
		return $faqcategory->Get($this->faqcategoryId);
	}
	
	
	/**
	* Associates the FaqCategory object to this one
	* @return 
	*/
	function SetFaqcategory(&$faqcategory)
	{
		$this->faqcategoryId = $faqcategory->faqcategoryId;
	}
}
?>
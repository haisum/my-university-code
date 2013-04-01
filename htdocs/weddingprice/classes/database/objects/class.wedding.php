<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `wedding` (
	`weddingid` int(11) NOT NULL auto_increment,
	`weddingdate` TIMESTAMP NOT NULL,
	`biddeadline` TIMESTAMP NOT NULL,
	`regionid` int(11) NOT NULL,
	`guestcount` INT NOT NULL,
	`bridalpartysize` INT NOT NULL,
	`budgetfrom` INT NOT NULL,
	`budgetto` VARCHAR(255) NOT NULL,
	`additionalinfo` TEXT NOT NULL,
	`status` enum('OPEN', 'CLOSED') NOT NULL,
	`posteddate` TIMESTAMP NOT NULL,
	`buyerid` int(11) NOT NULL,
	`lastmodified` TIMESTAMP NOT NULL,
	`title` VARCHAR(255) NOT NULL, INDEX(`regionid`,`buyerid`), PRIMARY KEY  (`weddingid`)) ENGINE=MyISAM;
*/

/**
* <b>Wedding</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0f / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=Wedding&attributeList=array+%28%0A++0+%3D%3E+%27weddingDate%27%2C%0A++1+%3D%3E+%27bidDeadline%27%2C%0A++2+%3D%3E+%27Region%27%2C%0A++3+%3D%3E+%27guestCount%27%2C%0A++4+%3D%3E+%27bridalPartySize%27%2C%0A++5+%3D%3E+%27budgetFrom%27%2C%0A++6+%3D%3E+%27budgetTo%27%2C%0A++7+%3D%3E+%27additionalInfo%27%2C%0A++8+%3D%3E+%27status%27%2C%0A++9+%3D%3E+%27postedDate%27%2C%0A++10+%3D%3E+%27Buyer%27%2C%0A++11+%3D%3E+%27lastModified%27%2C%0A++12+%3D%3E+%27Bid%27%2C%0A++13+%3D%3E+%27BidPerCategory%27%2C%0A++14+%3D%3E+%27Message%27%2C%0A++15+%3D%3E+%27title%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27TIMESTAMP%27%2C%0A++1+%3D%3E+%27TIMESTAMP%27%2C%0A++2+%3D%3E+%27BELONGSTO%27%2C%0A++3+%3D%3E+%27INT%27%2C%0A++4+%3D%3E+%27INT%27%2C%0A++5+%3D%3E+%27INT%27%2C%0A++6+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++7+%3D%3E+%27TEXT%27%2C%0A++8+%3D%3E+%27enum%28%5C%5C%5C%27OPEN%5C%5C%5C%27%2C+%5C%5C%5C%27CLOSED%5C%5C%5C%27%29%27%2C%0A++9+%3D%3E+%27TIMESTAMP%27%2C%0A++10+%3D%3E+%27BELONGSTO%27%2C%0A++11+%3D%3E+%27TIMESTAMP%27%2C%0A++12+%3D%3E+%27HASMANY%27%2C%0A++13+%3D%3E+%27HASMANY%27%2C%0A++14+%3D%3E+%27HASMANY%27%2C%0A++15+%3D%3E+%27VARCHAR%28255%29%27%2C%0A%29
*/
include_once('class.pog_base.php');
class Wedding extends POG_Base
{
	public $weddingId = '';

	/**
	 * @var TIMESTAMP
	 */
	public $weddingDate;
	
	/**
	 * @var TIMESTAMP
	 */
	public $bidDeadline;
	
	/**
	 * @var INT(11)
	 */
	public $regionId;
	
	/**
	 * @var INT
	 */
	public $guestCount;
	
	/**
	 * @var INT
	 */
	public $bridalPartySize;
	
	/**
	 * @var INT
	 */
	public $budgetFrom;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $budgetTo;
	
	/**
	 * @var TEXT
	 */
	public $additionalInfo;
	
	/**
	 * @var enum('OPEN', 'CLOSED')
	 */
	public $status;
	
	/**
	 * @var TIMESTAMP
	 */
	public $postedDate;
	
	/**
	 * @var INT(11)
	 */
	public $buyerId;
	
	/**
	 * @var TIMESTAMP
	 */
	public $lastModified;
	
	/**
	 * @var private array of Bid objects
	 */
	private $_bidList = array();
	
	/**
	 * @var private array of BidPerCategory objects
	 */
	private $_bidpercategoryList = array();
	
	/**
	 * @var private array of Message objects
	 */
	private $_messageList = array();
	
	/**
	 * @var VARCHAR(255)
	 */
	public $title;
	
	public $pog_attribute_type = array(
		"weddingId" => array('db_attributes' => array("NUMERIC", "INT")),
		"weddingDate" => array('db_attributes' => array("NUMERIC", "TIMESTAMP")),
		"bidDeadline" => array('db_attributes' => array("NUMERIC", "TIMESTAMP")),
		"Region" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"guestCount" => array('db_attributes' => array("NUMERIC", "INT")),
		"bridalPartySize" => array('db_attributes' => array("NUMERIC", "INT")),
		"budgetFrom" => array('db_attributes' => array("NUMERIC", "INT")),
		"budgetTo" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"additionalInfo" => array('db_attributes' => array("TEXT", "TEXT")),
		"status" => array('db_attributes' => array("SET", "ENUM", "'OPEN', 'CLOSED'")),
		"postedDate" => array('db_attributes' => array("NUMERIC", "TIMESTAMP")),
		"Buyer" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"lastModified" => array('db_attributes' => array("NUMERIC", "TIMESTAMP")),
		"Bid" => array('db_attributes' => array("OBJECT", "HASMANY")),
		"BidPerCategory" => array('db_attributes' => array("OBJECT", "HASMANY")),
		"Message" => array('db_attributes' => array("OBJECT", "HASMANY")),
		"title" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
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
	
	function Wedding($weddingDate='', $bidDeadline='', $guestCount='', $bridalPartySize='', $budgetFrom='', $budgetTo='', $additionalInfo='', $status='', $postedDate='', $lastModified='', $title='')
	{
		$this->weddingDate = $weddingDate;
		$this->bidDeadline = $bidDeadline;
		$this->guestCount = $guestCount;
		$this->bridalPartySize = $bridalPartySize;
		$this->budgetFrom = $budgetFrom;
		$this->budgetTo = $budgetTo;
		$this->additionalInfo = $additionalInfo;
		$this->status = $status;
		$this->postedDate = $postedDate;
		$this->lastModified = $lastModified;
		$this->_bidList = array();
		$this->_bidpercategoryList = array();
		$this->_messageList = array();
		$this->title = $title;
	}
	
	
	/**
	* Gets object from database
	* @param integer $weddingId 
	* @return object $Wedding
	*/
	function Get($weddingId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `wedding` where `weddingid`='".intval($weddingId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->weddingId = $row['weddingid'];
			$this->weddingDate = $row['weddingdate'];
			$this->bidDeadline = $row['biddeadline'];
			$this->regionId = $row['regionid'];
			$this->guestCount = $this->Unescape($row['guestcount']);
			$this->bridalPartySize = $this->Unescape($row['bridalpartysize']);
			$this->budgetFrom = $this->Unescape($row['budgetfrom']);
			$this->budgetTo = $this->Unescape($row['budgetto']);
			$this->additionalInfo = $this->Unescape($row['additionalinfo']);
			$this->status = $row['status'];
			$this->postedDate = $row['posteddate'];
			$this->buyerId = $row['buyerid'];
			$this->lastModified = $row['lastmodified'];
			$this->title = $this->Unescape($row['title']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $weddingList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `wedding` ";
		$weddingList = Array();
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
			$sortBy = "weddingid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$wedding = new $thisObjectName();
			$wedding->weddingId = $row['weddingid'];
			$wedding->weddingDate = $row['weddingdate'];
			$wedding->bidDeadline = $row['biddeadline'];
			$wedding->regionId = $row['regionid'];
			$wedding->guestCount = $this->Unescape($row['guestcount']);
			$wedding->bridalPartySize = $this->Unescape($row['bridalpartysize']);
			$wedding->budgetFrom = $this->Unescape($row['budgetfrom']);
			$wedding->budgetTo = $this->Unescape($row['budgetto']);
			$wedding->additionalInfo = $this->Unescape($row['additionalinfo']);
			$wedding->status = $row['status'];
			$wedding->postedDate = $row['posteddate'];
			$wedding->buyerId = $row['buyerid'];
			$wedding->lastModified = $row['lastmodified'];
			$wedding->title = $this->Unescape($row['title']);
			$weddingList[] = $wedding;
		}
		return $weddingList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $weddingId
	*/
	function Save($deep = true)
	{
		$connection = Database::Connect();
		$this->pog_query = "select `weddingid` from `wedding` where `weddingid`='".$this->weddingId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `wedding` set 
			`weddingdate`='".$this->weddingDate."', 
			`biddeadline`='".$this->bidDeadline."', 
			`regionid`='".$this->regionId."', 
			`guestcount`='".$this->Escape($this->guestCount)."', 
			`bridalpartysize`='".$this->Escape($this->bridalPartySize)."', 
			`budgetfrom`='".$this->Escape($this->budgetFrom)."', 
			`budgetto`='".$this->Escape($this->budgetTo)."', 
			`additionalinfo`='".$this->Escape($this->additionalInfo)."', 
			`status`='".$this->status."', 
			`posteddate`='".$this->postedDate."', 
			`buyerid`='".$this->buyerId."', 
			`lastmodified`='".$this->lastModified."', 
			`title`='".$this->Escape($this->title)."' where `weddingid`='".$this->weddingId."'";
		}
		else
		{
			$this->pog_query = "insert into `wedding` (`weddingdate`, `biddeadline`, `regionid`, `guestcount`, `bridalpartysize`, `budgetfrom`, `budgetto`, `additionalinfo`, `status`, `posteddate`, `buyerid`, `lastmodified`, `title` ) values (
			'".$this->weddingDate."', 
			'".$this->bidDeadline."', 
			'".$this->regionId."', 
			'".$this->Escape($this->guestCount)."', 
			'".$this->Escape($this->bridalPartySize)."', 
			'".$this->Escape($this->budgetFrom)."', 
			'".$this->Escape($this->budgetTo)."', 
			'".$this->Escape($this->additionalInfo)."', 
			'".$this->status."', 
			'".$this->postedDate."', 
			'".$this->buyerId."', 
			'".$this->lastModified."', 
			'".$this->Escape($this->title)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->weddingId == "")
		{
			$this->weddingId = $insertId;
		}
		if ($deep)
		{
			foreach ($this->_bidList as $bid)
			{
				$bid->weddingId = $this->weddingId;
				$bid->Save($deep);
			}
			foreach ($this->_bidpercategoryList as $bidpercategory)
			{
				$bidpercategory->weddingId = $this->weddingId;
				$bidpercategory->Save($deep);
			}
			foreach ($this->_messageList as $message)
			{
				$message->weddingId = $this->weddingId;
				$message->Save($deep);
			}
		}
		return $this->weddingId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $weddingId
	*/
	function SaveNew($deep = false)
	{
		$this->weddingId = '';
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
			$bidList = $this->GetBidList();
			foreach ($bidList as $bid)
			{
				$bid->Delete($deep, $across);
			}
			$bidpercategoryList = $this->GetBidpercategoryList();
			foreach ($bidpercategoryList as $bidpercategory)
			{
				$bidpercategory->Delete($deep, $across);
			}
			$messageList = $this->GetMessageList();
			foreach ($messageList as $message)
			{
				$message->Delete($deep, $across);
			}
		}
		$connection = Database::Connect();
		$this->pog_query = "delete from `wedding` where `weddingid`='".$this->weddingId."'";
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
				$pog_query = "delete from `wedding` where ";
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
	* Associates the Region object to this one
	* @return boolean
	*/
	function GetRegion()
	{
		$region = new Region();
		return $region->Get($this->regionId);
	}
	
	
	/**
	* Associates the Region object to this one
	* @return 
	*/
	function SetRegion(&$region)
	{
		$this->regionId = $region->regionId;
	}
	
	
	/**
	* Associates the Buyer object to this one
	* @return boolean
	*/
	function GetBuyer()
	{
		$buyer = new Buyer();
		return $buyer->Get($this->buyerId);
	}
	
	
	/**
	* Associates the Buyer object to this one
	* @return 
	*/
	function SetBuyer(&$buyer)
	{
		$this->buyerId = $buyer->buyerId;
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
		$fcv_array[] = array("weddingId", "=", $this->weddingId);
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
			$bid->weddingId = '';
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
		$bid->weddingId = $this->weddingId;
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
		$fcv_array[] = array("weddingId", "=", $this->weddingId);
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
			$bidpercategory->weddingId = '';
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
		$bidpercategory->weddingId = $this->weddingId;
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
	
	
	/**
	* Gets a list of Message objects associated to this one
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array of Message objects
	*/
	function GetMessageList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$message = new Message();
		$fcv_array[] = array("weddingId", "=", $this->weddingId);
		$dbObjects = $message->GetList($fcv_array, $sortBy, $ascending, $limit);
		return $dbObjects;
	}
	
	
	/**
	* Makes this the parent of all Message objects in the Message List array. Any existing Message will become orphan(s)
	* @return null
	*/
	function SetMessageList(&$list)
	{
		$this->_messageList = array();
		$existingMessageList = $this->GetMessageList();
		foreach ($existingMessageList as $message)
		{
			$message->weddingId = '';
			$message->Save(false);
		}
		$this->_messageList = $list;
	}
	
	
	/**
	* Associates the Message object to this one
	* @return 
	*/
	function AddMessage(&$message)
	{
		$message->weddingId = $this->weddingId;
		$found = false;
		foreach($this->_messageList as $message2)
		{
			if ($message->messageId > 0 && $message->messageId == $message2->messageId)
			{
				$found = true;
				break;
			}
		}
		if (!$found)
		{
			$this->_messageList[] = $message;
		}
	}
}
?>
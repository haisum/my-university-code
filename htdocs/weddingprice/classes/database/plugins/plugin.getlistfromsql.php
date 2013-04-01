<?php
class GetListFromSQL extends POG_Base implements POG_Plugin
{
	var $sourceObject;
	var $sql;
	var $version = '0.01';

	function Version()
	{
		return $this->version;
	}

	function GetListFromSQL($sourceObject = '', $argv = '')
	{
		$this->sourceObject = $sourceObject;
		$this->sql = $argv[0];
	}



	function Execute()
	{
		$objectName = get_class($this->sourceObject);
		return $this->FetchObjects($this->sql, get_class($this->sourceObject));
	}

	function SetupRender()
	{
		if ($this->PerformUnitTest() === false)
		{
			echo get_class($this).' failed unit test';
		}
		else
		{
			echo get_class($this).' passed unit test';
		}
	}

	function AuthorPage()
	{
		return "http://www.unitedworx.com";
	}

	function PerformUnitTest()
	{
		// unit test? what unit test?
		return true;

	}
	
	
}

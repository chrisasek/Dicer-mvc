<?php
namespace App\Classes;

class Constants extends General
{
	private $_db, $_data, $_table = 'constants';
	// errors constants
	const 	LOGIN_FAILED = "Sorry Logging in failed. Pls try again with the right combination",
		INVALID_LOGIN = "Invalid Login attempt Please Try Again!",
		INVALID_TOKEN = "Invalid token supplied!",
		SECTOR_SUCCESS = "New sector successfully added.",
		INDUSTRY_SUCCESS = "New industry successfully added.",
		CATEGORY_SUCCESS = "New category successfully added.",
		CONSTANT_SUCCESS = "New constant successfully added.",
		INVALID_REQUEST = "Invalid request made.";

	function __construct()
	{
		$this->_db = DB::getInstance();
		parent::__construct('constants');
	}

	public function find($id)
	{
		$data = $this->_db->get($this->_table, array('id', '=', $id));
		if ($data->count()) {
			$this->_data = $data->first();
			return $this;
		}

		return false;
	}

	public function getText($name)
	{
		$text = $this->_db->get($this->_table, array('name', '=', $name));
		if ($text && $text->count()) {
			return $text->first()->content;
		}
		return '';
	}

	public function getConstants($per_page, $off_set, $where = null)
	{
		return $this->_db->getPerPage($per_page, $off_set, $this->_table, $where, "ORDER BY id DESC");
	}

	public function data()
	{
		return $this->_data;
	}
}

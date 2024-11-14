<?php

namespace Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class General extends Model
{
	protected $table = 'constants';
	private $_db, $_data;

	function __construct($data)
	{
		$this->table = $data;
		
	}

	// public function find($value, $field = 'id')
	// {
	// 	// print_r($this->table);
	// 	$data = $this->where('id', 1); //where($field, $value)->first();
		
	// 	print_r($data);
	// 	// if ($data) {
	// 		// $this->_data = (object) $data;
	// 	// 	return $this;
	// 	// }
	// 	return false;
	// }

	public function create($fields = array())
	{
		if (!$this->_db->insert($this->_table, $fields)) {
			throw new Exception('There was a problem creating an account.');
		}
	}

	public function update($fields = array(), $id = 0, $keyfield = 'id')
	{
		if (!$this->_db->update($this->_table, $id, $fields, $keyfield)) {
			throw new Exception('There was a problem updating...');
		}
	}

	public function remove($id, $field = 'id')
	{
		$result = $this->_db->delete($this->_table, array($field, '=', $id));
		if ($result) {
			return true;
		}
		return false;
	}

}

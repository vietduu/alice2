<?php
namespace Bob\Model\DataObject;

class ProductType
{
	public $id;
	public $name;

	public function exchangeArray($data)
	{
		$this->name = (isset($data['name'])) ? $data['name'] : null;
	}
}
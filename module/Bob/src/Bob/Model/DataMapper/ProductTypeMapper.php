<?php
namespace Bob\Model\DataMapper;

use Bob\Model\DataObject\ProductType;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class ProductTypeMapper
{
	protected $tableGateway;

	/**
	 * ProductTypeMapper constructor.
	 * @param $tableGateway
	 */
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function saveProductType(ProductType $productType)
	{
		$data = array(
			'name' => $productType->name,
			);
		$id = (int) $productType->id;

		if (0 == $id)
		{
			$this->tableGateway->insert($data);
		} else {
			if ($this->getUser($id)){
			$this->tableGateway->update($data, array('id' => $id));
		} else {
			throw new \Exception('Product type ID does not exist');
			}
		}
	}

	public function getProductType($id)
	{
		$id = (int) $id;
		$row_set = $this->tableGateway->select(array('id' => $id));
		$row = $row_set->current();
		if (!$row){
			throw new \Exception('Could not find the product type ID$id');
		}
		return $row;
	}




}
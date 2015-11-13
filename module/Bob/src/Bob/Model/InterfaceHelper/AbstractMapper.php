<?php
namespace Bob\Model\InterfaceHelper;

abstract class AbstractMapper
{
	protected $tableGateway;

	/**
	 * GeneralProductMapper constructor.
	 * @param $tableGateway
	 */
	protected function __construct($tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function getTableGateway()
	{
		return $this->tableGateway;
	}

	public function getAdapter(){
		return $this->tableGateway->getAdapter();
	}

	public function fetchAll()
	{
		$resultSet = $this->getTableGateway()->select();
		return $resultSet;
	}

	public function getById($id)
	{
		$id = (int) $id;
		$set = $this->getTableGateway()->select(array('id' => $id));
		$row = $set->current();
		if (!$row){
			throw new \Exception('Could not find the product type ID$id');
		}
		return $row;
	}

	public function deleteById($id)
	{
		$this->getTableGateway()->delete(array('id' => (int) $id));
	}


	public abstract function getModelData($entity);

	public function save($entity)
	{
		$data = $this->getModelData($entity);

		$id = (int) $data['id'];

		if (0 == $id)
		{
			$this->getTableGateway()->insert($data);
		} else {
			if ($this->getById($id)){
				$this->getTableGateway()->update($data, array('id' => $id));
		} else {
			throw new \Exception('Product type ID does not exist');
			}
		}
	}
}
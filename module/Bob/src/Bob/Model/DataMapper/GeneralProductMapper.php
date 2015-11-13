<?php
namespace Bob\Model\DataMapper;

class GeneralProductMapper extends \Bob\Model\InterfaceHelper\AbstractMapper
{
	public function __construct($tableGateway)
	{
		parent::__construct($tableGateway);
	}

	public function getModelData($entity)
	{
		$this->settype($entity, 'GeneralProduct');
		return array(
			'general_id' => $entity->general_product_id,
			'general_name' => $entity->general_name,
			'sku' => $entity->sku,
			'description_fk' => $entity->description_fk,
			'product_type_fk' => $entity->product_type_fk,
			'invoice_flag' => $entity->invoice_flag,
			'invoice_type_fk' => $entity->invoice_type_fk,
			);
	}

	public function getProductsByProductTypeId($id)
	{
		$sql = "SELECT * FROM general_product gp LEFT JOIN product_type pt "
				. "ON (gp.product_type_fk = pt.id) "
				. "WHERE pt.id = ?";
		$params = array(
			':id' => $id,
			);
		$statement = $this->getAdapter()->query($sql);		
		$result = $statement->execute(array(1));
		return $result->getResource()->fetchAll();
	}

	public function getFullInformationByTypeId($id)
	{
		$sql = $sql = "SELECT * FROM general_product gp LEFT JOIN product_type pt "
				. "ON (gp.product_type_fk = pt.id) "
				. "LEFT JOIN images ON (gp.general_id = images.general_product_fk) "
				. "WHERE gp.general_id = ?";
		$statement = $this->getAdapter()->query($sql);
		$result = $statement->execute(array(2));
		return $result->getResource()->fetchAll();
	}
}
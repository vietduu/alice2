<?php
namespace Bob\Model\DataMapper;
use Bob\Model\DataObject\GeneralProduct;

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

	public function getModelObject()
	{
		return GeneralProduct::class;
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
		$sql = "SELECT * FROM general_product gp LEFT JOIN product_type pt "
				. "ON (gp.product_type_fk = pt.id) "
				. "LEFT JOIN images ON (gp.general_id = images.general_product_fk) "
				. "LEFT JOIN description ON (description.description_id = gp.description_fk) "
				. "WHERE gp.general_id = ?";
		$statement = $this->getAdapter()->query($sql);
		$result = $statement->execute(array($id));
		return $result->getResource()->fetchAll();
	}

	public function getProductInformationByInvoiceTypeId($id)
	{
		$sql = "SELECT * FROM general_product gp LEFT JOIN invoice_type it "
				. "ON (gp.invoice_type_fk = it.invoice_type_id) "
				. "LEFT JOIN images ON (gp.general_id = images.general_product_fk) "
				. "LEFT JOIN description ON (description.description_id = gp.description_fk) "
				. "WHERE gp.invoice_flag = 1 AND it.invoice_type_id = " . $id;
		$statement = $this->getAdapter()->query($sql);
		$result = $statement->execute();

		return $result->getResource()->fetchAll();
	}
}
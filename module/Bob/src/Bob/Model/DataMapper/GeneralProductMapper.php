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

	//http://akrabat.com/displaying-the-generated-sql-from-a-zenddbsql-object/
	//http://webdevnetwork.co.uk/example-of-raw-zend-frameowork-2-sql-query/
}
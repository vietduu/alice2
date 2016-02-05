<?php
namespace Bob\Model\DataMapper;
use Bob\Model\DataObject\CmsItemType;

class CmsItemTypeMapper extends \Bob\Model\InterfaceHelper\AbstractMapper
{
	public function __construct($tableGateway)
	{
		parent::__construct($tableGateway);
	}

	public function getModelData($entity)
	{
		$this->settype($entity, 'CmsItemType');
		return array(
			'id_cms_item_type' => $entity->id_cms_item_type,
			'key' => $entity->key,
			'description' => $entity->description,
			'label' => $entity->label,
			'xtype' => $entity->xtype,
			'parent_id' => $entity->parent_id,
		);
	}

	public function getModelObject()
	{
		return CmsItemType::class;
	}
}
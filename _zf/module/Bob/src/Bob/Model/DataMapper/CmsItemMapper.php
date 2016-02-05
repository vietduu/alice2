<?php
namespace Bob\Model\DataMapper;
use Bob\Model\DataObject\CmsItem;

class CmsItemMapper extends \Bob\Model\InterfaceHelper\AbstractMapper
{
	public function __construct($tableGateway)
	{
		parent::__construct($tableGateway);
	}

	public function getModelData($entity)
	{
		$this->settype($entity, 'CmsItem');
		return array(
			'id_cms_item' => $entity->id_cms_item,
			'fk_cms_folder' => $entity->fk_cms_folder,
			'fk_cms_item_type' => $entity->fk_cms_item_type,
			'content' => $entity->content,
			'created_at' => $entity->created_at,
		);
	}

	public function getModelObject()
	{
		return CmsItem::class;
	}
}
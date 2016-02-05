<?php
namespace Bob\Model\DataMapper;
use Bob\Model\DataObject\CmsFolder;

class CmsFolderMapper extends \Bob\Model\InterfaceHelper\AbstractMapper
{
	public function __construct($tableGateway)
	{
		parent::__construct($tableGateway);
	}

	public function getModelData($entity)
	{
		$this->settype($entity, 'CmsFolder');
		return array(
			'id_cms_folder' => $entity->id_cms_folder,
			'fk_cms_folder_type' => $entity->fk_cms_folder_type,
			'key' => $entity->key,
			'description' => $entity->description,
			'is_active' => $entity->is_active,
			'revision' => $entity->revision,
			'created_at' => $entity->created_at,
			'is_published' => $entity->is_published,
			);
	}

	public function getModelObject()
	{
		return CmsFolder::class;
	}
}
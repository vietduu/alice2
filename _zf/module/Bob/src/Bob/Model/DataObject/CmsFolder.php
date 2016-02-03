<?php
namespace Bob\Model\DataObject;

class CmsFolder implements \Bob\Model\InterfaceHelper\ModelInterface
{
	public $id_cms_folder;
	public $fk_cms_folder_type;
	public $key;
	public $description;
	public $is_active;
	public $revision;
	public $create_at;
	public $is_published;

	public function exchangeArray($data)
	{
		$this->id_cms_folder = (!empty($data['id_cms_folder'])) ? $data['id_cms_folder'] : null;
		$this->fk_cms_folder_type = (!empty($data['fk_cms_folder_type'])) ? $data['fk_cms_folder_type'] : null;
		$this->key = (!empty($data['key'])) ? $data['key'] : null;
		$this->description = (!empty($data['description'])) ? $data['description'] : null;
		$this->is_active = (!empty($data['is_active'])) ? $data['is_active'] : null;
		$this->revision = (!empty($data['revision'])) ? $data['revision'] : null;
		$this->create_at = (!empty($data['create_at'])) ? $data['create_at'] : null;
		$this->is_published = (!empty($data['is_published'])) ? $data['is_published'] : null;
	}
}
<?php
namespace Bob\Model\DataObject;

class CmsItem implements \Bob\Model\InterfaceHelper\ModelInterface
{
	public $id_cms_item;
	public $fk_cms_folder;
	public $fk_cms_item_type;
	public $content;
	public $created_at;

	public function exchangeArray($data)
	{
		$this->id_cms_item = (!empty($data['id_cms_item'])) ? $data['id_cms_item'] : null;
		$this->fk_cms_folder = (!empty($data['fk_cms_folder'])) ? $data['fk_cms_folder'] : null;
		$this->fk_cms_item_type = (!empty($data['fk_cms_item_type'])) ? $data['fk_cms_item_type'] : null;
		$this->content = (!empty($data['content'])) ? $data['content'] : null;
		$this->created_at = (!empty($data['created_at'])) ? $data['created_at'] : null;
	}
}
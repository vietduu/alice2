<?php
namespace Bob\Content\Form;
use Zend\Form\Form;
use Bob\Model\DataObject\CmsFolder;

class CmsForm extends Form 
{
	public function __construct($name = null) {
		parent::__construct('Cms');

		$this->add(array(
			'name' => 'id_cms_folder',
			'type' => 'Hidden',
		));

		$this->add(array(
			'name' => 'cms_folder',
			'type' => 'Text',
			'options' => array(
				'label' => 'Folder name: ',
			),
			'attributes' => array(
                'required' => 'required',
                'class' => 'cms_entity',
            )
		));

		$this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Save',
                 'id' => 'submit_btn',
             ),
         ));
	}
}
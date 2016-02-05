<?php
namespace Bob\Content\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Bob\Model\DataObject\CmsFolder;
use Bob\Model\DataMapper\CmsFolderTypeMapper;
use Zend\Db\Adapter\AdapterInterface;
use Bob\Helper\ConcreteServiceConfig;
use Zend\Db\Adapter\Adapter;

class CmsForm extends Form 
{
	protected $adapter;

	public function __construct(AdapterInterface $adapter) {
		parent::__construct('Cms');
		$this->adapter = $adapter;

		$this->setAttribute('method','post');

		$this->add(array(
			'name' => 'id_cms_folder',
			'attributes' => array(
				'type' => 'hidden',
			),
		));

		$this->add(array(
			'type' => 'Zend\Form\Element\Select',
			'name' => 'cms_folder_type',
			'options' => array(
				'label' => 'CMS folder type: ',
				'empty_option' => 'Please select',
				'value_options' => $this->getAllCmsFolderTypes(),
			),
			'attributes' => array(
				'value' => '1'
			)
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

	public function populateValues($data)
    {   
        foreach($data as $key=>$row)
        {
           if (is_array(@json_decode($row))){
                $data[$key] =   new \ArrayObject(\Zend\Json\Json::decode($row), \ArrayObject::ARRAY_AS_PROPS);
           }
        } 
         
        parent::populateValues($data);
    }


//	public function getAllCmsFolderTypes()
//	{
	//	$folderType = ConcreteServiceConfig::getCmsFolderTypeServiceConfig($this);
	//	return $folderType->fetchAll();
//	}

    public function getAllCmsFolderTypes(){
    	$adapter = $this->adapter;
    	$sql = "SELECT `key` FROM cms_folder_type";
    	$statement = $adapter->query($sql);
        $result    = $statement->execute();

   //     $selectData = array();

    /*    foreach ($result as $res) {
            $selectData[$res['id']] = $res['name'];
        }*/

        return $result->getResource()->fetchAll();
   //    return $selectData;
    }
}
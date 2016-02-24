<?php
namespace Bob\Content\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Bob\Model\DataObject\CmsItem;
//use Bob\Model\DataMapper\CmsFolderTypeMapper;
use Zend\Db\Adapter\AdapterInterface;
use Bob\Helper\ConcreteServiceConfig;
use Zend\Db\Adapter\Adapter;

class CmsItemForm extends Form 
{
	protected $adapter;

	public function __construct(AdapterInterface $adapter) {
		parent::__construct('cms-item');
		$this->adapter = $adapter;

		$this->setAttribute('method','post');

		$this->add(array(
			'name' => 'id_cms_item',
			'attributes' => array(
				'type' => 'hidden',
			),
		));

		$this->add(array(
			'name' => 'content',
			'type' => 'Text',
			'options' => array(
				'label' => 'Key:',
			),
		));
		
		$this->add(array(
             'name' => 'submit',
             'attributes' => array(
             	 'type' => 'submit',
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

    public function getAllCmsFolderTypes(){
    	$adapter = $this->adapter;
    	$sql = "SELECT * FROM cms_item_type";
    	$statement = $adapter->query($sql);
        $result    = $statement->execute();
        $types 	   = $result->getResource()->fetchAll();

        $selectData = array();
        foreach ($types as $type) {
            $selectData[] = $type[2];
        }

        return $selectData;
    }
}
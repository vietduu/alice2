<?php
namespace Bob\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Bob\Helper\ServiceConfigHelper;
use Bob\Helper\ConcreteServiceConfig;
use Bob\Model\DataObject\CmsFolder;
use Bob\Content\Form\CmsForm;
use Bob\Model\DataObject\CmsItem;
use Bob\Content\Form\CmsDetailForm;
use Bob\Content\Form\CmsItemForm;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class CmsController extends AbstractActionController
{
	public function indexAction()
	{
		$view = new ViewModel();
		$view->folders = $this->getFullCmsFolder();
		$view->flashMessenger = $this->flashMessenger()->getMessages();
		return $view;
	}

	public function addAction(){
		$view = new ViewModel();
		$adapter = ServiceConfigHelper::getAdapter($this);
		$form = new CmsForm($adapter);
		$form->get('submit')->setValue('Add');

		$request = $this->getRequest();

		if ($request->isPost()) {
			$cmsFolder = new CmsFolder();
			$form->setInputFilter($cmsFolder->getInputFilter());
			$form->setData($request->getPost());
			if ($form->isValid()){
				$cmsFolder->exchangeArray($form->getData());
				$this->saveCmsFolder($cmsFolder);
				$this->flashMessenger()->addMessage('CMS key is created successfully!');
				return $this->redirect()->toRoute('cms');
			}
		}

		$view->form = $form;
		
		return $view;
	}

	public function editAction(){
		$view = new ViewModel();
		$request = $this->getRequest();
		$url = $request->getUri();
		$view->url = $url;
		$id = substr($url, strripos($url,'/')+1);

		$adapter = ServiceConfigHelper::getAdapter($this);

		$form = new CmsDetailForm($adapter);
		$form->get('submit')->setValue('Create');

		$view->form = $form;
		$view->count = $this->countCmsItemsOfFolder($id);
		$view->items = $this->getFullCmsItemOfFolder($id);

		if (0 <= $this->countCmsItemsOfFolder($id)) {
			$this->createCmsItem($request);
		} else {
			throw new \Exception("Can't create/edit this cms item");
		}

		return $view;
	}

	public function saveCmsFolder($entity)
	{
		$cmsFolder = ConcreteServiceConfig::getCmsFolderServiceConfig($this);
		return $cmsFolder->save($entity);
	}

	public function getAllCmsFolderTypes()
	{
		$folderType = ConcreteServiceConfig::getCmsFolderTypeServiceConfig($this);
		return $folderType->fetchAll();
	}

	public function getAllCmsFolders(){
		$folder = ConcreteServiceConfig::getCmsFolderServiceConfig($this);
		return $folder->fetchAll();
	}

	public function getFullCmsFolder(){
		$folder = ConcreteServiceConfig::getCmsFolderServiceConfig($this);
		return $folder->getFullCmsFolder();
	}

	public function getAllCmsItemsOfFolder($id){
		$items = ConcreteServiceConfig::getCmsItemServiceConfig($this);
		return $items->getAllCmsItemsOfFolder($id);
	}

	public function getFullCmsItemOfFolder($id){
		$items = ConcreteServiceConfig::getCmsItemServiceConfig($this);
		return $items->getFullCmsItemOfFolder($id);
	}

	public function getAllCmsItemTypes(){
		$itemTypes = ConcreteServiceConfig::getCmsItemTypeServiceConfig($this);
		return $itemTypes->fetchAll();
	}

	public function countCmsItemsOfFolder($id){
		$items = ConcreteServiceConfig::getCmsItemServiceConfig($this);
		$result = $items->getAllCmsItemsOfFolder($id);
		$count = 0;
		foreach($result as $value){
			$count++;
		}
		return $count;
	}

	public function getItemTypeById($id){
		$itemType = ConcreteServiceConfig::getCmsItemTypeServiceConfig($this);
		return $itemType->getById($id);
	}


	public function createCmsItem($request) {
		if($request->isXmlHttpRequest())
      	{
			$item1 = explode(",", $_POST['array']);

			$array1 = [];
			foreach($item1 as $item){
				$item2 = explode("&", $item);
				array_push($array1, $item2);
			}

			$array2 = [];
			$array3 = [];
			foreach($array1 as $sub_array){
				foreach($sub_array as $small_array){
					$item = explode("=", $small_array, 2);
					$array2[$item[0]] = $item[1];
				}
				array_push($array3, $array2);
				$cmsItem = new CmsItem();
				$cmsItem->exchangeArray($array2);
				$this->saveCmsItem($cmsItem);
			}
			$this->flashMessenger()->addMessage('CMS items are created successfully!');	
		}
	}

	public function saveCmsItem($entity)
	{
		$cmsItem = ConcreteServiceConfig::getCmsItemServiceConfig($this);
		return $cmsItem->save($entity);
	}

	public function editCmsItem($request, $id) {
		if($request->isXmlHttpRequest())
      	{
      		$itemList = $this->getFullCmsItemOfFolder($id);
			$item1 = explode(",", $_POST['array']);

			$array1 = [];
			foreach($item1 as $item){
				$item2 = explode("&", $item);
				array_push($array1, $item2);
			}

			$array2 = [];
			$array3 = [];
		/*	foreach($itemList as $item) {
				$array2['id_cms_item'] = $item['id_cms_item'];
			}*/

			foreach($array1 as $sub_array){
				foreach($sub_array as $small_array){
					$item = explode("=", $small_array, 2);
					$array2[$item[0]] = $item[1];
				}
				array_push($array3, $array2);
				$cmsItem = new CmsItem();
				$cmsItem->exchangeArray($array2);
				$this->saveCmsItem($cmsItem);
			}
			$this->flashMessenger()->addMessage('CMS items are created successfully!');
		}
	}
}
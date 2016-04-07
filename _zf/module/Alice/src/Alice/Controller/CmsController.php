<?php
namespace Alice\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Bob\Helper\ServiceConfigHelper;
use Bob\Helper\ConcreteServiceConfig;
use Zend\Http\Request;
use Zend\Uri\Http;
use Bob\Model\DataObject\CmsFolder;
use Bob\Model\DataMapper\CmsFolderMapper;

class CmsController extends AbstractActionController
{	
	public function indexAction()
	{
		$view = new ViewModel();
		$request = $this->getRequest();
		$url = $request->getUri();

		$params = substr($url, strripos($url,'/')+1);

		$key = substr($params, 0, stripos($params,'.html'));
		$folderId = $this->getByKey($key)['id_cms_folder'];

		$view->items = $this->getAllCmsItemsOfFolder($folderId);
		return $view;
	}

	public function staticBlockAction(){
		$this->layout("layout/block");
		$view = new ViewModel();
		$request = $this->getRequest();
		$url = $request->getUri();
		$params = substr($url, strripos($url,'/')+1);

		$folderId = $this->getByKey($params)['id_cms_folder'];
		$view->items = $this->getAllCmsItemsOfFolder($folderId);

		return $view;
	}

	public function getHelper(){
		return null;
	}



	public function getFolderKeyById($id=12)
	{
	//	$folder = ConcreteServiceConfig::getCmsFolderServiceConfig($this);
		$_id = (int) $id;
		return "bang-gia-hoa-don";
	}

	public function getFullCmsItemOfFolder($id){
		$items = ConcreteServiceConfig::getCmsItemServiceConfig($this);
		return $items->getFullCmsItemOfFolder($id);
	}

	public function getByKey($key){
		$folderKey = ConcreteServiceConfig::getCmsFolderServiceConfig($this);
		return $folderKey->getByKey($key);
	}

	public function getAllCmsItemsOfFolder($id){
		$items = ConcreteServiceConfig::getCmsItemServiceConfig($this);
		return $items->getAllCmsItemsOfFolder($id);
	}
}
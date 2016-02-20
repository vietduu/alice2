<?php
namespace Bob\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Bob\Helper\ServiceConfigHelper;
use Bob\Helper\ConcreteServiceConfig;

use Bob\Model\DataObject\CmsFolder;
use Bob\Content\Form\CmsForm;
use Bob\Model\DataObject\Album;
use Bob\Content\Form\AlbumForm;
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
}
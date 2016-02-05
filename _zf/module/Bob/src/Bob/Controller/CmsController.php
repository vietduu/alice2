<?php
namespace Bob\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Bob\Helper\ServiceConfigHelper;
use Bob\Helper\ConcreteServiceConfig;

use Bob\Model\DataObject\CmsFolder;
use Bob\Content\Form\CmsForm;

class CmsController extends AbstractActionController
{
	public function indexAction()
	{
		return array();
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

				return $this->redirect()->toRoute('cms');
			}
		}

		$view->form = $form;
		$view->cmsFolderType = $this->getAllCmsFolderTypes();

		return $view;

	//	return array('form' => $form);
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
}
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
		$form = new CmsForm();
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
		return array('form' => $form);
	}

	public function saveCmsFolder($entity)
	{
		$cmsFolder = ConcreteServiceConfig::getCmsFolderServiceConfig($this);
		return $cmsFolder->save($entity);
	}
}
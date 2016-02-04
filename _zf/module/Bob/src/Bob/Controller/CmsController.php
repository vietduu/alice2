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
			$cms = new CmsFolder();
			$form->setInputFilter($cms->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()){
				$cms->exchangeArray($form->getData());

			}
		}
		return array('form' => $form);
	}
}
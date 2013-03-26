<?php
class ImageUploader_Form_Handler_Admin_AddField extends Zikula_Form_AbstractHandler
{
	/**
	 * Setup form.
	 *
	 * @param Zikula_Form_View $view Current Zikula_Form_View instance.
	 * @return boolean
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	function initialize(Zikula_Form_View $view)
	{
		$this->view->caching = false;
		
		$id = FormUtil::getPassedValue('id', false, 'GET');
		if($id)
		{
			$this->view->assign('value', $this->entityManager->find('ImageUploader_Entity_Fields', $id));
		}
	}
	
	
	/**
	 * Handle form.
	 *
	 * @param Zikula_Form_View $view Current Zikula_Form_View instance.
	 * @param $args
	 * @return boolean
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	function handleCommand(Zikula_Form_View $view, &$args)
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADD)) {
			return LogUtil::registerPermissionError();
		}

		if ($args['commandName'] == 'cancel') {
			System::redirect(ModUtil::url('ImageUploader', 'admin', 'viewFields'));
			return true;
		}

		$id = FormUtil::getPassedValue('id', false, 'GET');

		// check for valid form
		if (!$view->isValid()) {
			return false;
		}
		$data = $view->getValues();
		
		
		//checking for existant entry
		$search = array('fid' => $data['fid'],
			'module' => $data['moduleName'],
			'type' => $data['typeName'],
			'func' => $data['funcName']);
		$field = $this->entityManager->getRepository('ImageUploader_Entity_Fields')->findOneBy($search);
		
		if($field['id'] != '' && !$id)
			return LogUtil::registerError($this->__('Field already included!'));
		
		if($id)
		{
			$field = $this->entityManager->find('ImageUploader_Entity_Fields', $id);
		
			if($field['id'] == '' && $id != '')
				return LogUtil::registerError($this->__('No valid id passed!'));
		}
		
		//inserting image in DB
		if($id)
			$field = $this->entityManager->find('ImageUploader_Entity_Fields', $id);
		else
			$field = new ImageUploader_Entity_Fields();
		$field->setFid($data['fid']);
		$field->setModule(strtolower($data['moduleName']));
		$field->setType(strtolower($data['typeName']));
		$field->setFunc(strtolower($data['funcName']));
		$field->setEditor(1);
		$this->entityManager->persist($field);
		$this->entityManager->flush();
		
		
		LogUtil::registerStatus($this->__('Field successfully added!'));
		
		System::redirect(ModUtil::url('ImageUploader', 'admin', 'viewFields'));
		
		return true;
	}
}

<?php
/**
 * ImageUploader
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    ImageUploader/Controller/Admin
 */
class ImageUploader_Controller_Admin extends Zikula_AbstractController
{
	public function main()
	{
		System::redirect(ModUtil::url('ImageUploader', 'admin', 'view'));
		System::shutdown();
		return true;
	}
	
	public function view()
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADMIN)) {
			return LogUtil::registerPermissionError();
		}
		
		$this->view->assign('images', ModUtil::apiFunc('ImageUploader', 'File', 'getImages', array('search' => array())));
		return $this->view->fetch('Admin/View.tpl');
	}
	
	public function upload()
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADMIN)) {
			return LogUtil::registerPermissionError();
		}
		
		$this->view->assign('form', ModUtil::apiFunc('ImageUploader', 'File', 'uploadImage'));
		
		return $this->view->fetch('Admin/Upload.tpl');
	}
	
	public function remove()
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADMIN)) {
			return LogUtil::registerPermissionError();
		}
		
		$id = FormUtil::getPassedValue('id', false, 'GET');
		
		if(!$id)
			return LogUtil::registerError($this->__('You must pass an id!'));
		
		ModUtil::apiFunc($this->name, 'File', 'removeComplete', array('id' => $id));
		
		return System::redirect(ModUtil::url('ImageUploader', 'admin', 'view'));
	}
	
	
	public function viewFields()
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADMIN)) {
			return LogUtil::registerPermissionError();
		}
		
		$fields = $this->entityManager->getRepository('ImageUploader_Entity_Fields')->findAll();
		$this->view->assign('fields', $fields);
		
		return $this->view->fetch('Admin/ViewFields.tpl');
	}
	
	public function addField()
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADMIN)) {
			return LogUtil::registerPermissionError();
		}
		
		//Initialise form
		$form = FormUtil::newForm('ImageUploader', $this);
		return $form->execute('Admin/AddField.tpl', new ImageUploader_Form_Handler_Admin_AddField());
	}
	
}
?>

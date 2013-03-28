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
	/**
	* main function (dummy)
	*
	* @version 1.0
	* @return redirection to admin/view
	*/
	public function main()
	{
		//redirect to Admin->view 
		System::redirect(ModUtil::url('ImageUploader', 'admin', 'view'));
		//shutdown system to prevent any unnecessary html output
		System::shutdown();
		return true;
	}
	
		/**
		* shows all uploaded images from every user
		*
		* @version 1.0
		* @return string: template admin/View.tpl
		*/
	public function view()
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADMIN)) {
			return LogUtil::registerPermissionError();
		}
		
		$this->view->assign('images', ModUtil::apiFunc('ImageUploader', 'File', 'getImages', array('search' => array())));
		return $this->view->fetch('Admin/View.tpl');
	}
	
	/**
	* Admin upload function. This interface is like the users upload function.
	*
	* @version 1.0
	* @return string: template Admin/Upload.tpl
	*/
	public function upload()
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADMIN)) {
			return LogUtil::registerPermissionError();
		}
		
		$this->view->assign('form', ModUtil::apiFunc('ImageUploader', 'File', 'uploadImage'));
		
		return $this->view->fetch('Admin/Upload.tpl');
	}
	
		/**
		* Admin remove function.
		*
		* @version 0.2
		* @return redirection to admin->view
		* @todo Outsourcing removing section to API (user can delete own pictures)
		*/
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
	
	/**
	* View field function. Shows a list of fields activated for using with ImageUploader
	*
	* @version 1.0
	* @return string: template Admin/ViewFields.tpl
	*/
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
	
	/**
	* Add a new field or modify a field.
	*
	* @version 1.0
	* @return string: form: template Admin/AddField.tpl
	*/
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

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
		
		$image = $this->entityManager->find('ImageUploader_Entity_Images', $id);
		if($image['id'] == '')
			return LogUtil::registerError('You must pass a valid id!');
		
		//Removing pictures
		$imageTypeArray = explode('/', $image['fileextension']);
		$imagepath = ModUtil::getVar('ImageUploader', 'storePath') . $image['id'] . '.' . $imageTypeArray[1];
		unlink($imagepath);
		foreach(glob(ModUtil::getVar('ImageUploader', 'storePath') . 'generated/' . $image['id'] . '*.' . $imageTypeArray[1]) as $path)
		{
			unlink($path);
		}
		
		$this->entityManager->remove($image);
		$this->entityManager->flush();
		
		return System::redirect(ModUtil::url('ImageUploader', 'admin', 'view'));
	}
}
?>

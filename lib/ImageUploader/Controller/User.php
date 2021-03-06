<?php
/**
 * ImageUploader
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    ImageUploader/Controller/User
 */
class ImageUploader_Controller_User extends Zikula_AbstractController
{
	/**
	* @brief Provides an image scaled by height
	*
	* @return image
	*
	* This function provides an handler to send a image scaled by height
	*
	* @author Leonard Marschke
	* @version 1.0
	*/
	public function display()
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_READ)) {
			return LogUtil::registerPermissionError();
		}
		
		$height = FormUtil::getPassedValue('height', -1, 'GET');
		$width = FormUtil::getPassedValue('width', -1, 'GET');
		$id = FormUtil::getPassedValue('id', false, 'GET');
		
		if(!$id)
			return LogUtil::registerError('', '', 404);
		
		$search = array('id' => $id,
			'removed' => false);
		$imageDB = $this->entityManager->getRepository('ImageUploader_Entity_Images')->findOneBy($search);
		
		if($imageDB['id'] == '')
			return LogUtil::registerError('', '', 404);
		
		ob_end_clean();
		header('Content-type: ' . $imageDB['fileextension']); 
		
		$imageTypeArray = explode('/', $imageDB['fileextension']);
		$imagepath = ModUtil::getVar('ImageUploader', 'storePath') . $imageDB['id'] . '.' . $imageTypeArray[1];
		
		if($height < $imageDB['height'] && ($height > 0 || $width > 0))
		{
			$filepath = ModUtil::getVar('ImageUploader', 'storePath') . 'generated/' . $imageDB['id'] . '_H_' . $height . '_W_' . $width . '.' . $imageTypeArray[1];
		
			if(!file_exists($filepath))
			{
				$imagine = new Imagine\Gd\Imagine();
				$image = $imagine->open($imagepath);
				$size = $image->getSize();
				if($height > 0)
					$widthNew = floor($size->getWidth() * ($height / $size->getHeight()));
				else
					$widthNew = $width;
				if($widthNew >= $width && $width > 0)
					$height = floor($size->getHeight() * ($width / $size->getWidth()));
				$thumbnail = $image->thumbnail(new Imagine\Image\Box($widthNew, $height));
				$thumbnail->save($filepath);
			}
			echo readfile($filepath);
			
		} else {
			echo readfile($imagepath);
		}
		
		System::shutdown();
		return true;
	}


	/**
	* @brief Provides an page of all images
	*
	* @return string HTML
	*
	* This function provides an handler to see all images the user can use
	*
	* @author Leonard Marschke
	* @version 1.0
	*/
	public function view()
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADD)) {
			return LogUtil::registerPermissionError();
		}
		
		return $this->view->fetch('User/View.tpl');
	}

	/**
	* @brief Provides an page for adding images
	*
	* @return string HTML
	*
	* This function provides an handler to add a image
	*
	* @author Leonard Marschke
	* @version 1.0
	*/
	public function addImage()
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADD)) {
			return LogUtil::registerPermissionError();
		}
		
		$this->view->assign('form', ModUtil::apiFunc('ImageUploader', 'File', 'uploadImage'));
		
		return $this->view->fetch('User/AddImage.tpl');
	}

	/**
	* @brief Provides removing of images
	*
	* @return string HTML
	*
	* This function provides an handler to add a image
	*
	* @author Leonard Marschke
	* @version 1.0
	*/
	public function removeImage()
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADD)) {
			return LogUtil::registerPermissionError();
		}
		
		$id = FormUtil::getPassedValue('id', null, 'GET');
		if($id == null) {
			return LogUtil::registerError($this->__('Plaese pass a id!'));
		}
		
		$image = $this->entityManager->getRepository('ImageUploader_Entity_Images')->findOneBy(
			array(
				'uid' => UserUtil::getVar('uid'),
				'id' => $id
			)
		);
		
		if($image['id'] == '') {
			return LogUtil::registerError($this->__('Please pass a valid, for you accessable id.'));
		}
		
		ModUtil::apiFunc($this->name, 'File', 'removeComplete', array('id' => $image['id']));
		
		return System::redirect(ModUtil::url($this->name, 'user', 'view'));
	}

}

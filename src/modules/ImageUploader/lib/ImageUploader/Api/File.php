<?php
/**
 * ImageUploader
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    ImageUploader/Api/File
 */
 
 class ImageUploader_Api_File extends Zikula_AbstractApi
{
	/**
	* @brief Provides an image upload
	*
	* @return string HTML form
	*
	* This function provides an form handler wich allows you to upload a picture
	*
	* @author Leonard Marschke
	* @version 1.0
	*/
	public function uploadImage()
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADD)) {
			return LogUtil::registerPermissionError();
		}
		
		//Initialise form
		$form = FormUtil::newForm('ImageUploader', $this);
		return $form->execute('File/UploadImage.tpl', new ImageUploader_Form_Handler_File_UploadImage());
	}
	
	/**
	* @brief Provides an image array
	*
	* @return string HTML form
	*
	* This function provides an search for images by a sarching array
	*
	* @author Leonard Marschke
	* @version 1.0
	*/
	public function getImages($args)
	{
		if(!is_array($args['search']))
			return LogUtil::registerError($this->__('You have to pass a search array'));
		
		return $this->entityManager->getRepository('ImageUploader_Entity_Images')->findBy($args['search']);
	}
}


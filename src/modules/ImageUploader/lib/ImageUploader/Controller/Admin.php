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
		///@todo Viewing all uploaded images
	}
	
	public function upload()
	{
		///@todo Upload a image -> ForUtil
	}
	
	public function remove()
	{
		///@todo Remove a picture
	}
}
?>

<?php
/**
 * ImageUploader
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    ImageUploader/Api/Admin
 */
class ImageUploader_Api_Admin extends Zikula_AbstractApi
{
	/**
	* @brief Getting links for adminpanel
	*
	* @author Leonard Marschke
	* @version 1.0
	*/
	public function getlinks()
	{
		$links = array ();

		$links[] = array (
			'url'  => ModUtil::url('ImageUploader', 'admin', 'view'),
			'text' => $this->__('View all uploaded pictures'),
			'class'=> 'z-icon-es-view'
		);

		$links[] = array (
			'url'  => ModUtil::url('ImageUploader', 'admin', 'upload'),
			'text' => $this->__('Upload a picture'),
			'class'=> 'z-icon-es-new'
		);

		$links[] = array (
			'url'  => ModUtil::url('ImageUploader', 'admin', 'viewFields'),
			'text' => $this->__('View active Fields'),
			'class'=> 'z-icon-es-view'
		);

		$links[] = array (
			'url'  => ModUtil::url('ImageUploader', 'admin', 'addField'),
			'text' => $this->__('Add field'),
			'class'=> 'z-icon-es-new'
		);

		return $links;
	}
}


<?php
/**
 * ImageUploader
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    ImageUploader/Api/User
 */
class ImageUploader_Api_User extends Zikula_AbstractApi
{
	/**
	* @brief Getting links for userpanel
	*
	* @author Leonard Marschke
	* @version 1.0
	*/
	public function getlinks($args)
	{
		$links = array();

		$links[] = array (
			'url'  => ModUtil::url('ImageUploader', 'user', 'view'),
			'text' => $this->__('View pictures'),
			'class'=> 'z-icon-es-view'
		);

		$links[] = array (
			'url'  => ModUtil::url('ImageUploader', 'user', 'addImage'),
			'text' => $this->__('Upload an image'),
			'class'=> 'z-icon-es-new'
		);

		return $links;
	}
}

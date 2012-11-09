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
	 * Get admin panel links.
	 *
	 * @return array Array of admin links.
	 *
	 * @todo Icon für About finden
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

		return $links;
	}
}


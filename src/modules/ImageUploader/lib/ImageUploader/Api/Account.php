<?php
/**
 * ImageUploader
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    ImageUploader/Api/Account
 */

class ImageUploader_Api_Account extends Zikula_AbstractApi
{
	/**
	 * @brief get all user page items
	 * @return $items
	 *
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	public function getAll($args)
	{
		$items = array();

		if(SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADD))
		{
			$items[] = array(
				'url'   => ModUtil::url($this->name, 'user', 'view'),
				'module'=> $this->name,
				'title' => $this->__('View available pictures'),
				'icon'  => 'admin.png'
			);
			
			$items[] = array(
				'url'   => ModUtil::url($this->name, 'user', 'addImage'),
				'module'=> $this->name,
				'title' => $this->__('Add picture'),
				'icon'  => 'admin.png'
			);
		}

		return $items;
	}
}

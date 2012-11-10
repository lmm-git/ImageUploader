<?php
/**
 * ImageUploader
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    ImageUploader/Controller/Ajax
 */
class ImageUploader_Controller_Ajax extends Zikula_AbstractController
{
	/**
	* @brief Provides an list of all images the user can use
	*
	* @return string Zikula_Response_Ajax
	*
	* @author Leonard Marschke
	* @version 1.0
	*/
	public function viewPictures()
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADD)) {
			return LogUtil::registerPermissionError();
		}
		
		$images1 = ModUtil::apiFunc('ImageUploader', 'File', 'getImages', array('search' => array('uid' => UserUtil::getVar('uid'))));
		
		
		$em = $this->getService('doctrine.entitymanager');
		$qb = $em->createQueryBuilder();
		$qb->select('p')
		   ->from('ImageUploader_Entity_Images', 'p')
		   ->where('p.openly = true')
		   ->where('p.uid != ' . UserUtil::getVar('uid'));
		$images2 = $qb->getQuery()->getArrayResult();
		
		$this->view->assign('images', array_merge($images1, $images2));
		
		return new Zikula_Response_Ajax($this->view->fetch('Ajax/ViewPictures.tpl'));
	}
}

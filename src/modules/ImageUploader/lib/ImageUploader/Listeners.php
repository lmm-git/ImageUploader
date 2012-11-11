<?php
/**
 * ImageUploader
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    ImageUploader/Listeners
 */

class ImageUploader_Listeners
{
	/**
	* @brief Provides the corinit listener
	*
	* @return void
	*
	* Adding option of adding picture to page
	*
	* @author Leonard Marschke
	* @version 1.0
	*/
	public static function coreinit(Zikula_Event $event)
	{
		$name = 'ImageUploader';

		$modinfo1 = ModUtil::getInfoFromName($name);
		$modinfo2 = ImageUploader_Version::getMetaData();

		if ($modinfo1['version'] != $modinfo2['version']) {
			return;
		}

		$view = Zikula_View::getInstance('ImageUploader');

		$modname = ModUtil::getName();
		$func = FormUtil::getPassedValue('func', null, 'GET', FILTER_SANITIZE_STRING);
		$type = FormUtil::getPassedValue('type', null, 'GET', FILTER_SANITIZE_STRING);

		$search = array('module' => strtolower($modname),
			'type' => strtolower($type),
			'func' => strtolower($func));
		$em = ServiceUtil::getService('doctrine.entitymanager');
		$fields = $em->getRepository('ImageUploader_Entity_Fields')->findBy($search);

		$view->assign('fields', $fields);

		PageUtil::addVar('footer', $view->fetch('Listeners/Coreinit.tpl'));

		return true;
	}
}

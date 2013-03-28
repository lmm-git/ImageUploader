<?php
/**
 * ImageUploader
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    ImageUploader/Installer
 */
class ImageUploader_Installer extends Zikula_AbstractInstaller
{

	/**
	 * Provides an array containing default values for module variables (settings).
	 *
	 * @author Leonard Marschke
	 * @return array An array indexed by variable name containing the default values for those variables.
	 */
	protected function getDefaultModVars()
	{
		return array('storePath' => 'userdata/ImageUploader/',
			'imageWidth' => 250);
	}

	/**
	 * Initialise the ImageUploader module.
	 *
	 * @author Leonard Marschke
	 * @return boolean: true on success / false on failure.
	 */
	public function install()
	{
		$this->setVars($this->getDefaultModVars());
		
		//Install databases
		try {
			DoctrineHelper::createSchema($this->entityManager, array(
				'ImageUploader_Entity_Images'
			));
		} catch (Exception $e) {
			echo $e;
			return false;
		}
		try {
			DoctrineHelper::createSchema($this->entityManager, array(
				'ImageUploader_Entity_Fields'
			));
		} catch (Exception $e) {
			echo $e;
			return false;
		}
		
		EventUtil::registerPersistentModuleHandler(
			'ImageUploader',
			'core.postinit',
			array('ImageUploader_Listeners', 'coreinit')
		);

		// create hook
		HookUtil::registerProviderBundles($this->version->getHookProviderBundles());
		
		// Initialisation successful
		return true;
	}


	/**
	 * Upgrading the module
	 *
	 * @author Leonard Marschke
	 * @return boolean: true on success / false on error
	 * @param $oldversion
	 */
	public function upgrade($oldversion)
	{
		switch($oldversion) {
			case '0.9.1':
				// update the table
				try {
					DoctrineHelper::updateSchema($this->entityManager, array('ImageUploader_Entity_Images'));
				} catch (Exception $e) {
					LogUtil::registerError($e->getMessage());
					return false;
				}
			case '0.9.2': //future upgrades
		}
		return true;
	}

	/**
	 * Uninstall the module
	 *
	 * @author Leonard Marschke
	 * @return boolean: true on success / false on error
	 */
	public function uninstall()
	{
		//Remove all ModVars
		$this->delVars();
		
		//Remove all databases
		DoctrineHelper::dropSchema($this->entityManager, array(
			'ImageUploader_Entity_Images'
		));
		DoctrineHelper::dropSchema($this->entityManager, array(
			'ImageUploader_Entity_Fields'
		));
		
		HookUtil::unregisterProviderBundles($this->version->getHookProviderBundles());
		
		return true;
	}
}

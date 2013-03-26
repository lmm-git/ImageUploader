<?php
/**
 * ImageUploader
 *
 * @license    GPLv3
 * @package    ImageUploader/Installer
 */
class ImageUploader_Installer extends Zikula_AbstractInstaller
{

	/**
	 * Upload directory creation
	 */
	private function createUploadDirs()
	{
		// upload dir creation
		$dir = $this->getVar('upload_folder');
	
		if (mkdir($dir, System::getVar('system.chmod_dir', 0777), true)) {
			LogUtil::registerStatus($this->__f('Created the file storage directory successfully at [%s]. Be sure that this directory is accessible via web and writable by the webserver.', $dir));
		}
		
		$dir = $this->getVar('upload_folder') . '/generated';
		
		if (mkdir($dir, System::getVar('system.chmod_dir', 0777), true)) {
			LogUtil::registerStatus($this->__f('Created the file storage directory successfully at [%s]. Be sure that this directory is accessible via web and writable by the webserver.', $dir));
		}
		
		return true;
	}
	
	/**
	 * Provides an array containing default values for module variables (settings).
	 *
	 * @author Leonard Marschke
	 * @return array An array indexed by variable name containing the default values for those variables.
	 */
	protected function getDefaultModVars()
	{
		return array('imageWidth' => 250,
			'uploadFolder' => FileUtil::getDataDirectory() . '/ImageUploader');
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
		$this->createUploadDirs();
		
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

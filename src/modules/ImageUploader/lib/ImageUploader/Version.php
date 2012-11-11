<?php
/**
 * ImageUploader
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    ImageUploader/Version
 */

class ImageUploader_Version extends Zikula_AbstractVersion
{
	public function getMetaData()
	{
		$meta = array();
		$meta['displayname']    = __('ImageUploader');
		$meta['description']    = __('Easy tool to manage your Images on your website (primary for content)');
		//! module name that appears in URL
		$meta['url']            = __('img');
		$meta['version']        = '0.9.0';
		$meta['core_min']       = '1.3.3';
		$meta['core_max']       = '1.3.99';


		// Permissions schema
		$meta['securityschema'] = array();

		// Module depedencies
		$meta['dependencies'] = array();
		
		$meta['capabilities'] = array(HookUtil::PROVIDER_CAPABLE => array('enabled' => true));
		return $meta;
	}

	protected function setupHookBundles()
    {
        $bundle = new Zikula_HookManager_ProviderBundle(
            $this->name,
            'provider.imageuploader.filter_hooks.Filter',
            'filter_hooks', __('ImageUploader image prettyfier')
        );
        $bundle->addStaticHandler('filter', 'ImageUploader_HookHandler_Filter', 'view', 'imageuploader.filter');
        $this->registerHookProviderBundle($bundle);
    }
}

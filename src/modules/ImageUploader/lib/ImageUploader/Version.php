<?php
/**
 * ImageUploader
 *
 * @copyright  (c) Leonard Marschke
 * @license    GPLv3
 * @package    ImageUploader/Version
 */

/**
 * Locator Version Info.
 */
class ImageUploader_Version extends Zikula_AbstractVersion
{
	public function getMetaData()
	{
		$meta = array();
		$meta['displayname']    = $this->__('ImageUploader');
		$meta['description']    = $this->__('Easy tool to manage your Images on your website (primary for content)');
		//! module name that appears in URL
		$meta['url']            = $this->__('img');
		$meta['version']        = '0.0.1';
		$meta['core_min']       = '1.3.3';
		$meta['core_max']       = '1.3.99';


		// Permissions schema
		$meta['securityschema'] = array();

		// Module depedencies
		$meta['dependencies'] = array();
		return $meta;
	}
}

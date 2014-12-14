<?php
class ImageUploader_Form_Handler_File_UploadImage extends Zikula_Form_AbstractHandler
{
	/**
	 * Setup form.
	 *
	 * @param Zikula_Form_View $view Current Zikula_Form_View instance.
	 * @return boolean
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	function initialize(Zikula_Form_View $view)
	{
		$this->view->caching = false;
	}
	
	
	/**
	 * Handle form.
	 *
	 * @param Zikula_Form_View $view Current Zikula_Form_View instance.
	 * @param $args
	 * @return boolean
	 * @author Leonard Marschke
	 * @version 1.0
	 */
	function handleCommand(Zikula_Form_View $view, &$args)
	{
		//Security check
		if (!SecurityUtil::checkPermission('ImageUploader::', '::', ACCESS_ADD)) {
			return LogUtil::registerPermissionError();
		}

		if ($args['commandName'] == 'cancel') {
			if(FormUtil::getPassedValue('type') == 'admin')
				System::redirect(ModUtil::url('ImageUploader', 'admin', 'main'));
			else
				System::redirect(ModUtil::url('ImageUploader', 'user', 'view'));
			return true;
		}


		// check for valid form
		if (!$view->isValid()) {
			return false;
		}
		$data = $view->getValues();
		
		
		//checking for existant entry
		$search = array('title' => $data['title'],
			'uid' => UserUtil::getVar('uid'),
			'removed' => false);
		$image = $this->entityManager->getRepository('ImageUploader_Entity_Images')->findOneBy($search);
		
		if($image['id'] != '')
			return LogUtil::registerError($this->__('Please use another title because you have already a image with this title!'));
		
		
		//get MIME
		$finfo = finfo_open();
		if(!$finfo)
			return LogUtil::registerError($this->__('Opening fileinfo database failed. Please check your server configuration!'));
		$imageType = finfo_file($finfo, $data['image']['tmp_name'], FILEINFO_MIME_TYPE);
		$imageTypeArray = explode('/', $imageType);
		if($imageTypeArray[0] != 'image')
			return LogUtil::registerError($this->__('You have to upload an image file!'));
		finfo_close($finfo);
		
		//get height and width
		$imagine = new Imagine\Gd\Imagine();
		$uploadedImage = $imagine->open($data['image']['tmp_name']);
		$size = $uploadedImage->getSize();
		
		//inserting image in DB
		$image = new ImageUploader_Entity_Images();
		$image->setTitle($data['title']);
		$image->setUid(UserUtil::getVar('uid'));
		if($data['openly'] == 1)
			$image->setOpenly(true);
		else
			$image->setOpenly(false);
		$image->setFileextension($imageType);
		$exif = exif_read_data($data['image']['tmp_name']);
		if($exif['Orientation'] <= 4) {
			$image->setHeight($size->getHeight());
			$image->setWidth($size->getWidth());
		} else {
			$image->setHeight($size->getWidth());
			$image->setWidth($size->getHeight());
		}
		$image->setRemoved(false);
		$this->entityManager->persist($image);
		$this->entityManager->flush();
		
		//getting id
		$search = array('title' => $data['title'],
			'uid' => UserUtil::getVar('uid'));
		$image = $this->entityManager->getRepository('ImageUploader_Entity_Images')->findOneBy($search);
		
		$imagine = new Imagine\Gd\Imagine();
		$newimage = $imagine->open($data['image']['tmp_name']);
		
		switch ($exif['Orientation']) {
			case 2:
				$newimage->mirror();
				break;
			case 3:
				$newimage->rotate(180);
				break;
			case 4:
				$newimage->rotate(180)->mirror();
				break;
			case 5:
				$newimage->rotate(90)->mirror();
				break;
			case 6:
				$newimage->rotate(90);
				break;
			case 7:
				$newimage->rotate(-90)->mirror();
				break;
			case 8:
				$newimage->rotate(-90);
				break;
		}
		$newimage->save(ModUtil::getVar('ImageUploader', 'storePath') . $image['id'] . '.' . $imageTypeArray[1]);
		
		if(!copy($data['image']['tmp_name'], ModUtil::getVar('ImageUploader', 'storePath') . $image['id'] . '.' . $imageTypeArray[1]))
			return LogUtil::registerError($this->__('Problem while moving image... Please try again and check your data file! Also you should check if you have webspace left.'));
		unlink($data['image']['tmp_name']);
		LogUtil::registerStatus($this->__('Image successfully added!'));
		
		if(FormUtil::getPassedValue('type') == 'admin')
			System::redirect(ModUtil::url('ImageUploader', 'admin', 'main'));
		else
			System::redirect(ModUtil::url('ImageUploader', 'user', 'view'));
		
		return true;
	}
}

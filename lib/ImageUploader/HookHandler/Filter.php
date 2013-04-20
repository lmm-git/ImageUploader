<?php


class ImageUploader_HookHandler_Filter extends Zikula_Hook_AbstractHandler
{

	/**
	 * Filter hook for view.
	 * @param Zikula_FilterHook $hook
	 *
	 * @return void
	 */
	public static function view(Zikula_FilterHook $hook)
	{
		$text = $hook->getData();
		
		$textExploded = explode('$$', $text);
		for($i = 1; $i < (count($textExploded) - 1); $i += 2)
		{
			$tagstmp = explode('|', $textExploded[$i]);
			foreach($tagstmp as $key => $tag)
			{
				$tag = explode('=', $tag);
				$tags[$tag[0]] = $tag[1];
			}
			unset($tagstmp);
			if($tags['id'] != '' && $tags['title'] != '')
			{
				$em = ServiceUtil::getService('doctrine.entitymanager');
				$image = $em->find('ImageUploader_Entity_Images', str_replace(' ', '', $tags['id']));
				
				if($image['id'] != '')
				{
					$oldtags = $tags;
					if($oldtags['standardHeight'] == '' && $oldtags['standardWidth'] == '') {
						$tags['standardHeight'] = 250;
						$tags['standardWidth'] = round($image->getWidth() * ($tags['standardHeight'] / $image->getHeight()));
					} else {
						if($tags['standardHeight'] == '') {
							$tags['standardHeight'] = round($image->getHeight() * ($tags['standardWidth'] / $image->getWidth()));
						}
						if($tags['standardWidth'] == '') {
							$tags['standardWidth'] = round($image->getWidth() * ($tags['standardHeight'] / $image->getHeight()));
						}
						
						
					}
					$html = '<a href="' . ModUtil::url('ImageUploader', 'user', 'display', array('height' => $tags['fullHeight'], 'width' => $tags['fullWidth'], 'id' => $image['id'])) . '" rel="imageviewer" title="' . $tags['title'] . '" class="ImageUploaderPicture">';
					$html .= '<img src="' . ModUtil::url('ImageUploader', 'user', 'display', array('height' => $tags['standardHeight'], 'width' => $tags['standardWidth'], 'id' => $image['id'])) . '" title="' . $tags['title'] . '" height="' . $tags['standardHeight'] . '" width="' . $tags['standardWidth'] .'"/>';
					$html .= '</a>';
					$text = str_replace('$$' . $textExploded[$i] . '$$', $html, $text);
					PageUtil::addVar('javascript', 'imageviewer');
				}
			}
			unset($tags);
		}
		
		$hook->setData($text);
	}
}

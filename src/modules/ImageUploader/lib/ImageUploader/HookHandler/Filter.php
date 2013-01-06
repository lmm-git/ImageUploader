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
			unset($tagstp);
			if($tags['id'] != '' && $tags['title'] != '')
			{
				$em = ServiceUtil::getService('doctrine.entitymanager');
				$image = $em->find('ImageUploader_Entity_Images', str_replace(' ', '', $tags['id']));
				
				if($image['id'] != '')
				{
					$oldtags = $tags;
					if($tags['standardWidth'] == '' && $tags['standardHeight'] == '')
						$tags['standardWidth'] = 450;
					if($oldtags['standardHeight'] == '' && $oldtags['standardWidth'] == '')
						$tags['standardHeight'] = 250;
					elseif($tags['standardWidth'] != '')
						$tags['standardHeight'] = -1;
					if($tags['fullWith'] == '')
						$tags['fullWith'] = -1;
					if($tags['fullHeight'] == '')
						$tags['fullHeight'] = -1;
					$html = '<a href="' . ModUtil::url('ImageUploader', 'user', 'display', array('height' => $tags['fullHeight'], 'width' => $tags['fullWidth'], 'id' => $image['id'])) . '" rel="imageviewer" title="' . $tags['title'] . '">';
					$html .= '<img src="' . ModUtil::url('ImageUploader', 'user', 'display', array('height' => $tags['standardHeight'], 'width' => $tags['standardWidth'], 'id' => $image['id'])) . '" title="' . $tags['title'] . '"/>';
					$html .= '</a>';
					$text = str_replace('$$' . $textExploded[$i] . '$$', $html, $text);
					PageUtil::addVar('javascript', 'imageviewer');
				}
			}
		}
		
		$hook->setData($text);
	}
}

{php}
$this->assign('uid', UserUtil::getVar('uid'));
{/php}


{foreach from=$images item='image'}
<div style="float: left; margin: 15px; -webkit-border-radius: 15px; border-radius: 15px; -webkit-box-shadow:  5px 5px 7px 1px #777777; box-shadow:  5px 5px 7px 1px #777777; height: 200px; text-align: center;{if $mode == 1 && $image.uid == $uid} padding-bottom: 25px;{else} margin-bottom: 40px;{/if}">
	<img
	{if $mode == 2} 
		onclick="ImageUploader_InsertImage('$$id={$image.id}|title=', '{$image.title}$$');" style="cursor: pointer; max-width: 100%;"
	{else}
		style="max-width: 100%;" 
	{/if}
	src="{modurl modname='ImageUploader' type='user' func='display' height='200' width='500' id=$image.id}" alt="" title="{$image.title}" />
	{if $mode == 1 && $image.uid == $uid}
		<div style="clear:both; margin-top: 5px; font-size: 15px;"><a onclick="return confirm('{gt text='Are you sure to remove this picture?'}')" href="{modurl modname='ImageUploader' type='user' func='removeImage' id=$image.id}">{gt text="Remove"}</a></div>
	{/if}
</div>
{/foreach}
<div class="z-clearfix"></div>

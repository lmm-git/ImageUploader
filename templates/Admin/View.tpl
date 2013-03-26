{include file='Admin/Includes/Header.tpl' __title='View images' img='windowlist.png'}
{pageaddvar name='stylesheet' value='modules/ImageUploader/style/Admin/View.css'}

{foreach from=$images item="image"}
	<div class="ImageUploader_Showcase">
		<img src="{modurl modname='ImageUploader' type='user' func='display' height='80' width='180' id=$image.id}" alt="" title="{$image.title}" />
		<p>{$image.title}</p>
		<p class="ImageUploader_ShowcaseLink"><a onclick="return confirm('{gt text='Are you sure to remove this picture?'}');" href="{modurl modname='ImageUploader' type='admin' func='remove' id=$image.id}">{gt text='Delete picture'}</a></p>
	</div>
{foreachelse}
	<div class="ImageUploader_Showcase">
		<p>{gt text="You have no uploaded items!"}</p>
	</div>
{/foreach}

{include file='Admin/Includes/Footer.tpl'}

{assign var='addButton' value=false}
{foreach from=$fields item='field'}
	{assign var='addButton' value=true}
	<!--Adding ImageUploader support to field {$field.fid}-->
	<script type="text/javascript">
		jQuery('#{{$field.fid}}').focus(function () {
			jQuery('#ImageUploader_InsertImage').fadeIn(1000);
			textarea = document.getElementById('{{$field.fid}}');
		});
		jQuery('#{{$field.fid}}').blur(function () {
			jQuery('#ImageUploader_InsertImage').fadeOut(1000);
		});
	</script>
{/foreach}
{if $addButton == true}
	{pageaddvar name='javascript' value='jquery'}
	{pageaddvar name='javascript' value='Zikula.Ui'}
	{pageaddvar name='javascript' value='zikula'}
	{pageaddvar name="javascript" value="modules/ImageUploader/javascript/User/View.js"}
	<div id="ImageUploader_InsertImage" style="display: none; background-color: #FFFFFF; position: fixed; right: 0; top: 50%; margin-top: -45px; width: 90px; height: 90px; -webkit-border-top-left-radius: 10px; -webkit-border-bottom-left-radius: 10px; -moz-border-radius-topleft: 10px; -moz-border-radius-bottomleft: 10px; border-top-left-radius: 10px; border-bottom-left-radius: 10px; -webkit-box-shadow:  5px 5px 7px 5px #777777; box-shadow:  3px 3px 6px 5px #777777;">
		<a id="ImageUploader_User_View_Show" title="{gt text='Choose a picture'}" href="#ImageUploader_User_View" style="display: block; height: 100%;
		width: 100%; padding-top: 21px;" onclick="ImageUploader_LoadPictures();">{img modname='core' src='folder_images.png' set='icons/large'}</a>
	</div>
	<div id="ImageUploader_User_View" style="display: none;"></div>
	<script type="text/javascript">
		var defwindowmodal = new Zikula.UI.Window($('ImageUploader_User_View_Show'),{modal:true, width: 99999, height: 99999});
		mode = 2;
	</script>
{/if}

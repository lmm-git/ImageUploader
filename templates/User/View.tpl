{pageaddvar name="stylesheet" value="modules/EventManager/style/EventManager_wizard_step4.css"}
{pageaddvar name="javascript" value="modules/ImageUploader/javascript/User/View.js"}
{pageaddvar name="javascript" value="zikula"}
{pageaddvar name="javascript" value="jquery"}
{include file='User/Header.tpl'}
<h3>{gt text='Your pictures'}</h3>
<div id="ImageUploader_User_View"></div>
<script type="text/javascript">
jQuery(document).ready(function () {
	ImageUploader_LoadPictures();
});
</script>
{include file='User/Footer.tpl'}

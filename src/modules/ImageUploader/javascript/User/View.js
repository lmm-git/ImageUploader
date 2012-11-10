function ImageUploader_LoadPictures()
{
	new Zikula.Ajax.Request(
		"ajax.php?module=ImageUploader&func=viewPictures",
		{
			parameters: '',
			onComplete:	function (ajax)
				{
					var returns = ajax.getData();
					document.getElementById('ImageUploader_User_View').innerHTML = returns;
				}
		});
	
	setTimeout('ImageUploader_LoadPictures();', 5000);
}

jQuery(document).ready(function () {
	ImageUploader_LoadPictures();
});

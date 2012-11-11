var mode = 1;
var textarea;

function ImageUploader_LoadPictures()
{
	new Zikula.Ajax.Request(
		Zikula.Config.baseURL + "ajax.php?module=ImageUploader&func=viewPictures&mode=" + mode,
		{
			parameters: '',
			onComplete:	function (ajax)
				{
					var returns = ajax.getData();
					document.getElementById('ImageUploader_User_View').innerHTML = returns;
				}
		});
	
	/*setTimeout('ImageUploader_LoadPictures();', 5000);*/
}



function ImageUploader_InsertImage(sTag, eTag) {
	textarea.focus();
	/* IE */
	if(typeof document.selection != 'undefined') {
		/* Insert of the text */
		var range = document.selection.createRange();
		var insText = range.text;
		range.text = sTag + insText + eTag;
		/* Moving cursor */
		range = document.selection.createRange();
		if (insText.length == 0) {
			range.move('character', -eTag.length);
		} else {
			range.moveStart('character', sTag.length + insText.length + eTag.length);
		}
		range.select();
	}
	/* newer browsers */
	else
	{
		/* insert of the text */
		var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		var insText = textarea.value.substring(start, end);
		textarea.value = textarea.value.substr(0, start) + sTag + insText + eTag + textarea.value.substr(end);
		/* Moving cursor */
		var pos;
		if (insText.length == 0) {
			pos = start + sTag.length;
		} else {
			pos = start + sTag.length + insText.length + eTag.length;
		}
		textarea.selectionStart = pos;
		textarea.selectionEnd = pos;
	}
	//Close Modal
	defwindowmodal.closeHandler()
}

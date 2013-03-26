{form cssClass="z-form" enctype="multipart/form-data"}
{formerrormessage id='error'}
{formvalidationsummary}


<fieldset>
	<legend>{gt text='Upload a image'}</legend>

	<div class="z-formrow">
		{formlabel for="title" __text='Title of picture' mandatorysym=true}
		{formtextinput id="title" maxLength="255" mandatory=true}
	</div>

	<div class="z-formrow">
		{formlabel for="image" __text='Choose your picture' mandatorysym=true}
		{formuploadinput id="image" mandatory=true}
	</div>

	<div class="z-formrow">
		{formlabel for="openly" __text='Should this picture usable for all users?'}
		{formcheckbox id="openly"}
	</div>

</fieldset>

<div class="z-formbuttons z-buttons">
	{formbutton class="z-bt-ok z-btgreen" commandName="upload" __text="Upload"}
	{formbutton class="z-bt-cancel z-btred" commandName="cancel" __text="Cancel"}
</div>

{/form}


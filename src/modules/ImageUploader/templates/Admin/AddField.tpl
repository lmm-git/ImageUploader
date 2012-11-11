{include file='Admin/Includes/Header.tpl' __title='Add field' img='windowlist.png'}

{form cssClass="z-form" enctype="multipart/form-data"}
{formerrormessage id='error'}
{formvalidationsummary}


<fieldset>
	<legend>{gt text='New field'}</legend>

	<div class="z-formrow">
		{formlabel for="fid" __text='Id of the textarea (case sensitive)' mandatorysym=true}
		{formtextinput id="fid" maxLength="255" mandatory=true text=$value.fid}
	</div>

	<div class="z-formrow">
		{formlabel for="moduleName" __text='Name of the module' mandatorysym=true}
		{formtextinput id="moduleName" maxLength="255" mandatory=true text=$value.module}
	</div>

	<div class="z-formrow">
		{formlabel for="typeName" __text='Type of the module' mandatorysym=true}
		{formtextinput id="typeName" maxLength="255" mandatory=true text=$value.type}
	</div>

	<div class="z-formrow">
		{formlabel for="funcName" __text='Func of the module' mandatorysym=true}
		{formtextinput id="funcName" maxLength="255" mandatory=true text=$value.func}
	</div>

</fieldset>

<div class="z-formbuttons z-buttons">
	{formbutton class="z-bt-ok z-btgreen" commandName="send" __text="Add"}
	{formbutton class="z-bt-cancel z-btred" commandName="cancel" __text="Cancel"}
</div>

{/form}


{include file='Admin/Includes/Footer.tpl'}

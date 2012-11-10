{foreach from=$images item='image'}
<div style="float: left; margin: 15px; -webkit-border-radius: 15px; border-radius: 15px; -webkit-box-shadow:  5px 5px 7px 1px #777777; box-shadow:  5px 5px 7px 1px #777777; height: 200px; text-align: center;">
	<img src="{modurl modname='ImageUploader' type='user' func='displayImageByHeight' height='200' id=$image.id}" alt="" title="{$image.title}" />
</div>
{/foreach}
<div class="z-clearfix"></div>

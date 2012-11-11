{include file='Admin/Includes/Header.tpl' __title='View active fields' img='windowlist.png'}

<table class="z-datatable">
	<thead>
		<tr>
			<th>{gt text='Id'}</th>
			<th>{gt text='Module'}</th>
			<th>{gt text='Type'}</th>
			<th>{gt text='Func'}</th>
			<th>{gt text='Area'}</th>
			<th>{gt text='Operations'}</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$fields item="field"}
			<tr class="{cycle values='z-odd,z-even'}">
				<td>{$field.id}</td>
				<td>{$field.module}</td>
				<td>{$field.type}</td>
				<td>{$field.func}</td>
				<td>{$field.fid}</td>
				<td><a href="{modurl modname='ImageUploader' type='admin' func='addField' id=$field.id}">{gt text='Edit'}</a> | {gt text='Remove'}</td>
			</tr>
		{foreachelse}
			<tr>
				<td>{gt text='No linked areas!'}</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		{/foreach}
	</tbody>
</table>
{include file='Admin/Includes/Footer.tpl'}

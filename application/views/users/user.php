<div class="lista">
	<table>
		<tr>
			<th>id</th>
			<th>Username</th>
			<th>Email_address</th>
			<th>Role</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?foreach ($records as $row): ?>
		<tr>
			<td><b><?=$row->id;?></b></td>
			<td><b><?=$row->username;?></b></td>
			<td><b><?=$row->email_address;?></b></td>
			<td><b><?=$row->role;?></b> </td>
			<td><b><a href="edit/<?=$row->username;?>">Edit</a></b></td>
			<td><b><a href="delete/<?=$row->username;?>">Delete</a></b></td>
		</tr>
		<?endforeach;?>
	</table>
	<?=anchor('users/logout', 'Logout');?>
</div>
<div class="lista">
    <form action="<?= base_url("users/update"); ?>" method="post">
    <input type="hidden" name="id" value="<?= $id; ?>" />
		<table class="edit">
			<tr>
				<th colspan="2" class="red">Edit Records</th>
			</tr>
			<tr>
				<th>Username</th>
				<td>
					<label>
						<input type="text" name="username" value="<?= $username; ?>" />
					</label>
				</td>
			</tr>

			<tr>
				<th>Email</th>
				<td>
					<label>
						<input type="text" name="email_address" value="<?= $email_address; ?>" />
					</label>
				</td>
			</tr>

			<tr>
				<th>Role</th>
				<td>
					<label>
						<input type="text" name="role" value="<?= $role; ?>" />
					</label>
				</td>
			</tr>

			<tr>
				<th class="btn" colspan="2">
					<label>
						<input type="submit" name="submit" value="Edit Records">
					</label>
				</th>
			</tr>
		</table>
	</form>
	<div class="msg_error">
		<?= validation_errors('<p class="error">'); ?>
	</div>
</div>
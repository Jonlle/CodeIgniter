<div class = "lista">
    <form action="<?= base_url("users/update"); ?>" method="post">
    <input type="hidden" name="id" value="<?= $id; ?>" />
		<table border="1">
			<tr>
				<td colspan="2">
					<b>
						<font color='Red'>Edit Records </font>
					</b>
				</td>
			</tr>
			<tr>
				<td width="179">
					<b>Username</b>
				</td>
				<td>
					<label>
						<input type="text" name="username" value="<?= $username; ?>" />
					</label>
				</td>
			</tr>

			<tr>
				<td width="179">
					<b>Email Address</b>
				</td>
				<td>
					<label>
						<input type="text" name="email_address" value="<?= $email_address; ?>" />
					</label>
				</td>
			</tr>

			<tr>
				<td width="179">
					<b>Role</b>
				</td>
				<td>
					<label>
						<input type="text" name="role" value="<?= $role; ?>" />
					</label>
				</td>
			</tr>

			<tr align="Right">
				<td colspan="2">
					<label>
						<input type="submit" name="submit" value="Edit Records">
					</label>
				</td>
			</tr>
		</table>
	</form>
	<div class="msg_error">
		<?= validation_errors('<p class="error">'); ?>
	</div>
</div>
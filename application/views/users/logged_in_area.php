<div class="message">
	<h2>Bienvenido Admin,
		<?= $this->session->userdata('username'); ?>!</h2>
	<p>Esta sección representa el área a la que solo los administradores pueden acceder.</p>
	<h4>
		<?= anchor('users/logout', 'Logout'); ?>
	</h4>
	<h4>
		<?= anchor('users/user', 'View User List'); ?>
	</h4>
</div>
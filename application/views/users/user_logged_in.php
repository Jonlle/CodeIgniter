<div class="message">
	<h2>Bienvenido Usuario, 
		<?= $this->session->userdata('username'); ?>!</h2>
	<p>Esta sección representa el área a la que solo los usuarios pueden acceder.</p>
	<h4><?= anchor('users/logout', 'Logout'); ?></h4>
</div>
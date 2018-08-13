<div id="login_form">

	<h1>Login</h1>
    <?
	echo form_open('users/login');
	$username = array(
		'name'          => 'username',
		'id'            => 'username',
		'placeholder'   => 'Username',
	);
	echo form_input($username);
	$password = array(
		'name'          => 'password',
		'id'            => 'password',
		'placeholder'   => 'Password',
	);
	echo form_password($password);
	echo form_submit('submit', 'Login');
	echo anchor('users/signup', 'Create Account');
	echo form_close();
	?>

</div>
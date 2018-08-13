<div id="signup_form">
    <h1>Create an Account!</h1>

    <?
    //log_message('info', 'no set first_name');
    if (!isset($first_name)) {
        $first_name = '';
    }
    if (!isset($last_name)) {
        $last_name = '';
    }
    if (!isset($email_address)) {
        $email_address = '';
    }
    if (!isset($role)) {
        $role = '';
    }
    if (!isset($username)) {
        $username = '';
    }

    echo form_open('users/create_member');

    $first_name = array(
        'name'          => 'first_name',
        'id'            => 'first_name',
        'placeholder'   => 'First Name',
        'value'         => $first_name,
    );
    echo form_input($first_name);
    $last_name = array(
        'name'          => 'last_name',
        'id'            => 'last_name',
        'placeholder'   => 'Last Name',
        'value'         => $last_name,
    );
    echo form_input($last_name);
    $email_address = array(
        'name'          => 'email_address',
        'id'            => 'email_address',
        'placeholder'   => 'Email Address',
        'value'         => $email_address,
    );
    echo form_input($email_address);
    $role = array(
        'name'          => 'role',
        'id'            => 'role',
        'placeholder'   => 'Role',
        'value'         => $role,
    );
    echo form_input($role);
    $username = array(
        'name'          => 'username',
        'id'            => 'username',
        'placeholder'   => 'Username',
        'value'         => $username,
    );
    echo form_input($username);
    $password = array(
        'name'          => 'password',
        'id'            => 'password',
        'placeholder'   => 'Password',
    );
    echo form_password($password);
    $password2 = array(
        'name'          => 'password2',
        'id'            => 'password2',
        'placeholder'   => 'Password Confirmation',
    );
    echo form_password($password2);
    $submit = array(
        'name'          => 'submit',
        'id'            => 'submit',
        'value'         => 'Create Acccount',
    );
    echo form_submit($submit);
    ?>
    <div class="msg_error">
        <?= validation_errors('<p class="error">'); ?>
    </div>
</div>
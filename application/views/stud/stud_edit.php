<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Students Example</title>
</head>

<body>

    <?php
        echo form_open('stud/update');
        echo form_hidden('old_ci', $old_ci);
        echo form_label('CI: ', 'ci');
        $roll = array(
            'name'  => 'ci',
            'value' => $records[0]->ci,
        );
        echo form_input($roll);
        echo "<br/>";

        echo form_label('Name: ', 'name');
        $name = array(
            'name'          => 'name',
            'id'            => 'name',
            'value'         => $records[0]->name,
        );
        echo form_input($name);
        echo "<br/>";

        $submit = array(
            'name'          => 'Edit',
            'id'            => 'submit',
        );
        echo form_submit($submit, 'Edit');
        echo form_close();
    ?>

    </form>
</body>

</html>
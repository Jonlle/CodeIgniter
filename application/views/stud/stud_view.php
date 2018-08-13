<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Students Example</title>
</head>

<body>
    <div>
        <a href="<?php echo base_url("stud/add_view "); ?>">Add</a>
        <table border="1">
            <?php
                $i = 1;
                echo "<tr>";
                echo "<td>ID#</td>";
                echo "<td>CI</td>";
                echo "<td>Name</td>";
                echo "<td>Edit</td>";
                echo "<td>Delete</td>";
                echo "<tr>";
                
                foreach ($records as $r) {
                    echo "<tr>";
                    echo "<td>".$i++."</td>";
                    echo "<td>".$r->ci."</td>";
                    echo "<td>".$r->name."</td>";
                    echo "<td><a href = '".base_url("stud/edit/").$r->ci."'>Edit</a></td>";
                    echo "<td><a href = '".base_url("stud/delete/").$r->ci."'>Delete</a></td>";
                    echo "<tr>";
                }
            ?>
        </table>
    </div>

</body>

</html>
<!DOCTYPE html> 
<html lang = "en">
 
   <head> 
      <meta charset = "utf-8"> 
      <title>Students Example</title> 
   </head> 
   <body> 
         <?php 
            echo form_open('stud/add');
            echo form_label('CI: ', 'ci');
            $roll = array(
                'name'          => 'ci',
                'id'            => 'ci',
            );
            echo form_input($roll); 
            echo "<br/>"; 
			
            echo form_label('Name: ', 'name');
            $name = array(
                'name'          => 'name',
                'id'            => 'name',
            ); 
            echo form_input($name); 
            echo "<br/>"; 
            
            $submit = array(
                'name'          => 'Add',
                'id'            => 'submit',
            ); 
            echo form_submit($submit,'Add'); 
            echo form_close(); 
         ?> 
   </body>
</html>
<?php 

//input fields 
$name = array('id'=>'name','name'=>'name','type'=>'text','size'=>'45');
$code = array('id'=>'unit_code','name'=>'unit_code','type'=>'text','size'=>'45');

echo form_open(uri_string()); 
?>
	<table>
        <tr>
            <td><span class="labels">Name</span></td>
            <td><?php echo form_input($name); ?></td>
        </tr>
        <tr>
            <td><span class="labels">Unit code</span></td>
            <td><?php echo form_input($code); ?></td>
        </tr>
        
    </table>
    <?php echo form_submit('submit', 'Submit', 'class="btn green"'); ?>
<?php echo form_close(); ?>

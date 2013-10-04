<?php 

//input fields 
$name = array('id'=>'name','name'=>'name','type'=>'text','size'=>'45', 'value' => $course_unit->name);
$code = array('id'=>'unit_code','name'=>'unit_code','type'=>'text','size'=>'45', 'value' => $course_unit->unit_code);
$cf = array('id'=>'cf','name'=>'cf','type'=>'text','size'=>'45', 'value' => $course_unit->cf);

echo form_open(uri_string()); 
?>
	<table>
        <tr>
            <td><span class="labels">Name</span></td>
            <td><?php echo form_input($name); ?></td>
        </tr>
        <tr>
            <td><span class="labels">Course Unit code</span></td>
            <td><?php echo form_input($code); ?></td>
        </tr>
         <tr>
            <td><span class="labels">CF</span></td>
            <td><?php echo form_input($cf); ?></td>
        </tr>
        <tr>
            <td><span class="labels">Parent Course</span></td>
            <td><?php echo form_dropdown('course', $courses, $course_unit->course,'data-placeholder="Select parent course..." style="width:350px;"'); ?></td>
        </tr>
        
    </table>
    <?php echo form_submit('submit', 'Submit', 'class="btn green"'); ?>
<?php echo form_close(); ?>

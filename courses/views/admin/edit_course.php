<?php 

//input fields 
$name = array('id'=>'name','name'=>'name','type'=>'text','size'=>'45', 'value' => $course->name);
$code = array('id'=>'course_code','name'=>'course_code','type'=>'text','size'=>'45', 'value' => $course->course_code);
$course_duration = array('id'=>'course_duration','name'=>'course_duration','type'=>'text','size'=>'45', 'value' => $course->course_duration);

echo form_open(uri_string()); 
?>
	<table>
        <tr>
            <td><span class="labels">Name</span></td>
            <td><?php echo form_input($name); ?></td>
        </tr>
        <tr>
            <td><span class="labels">Code</span></td>
            <td><?php echo form_input($code); ?></td>
        </tr>
        <tr>
            <td><span class="labels">Course Duration (in years)</span></td>
            <td><?php echo form_input($course_duration); ?></td>
        </tr>
        
    </table>
    <?php echo form_submit('submit', 'Submit', 'class="btn green"'); ?>
<?php echo form_close(); ?>

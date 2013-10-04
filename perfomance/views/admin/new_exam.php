<?php 

//input fields 
$name = array('id'=>'name','name'=>'name','type'=>'text','size'=>'45');

echo form_open(uri_string()); 
?>
	<table>
        <tr>
            <td><span class="labels">Name</span></td>
            <td><?php echo form_input($name); ?></td>
        </tr>
        <tr>
            <td><span class="labels">Year</span></td>
            <td>
            	<?php echo form_dropdown('year', $years, '','class="chzn-select" data-placeholder="Select year..." style="width:350px;"'); ?>
            </td>
        </tr>
         <tr>
            <td><span class="labels">Semester</span></td>
            <td>
                <?php echo form_dropdown('semester', $semesters, '','class="chzn-select" data-placeholder="Select semester..." style="width:350px;"'); ?>
            </td>
        </tr>
        
    </table>
    <?php echo form_submit('submit', 'Submit', 'class="btn green"'); ?>
<?php echo form_close(); ?>

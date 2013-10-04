<?php 
//input fields 
$name = array('id'=>'name','name'=>'name','type'=>'text','size'=>'45');

$form_attributes = array('id' => 'post_results_form');
echo form_open(uri_string(), $form_attributes); 

if($exams){
    $style = "";
}else{
    $style = "style='display:none;'";
}
?>
	<table>
        <tr>
            <td><span class="labels">Year</span></td>
            <td>
            	<?php echo form_dropdown('year', $years, $this->input->post('year'),'class="chzn-select" data-placeholder="Select year..." style="width:350px;"'); ?>
            </td>
        </tr>
        <tr>
            <td><span class="labels">Semester</span></td>
            <td>
                <?php echo form_dropdown('semester', $semesters, $this->input->post('semester'),'id="semester" data-placeholder="Select semester..." style="width:350px;"'); ?>
            </td>
        </tr>
        <tr>
            <td><span class="labels">Exam</span></td>
            <td>
                <?php echo form_dropdown('exam', $exams, $this->input->post('exam'),'id="exam" data-placeholder="Select exam..." style="width:350px;"'); ?>
            </td>
        </tr>
        <tr>
            <td><span class="labels">Course</span></td>
            <td>
                <?php echo form_dropdown('course', $courses, $this->input->post('course'),'id="course" class="chzn-select" data-placeholder="Select a course..." style="width:350px;"'); ?>
            </td>
        </tr>
        <tr>
            <td><span class="labels">Course Unit</span></td>
            <td>
                <?php echo form_dropdown('course_unit', $course_units, $this->input->post('course_unit'),'id="course_unit" class="chzn-select" data-placeholder="Select a course unit..." style="width:350px;"'); ?>
            </td>
        </tr>

        <!-- <tr <?php echo $style; ?> >
            <td><span class="labels">Exam</span></td>
            <td>
                <?php echo form_dropdown('exam', $exams, $this->input->post('exam'),'id="exam" data-placeholder="Select exam..." style="width:350px;"'); ?>
            </td>
        </tr> -->
    </table>
    <br />
<?php 
// echo form_close(); 

// $form_attributes = array('id' => 'post_students_results_form');
// echo form_open(uri_string(), $form_attributes); 
?>
    <table width="100%">
        <thead>
            <tr>
                <th width="">#</th>
                <th>Name</th>
                <th>Score</th>
                <th width="">Grade</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i =1;
                foreach ($students as $student) {
                    echo "<tr>
                            <td><input type='hidden' name='student_ids[]' value='".$student->id."' />".$i."</td>
                            <td>".$student->display_name."</a></td>
                            <td><input type='text' name='scores[]' value='' /></td>
                            <td><input type='text' name='grades[]' value='' /></td>
                          </tr>";
                $i++;
                }
            ?>
            
        </tbody>
    </table>
    <?php echo form_submit('submit_form', 'Submit', 'class="btn green"'); ?>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function() 
        { 

            jQuery("#semester").change(function() {
                var year = jQuery("#year").val();

                if(year == ''){
                    alert('Please select an year');
                }else{
                    jQuery('#post_results_form').submit();
                }
                
            });

            jQuery("#course").change(function() {
    
                jQuery('#post_results_form').submit();
                
            });

            jQuery("#course_unit").change(function() {
                
                jQuery('#post_results_form').submit();
               
            });

        } 
    ); 
</script>
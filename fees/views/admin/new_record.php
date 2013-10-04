<?php 

//input fields 
$payable_item_amount = array('name'=>'payable_item_amount[]','type'=>'text','size'=>'45');
$payable_item_balance = array('name'=>'payable_item_balance[]','type'=>'text','size'=>'45','value' =>0);
$date_paid = array('id'=>'date_paid','name'=>'date_paid','type'=>'text','size'=>'51');

$form_attributes = array('id' => 'post_fees_form');
echo form_open(uri_string(), $form_attributes); 
?>
	<table>
        <tr>
            <td><span class="labels">Year</span></td>
            <td>
                <?php echo form_dropdown('year', $years, $this->input->post('year'),'class="chzn-select" data-placeholder="Select year..." style="width:350px;"'); ?>
            </td>
        </tr>
        <!-- <tr>
            <td><span class="labels">Semester</span></td>
            <td>
                <?php echo form_dropdown('semester', $semesters, $this->input->post('semester'),'id="semester" data-placeholder="Select semester..." style="width:350px;"'); ?>
            </td>
        </tr> -->
        <tr>
            <td><span class="labels">Course</span></td>
            <td>
                <?php echo form_dropdown('course', $courses, $this->input->post('course'),'id="course" class="chzn-select" data-placeholder="Select a course..." style="width:350px;"'); ?>
            </td>
        </tr>
        <tr>
            <td><span class="labels">Student</span></td>
            <td>
                <?php echo form_dropdown('student', $course_students_profiles, $this->input->post('student'),'id="student" class="chzn-select" data-placeholder="Select a student..." style="width:350px;"'); ?>
            </td>
        </tr>
        <tr>
            <td><span class="labels">Date paid</span></td>
            <td>
                <?php echo form_input($date_paid); ?>
            </td>
        </tr>
        
    </table>
    <br /><br />
    <table width="100%">
        <thead>
            <tr>
                <th width="1%"></th>
                <th width="25%">Name</th>
                <th>Amount Paid</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i=1;
                foreach ($course_payable_items as $course_payable_item) {
                    echo "<tr>
                            <td><input type='hidden' name='course_payable_item_ids[]' value='".$course_payable_item['id']."' />".$i."</td>
                            <td>".$course_payable_item['name']."</td>
                            <td>".form_input($payable_item_amount)."</td>
                            <td>".form_input($payable_item_balance)."</td>
                          </tr>";
                $i++;
                }
            ?>
        </tbody>
    </table>

    <?php echo form_submit('submit_fees', 'Submit', 'class="btn green"'); ?>
<?php echo form_close(); ?>

<script type="text/javascript">
    $(document).ready(function() 
        {
            jQuery("#date_paid").datepicker({ dateFormat: 'yy-mm-dd',showOtherMonths: true,showWeek: true,weekHeader: 'Week', altFormat: "DD, d MM, yy" });

            jQuery("#course").change(function() {

                jQuery('#post_fees_form').submit();
                
            });

            // jQuery("#course_unit").change(function() {
                
            //     jQuery('#post_results_form').submit();
               
            // });

        } 
    ); 
</script>

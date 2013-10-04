<div>
    <div id='profile_pic'><img src="<?php echo $this->module_details['path']."/img/student.png"; ?>" /></div>
    <div id='profile_data'>
        <h2><?php echo $student->display_name; ?></h2>
        <hr>
        <div>
            <p><b>Admission No.:</b> <?php echo $student->student_admission_no; ?></p>
            <p><b>Course of study: </b> <?php echo $student->course_of_study; ?></p>
            <p><b>Date of admission: </b> <?php echo $student->date_of_admission; ?></p>
        </div>
    </div>
</div>
<table id="myTable" class="tablesorter" width="100%">
    <thead>
        <tr>
            <th width="4%">#</th>
            <th width="60%">Exam</th>
            <th width="16%" style='text-align:center'>Year</th>
            <th width="16%" style='text-align:center'>Semester</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $i =1;
            foreach ($exams_data as $exam_data) {

                echo "<tr>
                        <td>".$i."</td>
                        <td><a href='admin/exams/student_exam_record/".$student->user_id."/exam/$exam_data->id'>".$exam_data->name."</a></td>
                        <td style='text-align:right'>".$exam_data->year."</td>
                        <td style='text-align:right'>".$exam_data->semester."</td>
                      </tr>";
            $i++;
            }

            //echo "<tr><td></td><td></td><td></td><td></td></tr>";
        ?>
        
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() 
        { 
            $("#myTable").tablesorter();
        } 
    ); 
</script>

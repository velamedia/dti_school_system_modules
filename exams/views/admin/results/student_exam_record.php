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
        <hr>
        <div>
            <p><b>Exam:</b> <?php echo $exam_data->name; ?></p>
            <p><b>Year of study: </b> <?php echo $exam_data->year; ?></p>
            <p><b>Semester: </b> <?php echo $exam_data->semester; ?></p>
        </div>
    </div>
</div>
<table id="myTable" class="tablesorter" width="100%">
    <thead>
        <tr>
            <th width="4%">#</th>
            <th width="20%">COURSE UNIT CODE</th>
            <th width="28%">COURSE UNIT TITLE</th>
            <th width="5%">CF</th>
            <th width="10%">MARKS</th>
            <th width="10%">GRADE</th>
            <th width="10%">GP</th>
            <th width="10%">PS</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $i =1;
            foreach ($exam_results as $exam_result) {
                //
                $course_unit_id = array($exam_result['course_unit_id']);
                $course_unit = $this->results->get_course_units($course_unit_id);

                if ($exam_result['score'] >=70) {
                    $gp = 4;
                    $ps = $course_unit[0]['cf'] * $gp;
                } elseif($exam_result['score'] >=60 and $exam_result['score'] < 70) {
                    $gp = 3;
                    $ps = $course_unit[0]['cf'] * $gp;
                } elseif($exam_result['score'] >=50 and $exam_result['score'] < 60) {
                    $gp = 2;
                    $ps = $course_unit[0]['cf'] * $gp;
                } elseif($exam_result['score'] >=40 and $exam_result['score'] < 50) {
                    $gp = 1;
                    $ps = $course_unit[0]['cf'] * $gp;
                } else{
                    $gp = 0;
                    $ps = 0;
                }

                $total_cf += $course_unit[0]['cf'];
                $total_ps += $ps;

                //print_r($course_unit);
                echo "<tr>
                        <td>".$i."</td>
                        <td>".$course_unit[0]['unit_code']."</a></td>
                        <td>".$course_unit[0]['name']."</td>
                        <td>".$course_unit[0]['cf']."</td>
                        <td>".$exam_result['score']."</td>
                        <td>".$exam_result['grade']."</a></td>
                        <td>".$gp."</td>
                        <td>".$ps."</td>
                      </tr>";
            $i++;
            }

            $total_gpa = $total_ps/$total_cf;

            echo "<tr>
                        <td></td>
                        <td></td>
                        <td style='text-align:right'><b>Total CF</b></td>
                        <td><b>".$total_cf."</b></td>
                        <td></td>
                        <td></td>
                        <td style='text-align:right'><b>Total PS</b></td>
                        <td><b>".$total_ps."</b></td>
                      </tr>";
            //echo "<tr><td></td><td></td><td></td><td></td></tr>";
        ?>
    </tbody>
</table>
<table>
    <tr>
        <td width="25%"><b>TERM GRADE POINT AVERAGE (GPA)</b></td>
        <td style='text-align:left'><?php echo $total_gpa; ?></td>
    </tr>
</table>

<script type="text/javascript">
    $(document).ready(function() 
        { 
            $("#myTable").tablesorter();
        } 
    ); 
</script>

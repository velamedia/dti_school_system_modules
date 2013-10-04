<table id="myTable" class="tablesorter" width="100%">
    <thead>
        <tr>
            <th width="15%">ADM NO.</th>
            <th width="18%">NAME</th>
             <?php 
                foreach ($course_units as $course_unit) {
                    echo "<th>".$course_unit['unit_code']."</th>";
                }
            ?>

        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td style="text-align:right;">CF</td>
            <?php 
                foreach ($course_units as $course_unit) {
                    echo "<td>".$course_unit['cf']."</td>";
                }
            ?>
        </tr>
        <?php 
            $i =1;
            foreach ($exam_students as $student) {
                
                $student = $this->ion_auth->get_user($student['student_id']);
                echo "<tr>
                        <td style='vertical-align: middle;'><a href='admin/exams/student/".$student->id."'>".$student->student_admission_no."</a></td>
                        <td style='vertical-align: middle;'><a href='admin/exams/student/".$student->id."'>".$student->display_name."</a></td>";
                        foreach ($course_units as $course_unit) {
                            foreach ($exam_results as $exam_result) {
                                if($student->id == $exam_result['student_id'] and $course_unit['id'] == $exam_result['course_unit_id']){
                                    // echo   "<td style='vertical-align: middle;'>"
                                    //             .$exam_result['score']."<br />"
                                    //             .$exam_result['score']."<br />".
                                    //         "</td>";

                                    switch ($exam_result['grade']) {
                                        case 'A':
                                            $cf_value = $course_unit['cf'] * 4;
                                            break;
                                        case 'B':
                                            $cf_value = $course_unit['cf'] * 3;
                                            break;
                                        case 'C':
                                            $cf_value = $course_unit['cf'] * 2.2;
                                            break;
                                        case 'D':
                                            $cf_value = $course_unit['cf'] * 1.8;
                                            break;
                                        case 'E':
                                            $cf_value = 0;
                                            break;
                                    }
                                    
                                    echo "<td style='vertical-align: middle;'>
                                            <table style='border: 0px;background-color:transparent;'>
                                                <tr>
                                                    <td style='border: 0px;background-color:transparent;'>Score: ".$exam_result['score']." </td>
                                                </tr>
                                                <tr>
                                                    <td style='border: 0px;background-color:transparent;'>Grade: ".$exam_result['grade']."</td>
                                                </tr>
                                                <tr>
                                                    <td style='border: 0px;background-color:transparent;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$cf_value."</td>
                                                </tr>
                                            </table>
                                         </td>";
                                }else{
                                    //echo   "<td></td>";
                                }
                            }
                        }

                echo "</tr>";
            $i++;
            }

        ?>
    </tbody>
</table>
<br><br>
<?php 
$rows = array_chunk($all_course_units, 4);
    
print "<table align='center' cellspacing='20' cellpadding='10' width='100%'>\n";
    foreach ($rows as $row) {
        print "<tr class='caption'>\n";
        foreach ($row as $value) {
            echo '<td><b>'.$value['unit_code']."</b> = ".$value['name']."</td>\n";
        }
        print "</tr>\n";
    }
    print "</table>\n";
?>
<script type="text/javascript">
    $(document).ready(function() 
        { 
            $("#myTable").tablesorter();
        } 
    ); 
</script>
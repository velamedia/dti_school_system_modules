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
            <td align="right">CF</td>
            <?php 
                foreach ($course_units as $course_unit) {
                    echo "<td></td>";
                }
            ?>
        </tr>
        <?php 
            $i =1;
            foreach ($exam_students as $student) {
                
                $student = $this->ion_auth->get_user($student['student_id']);
                echo "<tr>
                        <td><a href='javascript:return void(0);'>".$student->student_admission_no."</td>
                        <td>".$student->display_name."</td>";
                        foreach ($course_units as $course_unit) {
                            foreach ($exam_results as $exam_result) {
                                if($student->id == $exam_result['student_id'] and $course_unit['id'] == $exam_result['course_unit_id']){
                                    echo   "<td>".$exam_result['score']."</td>";
                                }else{
                                    //echo   "<td></td>";
                                }
                            }
                        }


                        // foreach ($course_units as $course_unit) {
                        //     if($course_unit['id'] == $exam_result['course_unit_id']){
                                
                        //         echo   "<td>".$exam_result['score']."</td>";
                        //     }else{
                        //         echo   "<td></td>";
                        //     }
                        // }
                
                echo "</tr>";
            $i++;
            }



            // foreach ($exam_results as $exam_result) {
                
            //     $student = $this->ion_auth->get_user($exam_result['student_id']);
            //     echo "<tr>
            //             <td><a href='admin/exams/student_profile/course/".$exam_result['exam_id']."/".$exam_result['course_id']."'>".$student->student_admission_no."</a></td>
            //             <td>".$student->display_name."</td>";
            //             foreach ($course_units as $course_unit) {
            //                 if($course_unit['id'] == $exam_result['course_unit_id']){
                                
            //                     echo   "<td>".$exam_result['score']."</td>";
            //                 }else{
            //                     echo   "<td></td>";
            //                 }
            //             }
                
            //     echo "</tr>";
            // $i++;
            // }
        ?>
        
    </tbody>
</table>
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
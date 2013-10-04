<?php

?>

<table id="myTable" class="tablesorter" width="100%">
    <thead>
        <tr>
            <th width="">#</th>
            <th>Course</th>
            <th>Exam</th>
            <th>Year</th>
            <th>Semester</th> 
        </tr>
    </thead>
    <tbody>
        <?php 
            $i =1;
            foreach ($courses_done as $course_done) {
                $course_id = $course_done[0]->course;
                $course = $this->results->get_course($course_id);
                echo "<tr>
                        <td>".$i."</td>
                        <td><a href='admin/exams/course_units_results/".$exam->id."/".$course->course_code."'>".$course->name."</a></td>
                        <td>".$exam->name."</td>
                        <td>".$exam->year."</td>
                        <td>".$exam->semester."</td>
                      </tr>";
            $i++;
            }
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
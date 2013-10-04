<?php

?>

<table id="myTable" class="tablesorter" width="100%">
    <thead>
        <tr>
            <th width="4%">#</th>
            <th width="40%">Name</th>
            <th>Unit Code</th>
            <th>CF</th>
            <th>Parent Course</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $i =1;
            foreach ($course_units as $course_unit) {
                $course = $this->course_units->get_course($course_unit['course']);
                echo "<tr>
                        <td>".$i."</td>
                        <td><a href='admin/course_units/edit_course_unit/".$course_unit['id']."'>".$course_unit['name']."</a></td>
                        <td>".$course_unit['unit_code']."</td>
                        <td>".$course_unit['cf']."</td>
                        <td>".$course->name."</td>
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
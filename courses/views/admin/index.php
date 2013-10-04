<?php

?>

<table id="myTable" class="tablesorter" width="100%">
    <thead>
        <tr>
            <th width="4%">#</th>
            <th width="30%">Name</th>
            <th width="30%">Code</th>
            <th>Course Duration (in years)</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $i =1;
            foreach ($courses as $course) {
                echo "<tr>
                        <td>".$i."</td>
                        <td><a href='admin/courses/edit_course/".$course['id']."'>".$course['name']."</a></td>
                        <td>".$course['course_code']."</td>
                        <td>".$course['course_duration']."</td>
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
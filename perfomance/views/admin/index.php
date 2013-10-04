<?php

?>

<table id="myTable" class="tablesorter" width="100%">
    <thead>
        <tr>
            <th width="">#</th>
            <th>Name</th>
            <th>Year</th>
            <th>Semester</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $i =1;
            foreach ($exams as $exam) {
                echo "<tr>
                        <td>".$i."</td>
                        <td><a href='admin/exams/results/courses/".$exam['id']."'>".$exam['name']."</a></td>
                        <td>".$exam['year']."</td>
                        <td>".$exam['semester']."</td>
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


<!-- <div id="sortable">
	<div class="one_half" id="1">
	    <section class="draggable title">
	        <h4>Elric</h4>
	        <a class="tooltip-s toggle" title="Toggle this element"></a>
	    </section>
	    <section class="item">
	        <div class="content">
					<a href="admissions"><img src="addons/shared_addons/modules/dashboard/img/admissions.jpg"></a>
					<a href="exams"><img src="addons/shared_addons/modules/dashboard/img/exams.jpg"></a>
					<a href="performance"><img src="addons/shared_addons/modules/dashboard/img/performance.jpg"></a>
	        </div>
	    </section>
	</div>

	<div class="one_half" id="1">
	    <section class="draggable title">
	        <h4>Olalekan</h4>
	        <a class="tooltip-s toggle" title="Toggle this element"></a>
	    </section>
	    <section class="item">
	        <div class="content">
					<a href="timetable"><img src="addons/shared_addons/modules/dashboard/img/timetable.jpg"></a>
					<a href="fees"><img src="addons/shared_addons/modules/dashboard/img/fees.jpg"></a>
	        </div>
	    </section>
	</div>
</div> -->
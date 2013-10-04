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
    
</table>

<script type="text/javascript">
    $(document).ready(function() 
        { 
            $("#myTable").tablesorter();
        } 
    ); 
</script>
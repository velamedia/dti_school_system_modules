<div><h2>Select this semester's course units</h2></div>
<?php echo form_open(uri_string()); ?>
    <table id="myTable" class="tablesorter" width="100%">
        <thead>
            <tr>
                <th width="4%">#</th>
                <th>Unit Code</th>
                <th>Name</th>
                
            </tr>
        </thead>
        <tbody>
            <?php 
                $i =1;
                foreach ($course_units as $course_unit) {
                    echo "<tr>
                            <td><input type='checkbox' name='course_units[]' value='".$course_unit['id']."' /></td>
                            <td>".$course_unit['unit_code']."</td>
                            <td>".$course_unit['name']."</td>
                          </tr>";
                $i++;
                }
            ?>
            
        </tbody>
    </table>
    <br />
    <?php echo form_submit('submit', 'Submit', 'class="btn green" style="width: 100px;"'); ?>
<?php echo form_close(); ?>
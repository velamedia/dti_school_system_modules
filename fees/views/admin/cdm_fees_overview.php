<?php

$cdm_fees_paid = $this->fees->get_course_fees_paid(2); //DST = course_id 1

foreach ($cdm_fees_paid as $cdm_fee_paid) {
   
    $key = $cdm_fee_paid['student_id'];

    if (!isset($cdm_students[$key])) {
        $cdm_students[$key] = array($cdm_fee_paid);
    } 
    else {
        $cdm_students[$key][] = $cdm_fee_paid;
     }
}
?>

<table id="myTable" class="tablesorter" width="100%">
    <thead>
        <tr>
            <th width="4%">#</th>
            <th width="30%">Student Name</th>
            <th width="30%">Amount paid</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $i =1;
            $cdm_amount_paid = 0;
            $cdm_balance = 0;
            foreach ($cdm_students as $cdm_student) {
                
                foreach ($cdm_student as $cdm_student_array) {
                    $cdm_student_profile = $this->ion_auth->get_user($cdm_student_array['student_id']);
                    $cdm_amount_paid += $cdm_student_array['amount_paid'];
                    $cdm_balance += $cdm_student_array['balance'];
                }
                
                $cdm_total_amount_paid += $cdm_amount_paid;
                $cdm_total_balance += $cdm_balance; 
                
                echo "<tr>
                        <td>".$i."</td>
                        <td><a href='admin/fees/student/".$cdm_student_profile->id."'>".$cdm_student_profile->display_name."</a></td>
                        <td style='text-align:right'>".number_format($cdm_amount_paid)."</td>
                        <td style='text-align:right'>".number_format($cdm_balance)."</td>
                      </tr>";
            $i++;
            }

            echo "<tr><td></td><td></td><td></td><td></td></tr>";
            echo "<tr>
                    <td></td>
                    <td>Totals</td>
                    <td style='text-align:right'>".number_format($cdm_total_amount_paid)."</td>
                    <td style='text-align:right'>".number_format($cdm_total_balance)."</td>
                  </tr>";
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

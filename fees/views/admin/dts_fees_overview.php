<?php

$dst_fees_paid = $this->fees->get_course_fees_paid(1); //DST = course_id 1

foreach ($dst_fees_paid as $dst_fee_paid) {
   
    $key = $dst_fee_paid['student_id'];

    if (!isset($dst_students[$key])) {
        $dst_students[$key] = array($dst_fee_paid);
    } 
    else {
        $dst_students[$key][] = $dst_fee_paid;
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
            $dst_amount_paid = 0;
            $dst_balance = 0;
            foreach ($dst_students as $dst_student) {
                
                foreach ($dst_student as $dst_student_array) {
                    $dst_student_profile = $this->ion_auth->get_user($dst_student_array['student_id']);
                    $dst_amount_paid += $dst_student_array['amount_paid'];
                    $dst_balance += $dst_student_array['balance'];
                }
                
                $dst_total_amount_paid += $dst_amount_paid;
                $dst_total_balance += $dst_balance; 
                
                echo "<tr>
                        <td>".$i."</td>
                        <td><a href='admin/fees/student/".$dst_student_profile->id."'>".$dst_student_profile->display_name."</a></td>
                        <td style='text-align:right'>".number_format($dst_amount_paid)."</td>
                        <td style='text-align:right'>".number_format($dst_balance)."</td>
                      </tr>";
            $i++;
            }

            echo "<tr><td></td><td></td><td></td><td></td></tr>";
            echo "<tr>
                    <td></td>
                    <td>Totals</td>
                    <td style='text-align:right'>".number_format($dst_total_amount_paid)."</td>
                    <td style='text-align:right'>".number_format($dst_total_balance)."</td>
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

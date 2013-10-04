<div>
    <div id='profile_pic'><img src="<?php echo $this->module_details['path']."/img/student.png"; ?>" /></div>
    <div id='profile_data'>
        <h2><?php echo $student->display_name; ?></h2>
        <hr>
        <div>
            <p><b>Admission No.:</b> <?php echo $student->student_admission_no; ?></p>
            <p><b>Course of study: </b> <?php echo $student->course_of_study; ?></p>
            <p><b>Date of admission: </b> <?php echo $student->date_of_admission; ?></p>
        </div>
    </div>
</div>
<table id="myTable" class="tablesorter" width="100%">
    <thead>
        <tr>
            <th width="4%">#</th>
            <th width="60%">Item Payable</th>
            <th width="16%" style='text-align:center'>Amount paid</th>
            <th width="16%" style='text-align:center'>Balance</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $i =1;

            foreach ($student_fees as $student_fee_item) {
                
                $total_amount_paid += $student_fee_item['amount_paid'];
                $total_balance += $student_fee_item['balance']; 

                $payable_item = $this->fees->get_payable_item($student_fee_item['payable_item_id']);
                
                echo "<tr>
                        <td>".$i."</td>
                        <td>".$payable_item->name."</td>
                        <td style='text-align:right'>".number_format($student_fee_item['amount_paid'])."</td>
                        <td style='text-align:right'>".number_format($student_fee_item['balance'])."</td>
                      </tr>";
            $i++;
            }

            echo "<tr><td></td><td></td><td></td><td></td></tr>";
            echo "<tr>
                    <td></td>
                    <td style='text-align:right'><b>Totals</b></td>
                    <td style='text-align:right'>".number_format($total_amount_paid)."</td>
                    <td style='text-align:right'>".number_format($total_balance)."</td>
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

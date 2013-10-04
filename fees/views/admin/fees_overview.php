<?php

include_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR .'highcharts' .DIRECTORY_SEPARATOR . 'Highchart.php';

$dst_fees = $this->fees->get_course_fees_paid(1); //DST = course_id 1
$cdm_fees = $this->fees->get_course_fees_paid(2); //DST = course_id 1

foreach ($dst_fees as $dst_fee) {
    $dst_total_amount += $dst_fee['amount_paid'];
    $dst_totalbalance += $dst_fee['balance'];
}

$dst_total = $dst_total_amount + $dst_totalbalance;
$dst_total_amount_percent = ($dst_total_amount/$dst_total)*100;
$dst_totalbalance_percent = ($dst_totalbalance/$dst_total)*100;


$chart = new Highchart();

$chart->chart->renderTo = "fees_overview_chart";
$chart->chart->plotBackgroundColor = null;
$chart->chart->plotBorderWidth = null;
$chart->chart->plotShadow = false;
$chart->title->text = "DST Students Fees Records Analysis for year ".date('Y');

$chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';}");

$chart->plotOptions->pie->allowPointSelect = 1;
$chart->plotOptions->pie->cursor = "pointer";
$chart->plotOptions->pie->dataLabels->enabled = 1;
$chart->plotOptions->pie->dataLabels->color = "#000000";
$chart->plotOptions->pie->dataLabels->connectorColor = "#000000";

$chart->plotOptions->pie->dataLabels->formatter = new HighchartJsExpr(
    "function() {
    return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %'; }");

$chart->series[] = array(
    'type' => "pie",
    'name' => "DST Students Fees Records",
    'data' => array(
        array(
            "DST Amount Paid",
            round($dst_total_amount_percent,2)
        ),
        array(
            "DST Total Balance",
            round($dst_totalbalance_percent,2)
        )
    )
);





foreach ($cdm_fees as $cdm_fee) {
    $cdm_total_amount += $cdm_fee['amount_paid'];
    $cdm_totalbalance += $cdm_fee['balance'];
}

$cdm_total = $cdm_total_amount + $cdm_totalbalance;
$cdm_total_amount_percent = ($cdm_total_amount/$cdm_total)*100;
$cdm_totalbalance_percent = ($cdm_totalbalance/$cdm_total)*100;

$cdm_chart = new Highchart();

$cdm_chart->chart->renderTo = "fees_overview_chart2";
$cdm_chart->chart->plotBackgroundColor = null;
$cdm_chart->chart->plotBorderWidth = null;
$cdm_chart->chart->plotShadow = false;
$cdm_chart->title->text = "CDM Students Fees Records Analysis for year ".date('Y');

$cdm_chart->tooltip->formatter = new HighchartJsExpr(
    "function() {
    return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';}");

$cdm_chart->plotOptions->pie->allowPointSelect = 1;
$cdm_chart->plotOptions->pie->cursor = "pointer";
$cdm_chart->plotOptions->pie->dataLabels->enabled = 1;
$cdm_chart->plotOptions->pie->dataLabels->color = "#000000";
$cdm_chart->plotOptions->pie->dataLabels->connectorColor = "#000000";

$cdm_chart->plotOptions->pie->dataLabels->formatter = new HighchartJsExpr(
    "function() {
    return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %'; }");

$cdm_chart->series[] = array(
    'type' => "pie",
    'name' => "CDM Students Fees Records",
    'data' => array(
        array(
            "CDM Amount Paid",
            round($cdm_total_amount_percent,2)
        ),
        array(
            "CDM Total Balance",
            round($cdm_totalbalance_percent,2)
        )
    )
);
?>

<div id="fees_overview_chart"></div>
<script type="text/javascript"><?php echo $chart->render("chart"); ?></script>

<div id="fees_overview_chart2"></div>
<script type="text/javascript"><?php echo $cdm_chart->render("chart"); ?></script>




<div id="sortable">
    <div class="one_full" id="1">
        <section class="draggable title">
            <h4>Students Fees Records Analysis for year <?php echo date('Y'); ?></h4>
            <a class="tooltip-s toggle" title="Toggle this element"></a>
        </section>
        <section class="item">
            <div class="content">
                <?php include('fees_overview.php'); ?>
            </div>
        </section>
    </div>

    <div class="one_half" id="1">
        <section class="draggable title">
            <h4>DST Students Fees Records for year <?php echo date('Y'); ?></h4>
            <a class="tooltip-s toggle" title="Toggle this element"></a>
        </section>
        <section class="item">
            <div class="content">
                <?php include('dts_fees_overview.php'); ?>
            </div>
        </section>
    </div>

    <div class="one_half" id="1">
        <section class="draggable title">
            <h4>CDM Students Fees Records for year <?php echo date('Y'); ?></h4>
            <a class="tooltip-s toggle" title="Toggle this element"></a>
        </section>
        <section class="item">
            <div class="content">
                <?php include('cdm_fees_overview.php'); ?>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() 
        {
            // setInterval(function() {
            //     alert('test'); 
            // }, 60000);
        } 
    ); 

   
        
</script>

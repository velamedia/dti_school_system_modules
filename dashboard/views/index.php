<?php
if(is_logged_in()){

?>

<div id="wrapper">
	<div id="container">
		<div id="left_col">
			<div class="icon">
				<a href="edit-profile"><img src="addons/shared_addons/modules/dashboard/img/admissions.jpg"></a>
				
			</div>
			<!-- <div class="icon">
				<a href="exams"><img src="addons/shared_addons/modules/dashboard/img/exams.jpg"></a>
				
			</div> -->
			<div class="icon">
				<a href="index.php/perfomance"><img src="addons/shared_addons/modules/dashboard/img/performance.jpg"></a>
				
			</div>
			<div class="icon">
				<a href="timetable"><img src="addons/shared_addons/modules/dashboard/img/timetable.jpg"></a>
			</div>
			<div class="icon">
				<a href="dashboard/unconfirmed_orders"><img src="addons/shared_addons/modules/dashboard/img/fees.jpg"></a>
				
			</div>
			
		</div>

	</div>
</div>

<?php
}else{
    redirect('users/login');
}
?>
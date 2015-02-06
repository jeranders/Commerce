<?php 
include 'bdd.php'; 
include 'sessions.php'; 
include 'Header.php';
include 'function.php';
?>

<div class="page-content">

<?php echo flash(); ?>
	<!-- BEGIN PAGE HEADER-->
	<h3 class="page-title">
		Configuration <small>Configuration de votre e-commerce</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="index.html">Accueil</a>					
			</li>					
		</ul>
		
	</div>
	<!-- END PAGE HEADER-->
	<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-12">
			Page content goes here

		</div>
	</div>
	<!-- END PAGE CONTENT-->
</div>

<?php include 'Footer.php'; ?>
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
		Accueil <small>Accueil</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="index.html">Accueil</a>					
			</li>					
		</ul>
		<div class="page-toolbar">
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
					Actions <i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu pull-right" role="menu">
					<li>
						<a href="#">Action</a>
					</li>
					<li>
						<a href="#">Another action</a>
					</li>
					<li>
						<a href="#">Something else here</a>
					</li>
					<li class="divider">
					</li>
					<li>
						<a href="#">Separated link</a>
					</li>
				</ul>
			</div>
		</div>
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
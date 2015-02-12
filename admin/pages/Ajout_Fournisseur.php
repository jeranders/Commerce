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
		Ajout fournisseur <small>Ajouter vos fournisseurs</small>
	</h3>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="index.php">Accueil</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">Ajout fournisseur</a>
			</li>
		</ul>
		
	</div>
	<!-- END PAGE HEADER-->
	<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		



		<div class="col-md-6 col-md-offset-3">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i> Ajout de fournisseur.
					</div>
					<div class="tools">
						<a href="" class="collapse" data-original-title="" title="">
						</a>

						<a href="" class="remove" data-original-title="" title="">
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<form role="form">
						<div class="form-body">

							<div class="form-group">
										<label> Liste des fournisseur </label>										
											<select class="form-control select2me" name="options2">
												<option value="">Choisir</option>
												<option value="Option 1">Option 1</option>
												<option value="Option 2">Option 2</option>
												<option value="Option 3">Option 3</option>
												<option value="Option 4">Option 4</option>
											</select>
										
									</div>

					</div>
					<div class="form-actions">
						<button type="submit" class="btn blue">Submit</button>
						<button type="button" class="btn default">Cancel</button>
					</div>
				</form>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->

	</div>



</div>
<!-- END PAGE CONTENT-->
</div>

<?php include 'Footer.php'; ?>
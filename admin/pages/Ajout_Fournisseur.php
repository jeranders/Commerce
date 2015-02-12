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

		<!-- modal-content -->
		<div class="modal fade" id="List_Fournisseur" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Liste des fournisseurs déja enregistré.</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<select class="form-control select2me" name="options2">
								<option value="">Voir...</option>
								<?php 
								$list_fournisseur = $bdd->query('SELECT * FROM fournisseurs');
								while ($donnees = $list_fournisseur->fetch()) {
									?>
									<option><?php echo $donnees['f_nom']; ?></option>
									<?php 
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">						
						<button type="button" class="btn default" data-dismiss="modal">Fermer</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

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
						<a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="Liste des fournisseurs">
						</a>
						<a href="" class="remove" data-original-title="" title="">
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<form role="form">
						<div class="form-body">

							<a href="#List_Fournisseur" data-toggle="modal" class="config" data-original-title="" title="Liste des fournisseurs">
							Voir la liste des fournisseurs</a>


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
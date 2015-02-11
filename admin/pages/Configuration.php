<?php 
include 'bdd.php'; 
include 'sessions.php'; 

include 'function.php';

/*HISTORIQUES DEBUT*/
$h_page = 'Configuration';
/*HISTORIQUES FIN*/

 // MODIFICATION DES RENSEIGNEMENTS PERSONNELS
if (isset($_POST['modif'])) {
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$tel = $_POST['tel'];
	$email_pro = $_POST['email_pro'];
	$email_perso = $_POST['email_perso'];
	$adresse = $_POST['adresse'];

	$update = $bdd->prepare('UPDATE configurations 
				SET c_nom = :nom,
				c_prenom = :prenom,
				c_tel = :tel,
				c_adresse = :adresse,
				c_email_societe = :email_pro,
				c_email_perso = :email_perso
				WHERE id = 0
				');
			$update->execute(array(			
				'nom' => $nom,
				'prenom' => $prenom,
				'tel' => $tel,
				'adresse' => $adresse,
				'email_pro' => $email_pro,
				'email_perso' => $email_perso
				));
				$update->closeCursor();

			// HISTORIQUE INSERT DEBUT
		historique(1, $h_page, 'Modifications des renseignements personnels.');
			// HISTORIQUE INSERT FIN	

	setFlash('Mise à jour des renseignements personneles effectué.');
	header('Location:Configuration.php');
	die();

}

// END

// MODIFICATION DU PASSWORD

if (isset($_POST['modif_password'])) {
	$mdp_actu = sha1($_POST['mdp_actu']);
	$nouveau_mdp = sha1($_POST['nouveau_mdp']);
	$re_nouveau_mdp = sha1($_POST['re_nouveau_mdp']);

	if ($mdp_actu OR $nouveau_mdp OR $re_nouveau_mdp != '') {

		$bdd_password = $bdd->query('SELECT c_password FROM configurations WHERE id = 0');
		$donnees = $bdd_password->fetch();

		if ($mdp_actu == $donnees['c_password']) {
			if (strlen($_POST['nouveau_mdp']) >= 4 AND strlen($_POST['nouveau_mdp']) < 12) {
				if ($nouveau_mdp == $re_nouveau_mdp) {

					$update = $bdd->prepare('UPDATE configurations SET c_password = :nouveau_mdp WHERE id = 0');
					$update->execute(array(	'nouveau_mdp' => $nouveau_mdp));
					$update->closeCursor();

					// HISTORIQUE INSERT DEBUT
					historique(1, $h_page, 'Modifications du mot de passe.');
			// HISTORIQUE INSERT FIN	

					setFlash('Votre mot de passe à bien été changé.');
					header('Location:Configuration.php');
					die();
				}else{
					setFlash('Attention les mots de passe ne sont pas identique', 'danger');
				}
			}else{
				setFlash('Le mot de passe doit avoir entre 4 et 12 caractères.', 'danger');
			}
		}else{
			setFlash('Erreur dans le password actuel merci de vérifier.', 'danger');
		}
		$bdd_password->closeCursor();

	}else{
		setFlash('Attention tous les champs ne sont pas rempli !', 'danger');
	}
}

// END


include 'Header.php';
?>

<div class="page-content">

<?php echo flash(); var_dump($_POST);?>
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Configuration <small>Configuration de votre e-commerce</small>
</h3>
<div class="page-bar">
<ul class="page-breadcrumb">
<li>
<i class="fa fa-home"></i>
<a href="index.php">Accueil</a>
<i class="fa fa-angle-right"></i>
</li>
<li>
<a href="#">Configuration</a>
</li>
</ul>

</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row profile">
<div class="col-md-12">
<!--BEGIN TABS-->
<div class="tabbable tabbable-custom tabbable-full-width">
<ul class="nav nav-tabs">
<li class="active">
<a href="#tab_1_1" data-toggle="tab">
Vue d'ensemble </a>
</li>
<li>
<a href="#tab_1_3" data-toggle="tab">
Compte </a>
</li>
<li>
<a href="#tab_1_6" data-toggle="tab">
Help </a>
</li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="tab_1_1">
<div class="row">
<div class="col-md-3">
<ul class="list-unstyled profile-nav">
<li>
<img src="../img/avatar.png" class="img-responsive" alt=""/>
<a href="#" class="profile-edit">
edit </a>
</li>
<li>
<a href="#">
Vider la table Clients </a>
</li>
<li>
<a href="#">
Vider la table Produits <span>
3 </span>
</a>
</li>
<li>
<a href="#">
Friends </a>
</li>
<li>
<a href="#">
Settings </a>
</li>
</ul>
</div>

<?php $configuration = $bdd->query('SELECT * FROM configurations');
$donnees = $configuration->fetch();
if ($donnees['c_type_activite'] == 1) {
	$active = 'Vente de marchandises';
	$fiscal = 'BIC';
}elseif ($donnees['c_type_activite'] == 2) {
	$active = 'Prestation de services';
	$fiscal = 'BIC';
}elseif ($donnees['c_type_activite'] == 3) {
	$active = 'Professions libérales relevant du RSI';
	$fiscal = 'BNC';
}elseif ($donnees['c_type_activite'] == 4) {
	$active = 'Professions libérales relevant de la CIPAV';
	$fiscal = 'BNC';
} ?>
<div class="col-md-9">
<div class="row">
<div class="col-md-8 profile-info">
<h1> <?php echo $donnees['c_nom_societe']; ?> </h1>
<p>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt laoreet dolore magna aliquam tincidunt erat volutpat laoreet dolore magna aliquam tincidunt erat volutpat.
</p>
<p>
<a href="#">
<?php echo $donnees['c_site']; ?> </a>
</p>
<ul class="list-inline">
<li class="tooltips"  data-container="body" data-placement="bottom" data-html="true" data-original-title="Ville de votre activité">
<i class="fa fa-map-marker"></i> Anor
</li>
<li class="tooltips"  data-container="body" data-placement="bottom" data-html="true" data-original-title="Date début de votre activité">
<i class="fa fa-calendar"></i> 01/03/2015
</li>
<li class="tooltips"  data-container="body" data-placement="bottom" data-html="true" data-original-title="Type d'activité">
<i class="fa fa-briefcase"></i> <?php echo $active; ?>
</li>
<li class="tooltips"  data-container="body" data-placement="bottom" data-html="true" data-original-title="Bénéfices industriels et commerciaux">
<i class="fa fa-star"></i> <?php echo $fiscal; ?>
</li>
<li class="tooltips"  data-container="body" data-placement="bottom" data-html="true" data-original-title="Numéro de SIRET">
<i class="fa fa-heart"></i> <?php echo $donnees['c_siret']; ?>
</li>
</ul>
</div>
<!--end col-md-8-->
<div class="col-md-4">
<div class="portlet sale-summary">
<div class="portlet-title">
<div class="caption">
Informations
</div>
<div class="tools">
<a class="reload" href="javascript:;">
</a>
</div>
</div>
<div class="portlet-body">
<ul class="list-unstyled">
<li>
<span class="sale-info">
Cotisation <i class="fa fa-img-up"></i>
</span>
<span class="sale-num">
<?php echo $donnees['c_cotisation']; ?> % </span>
</li>
<li>
<span class="sale-info">
Impot revenu  <i class="fa fa-img-down"></i>
</span>
<span class="sale-num">
<?php echo $donnees['c_impot']; ?> % </span>
</li>
<li>
<span class="sale-info">
Total </span>
<span class="sale-num">
<?php echo $donnees['c_cotisation'] + $donnees['c_impot']; ?> %</span>
</li>
<li>
<span class="sale-info">
ACCRE </span>
<span class="sale-num">
Non </span>
</li>
<li>
<span class="sale-info">
Plafond CA </span>
<span class="sale-num">
<?php echo $donnees['c_plafond']; ?>&euro; </span>
</li>
<li>
<span class="sale-info">
Plafond Actuel </span>
<span class="sale-num">
0&euro; </span>
</li>
</ul>
</div>
</div>
</div>
<?php $configuration->closeCursor(); ?>
<!--end col-md-4-->
</div>
<!--end row-->
<div class="tabbable tabbable-custom tabbable-custom-profile">
<ul class="nav nav-tabs">
<li class="active">
<a href="#tab_1_11" data-toggle="tab">
Historique des manipulations </a>
</li>
			
</ul>
<div class="tab-content">
<div class="tab-pane active" id="tab_1_11">
<div class="portlet-body">
<table class="table table-striped table-bordered table-advance table-hover">
<thead>
<tr>
<th>
<i class="fa fa-briefcase"></i> Page
</th>
<th class="hidden-xs">
<i class="fa fa-question"></i> Description
</th>
<th>
<i class="fa fa-bookmark"></i> Type
</th>
<th>
</th>
</tr>
</thead>

<tbody class="auto">

<?php 

$info_historique = $bdd->query('SELECT * FROM historiques ORDER BY h_date DESC LIMIT 10'); 

while ($donnees = $info_historique->fetch())
{
?>
<tr>
<td>
		<a href="#">
		<?php echo $donnees['h_page']; ?> </a>
		</td>
		<td class="hidden-xs">
		<?php echo $donnees['h_description']; ?> </a>
		</td>
		<td>
		<?php type_historique($donnees['h_type']); ?>
		</td>
		<td>
		<a class="btn default btn-xs blue-stripe" href="#">
		<?php echo getRelativeTime ($donnees['h_date']); ?> </a>
		</td>
		</tr>
<?php
}
$info_historique->closeCursor();
?>



</tbody>

</table>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
<!--tab_1_2-->
<div class="tab-pane" id="tab_1_3">
<div class="row profile-account">
<div class="col-md-3">
<ul class="ver-inline-menu tabbable margin-bottom-10">
<li class="active">
<a data-toggle="tab" href="#tab_1-1">
<i class="fa fa-cog"></i> Renseignements personnels </a>
<span class="after">
</span>
</li>
<li>
<a data-toggle="tab" href="#tab_2-2">
<i class="fa fa-picture-o"></i> Changement d'avatar </a>
</li>
<li>
<a data-toggle="tab" href="#tab_3-3">
<i class="fa fa-lock"></i> Changement de mot de passe </a>
</li>
<li>
<a data-toggle="tab" href="#tab_4-4">
<i class="fa fa-eye"></i> Réglages mode paiements </a>
</li>
<li>
<a data-toggle="tab" href="#tab_5-5">
<i class="fa fa-eye"></i> Réglages divers </a>
</li>
</ul>
</div>

<div class="col-md-9">
<div class="tab-content">
	<div id="tab_1-1" class="tab-pane active">
		<?php $renseignements = $bdd->query('SELECT * FROM configurations');
		$donnees = $renseignements->fetch(); ?>
		<form role="form" action="#" method="post">
			<div class="form-group">
				<label class="control-label">Votre nom</label>
				<input type="text" value="<?php echo $donnees['c_nom']; ?>" class="form-control" name="nom"/>
			</div>
			<div class="form-group">
				<label class="control-label">Votre prénom</label>
				<input type="text" value="<?php echo $donnees['c_prenom']; ?>" class="form-control" name="prenom"/>
			</div>
			<div class="form-group">
				<label class="control-label">Numéro de contact</label>
				<input type="text" value="+33 0 00 00 00" class="form-control" name="tel"/>
			</div>
			<div class="form-group">
				<label class="control-label">Votre e-mail pro</label>
				<input type="text" value="<?php echo $donnees['c_email_societe']; ?>" class="form-control" name="email_pro"/>
			</div>
			<div class="form-group">
				<label class="control-label">Votre adresse</label>
				<input type="text" value="<?php echo $donnees['c_adresse']; ?>" class="form-control" name="adresse"/>
			</div>
			<div class="form-group">
				<label class="control-label">Votre e-mail perso</label>
				<input type="text" value="<?php echo $donnees['c_email_perso']; ?>" class="form-control" name="email_perso"/>
			</div>
			<div class="margiv-top-10">
				<button type="submit" class="btn green-meadow" name="modif">Enregistrer les modifications</button>
			</div>
		</form>
		<?php $renseignements->closeCursor(); ?>
	</div>

<div id="tab_2-2" class="tab-pane">
<p>
Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
</p>
<form action="#" role="form">
<div class="form-group">
<div class="fileinput fileinput-new" data-provides="fileinput">
<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
</div>
<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
</div>
<div>
<span class="btn default btn-file">
<span class="fileinput-new">
Select image </span>
<span class="fileinput-exists">
Change </span>
<input type="file" name="...">
</span>
</div>
</div>
<div class="clearfix margin-top-10">
<span class="label label-danger">
NOTE! </span>
<span>
 Vous devez disposer de la dernière version de votre navigateur. </span>
</div>
</div>
<div class="margin-top-10">
<a href="#" class="btn green">
Enregistrer les modifications </a>
</div>
</form>
</div>
<div id="tab_3-3" class="tab-pane">
	<form action="#" method="post">
		<div class="form-group">
			<label class="control-label">Mot de passe actuel</label>
			<input type="password" class="form-control" name="mdp_actu"/>
		</div>
		<div class="form-group">
			<label class="control-label">Nouveau mot de passe</label>
			<input type="password" class="form-control" name="nouveau_mdp"/>
		</div>
		<div class="form-group">
			<label class="control-label">Re-rentrer le nouveau mot de passe</label>
			<input type="password" class="form-control" name="re_nouveau_mdp"/>
		</div>
		<div class="margin-top-10">
			<button type="submit" class="btn green-meadow" name="modif_password">Enregistrer les modifications</button>
		</div>
	</form>
</div>
<div id="tab_4-4" class="tab-pane">
	<form action="#">
		<table class="table table-bordered table-striped">
			<tr>
				<td>
					Utilisez vous PayPlug ?
				</td>
				<td>
					<label class="uniform-inline">
						<input type="radio" name="payplug" value="payplug1"/>
						Oui </label>
						<label class="uniform-inline">
							<input type="radio" name="payplug" value="payplug2"/>
							Non </label>
						</td>
					</tr>
					<tr>
						<td>
							Utilisez vous PayPal ?
						</td>
						<td>
							<label class="uniform-inline">
								<input type="radio" name="paypal" value="paypal1"/>
								Oui </label>
								<label class="uniform-inline">
									<input type="radio" name="paypal" value="paypal2"/>
									Non </label>
								</td>
							</tr>
						</table>
						<!--end profile-settings-->
						<div class="margin-top-10">
							<button type="submit" class="btn green-meadow" name="modif_divers">Enregistrer les modifications</button>
						</div>
					</form>
				</div>

				<div id="tab_5-5" class="tab-pane">
					<?php $renseignements = $bdd->query('SELECT * FROM configurations');
					$donnees = $renseignements->fetch(); ?>
					<form role="form" action="#" method="post">

						<div class="form-group">
							<label>Cotisation</label>
							<div class="input-group">
								<span class="input-group-addon">
									%
								</span>
								<input type="text" class="form-control" value="<?php echo $donnees['c_cotisation']; ?>" name="cotisation" >
							</div>
						</div>

						<div class="form-group">
							<label>Impot sur le revenu</label>
							<div class="input-group">
								<span class="input-group-addon">
									%
								</span>
								<input type="text" class="form-control" value="<?php echo $donnees['c_impot']; ?>" name="impot" >
							</div>
						</div>

						<div class="form-group">
							<label>Plafond du chiffre d'affaire</label>
							<div class="input-group">
								<span class="input-group-addon">
									&euro;
								</span>
								<input type="text" class="form-control" value="<?php echo $donnees['c_plafond']; ?>" name="plafond" >
							</div>
						</div>

						<div class="form-group">
							<label>Budget de départ</label>
							<div class="input-group">
								<span class="input-group-addon">
									&euro;
								</span>
								<input type="text" class="form-control" value="<?php echo $donnees['c_budget_depart']; ?>" name="budget_depart" >
							</div>
						</div>

						<div class="form-group">
							<label>Crédit sur votre compte pro</label>
							<div class="input-group">
								<span class="input-group-addon">
									&euro;
								</span>
								<input type="text" class="form-control" value="<?php echo $donnees['c_resultat_banque']; ?>" name="resultat_banque" >
							</div>
						</div>

			<div class="form-group">
				<label>Numéro de SIRET</label>
				<div class="input-group">
					<span class="input-group-addon">
						&euro;
					</span>
					<input type="text" class="form-control" value="<?php echo $donnees['c_siret']; ?>" name="siret" >
				</div>
			</div>
				
			
			<div class="margiv-top-10">
				<button type="submit" class="btn green-meadow" name="modif">Enregistrer les modifications</button>
			</div>
		</form>
		<?php $renseignements->closeCursor(); ?>
	</div>
</div>
</div>
<!--end col-md-9-->
</div>
</div>


<!--end tab-pane-->
<div class="tab-pane" id="tab_1_6">
<div class="row">
<div class="col-md-3">
<ul class="ver-inline-menu tabbable margin-bottom-10">
<li class="active">
<a data-toggle="tab" href="#tab_1">
<i class="fa fa-briefcase"></i> Questions général </a>
<span class="after">
</span>
</li>
<li>
<a data-toggle="tab" href="#tab_2">
<i class="fa fa-group"></i> Membership </a>
</li>
<li>
<a data-toggle="tab" href="#tab_3">
<i class="fa fa-leaf"></i> Terms Of Service </a>
</li>
<li>
<a data-toggle="tab" href="#tab_1">
<i class="fa fa-info-circle"></i> License Terms </a>
</li>
<li>
<a data-toggle="tab" href="#tab_2">
	<i class="fa fa-tint"></i> Payment Rules </a>
</li>
<li>
	<a data-toggle="tab" href="#tab_3">
		<i class="fa fa-plus"></i> Other Questions </a>
	</li>
</ul>
</div>
<div class="col-md-9">
<div class="tab-content">
	<div id="tab_1" class="tab-pane active">
		<div id="accordion1" class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
							1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
						</h4>
					</div>
					<div id="accordion1_1" class="panel-collapse collapse in">
						<div class="panel-body">
							Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
						</div>
					</div>
				</div>

			</div>
		</div>
		<div id="tab_2" class="tab-pane">
			<div id="accordion2" class="panel-group">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_1">
								1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
							</h4>
						</div>
						<div id="accordion2_1" class="panel-collapse collapse in">
							<div class="panel-body">
								<p>
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
								</p>
								<p>
									Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
								</p>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div id="tab_3" class="tab-pane">
				<div id="accordion3" class="panel-group">

				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!--end tab-pane-->
</div>
</div>
<!--END TABS-->
</div>
</div>
<!-- END PAGE CONTENT-->
</div>

<?php include 'Footer.php'; ?>
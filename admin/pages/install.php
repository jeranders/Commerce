<?php 
include 'bdd.php'; 
include 'sessions.php'; 
include 'function.php'; 

// DEBUT Verif fichier install
$requete = $bdd->query('SELECT c_valide FROM configurations');
$info = $requete->fetch();
if ($info['c_valide'] != 0) {
	header('Location:index.php');
	die();
}
$requete->closeCursor();
// FIN Verif fichier install

// DEBUT Formulaire Configuration
if(isset($_POST['send'])){
	$mail_professionnel = htmlspecialchars($_POST['mail-pro']);
	$mail_personnel = htmlspecialchars($_POST['mail-perso']);
	$nom_societe = htmlspecialchars($_POST['nom_societe']);
	$adresse_societe = htmlspecialchars($_POST['adresse_societe']);
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$utilisateur = htmlspecialchars($_POST['utilisateur']);
	$mot_de_passe = $_POST['mot_de_passe'];
	$mot_de_passe_verif = $_POST['mot_de_passe_verif'];
	$siret = htmlspecialchars($_POST['siret']);
	$phrase_secret = htmlspecialchars($_POST['phrase_secret']);
	$phrase_verif = htmlspecialchars($_POST['phrase_verif']);
	$activite = htmlspecialchars($_POST['activite']);
	$impot = htmlspecialchars($_POST['impot']);

	if ($mail_professionnel == '') {

		$erreur_mail_professionnel = msgErreur('Vous devez remplir un email valide.');

	}else if ($mail_personnel == '') {

		$erreur_mail_personnel = msgErreur('Vous devez remplir un email valide perso.');

	}else if ($nom_societe == '') {

		$erreur_nom_societe = msgErreur('Entrez un le nom de votre société.');

	}else if ($adresse_societe == '') {

		$erreur_adresse_societe = msgErreur('Entrez l\'adresse de votre société.');

	}else if ($nom == '') {

		$erreur_nom = msgErreur('Entrez votre nom.');

	}else if ($utilisateur == '') {

		$erreur_utilisateur = msgErreur('Entrez un nom d\'utilisateur.');

	}else if ($mot_de_passe == '') {

		$erreur_mot_de_passe = msgErreur('Mot de passe vide.');

	}else if ($mot_de_passe != $mot_de_passe_verif) {

		$erreur_mot_de_passe_verif_identique = msgErreur('Le mot de passe n\'est pas identique.');

	}else if ($siret == '') {

		$erreur_siret = msgErreur('Numéro de siret vide');

	}else if ($phrase_verif == '') {

		$erreur_phrase_verif = msgErreur('Vous n\'avez pas entré de phrase');

	}else if ($mot_de_passe AND strlen($mot_de_passe) <= 4 OR  strlen($mot_de_passe) > 8) {

		$erreur_mot_de_passe_court = msgErreur('Le mot de passe doit avoir entre 5 et 8 caractères.');

	}else{

		if ($impot == 1 && $activite == 1) {
			$taux_impot = 1;
			$cotisation = 13.3;
			$total_cotisation = $taux_impot + $cotisation;
			echo $total_cotisation;
		}elseif ($impot == 2 && $activite == 1) {
			$cotisation = 13.3;
			$total_cotisation = $cotisation;
			echo $total_cotisation;
		}


		$password = sha1($mot_de_passe);
		$validation = 1;

		// /*---Mise à jour du budget par rapport à la commande---*/
		// $req = $bdd->prepare('UPDATE configurations 
		// 	SET c_email_societe = :mail_professionnel,
		// 	c_email_perso = :mail_personnel,
		// 	c_nom_societe = :nom_societe,
		// 	c_adresse = :adresse_societe,
		// 	c_nom = :nom,
		// 	c_prenom = :prenom,
		// 	c_pseudo = :utilisateur,
		// 	c_password = :password,
		// 	c_siret = :siret,
		// 	c_phrase_secret = :phrase_secret,
		// 	c_phrase_verif = :c_phrase_verif,
		// 	c_type_activite = :activite,
		// 	c_impot = :impot,
		// 	c_valide = :validation
		// 	WHERE id = 0
		// 	');
		// $req->execute(array(            
		// 	'mail_professionnel' => $mail_professionnel,
		// 	'mail_personnel' => $mail_personnel,
		// 	'nom_societe' => $nom_societe,
		// 	'adresse_societe' => $adresse_societe,
		// 	'nom' => $nom,
		// 	'prenom' => $prenom,
		// 	'utilisateur' => $utilisateur,
		// 	'password' => $password,
		// 	'siret' => $siret,
		// 	'phrase_secret' => $phrase_secret,
		// 	'phrase_verif' => $phrase_verif,
		// 	'activite' => $activite,
		// 	'impot' => $impot,
		// 	'validation' => $validation
		// 	));

		// setFlash('Félicitation vous pouvez commencer à utiliser le portail. Pensez à compléter les informations.', 'success');
		// header('Location:index.php');
		// die();

	}



}
// FIN Formulaire Configuration

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="fr" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="fr" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="fr">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8"/>
	<title>Commerce</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
	<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="../../assets/admin/pages/css/lock.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
	<!-- BEGIN THEME STYLES -->
	<link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
	<link href="../../assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
	<div class="page-lock">
		<div class="col-md-12 ">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gears"></i> Configuration
					</div>
					
				</div>
				<div class="portlet-body form">
					<form role="form" method="post" action="#">
						<div class="form-body">
							<div class="form-group">
								<label>Adresse e-mail de la société *</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-envelope"></i>
									</span>
									<?php echo input('mail-pro'); ?>
								</div>
								<?php if (isset($erreur_mail_professionnel)) {
									echo $erreur_mail_professionnel;
								} ?>
							</div>

							<div class="form-group">
								<label>Adresse e-mail personnelle</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-envelope"></i>
									</span>
									<?php echo input('mail-perso'); ?>
								</div>
								<?php if (isset($erreur_mail_personnel)) {
									echo $erreur_mail_personnel;
								} ?>
							</div>

							<div class="form-group">
								<label>Nom de la société *</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-home"></i>
									</span>
									<?php echo input('nom_societe'); ?>
								</div>
								<?php if (isset($erreur_nom_societe)) {
									echo $erreur_nom_societe;
								} ?>
							</div>

							<div class="form-group">
								<label>Adresse de la société *</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-home"></i>
									</span>
									<?php echo input('adresse_societe'); ?>
								</div>
								<?php if (isset($erreur_adresse_societe)) {
									echo $erreur_adresse_societe;
								} ?>
							</div>

							<div class="form-group">
								<label>Votre nom *</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-user"></i>
									</span>
									<?php echo input('nom'); ?>
								</div>
								<?php if (isset($erreur_nom)) {
									echo $erreur_nom;
								} ?>
							</div>

							<div class="form-group">
								<label>Votre prénom</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-user"></i>
									</span>
									<?php echo input('prenom'); ?>
								</div>
							</div>

							<div class="form-group">
								<label>Nom d'utilisateur *</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-user"></i>
									</span>
									<?php echo input('utilisateur'); ?>
								</div>
								<?php if (isset($erreur_utilisateur)) {
									echo $erreur_utilisateur;
								} ?>
							</div>


							<div class="form-group">
								<label>Mot de passe *</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-unlock"></i>
									</span>
									<?php echo password('mot_de_passe'); ?>
								</div>
								<?php if (isset($erreur_mot_de_passe)) {
									echo $erreur_mot_de_passe;
								} 
								if (isset($erreur_mot_de_passe_court)) {
									echo $erreur_mot_de_passe_court;
								}
								?>
							</div>

							<div class="form-group">
								<label>Verifier mot de passe *</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-unlock"></i>
									</span>
									<?php echo password('mot_de_passe_verif'); ?>
								</div>								
								<?php if (isset($erreur_mot_de_passe_verif_identique)) {
									echo $erreur_mot_de_passe_verif_identique;
								} ?>
							</div>

							<div class="form-group">
								<label>N° Siret *</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-ticket"></i>
									</span>
									<?php echo input('siret'); ?>
								</div>
								<?php if (isset($erreur_siret)) {
									echo $erreur_siret;
								} ?>
							</div>

							<div class="form-group">
								<label>Phrase secret pour votre mot de passe *</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-question-circle"></i>
									</span>
									<select class="form-control" name="phrase_secret">
										<option value="Nom de votre premier animal" <?php if (isset($_POST['phrase_secret']) && $_POST['phrase_secret']=="Nom de votre premier animal") echo 'selected="selected"';?> >Nom de votre premier animal</option>
										<option value="Nom de jeune fille de votre mère" <?php if (isset($_POST['phrase_secret']) && $_POST['phrase_secret']=="Nom de jeune fille de votre mère") echo 'selected="selected"';?>>Nom de jeune fille de votre mère</option>									
										<option value="Nom de votre meilleur(e) ami(e)" <?php if (isset($_POST['phrase_secret']) && $_POST['phrase_secret']=="Nom de votre meilleur(e) ami(e)") echo 'selected="selected"';?>>Nom de votre meilleur(e) ami(e)</option>									
										<option value="Marque de votre première voiture" <?php if (isset($_POST['phrase_secret']) && $_POST['phrase_secret']=="Marque de votre première voiture") echo 'selected="selected"';?>>Marque de votre première voiture</option>									
										<option value="Surnom que l'on vous donnait petit" <?php if (isset($_POST['phrase_secret']) && $_POST['phrase_secret']=="Surnom que l'on vous donnait petit") echo 'selected="selected"';?>>Surnom que l'on vous donnait petit</option>									
									</select>
									<?php echo input('phrase_verif'); ?>
								</div>
								<?php if (isset($erreur_phrase_verif)) {
									echo $erreur_phrase_verif;
								} ?>
							</div>

							<div class="form-group">
								<label> <i class="fa fa-info-circle popovers" data-container="body" data-trigger="hover" data-placement="left" data-content="Selon votre activité le taux de cotisations ne sont pas les mêmes" data-original-title="Informations"></i> Activités *</label>
								<select class="form-control" name="activite">
									<option value="1" <?php if (isset($_POST['activite']) && $_POST['activite']=="1") echo 'selected="selected"';?>>Ventes de marchandises (BIC)</option>
									<option value="2" <?php if (isset($_POST['activite']) && $_POST['activite']=="2") echo 'selected="selected"';?>>Prestations de services BIC</option>
									<option value="3" <?php if (isset($_POST['activite']) && $_POST['activite']=="3") echo 'selected="selected"';?>>Prestations de services BNC</option>
									<option value="4" <?php if (isset($_POST['activite']) && $_POST['activite']=="4") echo 'selected="selected"';?>>Actités libérales (BNC)</option>
								</select>
							</div>

							<div class="form-group">
								<label><i class="fa fa-info-circle popovers" data-container="body" data-trigger="hover" data-placement="left" data-content="Option pour le versement libératoire de l’impôt sur le revenu" data-original-title="Informations"></i> Impôt sur le revenu *</label>
								<select class="form-control" name="impot">
									<option value="1" <?php if (isset($_POST['impot']) && $_POST['impot']=="1") echo 'selected="selected"';?>>Oui</option>									
									<option value="2" <?php if (isset($_POST['impot']) && $_POST['impot']=="2") echo 'selected="selected"';?>>Non</option>									
								</select>
							</div>

						</div>
						<div class="form-actions">
							<button type="submit" class="btn blue" name="send">Enregistrer</button>
						</div>
					</form>
				</div>
			</div>
			<!-- END SAMPLE FORM PORTLET-->

		</div>


		<div class="page-footer-custom">
			Commerce
		</div>
	</div>
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../../assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {    
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	Demo.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
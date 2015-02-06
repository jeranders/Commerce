<?php session_start();

// Fonction qui permet de faire un message par session.
function flash(){
	if (isset($_SESSION['flash'])) {
		extract($_SESSION['flash']);
		unset($_SESSION['flash']);
		return "<div class='alert alert-$type alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
		 $message</div>";
	}
}

function setFlash($message, $type = 'success', $icon= 'check'){
	$_SESSION['flash']['message'] = $message;
	$_SESSION['flash']['type'] = $type;
	$_SESSION['flash']['icon'] = $icon; // Icon disponible "check" pour succes, "warning" pour warning , "info" pour info, "ban" pour danger
}


// Protection des données SQL

if (!isset($_SESSION['csrf'])) {
	$_SESSION['csrf'] = sha1(time() + rand());
}

function csrf(){
	return 'csrf=' . $_SESSION['csrf'];
}

function checkCsrf(){
	if (!isset($_GET['csrf']) || $_GET['csrf'] != $_SESSION['csrf']) {
		header('Location:csrf.php');
		die();
	}
}
?>
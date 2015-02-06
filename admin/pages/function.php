<?php 
function input($id){
	$value = isset($_POST[$id]) ? $_POST[$id] : '';
	return "<input type='text' class='form-control' name='$id' value='$value'>";
								
}

function password($idpassword){
	$value = isset($_POST[$idpassword]) ? $_POST[$idpassword] : '';
	return "<input type='password' class='form-control' name='$idpassword' value='$value'>";
}

function select($id, $option = array()){
	$return = "<select class='form-control' id='$id' name='$id'>";
	foreach ($option as $id => $value) {
		$return .= "<option value='$id'>$value</option>";
	}
	$return .= '</select>';
	return $return;
}

function msgErreur($message){
	return "<div class='alert alert-danger alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
		<strong>Erreur !</strong> $message</div>";
}



?>

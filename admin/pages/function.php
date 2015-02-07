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



function getRelativeTime($date) {
    // Déduction de la date donnée à la date actuelle
    $time = time() - strtotime($date); 

    // Calcule si le temps est passé ou à venir
    if ($time > 0) {
        $when = "il y a";
    } else if ($time < 0) {
        $when = "dans environ";
    } else {
        return "il y a moins d'une seconde";
    }
    $time = abs($time); 

    // Tableau des unités et de leurs valeurs en secondes
    $times = array( 31104000 =>  'an{s}',       // 12 * 30 * 24 * 60 * 60 secondes
                    2592000  =>  'mois',        // 30 * 24 * 60 * 60 secondes
                    86400    =>  'jour{s}',     // 24 * 60 * 60 secondes
                    3600     =>  'heure{s}',    // 60 * 60 secondes
                    60       =>  'minute{s}',   // 60 secondes
                    1        =>  'seconde{s}'); // 1 seconde         

    foreach ($times as $seconds => $unit) {
        // Calcule le delta entre le temps et l'unité donnée
        $delta = round($time / $seconds); 

        // Si le delta est supérieur à 1
        if ($delta >= 1) {
            // L'unité est au singulier ou au pluriel ?
            if ($delta == 1) {
                $unit = str_replace('{s}', '', $unit);
            } else {
                $unit = str_replace('{s}', 's', $unit);
            }
            // Retourne la chaine adéquate
            return $when." ".$delta." ".$unit;
        }
    }
}




?>

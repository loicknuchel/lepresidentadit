<?php

function persistQuery($req){
	$result = mysql_query($req);
	//echo '<br/>'.$req.' <br/> '.mysql_errno().' :: '.mysql_error().'<br/>'; // Affiche toutes les requêtes
	return $result;
}

function nullSafe($val){
	if($val == null){return 'NULL';}
	else{return "'".$val."'";}
}

?>

<?php
// http://www.siteduzero.com/tutoriel-3-64912-securite-php-securiser-les-flux-de-donnees.html

/* Exist function :
  - is_int
  - is_numeric
  - is_float
  - is_bool
  - is_null
*/

function is_simple_int($string, $orNull = false){
  if($orNull == true && ($string == null || $string == '')){
    return true;
  }
  return preg_match("#^[0-9]+$#", $string);
}

function is_id($string){
  return is_simple_int($string);
}

// TODO
function is_date($string){
  /* True for : yyyy-mm-dd */
  return true;
}

// TODO
function is_datetime($string){
  /* True for : yyyy-mm-dd hh:mm:ss */
  return true;
}

// TODO
function is_url($string, $orNull = false){
  return true;
}

function is_mail($string){
	/*
	* commence par une lettre minuscule, un chiffre, un ".", un "_" ou un "-". Il y en a au moins un (login)
	* ensuite on a le "@"
	* ensuite on a la meme suite (nom de domaine)
	* ensuote on a le "."
	* ensuite on a entre 2 et 4 lettre minuscule ce qui fini la chaine (tld)
	*/
	return preg_match("#^[A-Za-z0-9._-]+@[A-Za-z0-9._-]{2,}\.[a-z]{2,4}$#", $string);
}

function is_ip($string){
	return preg_match("#^(((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]{1}[0-9]|[1-9])\.){1}((25[0-5]|2[0-4][0-9]|[1]{1}[0-9]{2}|[1-9]{1}[0-9]|[0-9])\.){2}((25[0-5]|2[0-4][0-9]|[1]{1}[0-9]{2}|[1-9]{1}[0-9]|[0-9]){1}))$#",$string);
}

function is_phone($string){
	/*
	* commence par un 0
	* prend ensuite un nombre entre 1 et 6 ou 8
	* prend ensuite un "-", un "." ou un " " non obligatoire et deux chiffres entre 0 et 9
	* l'etape precedante est repetee 4 fois et termine la chaine
	*/
	return preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $string);
}

function is_mdp($string){
	// a creer. doit contenir : min 8 lettres, un chiffre, une majuscule, une minuscule, un caractere special, max 20 lettres ?
	if( preg_match("#[0-9]#", $string) && preg_match("#[a-z]#", $string) && preg_match("#[A-Z]#", $string) && preg_match("#[^0-9^a-z^A-Z:print:]#", $string) && strlen($string) >= 8){
		return 1;
	}
	else{
		return 0;
	}
}

function string_max_lenght($string, $max_lenght){
	if(strlen($string) >= $max_lenght){
		return substr($string, 0, $max_lenght);
	} else{
		return $string;
	}
}

function generateRandomString($length, $complexity = 2){
	if($complexity == 1){$max = 10; $chars = "0123456789";}
	if($complexity == 2){$max = 26; $chars = "abcdefghijklmnopqrstuvwxyz";}
	if($complexity == 3){$max = 36; $chars = "0123456789abcdefghijklmnopqrstuvwxyz";}
	if($complexity == 4){$max = 62; $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";}
	if($complexity == 5){$max = 96; $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ&~#'{([-|`_^@)]=}+*<>,?;.:/!§%£€¨µ";}
	else                {$max = 36; $chars = "0123456789abcdefghijklmnopqrstuvwxyz";}
	
	$ret = '';
	for($i=0; $i<$length; $i++){
		$ret .= $chars[mt_rand(0,($max-1))];
	}
	
	return $ret;
}

?>

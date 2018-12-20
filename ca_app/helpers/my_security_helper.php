<?php
//Hash the password
if ( ! function_exists('do_hashing'))
{
	function do_hashing($str)
	{
		$new_hashed='';
		if($str)
			$new_hashed = password_hash($str, PASSWORD_DEFAULT);
		return $new_hashed;
	}
}

//Verify the password if its valid or invalid
if ( ! function_exists('verify_hashing'))
{
	function verify_hashing($str, $hashed_value)
	{
		return password_verify($str, $hashed_value);
	}
}

//Check if there is need to rehash the password
if ( ! function_exists('needs_rehashing'))
{
	function needs_rehashing($str)
	{
		return password_needs_rehash($str, PASSWORD_DEFAULT);
	}
}


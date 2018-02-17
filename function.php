<?php

	function userinfo($id)
	{

		global $db;
		return $db->query("SELECT * FROM users WHERE user_id='$id'")->fetch();

	}

	function createHash($uzunluk = 16)
	{

		$karekterler = "qwertyuopasdfghjklizxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM123456789";
		return substr(str_shuffle($karekterler), 0, $uzunluk);

	}

	function g($par)
	{

    	return @strip_tags(trim(addslashes($_GET[$par])));

	}

	date_default_timezone_set('Europe/Istanbul');	

	## Php Türkçe Tarih ##
	$turkceTarih = array(
		'January' => 'Ocak',
		'February' => 'Şubat',
		'March' => 'Mart',
		'April' => 'Nisan',
		'May' => 'Mayıs',
		'June' => 'Haziran',
		'July' => 'Temmuz',
		'August' => 'Ağustos',
		'September' => 'Eylül',
		'October' => 'Ekim',
		'November' => 'Kasım',
		'December' => 'Aralık',
		'Monday' => 'Pazartesi',
		'Tuesday' => 'Salı',
		'Wednesday' => 'Çarşamba',
		'Thursday' => 'Perşembe',
		'Friday' => 'Cuma',
		'Saturday' => 'Cumartesi',
		'Sunday' => 'Pazar',
	);

	function ip_address()
	{
		if(getenv("HTTP_CLIENT_IP")) {

		  $ip = getenv("HTTP_CLIENT_IP");

		  } else if(getenv("HTTP_X_FORWARDED_FOR")) {

		  $ip = getenv("HTTP_X_FORWARDED_FOR");

			  if (strstr($ip, ',')) {

			  $tmp = explode (',', $ip);

			  $ip = trim($tmp[0]);

			  }

		  } else {

			$ip = getenv("REMOTE_ADDR");

		  }

		return $ip;

	}
	
 
?>
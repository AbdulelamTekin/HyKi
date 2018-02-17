<?php

	try {		
		$db = new PDO("mysql:host=localhost;dbname=message",'root','xpsdf1491');
		$db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
	}
	catch (PDOExpception $e)
	{
		print $e->getMessage();
	}

	$url = "http://localhost/message";
	
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
	

?>
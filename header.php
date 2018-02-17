<?php

	ob_start();
	session_start();

	require_once 'config.php';
	require_once 'function.php';
	require_once 'user.class.php';

	if (isset($_SESSION['userEmail'])) {

	    $userASK=$db->prepare("SELECT * FROM users where user_email=:email or user_id=:userId");
	    $userASK->execute(array(
	      'email' => $_SESSION['userEmail'],
	      'userId' => $_SESSION['userId'],
	      ));
	    $count=$userASK->rowCount();
	    $userCzech=$userASK->fetch(PDO::FETCH_ASSOC);

	    //Kullanıcı ID Atama
	    if (!isset($_SESSION['userId'])) {
	        $_SESSION['userId']=$userCzech['user_id'];
	    }

	}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mesajlaşma</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/css/style.css?v=<?php echo createHash(); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/css/font-awesome/css/font-awesome.min.css">

    <script src="<?php echo $url; ?>/js/sweetalert.min.js"></script>
    <script src="<?php echo $url; ?>/js/jquery-1.11.3-jquery.min.js"></script>

</head>
<body>
	<div class="topnav">
		<?php if (isset($_SESSION['userId'])) { ?>
		<a href="index.php">Anasayfa</a>
		<a href="messages.php">Mesajlarım</a>
		<a href="log-out.php">Çıkış yap</a>
		<?php }else { ?> 
		<a href="index.php">Anasayfa</a>
		<a href="sing-up.php">Kaydol</a>
		<?php } ?>
	</div>
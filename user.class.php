<?php

	ob_start();
	session_start();

	require_once 'config.php';
	require_once 'function.php';

	/* Kullanıcı Giriş Kontrolü */
	if (isset($_POST['userLogin'])) {

		$user_email=htmlspecialchars($_POST['user_email']); 
		$user_pass=md5($_POST['user_pass']); 

		if (empty($user_email) || empty($user_pass)) {
			header("Location:index.php?status=warning");
		} else {

			$userASK=$db->prepare("SELECT * FROM users where user_email=:email and user_pass=:pass");
			$userASK->execute(array(
				'email' => $user_email,
				'pass' => $user_pass
			));	

			$count=$userASK->rowCount();



			if ($count==1) {

				$_SESSION['userEmail']=$user_email;

				header("Location:users.php?status=successful");
				

			} else {


				header("Location:index.php?status=error");

			}
		}	

	}

	/* Kullanıcı Kayıt İşlemi */
	if (isset($_POST['userRegister'])) {

		$user_name=htmlspecialchars(trim($_POST['user_name']));
		$user_email=htmlspecialchars(trim($_POST['user_email']));
		$user_ip=ip_address();

		$passwordone=htmlspecialchars(trim($_POST['passwordone']));
		$passwordtwo=htmlspecialchars(trim($_POST['passwordtwo']));

		$first_name=htmlspecialchars(trim($_POST['first_name']));
		$surname=htmlspecialchars(trim($_POST['surname']));

		if (empty($user_name) || empty($passwordone) || empty($passwordtwo) || empty($user_email)) {
			header("Location:sing-up.php?status=empty_form");
		} else {

			if ($passwordone==$passwordtwo) {

				if (strlen($passwordone)>=6) {

					// Başlangıç

					$userASK=$db->prepare("SELECT * FROM users WHERE user_name=:name");
					$userASK->execute(array(
						'name' => $user_name
					));

					//dönen satır sayısını belirtir
					$count=$userASK->rowCount();

					if ($count==0) {

						//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
						$password=md5($passwordone);


						//Kullanıcı kayıt işlemi yapılıyor...
						$save_user=$db->prepare("INSERT INTO users SET
							user_name=:user_name,
							user_pass=:user_pass,
							user_email=:user_email,
							first_name=:first_name,
							surname=:surname,
							user_ip=:user_ip
						");
						$insert=$save_user->execute(array(
							'user_name' => $user_name,
							'user_pass' => $password,
							'user_email' => $user_email,
							'first_name' => $first_name,						
							'surname' => $surname,
							'user_ip' => $user_ip
						));

						if ($insert) {
							header("Location:sing-up.php?status=successful");
						} else {
							header("Location:sing-up.php?status=error");
						}
					} else {
						header("Location:sing-up.php?status=repeated");
					}

				// Bitiş

				} else {
					header("Location:sing-up.php?status=missing_password");
				}
			} else {
				header("Location:sing-up.php?status=different_password");
			}
		}	
	}


	//Ürün Satıcı Teslim
	if ($_GET['delete_message']=="ok") {

		$ayarkaydet=$db->prepare("UPDATE messages_sub SET
			delete_message=:delete_message
			WHERE sub_id={$_GET['sub_id']}");

		$update=$ayarkaydet->execute(array(
			'delete_message' => 1
		));

		if ($update) {

			Header("Location:messages.php?status=successful");

		} else {

			Header("Location:messages.php?status=error");

		}

	}




?>
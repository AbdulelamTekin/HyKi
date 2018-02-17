<?php require_once 'header.php'; ?>
<?php

	require_once 'config.php';
	require_once 'function.php';

	ob_start();
    session_start();

	$sendId = $_SESSION['userId'];
	$userId = intval($_GET['id']);
	$userinfo = userinfo($userId);

?>
	<?php

		if ($_POST) {
			date_default_timezone_set('Europe/Istanbul');
			$text = strip_tags($_POST['text']);
			$subject = strip_tags($_POST['subject']);
			$date = strtr(date("d, F, Y, l"), $turkceTarih).", Saat ".date('H:i');

			if ($text!="" || $subject!="") {

				$c = $db->query("SELECT * FROM messages WHERE 
					user_id='$userId' and send_id='$sendId' or user_id='$sendId' and send_id='$userId'")->rowCount();
				if ($c == 0) {
					
					$insert = $db->query("INSERT INTO messages(user_id,send_id) values ('$userId','$sendId') ");

					$last_id = $db->lastInsertId();
					
					$icerikinsert = $db->query("INSERT INTO 
						messages_sub(messages_id,message_subject,message_text,message_date,user_id)values('$last_id','$subject','$text','$date','$sendId')");

					if ($icerikinsert) {

						$db->query("UPDATE messages SET updateTime='".time()."' WHERE message_id='".$last_id."'");
						
						echo "<script>sweetAlert('TAMAM', 'Mesaj Gönderildi.', 'success');</script>";

					} else {

						echo "<script>sweetAlert('HATA', 'Mesaj Gönderilemedi.', 'error');</script>";

					}


				} else {

					$w = $db->query("SELECT * FROM messages WHERE 
					user_id='$userId' and send_id='$sendId' or user_id='$sendId' and send_id='$userId'")->fetch();

					$icerikinsert = $db->query("INSERT INTO 
						messages_sub(messages_id,message_subject,message_text,message_date,user_id)values('".$w['message_id']."','$subject','$text','$date','$sendId')");

					if ($icerikinsert) {

						$db->query("UPDATE messages SET updateTime='".time()."' WHERE message_id='".$w['message_id']."'");
						
						echo "<script>sweetAlert('TAMAM', 'Mesaj Gönderildi.', 'success');</script>";

					} else {

						echo "<script>sweetAlert('HATA', 'Mesaj Gönderilemedi.', 'error');</script>";

					}

				}
				
			} else {

				echo "<script>sweetAlert('UYARI', 'Lütfen tüm alanları doldurun.', 'warning');</script>";

			}

		}

	?>
	<div class="row">	
		<form action="" method="POST">
			<div class="tag">
				<label><?php echo $userinfo['user_name']; ?></label> 
				<i class="fa fa-arrow-right"></i>  Mesaj Gönder
			</div>
			<div class="space"></div>
			<div class="panel">
				<div class="form-group">
					<label class="control-label">Konu <b>*</b></label>
					<input type="text" name="subject" placeholder="Konu">
				</div>
				<div class="form-group bottom">
					<textarea name="text" placeholder="Mesajınız"></textarea>
				</div>
				<div class="form-group">
					<button value="sumbit">Gönder</button>
				</div>
			</div>
		</form>
	</div>
<?php require_once 'footer.php' ?>	
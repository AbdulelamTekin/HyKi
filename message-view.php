<?php require_once 'header.php'; ?>
<?php

	require_once 'config.php';
	require_once 'function.php';

	ob_start();
    session_start();

	$sendId = $_SESSION['userId'];
	$userId = $_GET['id'];
	$userinfo = userinfo($userId);
	
?>
	<?php

		if ($_POST) {
			date_default_timezone_set('Europe/Istanbul');
			$text = strip_tags($_POST['text']);
			$date = strtr(date("d, F, Y, l"), $turkceTarih).", Saat ".date('H:i');

			if ($text!="") {

				$c = $db->query("SELECT * FROM messages WHERE 
					user_id='$userId' and send_id='$sendId' or user_id='$sendId' and send_id='$userId'")->rowCount();
				if ($c == 0) {
					
					$insert = $db->query("INSERT INTO messages(user_id,send_id) values ('$userId','$sendId') ");

					$last_id = $db->lastInsertId();
					
					$icerikinsert = $db->query("INSERT INTO 
						messages_sub(messages_id,message_text,message_date,user_id)values('$last_id','$text','$date','$sendId')");

					if ($icerikinsert) {
				
						echo "<script>sweetAlert('TAMAM', 'Mesaj Gönderildi.', 'success');</script>";

					} else {

						echo "<script>sweetAlert('HATA', 'Mesaj Gönderilemedi.', 'error');</script>";

					}


				} else {

					$w = $db->query("SELECT * FROM messages WHERE 
					user_id='$userId' and send_id='$sendId' or user_id='$sendId' and send_id='$userId'")->fetch();

					$m_id = $w['message_id'];

					$icerikinsert = $db->query("INSERT INTO 
						messages_sub(messages_id,message_text,message_date,user_id)values('$m_id','$text','$date','$sendId')");

					if ($icerikinsert) {
						
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
				<div class="list">
					<textarea name="text"></textarea>
				</div>
				<div class="list">
					<button value="sumbit">Gönder</button>
				</div>
			</div>
		</form>
		<?php

			$w = $db->query("SELECT * FROM 
				messages WHERE user_id='$userId' and send_id='$sendId' or user_id='$sendId' and send_id='$userId'")->fetch(PDO::FETCH_ASSOC);

			$all = $db->query("SELECT * FROM 
				messages_sub WHERE messages_id={$w['message_id']} order by sub_id desc")->fetchAll(PDO::FETCH_ASSOC);

			foreach($all as $key => $value) {

				$userinfo = userinfo($value['user_id']);

		?>
		<div class="space"></div>
		<div class="panel">
			<b><?php echo $userinfo['user_name']; ?></b>: <?php echo $value['message_text']; ?>
		</div>
		<?php } ?>
	</div>
	<?php

	if ($all['message_seen']==0) {

		$mesajguncelle=$db->prepare("UPDATE messages_sub SET
			message_seen=:message_seen
			WHERE messages_id={$w['message_id']} or sub_id={$_GET['sub_id']} ");

		$update=$mesajguncelle->execute(array(

			'message_seen' => 1

		));
	}

	?>
<?php require_once 'footer.php' ?>
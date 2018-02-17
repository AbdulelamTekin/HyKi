<?php require_once 'header.php'; ?>

	<?php

		require_once 'config.php';
		require_once 'function.php';

		$sendId = $_SESSION['userId'];
		$list = $db->query("SELECT * FROM messages WHERE user_id='$sendId' or send_id='$sendId' order by updateTime desc ")->fetchAll(PDO::FETCH_ASSOC);
		

	?>
	<div class="row">
		<div class="panel">
			<?php if ($_GET['status']=="error") { ?> 	
	             
	            <div class="alert alert-danger">
	                <strong><i class="fa fa-exclamation-triangle fa-lg"></i> Hata!</strong> Mesaj silinemedi.
	            </div>
	            <div class="space"></div>

	        <?php } else if ($_GET['status']=="successful") { ?>
	             
	            <div class="alert alert-success">
	                <strong><i class="fa fa-exclamation-triangle fa-lg"></i> Bilgi!</strong> Mesaj Başarıyla silindi
	            </div>
	            <div class="space"></div>

	        <?php } ?>
			<table id="customers">
				<tr>
					<th>Ad</th>
					<th>Mesaj</td>
					<th>Tarih</th>
					<th>Detay</th>
					<th></th>
				</tr>
				<?php

					foreach($list as $key => $value) {

						if ($value['user_id'] == $sendId)  {

							$useId = $value['send_id'];

						} else { 

							$useId = $value['user_id']; 

						}

						$userinfo = userinfo($useId);

						$sonmesaj = $db->query("SELECT * FROM messages_sub WHERE messages_id={$value['message_id']} order by sub_id,message_seen desc limit 0,01")->fetch(PDO::FETCH_ASSOC);

						$date = $sonmesaj['message_date'];
						$plenty = explode(",",$date);
						$combine = $plenty[0].$plenty[1].",".$plenty[3];

				?>
				<tr>
					<td><?php echo $userinfo['user_name']; ?></td>
					<td><?php echo substr($sonmesaj['message_subject'], 0,20) ?></td>
					<td><?php echo $combine; ?></td>	
					<td><a href="message-view.php?id=<?php echo $useId; ?>&sub_id=<?php echo $sonmesaj['sub_id'] ?>">Mesaj <i class="fa fa-envelope"></i></a></td>
					<td>
						<a href="user.class.php?delete_message=ok&sub_id=<?php echo $sonmesaj['sub_id'] ?>"><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>
				<?php } ?>
			</table>
			
		</div>
	</div>
<?php require_once 'footer.php' ?>
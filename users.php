<?php require_once 'header.php'; ?>

<?php

	require_once 'config.php';
	require_once 'function.php';

	ob_start();
    session_start();

    //Belirli veriyi seçme işlemi
	$userASK=$db->query("SELECT * FROM users");
	$userASK->execute();


	$sendId = $_SESSION['userId'];
	
?>
	<div class="row">
		<?php if ($_GET['status']=="successful") { ?> 	

            <div class="alert alert-success">
                <strong><i class="fa fa-info-circle fa-lg"></i> Bilgi!</strong> Giriş yapıldı
            </div>
            <div class="space"></div>

        <?php } ?>
		<div class="panel">
			
			<?php if($userASK->rowCount() > 0) { ?>
			<table id="customers">
				<tr>
					<th>Kullanıcı Ad</th>
					<th>E-Posta</td>				
					<th>Detay</th>
				</tr>
				<?php while($userCzech=$userASK->fetch(PDO::FETCH_ASSOC)) { ?>
				<?php if($userCzech["user_id"] != $_SESSION['userId']) { ?>	
				<tr>
					<td><?php echo $userCzech['user_name']; ?></td>
					<td><?php echo $userCzech['user_email']; ?></td>
					<td><a href="chat.php?id=<?php echo $userCzech['user_id']; ?>">Mesaj <i class="fa fa-envelope"></i></a></td>
				</tr>
				<?php } } ?>
			</table>
	        <?php } else { ?>
	        <div class="alert alert-warning">	
	        	Henüz Sıparişiniz Yok
	        </div>
	        <?php } ?>
		</div>
	</div>
<?php require_once 'footer.php' ?>
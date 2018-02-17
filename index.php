<?php require_once 'header.php'; ?>
<?php if (isset($_SESSION['userId'])) { ?>
<?php require_once 'users.php'; ?>
<?php }else { ?> 
	<div class="row">
		<form action="user.class.php" method="POST">
			<div class="space"></div>
	        <?php if ($_GET['status']=="error") { ?> 	
	             
	            <div class="alert alert-danger">
	                <strong><i class="fa fa-exclamation-triangle fa-lg"></i> Hata!</strong> Hatalı Giriş.
	            </div>
	            <div class="space"></div>

	        <?php } else if ($_GET['status']=="warning") { ?>
	             
	            <div class="alert alert-warning">
	                <strong><i class="fa fa-exclamation-triangle fa-lg"></i> Bilgi!</strong> Lütfen tüm form alanlarını doldurun
	            </div>
	            <div class="space"></div>

	        <?php } else if ($_GET['status']=="exit") { ?>
	             
	            <div class="alert alert-success">
	                <strong><i class="fa fa-info-circle fa-lg"></i> Bilgi!</strong> Başarılı bir şekilde çıkış yapıldı.
	            </div>
	            <div class="space"></div>

	        <?php } ?>
			<div class="panel">			
				<div class="col-lg-3">				
					<div class="form-group group-right">
						<label class="control-label">Kullanıcı adı</label>
						<input type="text" name="user_email" placeholder="Kullanıcı adı">					
					</div>
				</div>
				<div class="col-lg-3">				
					<div class="form-group group-left">
						<label class="control-label">Şifre</label>				
						<input type="password" name="user_pass" placeholder="Şifre">									
					</div>
				</div>
				<div class="form-group">
					<button value="sumbit" name="userLogin">Giriş Yap <i class="fa fa-sign-in"></i></button>
				</div>
			</div>
		</form>
	</div>
<?php } ?>	
<?php require_once 'footer.php' ?>
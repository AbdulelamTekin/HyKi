
<?php require_once 'header.php'; ?>
	<div class="row">
		<form action="user.class.php" method="POST">
			<div class="space"></div>
	        <?php if ($_GET['status']=="error") { ?> 	

	            <div class="alert alert-danger">
	                <strong>Hata!</strong> Kayıt Yapılamadı Sistem Yöneticisine Danışınız.
	            </div>
	            <div class="space"></div>

	        <?php } else if ($_GET['status']=="successful") { ?>
	             
	            <div class="alert alert-success">
	                <strong>Bilgi!</strong> Başarıyla kayıt olundu. <a href="index.php">Giriş yap</a>.
	            </div>
	            <div class="space"></div>

	        <?php } else if ($_GET['status']=="repeated") { ?>
	             
	            <div class="alert alert-warning">
	                <strong>Bilgi!</strong> Bu kullanıcı daha önce kayıt edilmiş.
	            </div>
	            <div class="space"></div>

	        <?php } else if ($_GET['status']=="missing_password") { ?>
	             
	            <div class="alert alert-warning">
	                <strong>Bilgi!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
	            </div>
	            <div class="space"></div>

	        <?php } else if ($_GET['status']=="different_password") { ?>
	             
	            <div class="alert alert-warning">
	                <strong>Bilgi!</strong> Girdiğiniz şifreler eşleşmiyor.
	            </div>
	            <div class="space"></div>

	        <?php } else if ($_GET['status']=="empty_form") { ?>
	             
	            <div class="alert alert-warning">
	                <strong>Bilgi!</strong> Formda boş alan mevcut. <br> Lütfen tüm (<b>*</b>) zorunlu anlanları doldurun
	            </div>
	            <div class="space"></div>

	        <?php } ?>
			<div class="panel">
				<div class="form-group">
					<label class="control-label">Kullanıcı adı <b>*</b></label>
					<input type="text" name="user_name" placeholder="Kullanıcı adı">
				</div>
				<div class="col-lg-3">				
					<div class="form-group group-right">
						<label class="control-label">Şifre <b>*</b></label>
						<input type="password" name="passwordone" placeholder="Şifre">					
					</div>
				</div>
				<div class="col-lg-3">				
					<div class="form-group group-left">
						<label class="control-label">Şifre tekrar <b>*</b></label>				
						<input type="password" name="passwordtwo" placeholder="Şifre tekrar">									
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Mail Adresiniz <b>*</b></label>
					<input type="text" name="user_email" placeholder="Mail Adresiniz">
				</div>
				<div class="col-lg-3">				
					<div class="form-group group-right">
						<label class="control-label">Adınız</label>
						<input type="text" name="first_name" placeholder="Adınız">					
					</div>
				</div>
				<div class="col-lg-3">				
					<div class="form-group group-right">
						<label class="control-label">Soyadınız</label>
						<input type="text" name="surname" placeholder="Soyadınız">					
					</div>
				</div>
				<div class="form-group">
					<button value="sumbit" name="userRegister">Kaydol</i></button>
				</div>
			</div>
		</form>
	</div>
<?php require_once 'footer.php' ?>
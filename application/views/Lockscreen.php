<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title><?=$title?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/vendor/bootstrap/css/bootstrap.min.css'?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/vendor/font-awesome/css/font-awesome.min.css'?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/vendor/linearicons/style.css'?>">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/main.css'?>">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box lockscreen clearfix">
					<div class="content">
						<?php if($success == 0){ ?>
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<i class="fa fa-info-circle"></i> Ohh Snap! You enter a wrong Password. Try again!
							</div>
						<?php } ?>
						<?php
							$imgs = null;
							if(strlen($this->session->userdata('user_image')) > 40){
								$imgs = $this->session->userdata('user_image');
							}else{
								$imgs = base_url().'uploads/'.$this->session->userdata('user_image');
						} ?>
						<div class="logo text-center"><img src="<?php echo base_url().'assets/img/pigpro100.png'?>" alt="Klorofil Logo" height="70" width="120"></div>
						<div class="user text-center" style="margin-top: -20px">
							<img src="<?=$imgs?>" class="img-circle" alt="Avatar" width="200" height="200">
							<h2 class="name"><?=$this->session->userdata('fname')." ". $this->session->userdata('lname')?></h2>
						</div>
						<form method="post" action="<?=base_url()?>Admins/lockScreen">
							<div class="input-group">
								<input type="password" name="lspassword" id="lspassword" class="form-control" placeholder="Enter your password ...">
								<span class="input-group-btn"><button type="submit" class="btn btn-primary" id="lockscreenbutton"><i class="fa fa-arrow-right"></i></button></span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>

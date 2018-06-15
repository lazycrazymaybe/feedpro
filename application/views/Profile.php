<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?=base_url()?>Admins/dashboard" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="<?=base_url()?>Admins/users" class=""><i class="lnr lnr-users"></i> <span>Users</span></a></li>
				<li><a href="<?=base_url()?>Admins/logs" class=""><i class="fa fa-list-alt"></i> <span>Logs</span></a></li>
				<li><a href="<?=base_url()?>Admins/feeds" class=""><i class="lnr lnr-inbox"></i> <span>Feeds</span></a></li>
				<!-- <li>
					<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Pages</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="subPages" class="collapse ">
						<ul class="nav">
							<li><a href="page-profile.html" class="">Profile</a></li>
							<li><a href="page-login.html" class="">Login</a></li>
							<li><a href="page-lockscreen.html" class="">Lockscreen</a></li>
						</ul>
					</div>
				</li> -->
			</ul>
		</nav>
	</div>
</div>
<!-- END LEFT SIDEBAR
	<!-- MAIN -->
<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-profile">
				<div class="clearfix">
					<!-- PROFILE HEADER -->
					<div class="profile-header">
						<div class="overlay"></div>
						<div class="profile-main">
							<?php
								$imgs = null;
								if(strlen($this->session->userdata('user_image')) > 40){
									$imgs = $this->session->userdata('user_image');
								}else{
									$imgs = base_url().'uploads/'.$this->session->userdata('user_image');
							} ?>
							<img src="<?=$imgs?>" class="img-circle" alt="Avatar" width="150" height="150"> 
							<h3 class="name"><?=$this->session->userdata('fname')." ".$this->session->userdata('lname')?></h3>
							<h3 class="name"><?=$this->session->userdata('username')?></h3>
							<span class="label label-primary">Administrator</span>
							<p></p>
							<div class="text-center"><a href="#" data-toggle="modal" data-target="#edit-data" id="<?=$this->session->userdata('userID')?>" class="btn btn-primary edit-data"><span class="lnr lnr-pencil"></span> &nbsp;Edit Profile</a></div>
						</div>
					</div>
					<!-- END PROFILE HEADER -->
					<!-- MODAL -->
						<div id="edit-data" class="modal fade">
						  <div class="modal-dialog">
						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title text-center">Update Profile</h4>
						      </div>
						      <div class="modal-body">
						        <form method="post" id="user-form" novalidate>
						        	<div class="form-group">
										    <label for="fname">First Name</label>
										    <input type="input" class="form-control" name="fname" id="fname" aria-describedby="firstName" placeholder="First Name" required>
										  </div>
									   	<div class="form-group">
										    <label for="lname">Last Name</label>
										    <input type="input" class="form-control" name="lname" id="lname" aria-describedby="lastName" placeholder="Last Name">
										</div>
										<div class="form-group">
											<label for="username">Username</label>
										    <input type="input" class="form-control" name="username" id="username" aria-describedby="username" placeholder="Username">
										</div>
										<div class="form-group">
										    <label for="password">Password</label>
										    <input type="password" class="form-control" name="password" id="password" aria-describedby="password" placeholder="Passowrd">
										</div>
										<input type="file" name="user_image" id="user_image">
										<span id="user_uploaded_image" style="margin-top: 20px;"></span>
						      </div>
							      <div class="modal-footer">
							      	<input type="hidden" class="form-control" name="option" id="option">
							      	<input type="hidden" class="form-control" name="isActive" id="isActive"> 	
							      	<input type="hidden" class="form-control" name="userType" id="userType">
							      	<input type="hidden" class="form-control" name="userID" id="userID">
							      	<input type="hidden" class="form-control" name="date" id="date">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							        <input type="submit" id="action" name="action" value="Update" class="btn btn-primary"/>
							      </div>
						     		</form>

						    </div>

						  </div>
						</div>
						<!-- MODAL -->
				</div>
			</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->

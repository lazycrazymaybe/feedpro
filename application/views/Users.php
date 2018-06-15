<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?=base_url()?>Admins/dashboard" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="<?=base_url()?>Admins/users" class="active"><i class="lnr lnr-users"></i> <span>Users</span></a></li>
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
				</li>
				<li><a href="tables.html" class=""><i class="lnr lnr-dice"></i> <span>Tables</span></a></li> -->
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
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">FeedPro User List</h3>
						<div class="right">
							<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
						</div>
						<button type="button" id="createUser" data-toggle="modal" data-target="#edit-data" class="btn btn-primary" style="margin-top:10px;background-color:#00AAFF;width: 80px; height: 30px;"><i class="fa fa-plus"></i> Create </button>
					</div>
					<div class="panel-body no-padding">
						<table id="userTable" class="table table-hover">
							<thead>
								<tr>
									<th>User ID</th>
									<th>Name</th>
									<th>Username</th>
									<th>Date &amp; Time</th>
									<th>User Type</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
						<!-- MODAL -->
						<div id="edit-data" class="modal fade">
						  <div class="modal-dialog">
						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 id="modalTitle" class="modal-title text-center">Update User</h4>
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
										    <input type="password" class="form-control" name="password" id="password" aria-describedby="password" placeholder="Passowrd" readonly>
										</div>
										<div class="form-group">
										  	<label for="userType">User Type</label>
												<select class="form-control" aria-describedby="userType" name="userType" id="userType">
											  	<?php $userType = array("User"=>"User","Admin"=>"Admin");
											  	  foreach($userType as $key => $value){ echo $key;?>
												  	<option value="<?=$key?>"><?=$value?></option>
												  	<?php } ?>
												</select>
										</div>
										<input type="checkbox" name="isActive" id="isActive" data-toggle="toggle" data-on="Activate" data-off="Deactivate" data-size="small">
										<label  id="resetWord" style="margin-left: 40px;" class="label label-default">Reset Password</label>
										<button type="button" class="btn btn-primary edit-data" name="resetPass" id="resetPass" style="margin-left:5px; height: 30px;"><i class="fa fa-refresh"></i></button>
										<input type="file" name="user_image" id="user_image" class="hide-file-upload">
						      </div>
							      <div class="modal-footer">
							      	<input type="hidden" class="form-control" name="option" id="option" aria-describedby="user_id">
							      	<input type="hidden" class="form-control" name="userID" id="userID" aria-describedby="user_id">
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
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i><?= date('F d, Y')?></span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->


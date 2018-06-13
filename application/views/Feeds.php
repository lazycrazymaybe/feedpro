<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?=base_url()?>Admins/dashboard" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="<?=base_url()?>Admins/users" class=""><i class="lnr lnr-users"></i> <span>Users</span></a></li>
				<li><a href="<?=base_url()?>Admins/logs" class=""><i class="fa fa-list-alt"></i> <span>Logs</span></a></li>
				<li><a href="<?=base_url()?>Admins/feeds" class="active"><i class="lnr lnr-inbox"></i> <span>Feeds</span></a></li>
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
						<h3 class="panel-title">Localy available Feeds</h3>
						<div class="right">
							<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
						</div>
					</div>
					<div class="panel-body no-padding">
						<table id="feedTable" class="table table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Protein</th>
									<th>Fiber</th>
									<th>Fat</th>
									<th>Calcium</th>
									<th>Moisture</th>
									<th>Phosphorous</th>
									<th>Maximum Inclusion</th>
									<th>Cost Per Kilo</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
						<!-- MODAL -->
						<div id="change-price" class="modal fade">
						  <div class="modal-dialog">
						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 id="modalTitle" class="modal-title text-center">Change Price</h4>
						      </div>
						      <div class="modal-body">
						        <form method="post" id="change-pass-form" novalidate>
						        	<div class="form-group">
										    <label for="cost">Change Price</label>
										    <input type="number" min="0" class="form-control" name="cost" id="cost" aria-describedby="cost" required>
										  </div>
						      </div>
							      <div class="modal-footer">
							      	<input type="hidden" class="form-control" name="feedID" id="feedID">
							      	<input type="hidden" class="form-control" name="feedName" id="feedName">
							      	<input type="hidden" class="form-control" name="crudeProtein" id="crudeProtein">
							      	<input type="hidden" class="form-control" name="crudeFiber" id="crudeFiber">
							      	<input type="hidden" class="form-control" name="crudeFat" id="crudeFat">
							      	<input type="hidden" class="form-control" name="Calcium" id="Calcium">
							      	<input type="hidden" class="form-control" name="Moisture" id="Moisture">
							      	<input type="hidden" class="form-control" name="Phosphorous" id="Phosphorous">
							      	<input type="hidden" class="form-control" name="maximumInclusion" id="maximumInclusion">
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
							<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i>Last updated on <?= date('F d, Y')?></span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->
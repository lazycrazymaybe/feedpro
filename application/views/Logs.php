<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="<?=base_url()?>Admins/dashboard" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
				<li><a href="<?=base_url()?>Admins/users" class=""><i class="lnr lnr-users"></i> <span>Users</span></a></li>
				<li><a href="<?=base_url()?>Admins/logs" class="active"><i class="fa fa-list-alt"></i> <span>Logs</span></a></li>
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
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">FeedPro Feed Logs
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
							</div>
						</div>
						<div class="panel-body no-padding">
							<table id="feedLogs" class="table table-hover">
								<thead>
									<tr>
										<th width="15%">Log ID</th>
										<th width="15%">Username</th>
										<th width="15%">Weight</th>
										<th width="15%">Date &amp; Time</th>
										<th width="15%">Cost</th>
										<th width="30%">Comment</th>
									</tr>
								</thead>
							</table>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Today <?= date('M d, Y')?></span></div>
								<div class="col-md-6 text-right"><a href="#" class="btn btn-primary">View All Logs</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


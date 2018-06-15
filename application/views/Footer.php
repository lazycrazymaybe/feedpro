<div class="clearfix"></div>
<footer>
	<div class="container-fluid">
		<p class="copyright">&copy; 2018 <a href="#" target="_blank">FeedPro</a>. All Rights Reserved.</p>
	</div>
</footer>
</div>
<!-- END OF WRAPPER -->
<!-- SCRIPTS -->
<script src="<?php echo base_url().'assets/vendor/jquery/jquery.min.js'?>"></script>
<script src="<?php echo base_url().'assets/vendor/bootstrap/js/bootstrap.min.js'?>"></script>
<script src="<?php echo base_url().'assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js'?>"></script>
<!-- <script src="<?php echo base_url().'assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js'?>"></script> -->
<script src="<?php echo base_url().'assets/vendor/chartist/js/chartist.min.js'?>"></script>
<script src="<?php echo base_url().'assets/scripts/klorofil-common.js'?>"></script>
<script src="<?php echo base_url().'assets/vendor/bootstrap/js/bootstrap-toggle.min.js'?>"></script>
<script src="<?php echo base_url().'assets/vendor/jquery/jquery.dataTables.min.js'?>"></script>
<script src="<?php echo base_url().'assets/vendor/bootstrap/js/dataTables.bootstrap.min.js'?>"></script>
<script src="<?php echo base_url().'assets/vendor/toastr/toastr.min.js'?>"></script>
<!-- END SCRIPTS -->
<script>
	$(function() {
		var data, options;

		// visits trend charts
		data = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			series: [{
				name: 'series-real',
				data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
			}]
		};
		options = {
			fullWidth: true,
			lineSmooth: false,
			height: "270px",
			low: 0,
			high: 'auto',
			series: {
				'series-real': {
					showArea: true,
					showPoint: true,
					showLine: true
				},
			},
			axisX: {
				showGrid: true,

			},
			axisY: {
				showGrid: false,
				onlyInteger: true,
				offset: 0,
			},
			chartPadding: {
				left: 20,
				right: 20
			}
		};
		new Chartist.Line('#visits-trends-chart', data, options);
	});
$(document).ready(function(){
	// START OF USERS
	var dataTables = $('#userTable').DataTable({
	    "processing":true,  
	    "serverSide":true,  
	    "order":[],
	    "ajax":{  
            url:"<?=base_url()?>Admins/getRecentRegistrationsAjax",  
            type:"POST"  
        }, 
       "columnDefs":[  
            {  
                 "targets":[5, 6],  
                 "orderable":false,  
            },  
       ],  
	});
	$(document).on('submit','#user-form', function(event){
		event.preventDefault();
		var defaultImage = "default.png";
		var userID = $('#userID').val();
		var fname = $('#fname').val();
		var lname = $('#lname').val();
		var username = $('#username').val();
		var password = $('#password').val();
		var isActive = $('#isActive').val();
		var userType = $('#userType').val();
		var date = $('#date').val();
		var extension = $('#user_image').val().split('.').pop().toLowerCase();
		var url = "<?=base_url()?>Admins/"+$('#option').val();
		console.log(url);
		console.log(extension);
		if(extension != ''){
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1 ){  
		        $('#user_image').val('');  
		       	$context = 'error';
				$message = 'Not an Image file or file is not supported';
				$position = 'top-right';
				toastr.remove();
				toastr[$context]($message, '' , { position: $position });
		    }  
		}
		
		if(fname != "" && lname != "" && username != ""){
			if(fname.length >= 3 && lname.length >= 3 && username.length >= 4){
				$.ajax({
					url:url,
					method:"POST",
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data){
						console.log(data);
						if(data == "created"){
							$('#user-form')[0].reset();
							$('#edit-data').modal('hide');
							dataTables.ajax.reload();  
							$context = 'success';
							$message = "User created successfully";
							$position = 'top-right';
							toastr.remove();
							toastr[$context]($message, '' , { position: $position });
							prevPass = null;
							load_counter();
						}
						else if(data == "successsuccess admin"){
							location.reload();  
							$('#user-form')[0].reset();
							$('#edit-data').modal('hide');
							prevPass = null;
							load_counter();
						}
						else if(data == "duplicate"){
							$context = 'error';
							$message = 'Not Updated! Duplicate "Username" entry';
							$position = 'top-right';
							toastr.remove();
							toastr[$context]($message, '' , { position: $position });
						}
						else if(data == "duplicatedCreation"){
							$context = 'error';
							$message = "Not created username already taken. Try again!";
							$position = 'top-right';
							toastr.remove();
							toastr[$context]($message, '' , { position: $position });
						}
						else{
							$('#user-form')[0].reset();
							$('#edit-data').modal('hide');
							dataTables.ajax.reload();  
							$context = 'success';
							$message = 'User Successfully Updated!';
							$position = 'top-right';
							toastr.remove();
							toastr[$context]($message, '' , { position: $position });
							prevPass = null;
							load_counter();
						}
					}
				});
			}else{
				$context = 'error';
				$message = 'Every field has a character minimum requirement	!';
				$position = 'top-right';
				toastr.remove();
				toastr[$context]($message, '' , { position: $position });
			}
		}else{
			$context = 'error';
			$message = 'No field should be left empty!';
			$position = 'top-right';
			toastr.remove();
			toastr[$context]($message, '' , { position: $position });
		}
	});

	$('#isActive').change(function(){
		cb = $(this);
		if(cb.val() == "0"){
			cb.val(1)
		}else{
			cb.val(0)
		}
	});

	$(document).on('click','.edit-data', function(){
		var userID = $(this).attr("id");
		console.log(userID);
		$.ajax({
			url:"<?= base_url()?>Admins/fetchUser",
			method: "POST",
			data:{userID:userID},
			dataType:'json',
			success:function(data){
				$('#myModal').modal('show');
				$('#userID').val(data.userID);
				$('#fname').val(data.fname);
				$('#lname').val(data.lname);
				$('#username').val(data.username);
				$('#password').val(data.password);
				$('#userType').val(data.userType);
				$('#isActive').val(data.isActive);
				$('#date').val(data.date);
				$('#user_uploaded_image').html(data.img);
				if(data.isActive == "1"){
					$('#isActive').prop('checked',true).change();
				}else{
					$('#isActive').prop('checked',false).change();
				}
				if($('#password').val() == "123"){
					$('#resetPass').attr("disabled", "disabled");
					$('#resetWord').text("Password has been reset");	
					$('#resetWord').removeClass("label label-warning");	
					$('#resetWord').addClass("label label-info");
				}else{
					$('#resetWord').text("Reset Password");	
					$('#resetWord').removeClass("label label-info");	
					$('#resetWord').addClass("label label-default");
					$('#resetPass').removeAttr("disabled");
				}
				$('#action').val('Update');
				$('#resetPass').show();
				$('#resetWord').show();
				$('#option').val('updateUser');
				$('#modalTitle').text('Update User');
				console.log(userID);
			}
		});
	});
	// END OF USERS
	// START OF DAILY LOGS
	var dataTables1 = $('#feedLogs').DataTable({
	    "processing":true,  
	    "serverSide":true,  
	    "order":[],
	    "ajax":{  
            url:"<?=base_url()?>Admins/getDailyLogsAjax",  
            type:"POST"  
        }, 
       "columnDefs":[  
            {  
                 "targets":[5],  
                 "orderable":false,  
            },  
       ],  
	});
	// END OF DAILY LOGS
	// USER PAGE
	//--Reset Password Acion--
	var prevPass;
	$('#resetPass').on('click',function(){
		console.log($('#password').val());
		if($('#password').val() != "123"){
			prevPass = $('#password').val();
		}
		if($('#resetWord').text() == "Reset Password"){
			$('#resetWord').text("Undo Reset");	
			$('#resetWord').removeClass("label label-default");	
			$('#resetWord').addClass("label label-warning");	
			$('#password').val("123");
		}
		else if($('#resetWord').text() == "Undo Reset"){
			$('#resetWord').text("Reset Password");
			$('#resetWord').removeClass("label label-warning");	
			$('#resetWord').addClass("label label-default");	
			$('#password').val(prevPass);
		}
	});
	//--Create New User Action--
	$('#createUser').on('click',function(){
		$('#action').val('Create');
		$('#fname').val("");
		$('#lname').val("");
		$('#username').val("");
		$('#password').val("");
		$('#userType').val("User");
		$('#isActive').prop('checked',true).change();
		$('#password').prop('readonly',false);
		$('#resetPass').hide();
		$('#resetWord').hide();
		$('#option').val('createUser');
		$('#modalTitle').text('Create New User');
		console.log('Creating User.');
	});
	// END OF USER PAGE
	// FEED PAGE
	var dataTables2 = $('#feedTable').DataTable({
		"lengthChange":false,
		"paging":false,
	    "processing":true,  
	    "serverSide":true,  
	    "order":[],
	    "ajax":{  
            url:"<?=base_url()?>Admins/getAllFeedDataAjax",  
            type:"POST"  
        }, 
       "columnDefs":[  
            {  
                 "targets":[9],  
                 "orderable":false,  
            },  
       ],  
	});
	$(document).on('click','.edit-price',function(){
		var feedID = $(this).attr("id");
		console.log(feedID);
		$.ajax({
			url:'<?=base_url()?>Admins/fetchFeed',
			method:'POST',
			data:{feedID:feedID},
			dataType:'json',
			success:function(data){
				$('#feedID').val(data.feedID);
				$('#feedName').val(data.feedName);
				$('#crudeProtein').val(data.crudeProtein);
				$('#crudeFiber').val(data.crudeFiber);
				$('#crudeFat').val(data.crudeFat);
				$('#Calcium').val(data.Calcium);
				$('#Moisture').val(data.Moisture);
				$('#Phosphorous').val(data.Phosphorous);
				$('#maximumInclusion').val(data.maximumInclusion);
				$('#cost').val(data.costPerKilo);
			}
		});
	});
	$(document).on('submit','#change-pass-form', function(event){
		event.preventDefault();
		if($('#cost').val() <= 0){
			$context = 'warning';
			$message = 'Cost must not be less that or equal to zero!';
			$position = 'top-right';
			toastr.remove();
			toastr[$context]($message, '' , { position: $position });
		}else{
			$.ajax({
			url:'<?=base_url()?>Admins/updateFeed',
			method:"POST",
			data:new FormData(this),
			contentType:false,
			processData:false,
			success:function(data){	
				if(data == "successful"){
					$('#change-price').modal('hide');
					dataTables2.ajax.reload();  
					$context = 'success';
					$message = 'Feed Is Successfully Updated!';
					$position = 'top-right';
					toastr.remove();
					toastr[$context]($message, '' , { position: $position });
				}else{
					$context = 'error';
					$message = 'Failed to update feed. Try again!';
					$position = 'top-right';
					toastr.remove();
					toastr[$context]($message, '' , { position: $position });
				}
			}
			});
		}
		
	});
	// END OF FEED PAGE
	// START OF NOTIFICATION
	function load_counter(){
		$.ajax({
			url:'<?= base_url()?>Admins/getNotifications',
			method:'POST',
			data: {view:'naa'},
			dataType: 'json',
			success:function(data){
				$('#notification').html(data.notifications);
				$('#notificationCount').html(data.counter);
				console.log(data);
			}
		});
	}
	load_counter();

	$('#peakNotifications').on('click',function(){
		$('#notificationCount').html("0");
		$.ajax({
			url:'<?= base_url()?>Admins/readNotification',
			method:'POST',
			data: {view:'naa'},
			dataType: 'json',
			success:function(data){
				console.log(data);
			}
		});
	});
	// });
	// END OF NOTIFICATION
	
});

	</script>
		</body>
	<!-- END BODY -->
</html>
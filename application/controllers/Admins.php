<?php  


	class Admins extends CI_Controller{

		function __construct(){
			parent:: __construct();
			$this->load->model('Admin');
			date_default_timezone_set('Asia/Manila');
		}

		public function trial(){
			$catcher = $this->Admin->makeDatatablesDailyLogs();
			print_r($catcher);
			$temp = array();
			foreach($catcher as $value){
				foreach($value as $date){
					$exp = explode("-",$date);
					$temp[] = $exp[1];
				}
			}
			print_r($temp);
		}

		public function index(){
			$this->load->helper('form');
			$data["title"]="FeedPro Web Management";
			$data["success"] = 1;
			if($this->input->post()){
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$login = $this->Admin->login($username,$password,"Admin");
				if($login){
					$this->session->set_userdata('username',$login[0]['username']);
					$this->session->set_userdata('fname',$login[0]['fname']);
					$this->session->set_userdata('lname',$login[0]['lname']);
					$this->session->set_userdata('userID',$login[0]['userID']);
					$this->session->set_userdata('password',$login[0]['password']);
					$this->session->set_userdata('user_image',$login[0]['img']);
					$data["success"] = 1;
					echo $this->session->userdata('user_image');
					print_r($login);
					redirect(base_url().'Admins/dashboard');
				}else{
					$data["success"] = 0;
				}
			}	
			$this->load->view('Login',$data);
		}

		public function dashboard(){
			$data['title'] = "FeedPro Dashboard";
			$data['userCount'] = $this->Admin->userCounter();
			$data['registerCount'] = $this->getMonthlyReg();
			$data['logCount'] = $this->getMonthlyLogs();
			$data['getGetFirstDayOfLastMonth'] = date('M d, Y',strtotime("first day of last month"));
			$data['getGetLastDayOfLastMonth'] = date('M d, Y',strtotime("last day of last month"));
			$data['thisMonth'] = date('F',strtotime('this month'));
			$data['thisMonthsRegs'] = $this->Admin->getNewRegistrarions();
			$data['thisDaysLogs'] = $this->Admin->getNewLogs();
			if($this->session->userdata('username') == "lskey"){
				$data['title'] = "FeedPro | Lock Screen";
				$data['success'] = 1;
				$this->load->view('Lockscreen',$data);
				$this->load->view('Footer',$data);
			}
			else if($this->session->userdata('username') !== null){
				$this->load->view('Header',$data);
				$this->load->view('Dashboard',$data);
				$this->load->view('Footer',$data);
			}else{
				redirect(base_url()."Admins");
			}
		}

		public function getRecentRegistrationsAjax(){
			$holder = $this->Admin-> make_datatables();
			$data = array();
			foreach ($holder as $value) {
				$sub_array = array();
				$sub_array[] = $value['userID']; 
				$sub_array[] = $value['lname'].", ".$value['fname']; 
				$sub_array[] = $value['username']; 
				$sub_array[] = $value['date']; 
				$sub_array[] = $value['userType']; 
				if($value['isActive'] == 1){
					$sub_array[] = '<span class="label label-success">Active</span>';
				}else{
					$sub_array[] = '<span class="label label-danger">Deactivate</span>';
				}
				$sub_array[] = '<button type="button" data-toggle="modal" data-target="#edit-data" class="btn btn-primary edit-data" id="'.$value['userID'].'" style="margin-left:-6px;"><i class="fa fa-edit"></i></button>';
				$data[] = $sub_array;
			}
			$output = array(  
	            "draw"=>intval($_POST["draw"]),  
	            "recordsTotal"=>$this->Admin->getAllData(),  
	            "recordsFiltered"=>$this->Admin->getFilteredData(),  
	            "data"=>$data  
           );  
			echo json_encode($output);
		}

		public function getDailyLogsAjax(){
			$holder = $this->Admin->makeDatatablesDailyLogs();
			$data = array();
			foreach ($holder as $value) {
				$sub_array = array();
				$sub_array[] = $value['logID'];
				$sub_array[] = $value['username'];
				$sub_array[] = $value['weight'];
				$sub_array[] = $value['date'];
				$sub_array[] = $value['cost'];
				$sub_array[] = $value['comment'];
				$data[] = $sub_array;
			}
			$output = array(  
	            "draw"=>intval($_POST["draw"]),  
	            "recordsTotal"=>$this->Admin->getAllDataDailyLogs(),  
	            "recordsFiltered"=>$this->Admin->getFilteredDataDailyLogs(),  
	            "data"=>$data  
           );  
			echo json_encode($output);
		}

		public function getAllFeedDataAjax(){
			$holder = $this->Admin->makeDatatablesFeeds();
			$data = array();
			foreach ($holder as $value) {
				$sub_array = array();
				$sub_array[] = $value['feedName'];
				$sub_array[] = $value['crudeProtein'];
				$sub_array[] = $value['crudeFiber'];
				$sub_array[] = $value['crudeFat'];
				$sub_array[] = $value['Calcium'];
				$sub_array[] = $value['Moisture'];
				$sub_array[] = $value['Phosphorous'];
				$sub_array[] = $value['maximumInclusion'];
				$sub_array[] = $value['costPerKilo'];
				$sub_array[] = '<button type="button" data-toggle="modal" data-target="#change-price" class="btn btn-primary edit-price" id="'.$value['feedID'].'" style="margin-left:-6px;"><i class="fa fa-edit"></i></button>';
				$data[] = $sub_array;
			}
			$output = array(  
	            "draw"=>intval($_POST["draw"]),  
	            "recordsTotal"=>$this->Admin->getAllDataFeeds(),  
	            "recordsFiltered"=>$this->Admin->getFilteredFeeds(),  
	            "data"=>$data  
            );  
			echo json_encode($output);
		}

		protected function getMonthlyReg(){
			$now = time();
			$date = date('Y-m-d',$now);
			$disect = explode("-",$date);
			if($disect[1] == 01){
				$disect[0] = $disect[0]-1;
				$disect[1] = 12;
				$makeTime = mktime(0,0,0,$disect[1],$disect[2],$disect[0]);
				$date = date('Y-m',$makeTime);
			}else{
				$makeTime = mktime(0,0,0,$disect[1]-1,0,$disect[0]);
				$date = date('Y-m',$makeTime);
			}
			$data = $this->Admin->getMonthlyRegCount($date);
			return $data;
		}

		protected function getMonthlyLogs(){
			$now = time();
			$date = date('Y-m-d',$now);
			$disect = explode("-",$date);
			if($disect[1] == 01){
				$disect[0] = $disect[0]-1;
				$disect[1] = 12;
				$makeTime = mktime(0,0,0,$disect[1],$disect[2],$disect[0]);
				$date = date('Y-m',$makeTime);
			}else{
				$makeTime = mktime(0,0,0,$disect[1]-1,0,$disect[0]);
				$date = date('Y-m',$makeTime);
			}
			$data = $this->Admin->getMonthlyLogCount($date);
			return $data;
		}

		public function users(){
			if($this->session->userdata('username') == "lskey"){
				$data['title'] = "FeedPro | Lock Screen";
				$data['success'] = 1;
				$this->load->view('Lockscreen',$data);
				$this->load->view('Footer',$data);
			}
			else if($this->session->userdata('username') !== null){
				$data['title'] = "FeedPro | Users";
				$this->load->view('Header',$data);
				$this->load->view('Users',$data);
				$this->load->view('Footer',$data);
			}else{
				redirect(base_url()."Admins");
			}
		}

		public function logs(){
			if($this->session->userdata('username') == "lskey"){
				$data['success'] = 1;
				$data['title'] = "FeedPro | Lock Screen";
				$this->load->view('Lockscreen',$data);
				$this->load->view('Footer',$data);
			}
			else if($this->session->userdata('username') !== null){
				$data['title'] = "FeedPro | Users";
				$this->load->view('Header',$data);
				$this->load->view('Logs',$data);
				$this->load->view('Footer',$data);
			}else{
				redirect(base_url()."Admins");
			}
		}

		public function feeds(){
			if($this->session->userdata('username') == "lskey"){
				$data['title'] = "FeedPro | Lock Screen";
				$data['success'] = 1;
				$this->load->view('Lockscreen',$data);
				$this->load->view('Footer',$data);
			}
			else if($this->session->userdata('username') !== null){
				$data['title'] = "FeedPro | Feeds";
				$this->load->view('Header',$data);
				$this->load->view('Feeds',$data);
				$this->load->view('Footer',$data);
			}else{
				redirect(base_url()."Admins");
			}
		}

		public function profile(){
			if($this->session->userdata('username') == "lskey"){
				$data['title'] = "FeedPro | Lock Screen";
				$data['success'] = 1;
				$this->load->view('Lockscreen',$data);
				$this->load->view('Footer',$data);
			}
			else if($this->session->userdata('username') !== null){
				$data['title'] = "FeedPro | Profile";
				$this->load->view('Header',$data);
				$this->load->view('Profile',$data);
				$this->load->view('Footer',$data);
			}else{
				redirect(base_url()."Admins");
			}
		}

		public function lockScreen(){
			$data['title'] = "FeedPro | Lock Screen";
			$data['success'] = 1;
			$this->session->set_userdata('username',"lskey");
			if($_POST){
				$password = $this->input->post('lspassword');
				echo $password;
				if(md5(sha1($password)) == $this->session->userdata('password')){
					$holder = $this->Admin->fetchUser($this->session->userdata('userID'));
					$this->session->set_userdata('username',$holder->username);
					redirect(base_url()."Admins/dashboard");
				}else{
					$data['success'] = 0;
				}
			}
			$this->load->view('Lockscreen',$data);
			$this->load->view('Footer',$data);
		}

		public function fetchUser(){
			$catcher = $this->Admin->fetchUser($_POST["userID"]);
			$data['userID'] =  $catcher->userID;
			$data['fname'] = $catcher->fname;
			$data['lname'] = $catcher->lname;
			$data['username'] = $catcher->username;
			$data['password'] = $catcher->password;
			$data['isActive'] = $catcher->isActive;
			$data['userType'] = $catcher->userType;
			$data['date'] = $catcher->date;
			$imgs = null;
			if(strlen($this->session->userdata('user_image')) > 40){
				$imgs = $this->session->userdata('user_image');
			}else{
				$imgs = base_url().'uploads/'.$this->session->userdata('user_image');
			}
		  if($catcher->img != ''){  
        	$data['img'] = '<img src="'.$imgs.'" class="img-circle" width="50" height="50" /><input type="hidden" name="hidden_user_image" id="hidden_user_image" value="'.$imgs.'" style="margin-left:4px;"/>';  
	      }  
	      else{  
	        $data['img'] = '<input type="hidden" name="hidden_user_image" value="" />';  
	      }  
				echo (json_encode($data));
		}
		public function fetchFeed(){
			$catcher = $this->Admin->fetchFeed($_POST['feedID']);
			$data['feedID'] = $catcher->feedID;
			$data['feedName'] = $catcher->feedName;
			$data['crudeProtein'] = $catcher->crudeProtein;
			$data['crudeFiber'] = $catcher->crudeFiber;
			$data['crudeFat'] = $catcher->crudeFat;
			$data['Calcium'] = $catcher->Calcium;
			$data['Moisture'] = $catcher->Moisture;
			$data['Phosphorous'] = $catcher->Phosphorous;
			$data['maximumInclusion'] = $catcher->feedID;
			$data['costPerKilo'] = $catcher->costPerKilo;
			echo json_encode($data);
		}

		public function updateFeed(){
			if($_POST){
				$feedID = $this->input->post('feedID');
				$form_data = array('costPerKilo'=>$this->input->post('cost'));
				$holder = $this->Admin->updateFeed($feedID,$form_data);
				echo "successful";
			}
		}

		public function updateUser(){
			if($_POST){
				$userID = $this->input->post('userID');
				$username = $this->input->post('username');
				$user_image = null;
				$password = null;
				$isActive = null;
				if($userID == $this->session->userdata('userID')){
					$isActive = 1;
				}else{
					$isActive = intval($this->input->post('isActive'));
				}
				if($_FILES['user_image']['name'] != ''){
					$user_image = $this->upload_image();
				}else{
					$user_image = $this->input->post('hidden_user_image');
				}
				$user = $this->Admin->fetchUser($userID);
				if($this->input->post('password') == $user->password){
					$password = $this->input->post('password');
				}else{
					$password = md5(sha1($this->input->post('password')));
				}
				$form_data = array(
									'fname'=>ucfirst(strtolower(trim($this->input->post('fname')))),
									'lname'=>ucfirst(strtolower(trim($this->input->post('lname')))),
									'username'=>strtolower(trim($username)),
									'password'=>$password,
									'isActive'=>$isActive,
									'userType'=>$this->input->post('userType'),
									'date'=>$this->input->post('date'),
									'img'=>$user_image
				);
				if($this->Admin->duplicateTrapper($username) == true){
					$userHolder = $this->Admin->fetchUser($userID);
					if($userHolder->username == $form_data['username']){
						$this->Admin->updateUser($userID,$form_data);
						echo "success";
						$this->createNotification($userID,'update');
						if($userID == $this->session->userdata('userID')){
							$userHolder = $this->Admin->fetchUser($userID);
							$this->session->set_userdata('username',$userHolder->username);
							$this->session->set_userdata('fname',$userHolder->fname);
							$this->session->set_userdata('lname',$userHolder->lname);
							$this->session->set_userdata('userID',$userHolder->userID);
							$this->session->set_userdata('password',$userHolder->password);
							$this->session->set_userdata('user_image',$userHolder->img);
							echo "success admin";
						}
					}else{
						echo "duplicate";
					}
				}else{
					echo "success";
					$this->createNotification($userID,'update');
					$this->Admin->updateUser($userID,$form_data);
					if($userID == $this->session->userdata('userID')){
						$userHolder = $this->Admin->fetchUser($userID);
						$this->session->set_userdata('username',$userHolder->username);
						$this->session->set_userdata('fname',$userHolder->fname);
						$this->session->set_userdata('lname',$userHolder->lname);
						$this->session->set_userdata('userID',$userHolder->userID);
						$this->session->set_userdata('password',$userHolder->password);
						$this->session->set_userdata('user_image',$userHolder->img);
						echo "success admin";
					}
				}
			}else{
				echo "wa man";				
			}
		}

		public function createUser(){
			if ($_POST) {
				$form_data = array(
								'fname'=>ucfirst(strtolower(trim($this->input->post('fname')))),
								'lname'=>ucfirst(strtolower(trim($this->input->post('lname')))),
								'username'=>strtolower(trim($this->input->post('username'))),
								'password'=>md5(sha1($this->input->post('password'))),
								'isActive'=>intval($this->input->post('isActive')),
								'userType'=>$this->input->post('userType'),
								'img'=>base_url().'assets/img/default.png'
				);
				if($this->Admin->duplicateTrapper($this->input->post('username')) == true){
					echo "duplicatedCreation";
				}else{
					$temp = $this->Admin->createUser($form_data);
					$this->createNotification($temp,'insert');
					echo "created";
				}
			}
		}

		protected function upload_image(){
			if(isset($_FILES['user_image'])){
				$extension = explode(".",$_FILES['user_image']['name']);
				$new_name = rand().".".$extension[1];
				$destination = './uploads/'.$new_name;
				move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
			}
			return $new_name;
		}

		public function logout(){
			$this->session->sess_destroy();
			redirect(base_url()."Admins");
		}

		public function createNotification($userID,$type){
			$form_data = array(
					'userID' => $userID,
					'type' => $type,
					'seen' => 1
			);
			$this->Admin->createNotification($form_data);
		}

		public function getNotifications(){
			$data = $this->Admin->getNotifications();
			$notificationCounter = $this->Admin->countUnreadNotification();
			$sub_array = array();
			if(count($data) == 0){
				$sub_array[] = "
					<li>
						<a href=# class='notification-item'><span class='dot bg-success'></span>"
						."No notifications yet.".
					"</a></li>";
			}else{
				foreach ($data as $value) {
					if($value['type'] == "update"){
						$sub_array[] = "
						<li>
							<a href=# class='notification-item'><span class='dot bg-success'></span>User "
							.$value['lname'].", ".$value['fname']." has been updated.".
						"</a></li>";
					}else{
						$sub_array[] = "
						<li>
							<a href=# class='notification-item'><span class='dot bg-info'></span>"
							.$value['lname'].", ".$value['fname'].". This new User has been created.".
						"</a></li>";
					}
				}
			}
			$output  = array(
				'notifications' => $sub_array,
				'counter' => $notificationCounter
			);
			echo json_encode($output);
		}

		public function readNotification(){
			$data = array(
				'seen' => 0
			);
			$this->Admin->readNotification($data);
		}

		public function forGraphs(){
			$catcher = $this->Admin->forGraphs();
			foreach($catcher as $value){

			}
		}

	}

?>